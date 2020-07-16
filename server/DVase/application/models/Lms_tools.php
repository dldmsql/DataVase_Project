<?php 
if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Lms_tools extends CI_Controller {
	
	public function insert( $table, $data )
	{
		if ( !$this->db->insert( $table, $data ) ) return false;

		return $this->db->insert_id();
	}
	
	public function logincheck( $ID,  $PW ){
		
		$this->db->select( "*" );
		
		$this->db->where( "member_ID", $ID );
		$this->db->where( "password", $PW );
		
		$result = $this->db->get( "members" );
		
		return $result->row_array();
	}
	
	public function get( $table )
	{
		$this->db->select( "*" );
		
		return $this->db->get( $table );
	}
}
?>