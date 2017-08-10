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
	private function reorder_subclasses($course, $teacher){
		$all_classes = $this->db->select('*')->from('assigned_courses')
		->where('course', $course)
		->where('teacher', $teacher)
		->get()->result();
		//exit(var_dump($all_classes)."<br>$course <br> $teacher");
		$classIndex = 1;
		foreach ($all_classes as $c) {
			$updateArray = array(
				'subclass' => $classIndex
				);
			$this->db->where('assign_id', $c->assign_id);
			$this->db->update('assigned_courses', $updateArray);
			$classIndex++;
		}
	}

	/* OGRETMENE SUBE ATAMASI BURADA YAPILACAK */
	public function AssignCourse($params){
		$course = $this->db->select('*')->from('courses')->where('lesson_id', $params['course'])->get()->row();
		$p = $course->practice_hours;
		$t = $course->theoric_hours;

		

		$insertArray = array(
			'course' => $params['course'],
			'teacher' => $params['teacher']
			);
		//$this->load->helper('special_insert');
		$this->db->insert('assigned_courses', $insertArray);
		$result = ($this->db->affected_rows() > 0);

		if($result === true){
			$insert_id = $this->db->insert_id();
			$this->reorder_subclasses($params['course'], $params['teacher']);

			$insertArray = array();

			for($i=0; $i<$t; $i++){
				array_push($insertArray, array(
					'assigned_course' => $insert_id,
					'type' => 1									//teorik ders
				));
			}

			for($i=0; $i<$p; $i++){
				array_push($insertArray, array(
					'assigned_course' => $insert_id,
					'type' => 2									//pratik ders
				));
			}

			$this->db->insert_batch('assigned_course_data', $insertArray);
			$result = ($this->db->affected_rows() > 0);
		}

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

	public function GetAssignedCourses($teacher_id){
		$query = $this->db->select('*')
			->from('assigned_courses')
			->join('assigned_course_data', 'assigned_courses.assign_id = assigned_course_data.assigned_course', 'inner')
			->join('users', 'assigned_courses.teacher = users.user_id', 'inner')
			->join('teacher_info', 'users.user_id = teacher_info.t_user_id', 'inner')
			->join('auths', 'users.user_auth = auths.auth_id', 'inner')
			//->join('departments', 'departments.department_id = teacher_info.department', 'inner')
			->join('honours', 'honours.honour_id = teacher_info.honour', 'inner')
			->join('courses', 'assigned_courses.course = courses.lesson_id', 'inner')
			->join('departments', 'courses.department = departments.department_id', 'inner')
			->where('assigned_courses.teacher', $teacher_id)
			->order_by('course', 'asc');

		$result = $query->get();
		//exit(var_dump($result));
		return $result->result();

	}

	/*
	SELECT *
	FROM `weekly_programs`
	INNER JOIN `weekly_program_data` ON `weekly_programs`.`prog_id` = `weekly_program_data`.`program`
	INNER JOIN `assigned_course_data` ON `assigned_course_data`.`acd_id` = `weekly_program_data`.`assigned_course_data`
	INNER JOIN `assigned_courses` ON `assigned_course_data`.`assigned_course` = `assigned_courses`.`assign_id`
	INNER JOIN `users` ON `assigned_courses`.`teacher` = `users`.`user_id`
	INNER JOIN `courses` ON `assigned_courses`.`course` = `courses`.`lesson_id`
	WHERE `users`.`user_id` = '128'
	*/

	public function GetWeeklyProgram($teacher_id = -1){
		if($teacher_id != -1){
			$query = $this->db->select('weekly_programs.*, weekly_program_data.*, users.*, courses.*, assigned_courses.*, assigned_course_data.*')
			->from('weekly_programs')
			->join('weekly_program_data', 'weekly_programs.prog_id = weekly_program_data.program', 'inner')
			->join('assigned_course_data','assigned_course_data.acd_id = weekly_program_data.assigned_course_data','inner')
			->join('assigned_courses', 'assigned_course_data.assigned_course = assigned_courses.assign_id', 'inner')
			->join('users','assigned_courses.teacher = users.user_id', 'inner')
			->join('courses', 'assigned_courses.course = courses.lesson_id', 'inner')
			->where('users.user_id', $teacher_id)
			->get();

			//exit(var_dump($query));

			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return null;
			}
		}else{
			return _EMPTY;
		}
	}

	public function UpdateWeeklyProgram($teacher_id = -1, $program_array = array()){
		if($teacher_id != -1 && !empty($program_array)){
			$this->db->where('teacher', $teacher_id);
			$this->db->delete('weekly_programs');
			$insertArray = array(
				'teacher' => $teacher_id
			);
			$this->db->insert('weekly_programs', $insertArray);
			$insert_id = $this->db->insert_id();

			$pdata_array = array();
			for($i=0; $i<5; $i++){
				for($j=0; $j<8;$j++){
					if($program_array[$i][$j] != 0){
						$pdata_row = array(
							'program' => $insert_id,
							'day' => $i,
							'hour' => $j,
							'assigned_course_data' => $program_array[$i][$j]
						);
						array_push($pdata_array, $pdata_row);
					}
					
				}
			}
			if(!empty($pdata_array)){
				$this->db->insert_batch('weekly_program_data', $pdata_array);
				return ($this->db->affected_rows() > 0);
			}else{
				return true;
			}
		}else{
			return _EMPTY;
		}
	}
	
}
?>