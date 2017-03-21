<?php
$access_token = '7gsRtLv7z3SC7cvikYXv7nhQ8rylow7Uw3iJ9gi97nY2PAtvULeW9RIHHaVgDeOQaojhxm/EJmLTXNJWNsTMi78lOuwnP76ZB1AI64OHKAOVg7a76JNQj5v5U+XzkeKyiX4nFCB7dJ23KlE4JpxLEgdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			if ($text == "สวัสดี" 
				|| $text == "หวัดดี" 
				|| $text == "ดี"
				|| $text == "ดีๆ")
			{
				$text2 = "สวัสดีครับ";
			}
			if ($text == "1+1 ได้เท่าไหร่?" 
				|| $text == "1+1เท่ากับเท่าไหร่" 
				|| $text == "1+1เท่ากับ?" 
				|| $text == "1+1เท่ากับ")
			{
				$text2 = "ได้ 2 ไง คิดไม่ได้หรอ";
			}
			if ($text == "ใครหล่อที่สุด?" 
				|| $text == "ใครสวยที่สุด" 
				|| $text == "ใครสวย" 
				|| $text == "ใครสวย?" 
				|| $text == "ใครหล่อ" 
				|| $text == "ใครหล่อ?")
			{
				$text2 = "คนที่คุณก็รู้ว่าใคร.. >_<";
			}
			if ($text == "โสดไหม?" 
				|| $text == "โสดป่าว"
				|| $text == "โสดไหม" 
				|| $text == "โสดหรือป่าว")
			{
				$text2 = "โสดตัวเท่าบ้าน";
			}
			if ($text == "ชื่ออะไร?" 
				|| $text == "ชื่ออะไร" 
				|| $text == "ชื่อไรอะ?" 
				|| $text == "ชื่อไรอะ" 
				|| $text == "ชื่อไรอะ?")
			{
				$text2 = "ผมชื่อ 'Smart Farm System' ครับ ผมเป็น บอท ตอบข้อความอัตโนมัติครับ";
			}
			if ($text == "ใครเป็นคนสร้าง?" 
				|| $text == "ใครเป็นคนสร้าง" 
				|| $text == "ใครสร้าง?" 
				|| $text == "ใครสร้าง")
			{
				$text2 = "สร้างโดย คุณสุภกิจ บัวสอด";
			}

			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text2
			];

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
		}
	}
}
echo "OK";