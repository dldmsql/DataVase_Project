<? if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Model_tools extends CI_Model {

    public function insert( $table, $data )
    {
        if ( !$this->db->insert( $table, $data ) ) return false;

        return $this->db->insert_id();
    }

    public function get( $table, $ID )
    {
        $this->db->where( "ID", $ID );

        $this->db->limit( 1 );

        $result = $this->db->get( $table );

        return $result->row_array();
    }

    public function get_by_where( $table, $where = array(), $order = array(), $limit = 0 )
    {
        $this->db->where( $where );

        if ( sizeof( $order ) > 0 ){
            for ( $i = 0; $i < sizeof( $order ); $i++ ) $this->db->order_by( $order[$i][0], $order[$i][1] );
        }

        if ( $limit > 0 ) $this->db->limit( $limit );

        $result = $this->db->get( $table );

        if ( $limit == 1 ){
            if ( $result->num_rows() == 0 ) return array();
            else return $result->row_array();
        }
        else return $result;
    }

    public function update( $table, $set, $ID )
    {
        $this->db->where( "ID", $ID );

        // 이주현 : $this->db->limit( ) 은 받을 열의 개수를 설정할 때 사용.
        $this->db->limit( 1 );

        return $this->db->update( $table, $set );
    }

    public function update_by_where( $table, $set, $where )
    {
        return $this->db->update( $table, $set, $where );
    }

    public function delete( $table, $ID )
    {
        $this->db->where( "ID", $ID );

        $this->db->limit( 1 );

        return $this->db->delete( $table );
    }

    public function delete_by_where( $table, $where )
    {
        $this->db->where( $where );

        return $this->db->delete( $table );
    }

}

?>