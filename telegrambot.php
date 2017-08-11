<?php 
//https://api.telegram.org/bot407001013:AAF6aK7jVk4mg9_TmCirow_snw_c96c91NM/getudates - it will display the messages sent from phone in browser wen typed in address bar
// https://api.telegram.org/bot407001013:AAF6aK7jVk4mg9_TmCirow_snw_c96c91NM/sendmessage?chat_id=377563195&text=something - it will send the message to chat bot

$botToken = "407001013:AAF6aK7jVk4mg9_TmCirow_snw_c96c91NM";
$website = "https://api.telegram.org/bot".$botToken;
$update = file_get_contents($website."/getupdates");
$updatearray = json_decode($update, TRUE);

$chat_id = $updatearray["result"][0]["message"]["chat"]["id"];
print_r($chat_id);
print_r($updatearray);

//print_r($text); will print first text (/start)
//file_get_contents($website."/sendmessage?chat_id=".$chat_id."&text=sunday");


 ?>