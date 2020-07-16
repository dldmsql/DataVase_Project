<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Model_tools extends CI_Model {
	
	public function get_by_post( $post_value )
	{
		$this->db->select( "name, id, password, nickname, phone, e-mail, birthday" );
		
		$this->db->where( "name", $post_value );
		
		return $this->db->get( "member" );
	}
	
}

?>