<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Tshopping_tools3 extends CI_Model {
	
	public function get_by_post(  )
	{	
		$this->db->select( "name, adress, color, number, Registered" );
		
		return $this->db->get( "torder" );
	}
	
}

?>