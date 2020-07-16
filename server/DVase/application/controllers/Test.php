<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Test extends CI_Controller {

	public function a() 
	{
		$this->load->view('a');
	}
	
	public function b()
	{
		$this->mentor->b();
		echo "<script> alert( '".date('Y-m-d')."');</script>";
	}
	
	public function c()
	{
		$a = "/a/";
		
		$b = explode( "/", $a);
		echo "사이즈 : ".sizeof($b);
		
		for( $i = 1; $i < sizeof( $b); $i++){
			echo $b[$i];
			echo "<br>";
		}
	}
	
	public function file_upload()
   {
      $this->load->library( "upload" );
     // $this->load->library( "image_lib" );

      $config = array(
         "upload_path"   => "/var/www/html/img/upload",
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
   
   public function form()
	{
		//form을 출력하기 위한 메소드

		$this->load->view( "form" );
	}	

	public function process_post_data()
	{
		//application/views/form.php로부터 전송된 데이터를 처리하기 위한 메소드

		$this->load->model( "model_tools" );
		
		$result = $this->model_tools->get_by_post( $_POST["name"] );
		
		foreach ( $result->result_array() as $row ){
			echo $row[ "name" ]." ".$row[ "id" ]."<br>";	
		}
	}	

}
?>