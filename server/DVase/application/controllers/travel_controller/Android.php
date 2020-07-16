<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Android extends CI_Controller {
	
	 public function campus( )
	 {
		 $this->load->model("lms_tools");
		 $name = $this->input->post("type");
		 
		 $result = $this->lms_tools->get( $name );
		 $data = array();
		 
		 foreach( $result->result_array() as $row ){
			 array_push($data,
				array(
					"id"=>$row["ID"],
					"name"=>$row["name"]
				));
		 }
		 
		print json_encode($data);
	 }
	 
	 public function college( )
	 {
		 $this->load->model("lms_tools");
		 $name = $this->input->post("type");
		 
		 $result = $this->lms_tools->get( $name );
		 $data = array();
		 
		 foreach( $result->result_array() as $row ){
			 array_push($data,
				array(
					"id"=>$row["ID"],
					"name"=>$row["name"],
					"campus_ID" => $row["campus_ID"]
				));
		 }
		 
		print json_encode($data);
	 }
	 
	 public function department( )
	 {
		 $this->load->model("lms_tools");
		 $name = $this->input->post("type");
		 
		 $result = $this->lms_tools->get( $name );
		 $data = array();
		 
		 foreach( $result->result_array() as $row ){
			 array_push($data,
				array(
					"id"=>$row["ID"],
					"name"=>$row["name"],
					"college_ID" => $row["college_ID"]
				));
		 }
		 
		print json_encode($data);
	 }
	 
	 public function members()
	 {
		 $this->load->model("lms_tools");
		 $name = $this->input->post("type");
		 
		 $result = $this->lms_tools->get( $name );
		 $data = array();
		 
		 foreach( $result->result_array() as $row ){
			 array_push($data,
				array(
					"id"=>$row["ID"],
					"member_ID"=>$row["member_ID"],
					"pw" => $row["password"],
					"name"=>$row["name"],
					"campus_ID"=>$row["campus_ID"],
					"college_ID" => $row["college_ID"],
					"department_ID"=>$row["department_ID"],
					"number"=>$row["number"],
					"birthday"=>$row["birthday"],
					"phone"=>$row["phone"]
				));
		 }
		 print json_encode($data);
	 }
}
