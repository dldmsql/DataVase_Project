<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Test extends CI_Controller {
	
	public function process_post_data()
	{
		$this->load->model( "model_tools" );
		
		$v = $_POST["IdInput"];
		
		$data = array(	
			"result" => $this->model_tools->get_by_post( $v )
		);
		
		/*$result = $this->model_tools->get_by_post( $v );*/
		
		$this->load->view("test_view", $data);
	}
	
	public function a(){
		echo "a";
	}	
	
	public function information()
	{
		$this->load->view('testview');
	}

    public function android(){
	    $this->load->view('boardview');

    }
}
?>