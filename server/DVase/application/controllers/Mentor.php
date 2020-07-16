<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Mentor extends CI_Controller {

	public function a() 
	{
		$this->load->view('a');
	}
	
	public function b()
	{
		echo "b";
	}
	
	public function send_mail()
	{
		$from = "no-reply@15.164.251.97";
		$header = "From: ".$from."\nContent-Type: text/html";

		$to = "kimkyuri99@daum.net";
		$subject = "메일 제목";
		$content = "메일 내용";

		mail( $to, $subject, $content, $header );
	}
	
	public function test()
	{
	}
	
	public function ffmpeg_test()
	{
		$filename = "http://15.164.251.97/mentor/myvideo.mp4"; //cli실행으로 php test.avi 첫번째 인자를 파일명을 받게함 ,편집요망~
		$movie = new ffmpeg_movie($filename, false); //ffmpeg모듈이 정상적으로 설치돼야합니다

		if (is_object($movie) === false) {
			die("movie Error");
		}

		$duration = floor($movie->getDuration()); //플레이타임 추출
		if ($duration == 0) {
			die("duration Error");
		}

		$codec['video'] = $movie->getVideoCodec();  //비디오코덱추출
		$codec['audio'] = $movie->getAudioCodec();  //오디오코덱추출
		$codec['channel'] = $movie->getAudioChannels(); //채널 추출

		if ($codec['video'] == "") {
			die("video Error");
		}
		 
		$rand = mt_rand(0, 10); //이부분은 프레임중 랜덤하게 추출하는것이라 구간을 작게잡아야 빠릅니다 
		$frame = $movie->getFrame($rand);
		if (is_object($frame) === false) {
			die("frame Error");
		}
		$codec['height'] = $frame->getHeight();
		$codec['width'] = $frame->getWidth();
		
		echo $codec;
	}
	
	
	//Controller
	public function login()
	{	
		$this->model_tols->login_check( $_POST["ID"], $_POST["PW"] );
		
		if( $result->num_rows != 1 ) echo "로그인 실패입니다.";
		else {
			$this->session->set_userdata( "ID", $_POST["ID"] );
		}
		
 	}
	
	//Model_tools
	public function login_check( $ID, $PW )
	{
		$this->db->where( "ID", $ID );
		$this->db->where( "PW", $PW );
		
		$result = $this->db->get( DB이름 );
		
		return $result;
	}
	
	public function mabangjin(){
		$this->load->view( 'mentor/0124-4' );
	}
}
?>