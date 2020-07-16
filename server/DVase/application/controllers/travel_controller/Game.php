<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Game extends CI_Controller {
	
	public function select()
	{
		$this->load->view("gameview1");
	}
	
	public function initial_game(){
		
	}

	public function start(){
		$this->load->view("gameview2");
	}


}//자료구조
?>