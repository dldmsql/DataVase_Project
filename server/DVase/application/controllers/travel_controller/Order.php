<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Order extends CI_Controller {
	
	public function mdtools()
	{
		$this->load->model( "shopping_tools" );
		
		/*$v = "꼬맹이";
		
		$n = "우우";*/
		
		$v = $_POST["nameOrder"];
		
		$n = $_POST["adressOrder"];
		
		$d = $_POST["shirtOrder"];
		
		$s = $_POST["numberOrder"];
		
		$data = array(	
			"result" => $this->shopping_tools->get_by_post( $v, $n, $d, $s )
		);
		
		/*$result = $this->model_tools->get_by_post( $v );*/
		
		$this->load->view("shopping2", $data);
	}
	
	public function sh()
	{
		$this->load->view('shopping');
	}
	
}

?>