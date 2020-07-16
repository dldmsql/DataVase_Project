<? if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

class Model_tools extends CI_Model {

	public function get_by_test($post_value){
		$this->db->select("gender,name,id");
		$this->db->where("gender",$post_value);
		return $this->db->get("sql_practice");
	} 
	
	public function out($pocketmon){
		
		$this->db->where("name",$pocketmon);
		
		$result=$this->db->get("pocketmon");
		return $result;
	}
}

?>