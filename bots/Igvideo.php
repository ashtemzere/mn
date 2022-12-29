
<?php
/*
#------------{@ABoTaim}------------#]

 تغير الحقوق تدل على علامة فشلك *_*

- By : ~ @ABoTaim
- Ch : ~ @Watan_e
- Tw : ~ @ABoTaim_SYBot 

#------------{@ABoTaim}------------#
*/
$API = '1066268413:AAEaB4-2k0vL-kIAQu_n60oAp6RmO13z078';
define('API_KEY',$API);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
}else{
return json_decode($res);
}}
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$text = $message->text;
$username = $message->from->username;
$admin = 559241378; // ئایدی تەلێگرامت
$name = $message->from->first_name;
$Ch = "DanyarExpert"; // یوسەر نەیمی چەنالت بێ @
$join = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=@$Ch&user_id=".$from_id);
#------------{@ABoTaim}------------#
if($message && (strpos($join,'"status":"left"') or strpos($join,'"Bad Request: USER_ID_INVALID"') or strpos($join,'"status":"kicked"'))!== false){
bot('sendmessage',[
'chat_id'=>$chat_id,
    'text'=>" 
• ببورە💁🏻‍♂️ 

• ناتوانی ئەم بۆتە بەکاربێنی
• سەرەتا جۆینی ئەم چەناڵە بکە 

► @$ch

• پاشان Start بکەوە 🔄 " ,
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[

]])]);
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>" 


• name : [$name](tg://user?id=$chat_id) ، 🕸؛
• username :  ، [@$username](tg://user?id=$chat_id) ؛ 🐍
• id : ، [$chat_id](tg://user?id=$chat_id) ؛ 🐢 ",
 'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>'true',
]);return false;}
#------------{@ABoTaim}------------#
$T4TTTT = 457270911; //ايديك
$SAIED = file_get_contents("SAIED.txt");
$SAIED0 = file_get_contents("SAIED0.txt");
$SAIED1= file_get_contents("SAIED1.txt");
$SAIED5 = file_get_contents("SAIED2.txt");
$SAIED6 = file_get_contents("SAIED3.txt");
$SAIED20 = json_decode(file_get_contents('php://input'));
$SAIED18 = $update->message;
$SAIED13 = $SAIED18->chat->id;
$SAIED17 = $SAIED18->text;
$SAIED19 = $SAIED20->callback_query->data;
$SAIED12 = $SAIED20->callback_query->message->chat->id;
$SAIED14 =  $SAIED20->callback_query->message->message_id;
$SAIED15 = $SAIED18->from->first_name;
$SAIED16 = $SAIED18->from->username;
$SAIED11 = $SAIED18->from->id;
$SAIED2 = explode("\n",file_get_contents("SAIED4.txt"));
$SAIED3 = count($SAIED2)-1;
if ($SAIED18 && !in_array($SAIED11, $SAIED2)) {
    file_put_contents("SAIED4.txt", $SAIED11."\n",FILE_APPEND);
  }
