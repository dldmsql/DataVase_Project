<?php

 $url = "https://fcm.googleapis.com/fcm/send";
    $token = "e_QrCj6a0B0:APA91bFp5056KKdfB4YoPNPnzfz6hYm7xDy0l5Q4C8zOYn4tA5W4GScbohwGPMry0LUFIDqG94ISsSCsowHlY2Gjg3tvi3acQdsBwupn6BNJytbtyzruTrk8gAFByZW6OJV7DQPCTY2Y";
    $serverKey = 'AAAAxnuYhIQ:APA91bFR1WdrWK1xIiSb5a0VWfbKsBI1Pjzwp1Jbqdiey3ElSPT8RTpyax0S2PBmvUGfnaExjqJv0o5Fn-9Aj340j1G7Dc8UqVdA45V3w2GSkhqJbDW4D9laycgP5DHC9v43Pk634qIu';
    $title = "Notification title";
    $body = "Hello I am from Your php server";
    $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1');
    $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
    $json = json_encode($arrayToSend);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: key='. $serverKey;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    //Send the request
    $response = curl_exec($ch);
    //Close request
    if ($response === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
?>