<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Pet extends CI_Controller {
	
	
	public function show()
	{
		$this->load->view("petview");
	}
	
	
	
}
?>