if($SAIED17 == "/admin" and $SAIED11 == $T4TTTT){
bot("sendmessage",[
"chat_id"=>$SAIED13,
"text"=>"- هذه لوحة التحكم الخاصة بك ، 🔰
- يمكنك التحكم بجميع اوامر البوت من هنا ، 🐬
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎",
 'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>'true',
'reply_markup'=>json_encode([ 
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"• رسالة توجيه ، ☝️🏻💚"],['text'=>"• رسالة نصية ، ☝️🏻💛"]],
[['text'=>"- عدد المشتركين ، 🐳"]],
[['text'=>"• تفعيل الآشعارات ، 🎨"],['text'=>"• تعطيل الآشعارات ، 🎳"]],
[['text'=>"• تفعيل التواصل ، ⛳️"],['text'=>"• تعطيل التواصل ، 🏉"]],
   ] 
   ])
]);
}
if($text == "🔙" ){
bot('SendMessage',[
'chat_id'=>$chat_id,
"text"=>"  
- هذه لوحة التحكم الخاصة بك ، 🔰
- يمكنك التحكم بجميع اوامر البوت من هنا ، 🐬
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎",
 'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>'true',
'reply_markup'=>json_encode([ 
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"• رسالة توجيه ، ☝️🏻💚"],['text'=>"• رسالة نصية ، ☝️🏻💛"]],
[['text'=>"- عدد المشتركين ، 🐳"]],
[['text'=>"• تفعيل الآشعارات ، 🎨"],['text'=>"• تعطيل الآشعارات ، 🎳"]],
[['text'=>"• تفعيل التواصل ، ⛳️"],['text'=>"• تعطيل التواصل ، 🏉"]],
   ] 
   ])
]);
unlink("SAIED.txt");
}
if($text == "• رسالة توجيه ، ☝️🏻💚" ){
bot('SendMessage',[
    'chat_id'=>$chat_id,
'text'=>"~ أرسل رسالتك وسيتم توجيهها لـ [ $SAIED3 ] مشترك ، 🐙 ",
 'reply_markup'=>json_encode([ 
 'resize_keyboard'=>true,
      'keyboard'=>[
[['text'=>"🔙"]],
]])
]);
file_put_contents("SAIED.txt","SAIED2");
}

