<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Model_tools extends CI_Model {
	
	public function get_test()
	{
		$this->db->select( "name, id, password, nickname, phone, e-mail, birthday" );
		
		$this->db->where( "name", "다우다" );
		
		return $this->db->get( "member" );
	}
	
	public function get_multiple_test()
	{
		return $this->db->get( "member" );
	}
	
}

?>