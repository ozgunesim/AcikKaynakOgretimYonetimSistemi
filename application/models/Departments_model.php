<?php
Class Departments_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function GetDepartments(){
		$query = $this->db->select('*')->from('departments')->get();
		return $query->result();
	}
}
?>