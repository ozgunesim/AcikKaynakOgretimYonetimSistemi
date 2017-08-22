<?php
Class Course_model extends CI_Model{
	function __construct(){
		parent::__construct();
		if(!defined('_OK')) define("_OK", "_OK");
		if(!defined('_EMPTY')) define("_EMPTY", "_EMPTY");
		$this->load->database();
		$this->load->helper('special_insert');
	}

	public function GetCourseCount(){
		$query = $this->db->select('count(*) as total')->from('courses')->get();
		return $query->row()->total;
	}

	public function GetAllCourses(){
		$query = $this->db->select('courses.*, departments.*')
		->from('courses')
		->join('departments', 'departments.department_id = courses.department', 'inner')
		->get();
		return $query->result();
	}

	public function AddSemester($start = -1, $end = -1, $courses_start = -1, $courses_end = -1, $name = ""){
		if(!empty($name) && $start != -1 && $end != -1){
			$insertArray = array(
				'start_date' => $start,
				'end_date' => $end,
				'courses_start_date' => $courses_start,
				'courses_end_date' => $courses_end,
				'semester_name' => $name
			);
			$this->db->insert('semesters', $insertArray);
			return ($this->db->affected_rows() > 0);
		}else{
			return _EMPTY;
		}
	}

	public function GetSemesters(){
		return $this->db->select('*')->from('semesters')->get()->result();
	}

	public function GetCurrentSemester(){
		$query = $this->db->select('*')->from('semesters')
		->where('start_date <= ', date('Y-m-d'))
		->where('end_date >=', date('Y-m-d'))
		->get();

		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return null;
		}
	}

	public function AddCourse($newCourse = array()){
		if(!empty($newCourse)){
			$this->load->model('departments_model');
			$dept = $this->departments_model->GetDepartmentByCode($newCourse['department'])->department_id;
			$insertArray = array(
				'lesson_code' => $newCourse['optic'],
				'lesson_name' => $newCourse['name'],
				'practice_hours' => $newCourse['practice'],
				'theoric_hours' => $newCourse['theoric'],
				'akts' => $newCourse['akts'],
				'department'  => $dept
			);
			//exit(var_dump($insertArray));
			$result = $this->db->insert('courses', $insertArray);
			if($this->db->affected_rows() > 0){
				return true;
			}else{
				return 'Ders Eklenemedi. Böyle bir ders zaten olabilir.';
			}
		}else{
			return _EMPTY;
		}
	}

	public function SearchCourse($params = array(), $page=-1){
		if(!empty($params) && $page != -1){
			$query = $this->db->select('courses.*, departments.*')->from('courses')
			->join('departments', 'departments.department_id = courses.department', 'inner');
			foreach ($params as $key => $value) {
				if(!empty($value) && $value != null)
					$this->db->like($key, $value);
			}
			$db2 = clone $this->db;
			$result['all_count'] = $db2->get()->num_rows();

			//exit(var_dump($params));

			$this->load->config('pagination');
			$limit = $this->config->item('pagination_limit');
			$result['limited'] = $this->db->limit($limit, ($page-1) * $limit)->get()->result();
			return $result;
		}else{
			return _EMPTY;
		}
	}

	public function DeleteCourse($c_id = -1){
		if($c_id != -1){
			$result = $this->db->delete('courses', array('lesson_id' => $c_id));
			return $result;
		}else{
			return _EMPTY;
		}
	}

	public function GetCourseByWeeklyProgramData($p_data_id = -1){
		if($p_data_id != -1){
			$this->db->select('courses.*')
			->from('weekly_program_data')
			->join('assigned_course_data','assigned_course_data.acd_id = weekly_program_data.assigned_course_data', 'inner')
			->join('assigned_courses', 'assigned_courses.assign_id = assigned_course_data.assigned_course', 'inner')
			->join('courses','courses.lesson_id = assigned_courses.course','inner')
			->where('weekly_program_data.p_data_id', $p_data_id);
			$query = $this->db->get();
			if($this->db->affected_rows() > 0){
				return $query->result();
			}else{
				return null;
			}
		}else{
			return _EMPTY;
		}
	}

	public function GetSubclassByDay($day = -1, $user = -1, $course = -1, $subclass = -1 ){
		if($day != -1 && $user != -1 && $course != -1 && $subclass != -1){
			$query = $this->db->select('*')
			->from('weekly_program_data')
			->join('assigned_course_data','assigned_course_data.acd_id = weekly_program_data.assigned_course_data', 'inner')
			->join('assigned_courses', 'assigned_courses.assign_id = assigned_course_data.assigned_course', 'inner')
			->join('courses','courses.lesson_id = assigned_courses.course', 'inner')
			->where('weekly_program_data.day', $day)
			->where('assigned_courses.teacher', $user)
			->where('assigned_courses.course', $course)
			->where('assigned_courses.subclass', $subclass)
			->get();
			return ($query->num_rows() > 0) ? $query->result() : null;
		}else{
			return _EMPTY;
		}
	}


	
	
}
?>