<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Sleep extends CI_Controller {
	
	public function startinsert()
	{
		$this->load->model( "sleep_tools" );
		
		$a = $_POST["nameInsert"];
		
		$data = array(
			"result" => $this->sleep_tools->time_insert( $a )
		);
		
		$this->load->view("sleepview1", $data);
	}
	
	public function endinsert()
	{
		$this->load->model( "sleep_tools" );
		
		$b = $_POST["nameInsert"];
		
		$result = $this->sleep_tools->time_check( $b );
		
		foreach ( $result->result_array() as $row ){
			$c = $row["Registered"];
		}
		
		$sec = strtotime( date( "Y-m-d H:i:s" ) ) - strtotime( $c );
		
		$h = intval( $sec / ( 60 * 60 ) );
		$m = intval( ( $sec - ( $h * 60 * 60 ) ) / 60 );
		
		$hours = "";
		
		if($h>0) $hours = $h."시간";
		
		if($m>0) $hours = $hours." ".$m."분";
		
		echo $hours;
	}
	
}