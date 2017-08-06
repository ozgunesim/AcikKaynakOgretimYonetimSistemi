<?php
Class Teacher_model extends CI_Model{
	function __construct(){
		parent::__construct();
		if(!defined('_OK')) define("_OK", "_OK");
		if(!defined('_EMPTY')) define("_EMPTY", "_EMPTY");
		$this->load->database();
	}

	/*public function GetStudentByNumber($num = ""){
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
	}*/

	public function GetTeacherCount(){
		$query = $this->db->select('count(*) as total')->from('users')
		->where('user_auth', 2)
		->where('isActive', '1')
		->get();
		return $query->row()->total;
	}

	public function GetAllTeachers(){
		$query = $this->db->select('users.*, teacher_info.*, auths.*, departments.*, honours.*')
		->from('users')
		->join('teacher_info', 'users.user_id = teacher_info.t_user_id', 'inner')
		->join('auths', 'users.user_auth = auths.auth_id', 'inner')
		->join('departments', 'departments.department_id = teacher_info.department', 'inner')
		->join('honours', 'honours.honour_id = teacher_info.honour', 'inner')
		->where('users.user_auth','2')
		->get();
		return $query->result();
	}

	public function SearchTeacher($params = array(), $page=-1){
		if(!empty($params) && $page != -1){

			if(isset($params['dept'])){
				$this->load->model('departments_model');
				$dept = $this->departments_model->GetDepartmentByCode($params['dept']);
			}

			$this->load->config('pagination');
			$limit = $this->config->item('pagination_limit');
			$this->db->select('users.*, teacher_info.*, auths.*, departments.*, honours.*')
			->from('users')
			->join('teacher_info', 'users.user_id = teacher_info.t_user_id', 'inner')
			->join('auths', 'users.user_auth = auths.auth_id', 'inner')
			->join('departments', 'departments.department_id = teacher_info.department', 'inner')
			->join('honours', 'honours.honour_id = teacher_info.honour', 'inner')
			->where('users.user_auth','2');

			if(isset($params['name'])){
				$this->db->like('users.user_name', $params['name']);
			}

			if(isset($params['honour'])){
				$this->db->like('teacher_info.honour', $params['honour']);
			}

			if(isset($params['email'])){
				$this->db->like('users.user_mail', $params['email']);
			}

			if(isset($params['dept'])){
				$this->db->like('teacher_info.department', $dept->department_id);
			}

			$db2 = clone $this->db;
			$result['all_count'] = $db2->get()->num_rows();
			$result['limited'] = $this->db->limit($limit, ($page-1) * $limit)->get()->result();
			
			return $result;

		}else{
			return _EMPTY;
		}
	}

	//ŞUBELERI DB'YE EKLENME SIRALARINA GORE YENIDEN ADLANDIRIR.
	private function reorder_classes($course, $teacher){
		$all_classes = $this->db->select('*')->from('assigned_courses')
		->where('course', $course)
		->where('teacher', $teacher)
		->get()->result();
		$classIndex = 1;
		foreach ($all_classes as $c) {
			$updateArray = array(
				'class' => $classIndex
				);
			$this->db->where('assign_id', $c->assign_id);
			$this->db->update('assigned_courses', $updateArray);
			$classIndex++;
		}
	}

	/* OGRETMENE SUBE ATAMASI BURADA YAPILACAK */
	public function AssignCourse($params){
		$insertArray = array(
			'course' => $params['course'],
			'teacher' => $params['teacher']
			);
		$this->load->helper('special_insert');
		$result = special_insert('assigned_courses', $insertArray);
		if($result === true)
			$this->reorder_classes($params['course'], $params['teacher']);

		return $result;
	}


	public function DeleteAssignedCourse($a_id = -1){
		if($a_id != -1){
			$temp = $this->db->select('*')->from('assigned_courses')->where('assign_id', $a_id)->get()->row();
			$this->db->where('assign_id', $a_id);
			$this->db->delete('assigned_courses');
			$result = ($this->db->affected_rows() > 0);
			if($result === true)
				$this->reorder_classes($temp->course, $temp->teacher);

			return $result;
		}else{
			return _EMPTY;
		}
	}

	public function SearchAssignments($params = array(), $page= -1){
		if(!empty($params) && $page != -1){

			if(isset($params['dept'])){
				$this->load->model('departments_model');
				$dept = $this->departments_model->GetDepartmentByCode($params['dept']);
			}

			$this->load->config('pagination');
			$limit = $this->config->item('pagination_limit');

			//exit(var_dump($params));

			$this->db->select('users.*, teacher_info.*, auths.*, departments.*, honours.*, assigned_courses.*, courses.*')
			->from('users')
			->join('teacher_info', 'users.user_id = teacher_info.t_user_id', 'inner')
			->join('auths', 'users.user_auth = auths.auth_id', 'inner')
			//->join('departments', 'departments.department_id = teacher_info.department', 'inner')
			->join('honours', 'honours.honour_id = teacher_info.honour', 'inner')
			->join('assigned_courses', 'assigned_courses.teacher = users.user_id', 'inner')
			->join('courses', 'assigned_courses.course = courses.lesson_id', 'inner')
			->join('departments', 'courses.department = departments.department_id', 'inner')
			->where('users.user_auth','2');


			if(isset($params['name'])){
				$this->db->like('users.user_name', $params['name']);
			}

			if(isset($params['honour'])){
				$this->db->like('teacher_info.honour', $params['honour']);
			}

			if(isset($params['email'])){
				$this->db->like('users.user_mail', $params['email']);
			}

			if(isset($params['dept'])){
				$this->db->like('teacher_info.department', $dept->department_id);
			}

			//exit(var_dump($query));

			$db2 = clone $this->db;
			$result['all_count'] = $db2->get()->num_rows();
			$this->db->order_by('course', 'asc');
			$result['limited'] = $this->db->limit($limit, ($page-1) * $limit)->get()->result();
			
			return $result;

		}else{
			return _EMPTY;
		}
	}
	
}
?>