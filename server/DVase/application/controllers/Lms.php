<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Lms extends CI_Controller {
	
	public $member;
	
	public function index()
	{ 	
		$this->load->model( "lms_tools" );
		$data = array(
			"campus" 	 => $this->lms_tools->get( "campus" ),
			"college"	 => $this->lms_tools->get( "college" ),
			"department" => $this->lms_tools->get( "department" )
		);
			
		$this->load->view( "lms/lmslogin_min", $data );
	}
	
	public function lecture()
	{
		$data = array(
			"campus" 	 => $this->lms_tools->get( "campus" ),
			"college" 	 => $this->lms_tools->get( "college" ),
			"department" => $this->lms_tools->get( "department" )
		);
			
		$this->load->view( "lms/lmslecture", $data );
	}
	
	public function logincheck()
	{
		
		$this->form_validation->set_rules( "ID", "", "required" );
		$this->form_validation->set_rules( "PW", "", "required" );

		if ( !$this->form_validation->run() ){
			
			return false;
		}
		
		$result = $this->lms_tools->logincheck( $this->input->post( "ID" ), $this->input->post( "PW" ) );
		
		if( !$result ) echo $result;
		else{
			$data = array(
				"member" 	 => $result,
				"campus" 	 => $this->lms_tools->get("campus"),
				"college" 	 => $this->lms_tools->get("college"),
				"department" => $this->lms_tools->get("department")
			);	
			$this->load->view( "lms/lmsmain", $data );
		}
	}
	
	public function signupcheck()
	{
		$this->form_validation->set_rules( "id", "", "required" );
		$this->form_validation->set_rules( "password", "", "required" );
		$this->form_validation->set_rules( "name", "", "required" );
		$this->form_validation->set_rules( "campus", "", "required" );
		$this->form_validation->set_rules( "college", "", "required" );
		$this->form_validation->set_rules( "department", "", "required" );
		$this->form_validation->set_rules( "number", "", "required" );
		$this->form_validation->set_rules( "birthday", "", "required" );
		$this->form_validation->set_rules( "phone", "", "required" );
		
		if ( !$this->form_validation->run() ){
			$this->library_tool->error_msg( validation_errors( " ", " " ) );

			return false;
		}
		
		$data = array(
		    "member_ID" 	  => $this->input->post("id"),
			"password" 		  => $this->input->post("password"),
			"name"       	 	  => $this->input->post( "name" ),
			"campus_ID"  	  => $this->input->post("campus"),
			"college_ID" 		  => $this->input->post("college"),
			"department_ID" => $this->input->post("department"),
			"number"     	 	  => $this->input->post( "number" ),
			"birthday" 		  => $this->input->post("birthday"),
			"phone" 			  => $this->input->post("phone")
		);
		
		if ( !$this->lms_tools->insert("members", $data) ) {
			 $this->library_tool->error_msg( ERRORMSG_SIGNUP_FAIL );

            return false;
		}
		
		$this->library_tool->return_true();
	}
}
