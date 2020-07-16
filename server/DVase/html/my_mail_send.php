<?
	$from = "no-reply@15.164.251.97";
	$header = "From: ".$from."\nContent-Type: text/html";

	$to = "kyuri99@naver.com";
	$subject = "메일 제목";
	$content = "메일 내용";

	mail( $to, $subject, $content, $header );
?>