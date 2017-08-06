<?php
Class User_model extends CI_Model{
	function __construct(){
		parent::__construct();
		if(!defined('_OK')) define("_OK", "_OK");
		if(!defined('_EMPTY')) define("_EMPTY", "_EMPTY");
		$this->load->database();
		$this->load->helper('special_insert');
	}

	public function GetUser($email = "", $pw = ""){
		if($email != "" && $pw != ""){
			$query = $this->db->select('users.*, auths.*')
			->from('users')
			->join('auths', 'users.user_auth = auths.auth_id','inner')
			->where('users.user_mail', $email)
			->where('users.user_pw', strtolower(md5($pw)))
			->get();
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return null;
			}
		}else{
			return _EMPTY;
		}
	}

	public function GetAuthList(){
		$query = $this->db->select('*')->from('auths')->get();
		return $query->result();
	}

	public function AddUserList($userArray = array(), $auth = -1){
		if(!empty($userArray) && $auth != -1){
			$departments = $this->db->select('*')->from('departments')->get()->result_array();
			foreach ($userArray as $u) {
				$result = $this->addOneUser($u, $auth, $departments) !== true ;
				/*if($result !== true)
				return $result;*/
			}
			return true;
		}else{
			exit(var_dump($userArray) . 'bos hatasi');
			return;
			return _EMPTY;
		}
	}
	private function addOneUser($u, $auth, $departments){
		//exit(print_r($userArray));
		if(isset($u->surname)){
			$u->name = $u->name . ' ' . $u->surname;
		}
		$isActive = ($auth == 2) ? 1 : 0;
		$insertArray = array(
			'user_mail' => $u->email,
			'user_pw' => md5("default"),
			'user_auth' => $auth,
			'user_name' => $u->name,
			'isActive' => $isActive
			);

		$inserted = special_insert('users',$insertArray);
		if($inserted === true){
			$id = $this->db->insert_id();
			if($auth == 2){
				$dep = $this->getDeptID($departments, $u->department);
				if($dep == null)
					return "bölüm hatası";
				$infoArray = array(
					't_user_id' => $id,
					'biography' => $u->bio,
					'honour' => $u->honour,
					'department' => $dep
					);
				//$this->db->insert('teacher_info', $infoArray);
				return special_insert('teacher_info', $infoArray);
				//return true;
			}else if($auth == 3){
				$dep = $this->getDeptID($departments, $u->department);
				if($dep == null)
					return "bölüm hatası";
				$infoArray = array(
					's_user_id' => $id,
					'number' => $u->number,
					'department' => $dep
					);
				//$this->db->insert('student_info', $infoArray);
				return special_insert('student_info', $infoArray);
				//return true;
			}else{
				return('auth hatası');
			}
		}else{
			return($inserted);
		}
	}


	public function AddUser($user = "", $auth = -1){
		if(!empty($user) && $auth != -1){
			$departments = $this->db->select('*')->from('departments')->get()->result_array();
			return $this->addOneUser($user, $auth, $departments);
		}else{
			return _EMPTY;
		}
	}

	private function getDeptID($list, $code){
		//exit(print_r($list));
		foreach ($list as $dep) {
			if($dep['department_code'] == $code)
				return $dep['department_id'];
		}
		return null;
	}

	public function GetUserByName($name = ""){
		if(!empty($name)){
			$query = $this->db->select('*')->from('users')->like('user_name', $name)->get();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return "NOT_FOUND";
			}
		}else{
			return _EMPTY;
		}
	}

	public function BanUser($user_id = -1){
		if($user_id != -1){
			$data = array(
				'isActive' => '0'
				);
			$this->db->where('user_id', $user_id);
			$this->db->update('users', $data);
			return true;
		}else{
			return _EMPTY;
		}
		
	}

	public function ActivateUser($user_id = -1){
		if($user_id != -1){
			$data = array(
				'isActive' => '1'
				);
			$this->db->where('user_id', $user_id);
			$this->db->update('users', $data);
			return true;
		}else{
			return _EMPTY;
		}
		
	}

	public function ChangeUserName($name = "", $user_id = -1){
		if(!empty($name) && $user_id != -1){
			$updateArray = array(
				'user_name' => $name
				);
			$this->db->where('user_id', $user_id);
			$this->db->update('users', $updateArray);
			$result = ($this->db->affected_rows() > 0);
			if($result === true){
				if($result === true){
					$this->ReloadUser();
				}
			}
			return $result;
		}else{
			return _EMPTY;
		}
	}

	public function ChangeEmail($email = "", $user_id = -1){
		if(!empty($email) && $user_id != -1){
			$updateArray = array(
				'user_mail' => $email
				);
			$this->db->where('user_id', $user_id);
			$this->db->update('users', $updateArray);
			$result = ($this->db->affected_rows() > 0);
			if($result === true){
				$this->ReloadUser();
			}
			return $result;
		}else{
			return _EMPTY;
		}
	}

	public function ReloadUser($user_id = -1){
		$this->db->select('users.*, auths.*')
		->from('users')
		->join('auths', 'users.user_auth = auths.auth_id','inner');

		if($user_id == -1){
			$user_sess = $this->session->userdata('user');
			$this->db->where('users.user_id', $user_sess->user_id);
		}else{
			$this->db->where('users.user_id', $user_id);
		}
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$result = $query->row();
			$this->session->set_userdata('user', $result);
			return $result;
		}else{
			return null;
		}
	}
	
}
?>