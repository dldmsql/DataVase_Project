<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Tshopping_delete extends CI_Model {
	
	public function get_by_post( $dd ) 
	
	/*$this->db->where('Value', $dd);
	
	$this->db->delete('torder');*/
	
	$this->db->delete('torder', array('Value' => $dd));
	
	return $this->db->get( "torder" );
	
	}
	
}

?>