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
				|| $text == "1+1ได้เท่าไหร่?" 
				|| $text == "1+1ได้เท่าไหร่" 
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
			if ($text == "บ้ายบาย" 
				|| $text == "บาย" 
				|| $text == "กูดบาย" )
			{
				$text2 = "โอเคร.. ไว้เจอกันใหม่นะ!";
			}
			if ($text == "ผักกาดขาว")
			{
				$text2 = "ผักกาดขาวเป็นผักกาดชนิดหนึ่งของ ผักกาดจีน ถิ่นกำเนิดใกล้กับปักกิ่ง 
ใช้ระยะเวลาในการปลูกระหว่าง 40 - 50 วัน โดยสามารถเจริญเติบโตได้ดีในอุณหภูมิระหว่าง 21 - 26.6 องศาเซลเซียส ราคาขายท้องตลาดอยู่ที่ 8 - 10 บาทต่อกิโลกรัม
อ่านเพิ่มเติม http://myveget.com/%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B8%9B%E0%B8%A5%E0%B8%B9%E0%B8%81%E0%B8%9C%E0%B8%B1%E0%B8%81%E0%B8%81%E0%B8%B2%E0%B8%94%E0%B8%82%E0%B8%B2%E0%B8%A7.html
";
			}
			if ($text == "ผักบุ้ง")
			{
				$text2 = "ผักบุ้งเป็นพืชที่พบได้ในเขตร้อน ผักบุ้งที่นิยมมาทำอาหารมี 3 สายพันธุ์ คือ ผักบุ้งไทย ผักบุ้งนาและผักบุ้งจีน ใช้ระยะเวลาในการปลูกประมาณ 30 – 45 วัน โดยสามารถเจริญเติบโตได้ดีในอุณหภูมิ มากกว่า 25 องศาเซลเซียสขึ้นไป โดยราคาตามท้องตลาดจะอยู่ที่ประมาณ 12 บาทต่อกิโลกรัม  *อ่านเพิ่มเติมhttp://www.rakbankerd.com/agriculture/page.php?id=7107&s=tblplant";
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