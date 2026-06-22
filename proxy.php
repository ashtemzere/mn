<?php
declare(strict_types=1);

/*
 * HTTPS bridge for the HTTP-only HLS provider used by this site.
 * Modified to allow ALL hosts (Open Proxy).
 */

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, HEAD, OPTIONS');
header('Access-Control-Allow-Headers: Range, Origin, Accept, Content-Type');
header('Access-Control-Expose-Headers: Content-Length, Content-Range, Content-Type, Accept-Ranges');
header('X-Content-Type-Options: nosniff');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

function proxyError(int $status, string $message): void
{
    http_response_code($status);
    header('Content-Type: text/plain; charset=utf-8');
    echo $message;
    exit;
}

// لێرەدا دەستکاریمان کرد بۆ ئەوەی ڕێگە بە هەموو سایتەکان بدات
function isAllowedStreamUrl(string $url): bool
{
    return true; 
}

function normalizePath(string $path): string
{
    $segments = explode('/', $path);
    $output = [];

    foreach ($segments as $segment) {
        if ($segment === '' || $segment === '.') {
            continue;
        }
        if ($segment === '..') {
            array_pop($output);
            continue;
        }
        $output[] = $segment;
    }

    return '/' . implode('/', $output);
}

function resolveUrl(string $baseUrl, string $reference): string
{
    $reference = trim($reference);
    if ($reference === '') {
        return $baseUrl;
    }
    if (preg_match('~^[a-z][a-z0-9+.-]*://~i', $reference)) {
        return $reference;
    }

    $base = parse_url($baseUrl);
    if ($base === false || !isset($base['scheme'], $base['host'])) {
        return $reference;
    }

    $origin = $base['scheme'] . '://' . $base['host'];
    if (isset($base['port'])) {
        $origin .= ':' . $base['port'];
    }

    if (substr($reference, 0, 2) === '//') {
        return $base['scheme'] . ':' . $reference;
    }
    if ($reference[0] === '/') {
        return $origin . normalizePath($reference);
    }
    if ($reference[0] === '?') {
        return $origin . ($base['path'] ?? '/') . $reference;
    }

    $basePath = $base['path'] ?? '/';
    $directory = substr($basePath, 0, (int) strrpos($basePath, '/') + 1);

    return $origin . normalizePath($directory . $reference);
}

function proxyAddress(string $url): string
{
    $script = $_SERVER['SCRIPT_NAME'] ?? '/stream-proxy.php';
    return $script . '?url=' . rawurlencode($url);
}

function requestUpstream(string $url): array
{
    $headers = [
        'Accept: */*',
        'Connection: keep-alive',
    ];

    if (!empty($_SERVER['HTTP_RANGE'])) {
        $headers[] = 'Range: ' . $_SERVER['HTTP_RANGE'];
    }

    $curl = curl_init($url);
    if ($curl === false) {
        proxyError(500, 'Unable to initialize the stream request.');
    }

    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => true,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_ENCODING => '',
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Linux; Android 14) AppleWebKit/537.36 Chrome/126 Mobile Safari/537.36',
        CURLOPT_HTTPHEADER => $headers,
    ]);

    $response = curl_exec($curl);
    if ($response === false) {
        $message = curl_error($curl);
        curl_close($curl);
        proxyError(502, 'Upstream stream request failed: ' . $message);
    }

    $status = (int) curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
    $headerSize = (int) curl_getinfo($curl, CURLINFO_HEADER_SIZE);
    $contentType = (string) (curl_getinfo($curl, CURLINFO_CONTENT_TYPE) ?: '');
    curl_close($curl);

    return [
        'status' => $status,
        'headers' => substr($response, 0, $headerSize),
        'body' => substr($response, $headerSize),
        'contentType' => $contentType,
    ];
}

$targetUrl = $_GET['url'] ?? '';
if (!is_string($targetUrl) || !isAllowedStreamUrl($targetUrl)) {
    proxyError(403, 'This stream URL is not allowed.');
}

$currentUrl = $targetUrl;
$upstream = null;

for ($redirects = 0; $redirects <= 5; $redirects++) {
    $upstream = requestUpstream($currentUrl);

    if ($upstream['status'] < 300 || $upstream['status'] >= 400) {
        break;
    }

    if (!preg_match('/^Location:\s*(.+)$/mi', $upstream['headers'], $match)) {
        proxyError(502, 'The stream redirect did not include a destination.');
    }

    $nextUrl = resolveUrl($currentUrl, trim($match[1]));
    if (!isAllowedStreamUrl($nextUrl)) {
        proxyError(403, 'The stream redirected to a host that is not allowed.');
    }
    $currentUrl = $nextUrl;
}

if ($upstream === null || ($upstream['status'] >= 300 && $upstream['status'] < 400)) {
    proxyError(508, 'The stream returned too many redirects.');
}

$status = (int) $upstream['status'];
$body = (string) $upstream['body'];
$contentType = (string) $upstream['contentType'];
$isManifest = stripos($contentType, 'mpegurl') !== false
    || substr(ltrim($body), 0, 7) === '#EXTM3U';

if ($isManifest && $status >= 200 && $status < 300) {
    $lines = preg_split('/\r\n|\r|\n/', $body);
    $rewritten = [];

    foreach ($lines as $line) {
        $trimmed = trim($line);

        if ($trimmed !== '' && $trimmed[0] !== '#') {
            $line = proxyAddress(resolveUrl($currentUrl, $trimmed));
        } elseif ($trimmed !== '' && $trimmed[0] === '#') {
            $line = preg_replace_callback(
                '/URI=(["\'])(.*?)\1/i',
                static function (array $match) use ($currentUrl): string {
                    return 'URI=' . $match[1]
                        . proxyAddress(resolveUrl($currentUrl, $match[2]))
                        . $match[1];
                },
                $line
            );
        }

        $rewritten[] = $line;
    }

    $body = implode("\n", $rewritten);
    $contentType = 'application/vnd.apple.mpegurl';
    header('Cache-Control: no-store, no-cache, must-revalidate');
} else {
    header('Cache-Control: public, max-age=30');
}

http_response_code($status);
header('Content-Type: ' . ($contentType !== '' ? $contentType : 'application/octet-stream'));

foreach (['Content-Range', 'Accept-Ranges'] as $headerName) {
    if (preg_match('/^' . preg_quote($headerName, '/') . ':\s*(.+)$/mi', $upstream['headers'], $match)) {
        header($headerName . ': ' . trim($match[1]));
    }
}

header('Content-Length: ' . strlen($body));

if ($_SERVER['REQUEST_METHOD'] !== 'HEAD') {
    echo $body;
}
?>
