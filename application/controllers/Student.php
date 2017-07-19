<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Student extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('session');
	}

	public function info(){
		//ogrenci bu alanda aldigi dersleri ve bu derslerin sorumlularini görecek
	}

	public function ajax_search(){
		if($this->input->post('user_name')!=null){
			$this->load->model('user_model');
			$result = $this->user_model->GetUserByName($this->input->post('user_name'));
			$this->printResult($result);
		}else if($this->input->post('number')!=null){
			$this->load->model('student_model');
			$result = $this->student_model->GetStudentByNumber($this->input->post('number'));
			$this->printResult($result);
		}
	}

	private function printResult($result){
		if($result == _EMPTY){
			echo "Boş alan var!";
		}else if($result == "NOT_FOUND"){
			echo "Bulunamadı.";
		}else{
			echo json_encode($result);
		}
	}

}
?>