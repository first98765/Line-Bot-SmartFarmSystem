<?php
$access_token = '7gsRtLv7z3SC7cvikYXv7nhQ8rylow7Uw3iJ9gi97nY2PAtvULeW9RIHHaVgDeOQaojhxm/EJmLTXNJWNsTMi78lOuwnP76ZB1AI64OHKAOVg7a76JNQj5v5U+XzkeKyiX4nFCB7dJ23KlE4JpxLEgdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;