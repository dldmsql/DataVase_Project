<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Torder extends CI_Controller {
	
	
	public function sh()
	{ 
		
		$this->load->model( "tshopping_tools" );
		
		
		$e = "김규리";
		
		$data = array(	
			"result" => $this->tshopping_tools->allview( )
		);
		
		/*$result = $this->model_tools->get_by_post( $v );*/
		
		$this->load->view("tshopping", $data);
		
	}
	
	public function mdtools()
	{
		$this->load->model( "tshopping_tools" );
		
		/*$v = "꼬맹이";
		
		$n = "우우";*/
		
		$a = $_POST["nameOrder"];
		
		$b = $_POST["adressOrder"];
		
		$c = $_POST["colorOrder"];
		
		$d = $_POST["numberOrder"];
		
		$data = array(	
			"result" => $this->tshopping_tools->get_by_post( $a, $b, $c, $d )
		);
		
		/*$result = $this->model_tools->get_by_post( $v );*/
		
		$this->load->view("tshopping2", $data);
	}
	
	public function mdcheck()
	{
		$this->load->model( "tshopping_tools" );
		
		/*$e = "김규리";*/
		
		$e = $_POST["nameCheck"];
		
		$data = array(	
			"result" => $this->tshopping_tools->name_select( $e )
		);
		
		/*$result = $this->model_tools->get_by_post( $v );*/
		
		$this->load->view("tshopping3", $data);
	}
	
	
	
	public function de()
	{
		$this->load->model( "tshopping_tools" );

		$f = $_POST["delValue"];
		
		/*$f = "9";*/
		
		
		$result = $this->tshopping_tools->id_select( $f );
	
		
		foreach ( $result->result_array() as $row ){
		$g = $row["name"];
		}
		
				
		$data = array(	
			"result" => $this->tshopping_tools->id_delete( $f, $g )
		);
		
		$this->load->view("tshopping4", $data);
		
	}
	
}

?>