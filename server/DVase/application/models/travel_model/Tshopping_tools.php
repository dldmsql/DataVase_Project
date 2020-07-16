<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Tshopping_tools extends CI_Model {
	
	public function allview()
	{		
		return $this->db->get( "torder" );
	}
	
	public function get_by_post( $a, $b, $c, $d )
	{	$data = array( 
			'name' =>  $a, 
			'adress' =>  $b, 
			'color' =>  $c,
			'number' =>  $d,
			);
		$this->db->insert('torder', $data);
		
		$this->db->select( "name, adress, color, number, Value, Registered" );
		
		return $this->db->get( "torder" );
	}
	
	public function name_select( $e )
	{	
		/*$this->db->select( 'torder', $data);*/
		
		$this->db->select( "name, color, number, Value, Registered" );
		
		$this->db->where( "name", $e );

		return $this->db->get( "torder" );
	}
	
	public function id_select( $f )
	

	{
		$this->db->select( "name, Value" );
		
		$this->db->where( 'Value' , $f );
	
		return $this->db->get( "torder" );
		
	}	
	
	public function id_delete( $f, $g ) 
	
	{
	
		/*$this->db->where('Value', $f);
	
		$this->db->delete('torder');*/	
		
		$this->db->delete('torder', array('Value' => $f));
		
		$this->db->select( "name, color, number, Value, Registered" );
		
		$this->db->where( "name", $g );
		
	
		return $this->db->get( "torder" );
	
	}
	
	

	
}

?>