if($SAIED18 and $SAIED == "SAIED2" and $SAIED11 == $T4TTTT and $text != '🔙'){
bot("sendmessage",[
"chat_id"=>$SAIED13,
"text"=>'- تم التوجيه بنجاح 🦕',
 'reply_markup'=>json_encode([ 
'resize_keyboard'=>true,
      'keyboard'=>[
[['text'=>"🔙"]],
]])
]);
for($i=0;$i<count($SAIED2); $i++){
bot('forwardMessage', [
'chat_id'=>$SAIED2[$i],
'from_chat_id'=>$SAIED11,
'message_id'=>$SAIED18->message_id
]);
unlink("SAIED.txt");
}
}
if($text == "• رسالة نصية ، ☝️🏻💛"){
bot('SendMessage',[
    'chat_id'=>$chat_id,
'text'=>"~ أرسل رسالتك وسيتم إرسالها لـ [ $SAIED3 ] مشترك ، 🐠",
 'reply_markup'=>json_encode([ 
  'resize_keyboard'=>true,
      'keyboard'=>[
[['text'=>"🔙"]],
]])
]);
file_put_contents("SAIED.txt","SAIED3");
}
if($SAIED17 and $SAIED == "SAIED3" and $SAIED11 == $T4TTTT and $text != '🔙'){
bot("sendmessage",[
"chat_id"=>$SAIED13,
"text"=>'- تم النشر بنجاح 🐋',
 'reply_markup'=>json_encode([ 
'resize_keyboard'=>true,
      'keyboard'=>[
[['text'=>"🔙"]],
]])
]);
for($i=0;$i<count($SAIED2); $i++){
bot('sendMessage', [
'chat_id'=>$SAIED2[$i],
'text'=>$SAIED17
]);
unlink("SAIED.txt");
}
}
if($text == "- عدد المشتركين ، 🐳"){
bot('SendMessage',[
    'chat_id'=>$chat_id,
'text'=>"- عدد مشتركين البوت  [ $SAIED3 ] مشترك ، 🦑",
 'reply_markup'=>json_encode([ 
'resize_keyboard'=>true,
      'keyboard'=>[
[['text'=>"🔙"]],
]])
]);
unlink("SAIED.txt");
}
if($text == "• تفعيل الآشعارات ، 🎨"){
bot('SendMessage',[
    'chat_id'=>$chat_id,
'text'=>'• تم تفعيل الآشعارات ، 🎭',
 'reply_markup'=>json_encode([ 
'resize_keyboard'=>true,
      'keyboard'=>[
[['text'=>'🔙' ,'callback_data'=>"SAIED"]],
]])
]);
file_put_contents("SAIED2.txt","SAIED");
}
if($SAIED17 == "/start" and $SAIED5 == "SAIED" and $SAIED11 != $T4TTTT){
bot("sendmessage",[
"chat_id"=>$T4TTTT,
"text"=>"- عضو جديد قام بالدخول الى البوت ، 🛡
- الاسم ، [$SAIED15](tg://user?id=$chat_id) ، 🦕
- المعرف ، [@$SAIED16](tg://user?id=$chat_id) ، 🐢
- الايدي ، [$SAIED11](tg://user?id=$chat_id) ، 🐝 
﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎﹎
~  عدد المشتركين ، { $SAIED3 } ، 🦑 ",
 'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>'true',
]);
}
if($text == "• تعطيل الآشعارات ، 🎳"){
bot('SendMessage',[
    'chat_id'=>$chat_id,
'text'=>'• تم تعطيل الآشعارات ، 🎯 ',
 'reply_markup'=>json_encode([ 
'resize_keyboard'=>true,
      'keyboard'=>[
[['text'=>"🔙"]],
]])
]);
unlink("SAIED.txt");
unlink("SAIED2.txt");
}
if($text == "• تفعيل التواصل ، ⛳️"){
bot('SendMessage',[
    'chat_id'=>$chat_id,
'text'=>'• تم تفعيل التواصل ، 🧩',
 'reply_markup'=>json_encode([ 
'resize_keyboard'=>true,
      'keyboard'=>[
[['text'=>"🔙"]],
]])
]);
file_put_contents("SAIED3.txt","SAIED");
}
if($SAIED18 and $SAIED6 == "SAIED" and $SAIED11 != $T4TTTT){
bot('forwardMessage', [
'chat_id'=>$T4TTTT,
'from_chat_id'=>$SAIED11,
'message_id'=>$SAIED18->message_id
]);
}
if($SAIED18 and $SAIED6 == "SAIED" and $SAIED11 == $T4TTTT){
bot('sendMessage',[
'chat_id'=>$SAIED18->reply_to_message->forward_from->id,
    'text'=>$SAIED17,
    ]);
}
if($text == "• تعطيل التواصل ، 🏉"){
bot('SendMessage',[
    'chat_id'=>$chat_id,
'text'=>'• تم تعطيل التواصل ، 🎷',
 'reply_markup'=>json_encode([ 
'resize_keyboard'=>true,
      'keyboard'=>[
[['text'=>"🔙"]],
]])
]);
unlink("SAIED.txt");
unlink("SAIED3.txt");
}
if($text == "/start"){
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"-  • سڵاو 👋🏻  ، [$name](tg://user?id=$chat_id)

 •بۆتی دابەزاندنی ڤیدیۆ لە ئینستاگرام ، 📥'
 
 • دەتوانی ھەر  ڤیدیۆیەکت بوێت لە ئینستاگرام  دایبەزێنیت تەنھا لە رێی ناردنی لینکی ڤیدیۆکە🖇
 ",
 'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>'true',
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Danyar Expert",'url'=>'https://t.me/Danyarexpert']],
]])]);}
#------------{@ABoTaim}------------#
if($text !== "/start"){
bot('sendphoto',[
'chat_id'=>$chat_id,
'photo'=>"$text",
'caption'=>"
 • Photo Downloaded",
 'reply_markup'=>json_encode([
'inline_keyboard'=>[

]])]);}
if($text !== "/start"){
bot('Sendvideo',[
'chat_id'=>$chat_id,
'video'=>"$text",
'caption'=>"
• Video Downloaded",
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Danyar Expert ",'url'=>'https://t.me/Danyarexpert']],
]])]);}
if($text !== "/start" and $chat_id != $admin){
bot('SendMessage',[
'chat_id'=>$admin,
'text'=>" Video downloaded ⛳

~ name  ، [$name](tg://user?id=$chat_id) ، 🏈
~ user name ،  [@$username](tg://user?id=$chat_id) ، 🐣
~  id ،  [$chat_id](tg://user?id=$chat_id) ، 🦆 
ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ
•link video ، 👇🏾💞
`$text` ",
 'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>'true',
]);
}
/*
#------------{@ABoTaim}------------#]

 تغير الحقوق تدل على علامة فشلك *_*

- By : ~ @ABoTaim
- Ch : ~ @Watan_e
- Tw : ~ @ABoTaim_SYBot 

#------------{@ABoTaim}------------#
*/
