<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Board_tools extends CI_Controller {

	public function allview( )
	{	
		$this->db->select( "Value, title, name, password, Registered" );
		
		$this->db->limit(15);
	
		$this->db->order_by( 'order DESC, Value ASC' );
	
		return $this->db->get( "board" );
	}
	
	public function pagechange( $pg )
	{
		$pgc = $pg-1;
		
		$this->db->select( "Value, title, name, password, Registered" );
		
		$this->db->limit(15,15*$pgc);
		
		$this->db->order_by ( 'order DESC, Value ASC' );
		
		return $this->db->get( "board" );
	}
	
	public function board_insert_ready( $a, $b, $c, $p )
	{
		$data = array(
			'title' => $a,
			'content' => $b,
			'name' => $c,
			'password' => $p,
			);	
		$this->db->insert('board', $data);
			
		$o = $this->db->insert_id();
	
		$this->db->select( "Value" );
		
		$this->db->where( 'Value', $o );
	
		return $this->db->get( "board" );
	}
	
	public function board_insert( $id )
	{	
		$data = array(
			'order' => $id,
			);
		$this->db->where( 'Value', $id);
		
		$this->db->update( 'board', $data);
		
		$this->db->select( "Value, title, name, password, Registered" );
		
		$this->db->order_by( 'order DESC, Value ASC' );

		return $this->db->get( "board" );
	}
	/*public function board_insert( $a, $b, $c, $p )
	{	
		$data = array(
			'title' => $a,
			'content' => $b,
			'name' => $c,
			'password' => $p,
			);
		$this->db->insert('board', $data);
		
		$this->db->select( "Value, title, name, password, Registered" );

		return $this->db->get( "board" );
	}*/
	public function board_select( $t, $c )
	{
		if ( $t == "제목" ){
			$this->db->select( "Value, title, name, password, Registered" );
			
			$this->db->where( "title", $c );
			
			$this->db->order_by ( 'order DESC, Value ASC' );
			
			return $this->db->get( "board" );
		}
		else {
			$this->db->select("Value, title, name, password, Registered" );
			
			$this->db->where( "name", $c );
			
			$this->db->order_by ( 'order DESC, Value ASC' );
			
			return $this->db->get( "board" );
		}
	}
	/*public function name_select( $d )
	{
		$this->db->select( "Value, title, name, password, Registered" );
		
		$this->db->where( "name", $d );

		return $this->db->get( "board" );
	}*/
	
	public function content_look( $h )
	{
		$this->db->select( "title, name, content, password, Value, Registered" );
		
		$this->db->where( 'Value', $h );
		
		return $this->db->get( "board" );
	}
	
	public function board_reply( $re )
	{
		$this->db->select( "Value" );
		
		$this->db->where( 'Value', $re );
		
		return $this->db->get( "board" );
	}
	
	public function reply_final( $o, $p, $q, $r )
	{
		$data = array(
			'title' => $r,
			'content' => $o,
			'name' => $p,
			);
		$redata = array(
			'order' => $q,
			);
		$this->db->insert('board', $data);
		
		$a = $this->db->insert_id();
		
		$this->db->where( 'Value', $a );
		
		$this->db->update( 'board', $redata );
		
		$this->db->select( "Value, title, name, password, Registered" );
		
		$this->db->order_by( 'order DESC, Value ASC' );
		
		return $this->db->get( "board" );					
	}
	
	public function password_checking( $p, $h )
	{
		$this->db->select( "title, name, content, password, Value" );
		
		$this->db->where( 'password', $p );
		
		$this->db->where( 'Value', $h );
		
		$result = $this->db->get("board");
		
		if ( $result->num_rows() == 0 ) return false; 
		
		return $result;
	}
	
	public function general_delete( $f )
	{
		$this->db->delete('board', array('Value' => $f));
		
		$this->db->select( "Value, title, name, password, Registered" );
		
		$this->db->order_by( 'order DESC, Value ASC' );
		
		return $this->db->get( "board" );
	}
	
	public function re_write( $i )
	{
		$this->db->select( "title, name, content, password, Value" );
		
		$this->db->where( 'Value', $i );
		
		return $this->db->get( "board" );
	}
	
	public function rewrite_final( $j, $k, $l, $m, $n )
	{
		$data = array(
			'title' => $j,
			'content' => $k,
			'name' => $l,
			'password' => $m,
			);
		$this->db->where( 'Value', $n);
		
		$this->db->update( 'board', $data);
		
		$this->db->select( "Value, title, name, password, Registered" );
		
		$this->db->order_by( 'order DESC, Value ASC' );
				
		return $this->db->get( "board" );
	}
	
}