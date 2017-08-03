<?php
Class Departments_model extends CI_Model{
	function __construct(){
		parent::__construct();
		if(!defined('_OK')) define("_OK", "_OK");
		if(!defined('_EMPTY')) define("_EMPTY", "_EMPTY");
		$this->load->database();
	}

	public function GetDepartmentCount(){
		$query = $this->db->select('count(*) as total')->from('departments')->get();
		return $query->row()->total;
	}


	public function GetDepartments(){
		$query = $this->db->select('*')->from('departments')->get();
		return $query->result();
	}

	public function GetDepartmentByCode($_code = -1){
		if($_code != -1){
			$query = $this->db->select('*')->from('departments')->where('department_code', $_code)->get();
			if($query->num_rows() == 0)
				return "Bölüm bulunamadı!";
			return $query->row();
		}else{
			return "Bölüm kodu bilgisi eksik!";
		}
		
	}
}
?>