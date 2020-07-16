<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Board extends CI_Controller {
	
	public function in()
	{
		$this->load->model( "board_tools" );
		
		$data = array(	
			"result" => $this->board_tools->allview( )
		);
		$this->load->view("boardview", $data);
	}
	public function show()
	{
	    $a = "";
        if(isset($_POST["userId"])){
            $a = $_POST["test"];
        }
	}
	
	public function map()
	{
		$this->load->view("boardmap");
	}
	public function go()
	{
		$this->load->view("boardview");
	}
	
	public function pgmove()
	{
		$this->load->model( "board_tools" );
		
		$pg = $_POST["pageNumber"];		
		
		$data = array(
			"result" => $this->board_tools->pagechange( $pg )
		);
		
		$this->load->view("boardview2", $data);
	}
	
	public function write()
	{
		$this->load->view("boardwrite");
	}

	public function nodeinsert()
	{
		$this->load->model( "board_tools" );
		
		$a = $_POST["titleInsert"];
		
		$b = $_POST["contentInsert"];
		
		$c = $_POST["nameInsert"];
		
		$p = $_POST["passwordInsert"];
		
		$result = $this->board_tools->board_insert_ready( $a, $b, $c, $p );
		
		foreach ( $result->result_array() as $row ){
			$id = $row["Value"];
		}
		$data = array(
			"result" => $this->board_tools->board_insert( $id )
		);
		$this->load->view("boardviewnode", $data);			
	}
	
	public function boinsert()
	{
		$this->load->model( "board_tools" );
		
		$a = $_POST["titleInsert"];
		
		$b = $_POST["contentInsert"];
		
		$c = $_POST["nameInsert"];
		
		$p = $_POST["passwordInsert"];
		
		$result = $this->board_tools->board_insert_ready( $a, $b, $c, $p );
		
		foreach ( $result->result_array() as $row ){
			$id = $row["Value"];
		}
		$data = array(
			"result" => $this->board_tools->board_insert( $id )
		);
		$this->load->view("boardview2", $data);			
	}
	
	public function select()
	{
		$this->load->model( "board_tools" );
		
		$t = $_POST["searchType"];
		
		$c = $_POST["checkThing"];
		
		$data = array(
			"result" => $this->board_tools->board_select( $t, $c )
		);
		$this->load->view("boardview2", $data);
	}
	/*public function nselect()
	{
		$this->load->model( "board_tools" );
		
		$d = $_POST["nameCheck"];
		
		$data = array(
			"result" => $this->board_tools->name_select( $d )
		);
		$this->load->view("boardview2", $data);
		
	}*/
	
	public function conlok()
	{
		$this->load->model( "board_tools" );
		
		$h = $_POST["lookValue"];
		
		$data = array(
			"result" => $this->board_tools->content_look( $h )
		);
		$this->load->view("boardconview", $data);
	}
	
	public function repp()
	{
		$this->load->model( "board_tools" );
		
		$re = $_POST["repValue"];
		
		$data = array(
			"result" => $this->board_tools->board_reply( $re )
		);
		$this->load->view("boardreply", $data);
	}
	
	public function reply()
	{
		$this->load->model( "board_tools" );
		
		$o = $_POST["contentReply"];
		
		$p = $_POST["nameReply"];
		
		$q = $_POST["valueReply"];

		$r = "=> Re : 답변입니다.";
		
		$data = array(
			"result" => $this->board_tools->reply_final( $o, $p, $q, $r )
		);
		$this->load->view("boardcontent", $data);		
	}
	
	public function actionpass()
	{
		$this->load->view("boardpw");
	}
	
	public function pwcheck()
	{
		$this->load->model( "board_tools" );
		
		$p = $_POST["passwordCheck"];
		
		$h = $_POST["lookValue"];
		
		if ( $result = $this->board_tools->password_checking( $p, $h ) ){
		
			foreach ( $result->result_array() as $row ){
				echo $row["Value"];
			}
		}
		else {
			echo "비밀번호가 틀렸습니다.";
		}
		/*$this->load->view("boardview4", $data);*/
	}
	
	public function de()
	{
		$this->load->model( "board_tools" );
		
		$f = $_POST["delValue"];
		
		$data = array(
			"result" => $this->board_tools->general_delete( $f )
		);
		
		$this->load->view("boardcontent", $data);
	}
	/*public function de()
	{
		$this->load->model( "board_tools" );
		
		$f = $_POST["delValue"];
		
		$result = $this->board_tools->value_select( $f );
		
		foreach ( $result->result_array() as $row ){
			$g = $row["name"];
		}
		$data = array(
			"result" => $this->board_tools->value_delete( $f, $g )
		);
		$this->load->view("boardview3", $data);		
	}*/
	public function rere()
	 {		 
		$this->load->model( "board_tools" );
		
		$i = $_POST["recheckValue"];
		
		$data = array(	
			"result" => $this->board_tools->re_write( $i )
		);
		$this->load->view("boardrerewrite", $data);
	} 
	
	public function rewrite()
	{
		$this->load->model( "board_tools" );
		
		$j = $_POST["titleRe"];
		
		$k = $_POST["contentRe"];
		
		$l = $_POST["nameRe"];
		
		$m = $_POST["passwordRe"];
		
		$n = $_POST["valueRe"];
		
		$data = array(
			"result" => $this->board_tools->rewrite_final( $j, $k, $l, $m, $n )
		);
		$this->load->view("boardview2", $data);
	}
	public function upload()
	{
		$this->load->view("uploadview");
	}
	public function file_upload()
   {
      $this->load->library( "upload" );
     // $this->load->library( "image_lib" );

      $config = array(
         "upload_path"   => "/var/www/upload",
         "allowed_types" => "*",
         "max_size"      => 102400,
         "overwrite"     => true
      );

      $this->upload->initialize( $config );

      $FILES = $_FILES;

      /*for ( $i = 0; $i < sizeof( $FILES["userfile"]["name"] ); $i++ ){
         $_FILES["userfile"]["name"] = $FILES["userfile"]["name"][$i];
         $_FILES["userfile"]["type"] = $FILES["userfile"]["type"][$i];
         $_FILES["userfile"]["tmp_name"] = $FILES["userfile"]["tmp_name"][$i];
         $_FILES["userfile"]["error"] = $FILES["userfile"]["error"][$i];
         $_FILES["userfile"]["size"] = $FILES["userfile"]["size"][$i];*/

         if ( $this->upload->do_upload() ) echo "uploaded";
         else echo "failed";
     // }
   }
   public function upload_server()
   {
	   $this->load->library('upload');
	    
		$file_path = "/var/www/upload";
     
    $file_path = $file_path . basename( $_FILES['uploaded_file']['name']);
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
        echo "success";
    } else{
	
        echo "fail";
    }
   }
   
   public function st(){
	   $this->load->view('socket_test');
   }

	public function study(){
		$this->load->view('socket_study');
	}
	public function socket(){
		$a = $_POST["a"];
		
		$this->load->view("socket_studing");
	}
	
	public function popup(){
		$this->load->view("loadpopup");
		
	}
	public function fcm(){
		$this->load->view("appfcm");
	}
	
	public function notifi(){
		$this->load->view("app_notification");
	}

	/*public function re( $value )
	{
		$this->load->model( "board_tools" );
		
		$data = array(	
			"result" => $this->board_tools->allview( )
		);
		$this->load->view("boardrewrite", $data);
	} 
	 travel-plus.co.kr/board/re/$value(숫자 DB내 고유값)를 주소창에 쓰면 그 $value가 주소창에 쓴 숫자와 같은 것. */
		
	/*public function lo()
	{
		$this->load->model( "board_tools" );
		
		$h = $_POST["lookValue"];
		
		$data = array(
			"result" => $this->board_tools->look_select( $h )
		);
		
		$this->load->view("boardview4", $data);
	}*/
	
	public function test(){
		$this->load->model("Board_Tools");
	}
	public function mail(){
		$this->load->view("boardsendmail");
	}
	public function send_mail( $data )
   {
       
      $from = "no-reply@travel-plus.co.kr";

      if ( isset( $data["to"] ) ) $to = $data["to"];
      else $to = "kyuri99@naver.com";

      $content = "";
      if ( isset( $data["content"] ) ) $content = $data["content"];

      $header = "From: ".$from."\nContent-Type: text/html";

      return mail( $to, $data["subject"], $content, $header );
   }
}
?>