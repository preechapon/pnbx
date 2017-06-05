<?php

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	$access_token = 'Wq9xxsG1gxLCMJba+ZwZ8X/8KMJWgBk6PmqkRPfrM0IoWHCVwuaChqcB+fcKZQ/RxKlZabEzvYM5BePVCSs0bNn/YSVteCjWvWCr67dtNObLd66Zn2oCnHK1Rp/uJ17dRWKuGPdoTqri9lEX+mRdxwdB04t89/1O/w1cDnyilFU=';
	/*
	$url = 'https://api.line.me/v1/oauth/verify';
	$headers = array('Authorization: Bearer ' . $access_token);
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$result = curl_exec($ch);
	curl_close($ch);
	echo $result;
	*/
	//
	//bot
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			// Build message to reply back
			$xid=$event['events']['source']['userId'];
			$messages = [
				'type' => 'text',
				'text' => $text . " <i> rrrr </i> " . $xid . " ----- "
				
				//'text' => $text." http://202.29.80.36/bizapp/skf_store/ ".$result . ' rrrrr  x ' . $replyToken
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
			echo $result . "<i> xxxx </i>  " . "\r\n";
			//echo "OK";
			//header( "location: https://enigmatic-fjord-20579.herokuapp.com/xdetails.php" );
			//exit(0);

			
		}
	}
}

echo "OK";

?>
