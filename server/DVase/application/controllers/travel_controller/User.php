<?php
class User extends CI_Controller
{
    public function index($user_id = null)
    {
	// We load the CI welcome page with some lines of Javascript
		
        $this->load->view('communicate_message', array('user_id' => $user_id));
		
    } 
	
	public function chat()
	{
		$user_nickname = $POST["user_nickname"];
		
		echo $user_id;
		$this->load->view('communicate_message', array('user_nickname' => $user_nickname));
	}
	
	public function setting()
	{
		$this->load->view('communicate_idselect');
	}
}
