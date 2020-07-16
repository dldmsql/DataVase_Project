<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller{

	public function mp()
	{
		$this->load->view('mainpage');
	}
	
	public function travel()
	{
		$this->load->view('travel'); 
	}
	
	public function travela($type)
	{
		$this->load->view('travel'); 
	}
	
	
	public function nm()
	{
		$this->load->view('new');
	}
	public function chat()
	{
		$this->load->view('communicate_message');
	}
	
	public function a()
	{
		echo base_url();
	}
}
?>