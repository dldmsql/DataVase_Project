<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Test extends CI_Controller {
	
	public function index()
	{
		$this->load->model( "model_tools" );
		
		$result = $this->model_tools->get_test();
		
		foreach ( $result->result_array() as $row ){
			echo $row["name"]." ".$row["id"]." ".$row["password"]." ".$row["nickname"]." ".$row["phone"]." ".$row["e-mail"]." ".$row["birthday"]."<br>";
		}
		
		echo "<p>여기서부터 2번째 테스트</p>";
		
		$result_multiple = $this->model_tools->get_multiple_test();
		
		foreach ( $result_multiple->result_array() as $row ){
			echo $row["name"]." ".$row["id"]." ".$row["password"]." ".$row["nickname"]." ".$row["phone"]." ".$row["e-mail"]." ".$row["birthday"]."<br>";
		}
	}
}

?>