<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Ex_controller extends CI_Controller {
	
	public function view_test()
	{
		$data = array(
			"a" => "hi",
			"b" => "hello"
		);
	
		$this->load->view( "ex_view", $data );
	}
	
	public function arg_test( $a )
	{
		echo $a;
	}
	
	public function arg_test1( $a, $b, $c )
	{
		echo $a." ".$b." ".$c;
	}	
}
?>