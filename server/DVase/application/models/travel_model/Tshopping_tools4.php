<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Tshopping_tools4 extends CI_Model {
	
	public function get_by_post( $f ) 
	
	{
	
	/*$this->db->where('Value', $f);
	
	$this->db->delete('torder');*/
	
	$this->db->delete('torder', array('Value' => $f));
	
	return $this->db->get( "torder" );
	
	}
	
}

?>