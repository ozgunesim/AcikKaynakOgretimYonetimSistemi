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
			$result = special_insert('courses', $insertArray);
			return $result;
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
	
	
}
?>