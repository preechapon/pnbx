<?php
$strAccessToken = 'Wq9xxsG1gxLCMJba+ZwZ8X/8KMJWgBk6PmqkRPfrM0IoWHCVwuaChqcB+fcKZQ/RxKlZabEzvYM5BePVCSs0bNn/YSVteCjWvWCr67dtNObLd66Zn2oCnHK1Rp/uJ17dRWKuGPdoTqri9lEX+mRdxwdB04t89/1O/w1cDnyilFU=';
 
$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
 
$strUrl = "https://api.line.me/v2/bot/message/reply";
 
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
$xtext = $arrJson['events'][0]['message']['text'];
if($arrJson['events'][0]['message']['text'] == "สวัสดี"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "สวัสดี ID คุณคือ ".$arrJson['events'][0]['source']['userId'] ;
}else if($arrJson['events'][0]['message']['text'] == "ชื่ออะไร"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "<html><body><div style='background-color: #F00; height:20px'>ทดสอบ</div></body></html>";
}else if($arrJson['events'][0]['message']['text'] == "ทำอะไรได้บ้าง"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "ฉันทำอะไรไม่ได้เลย คุณต้องสอนฉันอีกเยอะ";
}else if(substr($xtext,0,1) == "+"){

 $text1 = $arrJson['events'][0]['source']['userId'];
 $text2 = $arrJson['events'][0]['message']['text'];

 $url = "http://202.29.80.36/bizapp/skf/line_order_curl.php"; 
$data = array (
	"lineid" => "$text1",
	"p9" => "$text2"
	);
$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
	$output = curl_exec($ch); 
	curl_close($ch); 
//echo $output;
 
 
 
  $arrPostData = array();
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
 //URL Example : “../line_order_css.php?lineid=luser1&p9=+%2B+ขาหลัง+10” 
 $xArr = explode(" ",$xtext);
  $arrPostData['messages'][0]['text'] = $output; 
 
}else if($arrJson['events'][0]['message']['text'] == "เตือน"){
  $strUrl = "https://api.line.me/v2/bot/message/push";
  $arrPostData = array();
  $arrPostData['to'] = $arrJson['events'][0]['source']['userId'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "นี้คือการทดสอบ Push Message";
}else{
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "ฉันไม่เข้าใจคำสั่ง";
}
 
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$strUrl);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close ($ch);
 
?>
