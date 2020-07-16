<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Testtest extends CI_Controller {
	
	public function process_post_data()
	{
		$this->load->model( "model_tools1" );
		
		$v = $_POST["IdInput"];
		
		$data = array(	
			"result" => $this->model_tools->get_by_post( $v )
		);
		
		/*$result = $this->model_tools->get_by_post( $v );*/
		
		$this->load->view("test_view1", $data);
	}
	
	public function information()
	{
		$this->load->view('testview1');
	}
	
}

?>