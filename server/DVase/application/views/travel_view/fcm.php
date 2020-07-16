<?php


function send_notification ($tokens, $jsonMessage)

{

 $url = 'https://fcm.googleapis.com/fcm/send';

$server_key = 'AAAAxnuYhIQ:APA91bFR1WdrWK1xIiSb5a0VWfbKsBI1Pjzwp1Jbqdiey3ElSPT8RTpyax0S2PBmvUGfnaExjqJv0o5Fn-9Aj340j1G7Dc8UqVdA45V3w2GSkhqJbDW4D9laycgP5DHC9v43Pk634qIu';

 $headers = array(

  'Authorization:key =' .$server_key,

  'Content-Type: application/json'

  );



   $ch = curl_init();

   curl_setopt($ch, CURLOPT_URL, $url);

   curl_setopt($ch, CURLOPT_POST, true);

   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

   curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  

   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsonMessage));

   $result = curl_exec($ch);           

   if ($result === FALSE) {

    die('Curl failed: ' . curl_error($ch));

   }

   curl_close($ch);

   return $result;

}



 

// 발송 대상자 디비에 저장한 token 을 가져와 배열에 담는다.

$tokens = array();

$tokens[] = "e_QrCj6a0B0:APA91bFp5056KKdfB4YoPNPnzfz6hYm7xDy0l5Q4C8zOYn4tA5W4GScbohwGPMry0LUFIDqG94ISsSCsowHlY2Gjg3tvi3acQdsBwupn6BNJytbtyzruTrk8gAFByZW6OJV7DQPCTY2Y";

/*

if(mysqli_num_rows($result) >0 ){

 while ($row = mysqli_fetch_assoc($result)) {

  $tokens[] = $row["Token"];

 }

}

*/



// 발송 메시지

$jsonMessage = array(

"to" =>"/topics/news",

"notification" => array("title"=>"타이틀","body"=>"내용"),

"data"=>array("wow"=>"good")

);

 

// 발송

$message_status = send_notification($tokens, $jsonMessage);

echo $message_status;

 

?>