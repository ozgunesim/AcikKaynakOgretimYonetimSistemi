<?php
Class Messages_model extends CI_Model{
	function __construct(){
		parent::__construct();
		if(!defined('_OK')) define("_OK", "_OK");
		if(!defined('_EMPTY')) define("_EMPTY", "_EMPTY");
		$this->load->database();
	}

	//SELECT max(message_content), sender, receiver, message_id, max(timestamp) FROM `messages` group by sender
	public function LoadLastMessagesList($user_id = -1){
		if($user_id != -1){
			$query = $this->db
			->select('max(message_content) as message_content, sender, receiver, message_id, max(state) as has_msg, max(timestamp) as timestamp, sender_user.user_name as sender_username, receiver_user.user_name as receiver_username')
			->from('messages')
			->join('users as sender_user','messages.sender = sender_user.user_id','inner')
			->join('users as receiver_user','messages.receiver = receiver_user.user_id','inner');

			$where = "(messages.receiver='" . $this->db->escape_str($user_id) ."' OR messages.sender='" . $this->db->escape_str($user_id) . "')";
			$query = $this->db->where($where)
			->group_by('sender,receiver')
			->get();
			//exit(var_dump($query));
			return ($query->num_rows() > 0) ? $query->result() : null;
		}else{
			return _EMPTY;
		}
	}

	public function GetMesagesBySender($sender_id = -1, $receiver_id = -1){
		if($sender_id != -1 && $receiver_id != -1){
			$this->db
			->select(' message_content, sender, receiver, message_id, timestamp, sender_user.user_name as sender_username, receiver_user.user_name as receiver_username')
			->from('messages')
			->join('users as sender_user','messages.sender = sender_user.user_id','inner')
			->join('users as receiver_user','messages.receiver = receiver_user.user_id','inner');
			//->where('messages.sender', $sender_id)
			//->where('messages.receiver', $receiver_id)
			$where = "(messages.sender='" . $this->db->escape_str($sender_id) ."' AND messages.receiver='" . $this->db->escape_str($receiver_id) . "') OR (messages.sender='" . $this->db->escape_str($receiver_id) ."' AND messages.receiver='" . $this->db->escape_str($sender_id) . "')";
			$query = $this->db->where($where)
			->order_by('messages.message_id','asc')
			->limit(100, 0)
			->get();
			//exit(var_dump($query));
			return ($query->num_rows() > 0) ? $query->result() : null;
		
		}else{
			return _EMPTY;
		}
	}


	public function SendMessage($sender = -1, $target = -1, $content = -1){
		if($sender != -1 && $target != -1 && $content != -1){
			$insertArray = array(
				'sender' => $sender,
				'receiver' => $target,
				'message_content' => $content,
				'state' => '1'
			);
			$this->db->insert('messages', $insertArray);
			return ($this->db->affected_rows() > 0);
		}else{
			return _EMPTY;
		}
	}

}
?>