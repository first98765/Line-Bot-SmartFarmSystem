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
			switch ($text) {
			    case สวัสดี:
			        $text2 = "สวัสดีครับ";
			        break;
			    case 1+1 ได้เท่าไหร่?:
			        $text2 = "ได้ 2 ไง คิดไม่ได้หรอ";
			        break;
			    case ใครหล่อที่สุด?:
			        $text2 = "เฟิร์สไง ^_^";
			        break;
			    case โสดไหม?:
			    	$text2 = "โสดตัวเท่าบ้าน";
			    	break;
			    case ชื่ออะไร?
			    	$text2 = "ผมชื่อ 'Smart Farm System' ครับ ผมเป็น บอท ตอบข้อความอัตโนมัติครับ";
			    	break;
			    case ใครเป็นคนสร้าง?:
			    	$text2 = "สร้างโดย คุณสุภกิจ บัวสอด";
			    	break;
			    default:
			        $text2 = "ไม่สามารถตอบคำถามได้.."
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