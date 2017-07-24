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
				if( $this->addOneUser($u, $auth, $departments) !== true )
					return "Kullanıcı eklenirken hata oluştu!";
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
		$insertArray = array(
			'user_mail' => $u->email,
			'user_pw' => md5("default"),
			'user_auth' => $auth,
			'user_name' => $u->name,
			'isActive' => 0
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
					'biography' => $u->biography,
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
	
}
?>