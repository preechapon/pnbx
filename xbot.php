<?php

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	$access_token = 'Wq9xxsG1gxLCMJba+ZwZ8X/8KMJWgBk6PmqkRPfrM0IoWHCVwuaChqcB+fcKZQ/RxKlZabEzvYM5BePVCSs0bNn/YSVteCjWvWCr67dtNObLd66Zn2oCnHK1Rp/uJ17dRWKuGPdoTqri9lEX+mRdxwdB04t89/1O/w1cDnyilFU=';
	//
	//bot
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			
//
// A very simple PHP example that sends a HTTP POST to a remote site
//

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://202.29.80.36/bizapp/skf_store/line_order.php?p9=luser1+ยืนยัน");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
	    "p9=". $text);
            

// in real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS, 
//          http_build_query(array('postvar1' => 'value1')));

// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

curl_close ($ch);

// further processing ....
if ($server_output == "OK") { 
	$xMsg="OK";
} else {
	$xMsg="No";
}

			
			
			
			
			//echo "OK";
			//header( "http://202.29.80.36/bizapp/skf_store/line_order.php?p9=luser1+%2B+%E0%B8%82%E0%B8%B2%E0%B8%AB%E0%B8%A5%E0%B8%B1%E0%B8%87+15");
			//exit(0);
			// Get replyToken
			$replyToken = $event['replyToken'];
			// Build message to reply back
			$xid=$events['userid'];
			$messages = [
				'type' => 'text',
				'text' => $xMsg . " ----- " . $text
				//'type' => 'URL',
				//'URL' => "http://202.29.80.36/bizapp/skf_store/"
				
				//'text' => $text." http://202.29.80.36/bizapp/skf_store/".$result . ' rrrrr  x ' . $replyToken
			];
			//test 
		   	//test
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			echo $result . "\r\n";
			//echo "OK";
			//header( "location: https://enigmatic-fjord-20579.herokuapp.com/xdetails.php" );
			//exit(0);

			
		}
	}
}

echo "OK";

?>
