<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Sleep_tools extends CI_Controller {
	
	public function time_insert( $a )
	{	
		$data = array(
			'name' => $a,
			);
		$this->db->insert( 'sleep', $data);
		
		$this->db->select( "name, Registered" );

		return $this->db->get( "sleep" );
	}
	
	public function time_check( $b )
	{
		$this->db->where( 'name', $b );
		
		$this->db->select("Registered");
		
		return $this->db->get("sleep");
	}
	
/*$sec = strtotime( date( "Y-m-d H:i:s" ) ) - strtotime( $this->study_begun["registered"] );




  $h = intval( $sec / ( 60 * 60 ) );

  $m = intval( ( $sec - ( $h * 60 * 60 ) ) / 60 );




  $hours = "";




  if ( $h > 0 ) $hours = $h."시간";




  if ( $m > 0 ) $hours = $hours." ".$m."분";*/
	
}