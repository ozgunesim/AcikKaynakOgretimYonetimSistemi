<?php
Class Student_model extends CI_Model{
	function __construct(){
		parent::__construct();
		if(!defined('_OK')) define("_OK", "_OK");
		if(!defined('_EMPTY')) define("_EMPTY", "_EMPTY");
		$this->load->database();
	}

	public function GetStudentByNumber($num = ""){
		if(!empty($num)){
			$query = $this->db->select('student_info.*, users.*')
					->from('student_info')
					->join('users', 'student_info.s_user_id = users.user_id','inner')
					->like('student_info.number', $num)
					->get();
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return "NOT_FOUND";
			}
		}else{
			return _EMPTY;
		}
	}

	public function GetStudentCount(){
		$query = $this->db->select('count(*) as total')->from('users')
		->where('user_auth', 3)
		->where('isActive', '1')
		->get();
		return $query->row()->total;
	}

	public function GetStudentPage(){
		$this->load->config('pagination');
		$limit = $this->config->item('pagination_limit');
		
	}

	public function SearchStudent($params = array(), $page=-1){
		if(!empty($params) && $page != -1){

			if(isset($params['dept'])){
				$this->load->model('departments_model');
				$dept = $this->departments_model->GetDepartmentByCode($params['dept']);
			}

			$this->load->config('pagination');
			$limit = $this->config->item('pagination_limit');
			$this->db->select('users.*, student_info.*, auths.*, departments.*')
			->from('users')
			->join('student_info', 'users.user_id = student_info.s_user_id', 'inner')
			->join('auths', 'users.user_auth = auths.auth_id', 'inner')
			->join('departments', 'departments.department_id = student_info.department', 'inner')
			->where('users.user_auth','3');

			if(isset($params['name'])){
				$this->db->like('users.user_name', $params['name']);
			}

			if(isset($params['number'])){
				$this->db->like('student_info.number', $params['number']);
			}

			if(isset($params['email'])){
				$this->db->like('users.user_mail', $params['email']);
			}

			if(isset($params['dept'])){
				$this->db->like('student_info.department', $dept->department_id);
			}

			$db2 = clone $this->db;
			$result['all_count'] = $db2->get()->num_rows();
			$result['limited'] = $this->db->limit($limit, ($page-1) * $limit)->get()->result();
			
			return $result;

		}else{
			return _EMPTY;
		}
	}
	
}
?>