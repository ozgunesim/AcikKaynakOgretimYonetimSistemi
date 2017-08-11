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
			->join('enrolments', 'enrolments.student = users.user_id')
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

			if(isset($params['enrol_id'])){
				$this->db->where('enrolments.enrol_id', $params['enrol_id']);
			}

			$db2 = clone $this->db;
			$result['all_count'] = $db2->get()->num_rows();
			$result['limited'] = $this->db->limit($limit, ($page-1) * $limit)->get()->result();
			
			return $result;

		}else{
			return _EMPTY;
		}
	}

	public function GetEnrolments($weekly_program_data = -1){
		if($weekly_program_data != -1){
			$this->db->select('*')
			->from('weekly_program_data')
			->join('assigned_course_data','weekly_program_data.assigned_course_data = assigned_course_data.acd_id', 'inner')
			->join('assigned_courses', 'assigned_courses.assign_id = assigned_course_data.assigned_course', 'inner')
			->join('enrolments', 'assigned_courses.assign_id = enrolments.assigned_course', 'inner')
			//->join('courses', 'courses.lesson_id = assigned_courses.course', 'inner')
			->join('users', 'users.user_id = enrolments.student','inner')
			->join('student_info', 'student_info.s_user_id = users.user_id', 'inner')
			->join('departments', 'departments.department_id = student_info.department','inner')
			->where('weekly_program_data.p_data_id', $weekly_program_data);
			$query = $this->db->get();
			//exit(var_dump($query));
			if($query->num_rows() > 0){
				//exit(var_dump($query->result()));
				return $query->result();
			}else{
				return null;
			}
		}else{
			return _EMPTY;
		}
	}
	
}
?>