<?php
Class Notice_model extends CI_Model{
	function __construct(){
		parent::__construct();
		if(!defined('_OK')) define("_OK", "_OK");
		if(!defined('_EMPTY')) define("_EMPTY", "_EMPTY");
		$this->load->database();
	}

	public function AddNotice($txt = "", $sender_id = -1, $type= -1){
		if(!empty($txt) && $sender_id != -1 && $type != -1){
			$insertArray = array(
				'notice_text' => $txt,
				'notice_sender' => $sender_id,
				'notice_type'	=> $type
				);
			$result = $this->db->insert('notices', $insertArray);
			return $result;
		}else{
			return _EMPTY;
		}
	}

	public function DeleteNotice($ntc_id = -1){
		if($ntc_id != -1){
			$result = $this->db->delete('notices', array('notice_id' => $ntc_id));
			return $result;
		}else{
			return _EMPTY;
		}
	}

	public function GetNotices($page=-1){
		if($page != -1){


			//$this->load->config('pagination');
			//$limit = $this->config->item('pagination_limit');
			$limit = 5;
			$this->db->select('notices.*, users.*')
			->from('notices')
			->join('users', 'users.user_id = notices.notice_sender', 'inner');

			$db2 = clone $this->db;
			$result['all_count'] = $db2->get()->num_rows();
			$result['limited'] = $this->db->limit($limit, ($page-1) * $limit)->order_by('notice_id','DESC')->get()->result();
			
			return $result;

		}else{
			return _EMPTY;
		}
	}


}
?>