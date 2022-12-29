<?php
$callLinks = new Func("callLinks", function() use (&$code, &$document, &$window, &$errorMessage) {
  $code = get(call_method($document, "getElementById", "code"), "value");
  switch ($code) {
    case "1":
      set(get($window, "location"), "href", "https://kurdapp.tk/app");
      break;
    case "":
      set($errorMessage, "innerHTML", "\xDA\x98\xD9\x85\xD8\xA7\xD8\xB1\xDB\x95\xDB\x8C \xD9\xBE\xD9\x88\xD8\xB3\xD8\xAA\xDB\x95\xDA\xA9\xDB\x95 \xD8\xAF\xD8\xA7\xD8\xAE\xD9\x84 \xD8\xA8\xDA\xA9\xDB\x95");
      set($errorMessage, "style", "text-align:center;font-size:25px;color: white;font-family: UniQAIDAR_KAMARAN;");
      break;
    default:
      set($errorMessage, "innerHTML", "\xD8\xA6\xDB\x95\xD9\x85 \xDA\x98\xD9\x85\xD8\xA7\xD8\xB1\xDB\x95\xDB\x8C\xDB\x95 \xD8\xAA\xD9\x88\xD9\x85\xD8\xA7\xD8\xB1 \xD9\x86\xDB\x95\xDA\xA9\xD8\xB1\xD8\xA7\xD9\x88\xDB\x95");
      set($errorMessage, "style", "text-align:center;font-size:25px;color: white;font-family: UniQAIDAR_KAMARAN;");
      break;
  }
});
$getIt = call_method($document, "getElementById", "get");
$errorMessage = call_method($document, "getElementById", "P-For-Errors");
call_method($getIt, "addEventListener", "click", $callLinks);
