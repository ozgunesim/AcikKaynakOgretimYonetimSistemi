<?php
Class Honour_model extends CI_Model{
	function __construct(){
		parent::__construct();
		if(!defined('_OK')) define("_OK", "_OK");
		if(!defined('_EMPTY')) define("_EMPTY", "_EMPTY");
		$this->load->database();
	}

	public function GetHonours(){
		$query = $this->db->select('*')->from('honours')->get();
		return $query->result();
	}
}
?>