<?php
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;

$token = "c//eUJe6lMKtCicCrC9eCSE5pHZvRiCgavKE5bI6Jd8ujPcvCubtGWhUloHHixBOumFO6IRkKD+q9+AYcU/0tcylBJcaZpWUhotRTPJbQpLkjbzjjl8Q1UwTw60olaqh0fRR7qi3AEYzFej6zDDoyQdB04t89/1O/w1cDnyilFU=
";
//นำ token ที่มาจาก line developer account ของเรามาใส่ครับ

$httpClient = new CurlHTTPClient($token);
$bot = new LINEBot($httpClient, [‘channelSecret’ => $token]);
// webhook
$jsonStr = file_get_contents(‘php://input’);
$jsonObj = json_decode($jsonStr);
print_r($jsonStr);
foreach ($jsonObj->events as $event) {
if(‘message’ == $event->type){
// debug
//file_put_contents(“message.json”, json_encode($event));
$text = $event->message->text;

if (preg_match(“/สวัสดี/”, $text)) {
$text = “มีอะไรให้ Densha รับใช้ครับ”;
}

if (preg_match(“/สบายดีมั้ย/”, $text)) {     //หากในแชตที่ส่งมามีคำว่า เปิดทีวี ก็ให้ส่ง mqtt ไปแจ้ง server เราครับ

}
$text = “สบายดีครับ”;
}
if (preg_match(“/สบายดี/”, $text) ) {

}
$text = “ดีแล้วๆ รักษาสุขภาพด้วยนะคร้าบ”;
}
$response = $bot->replyText($event->replyToken, $text); // ส่งคำ reply กลับไปยัง line application

}
}

?>