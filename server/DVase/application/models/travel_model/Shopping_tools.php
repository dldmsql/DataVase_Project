<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Shopping_tools extends CI_Model {
	
	public function get_by_post( $v, $n )
	{	$data = array( 
			'name' =>  $v, 
			'adress' =>  $n, 
			'color' => $d,
			'number' => $s,
			);
		$this->db->insert('order', $data);
		
		$this->db->select( "name, adress, color, number, Registered" );
		
		return $this->db->get( "order" );
	}
	
}

?>