<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Tshopping_tools2 extends CI_Model {
	
	public function get_by_post( $e )
	{	
		/*$this->db->select( 'torder', $data);*/
		
		$this->db->select( "name, color, number, Value, Registered" );
		
		$this->db->where( "name", $e );

		return $this->db->get( "torder" );
	}
	
	public function allview()
	{		
		return $this->db->get( "torder" );
	}
}

?>