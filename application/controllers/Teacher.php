<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Teacher extends CI_Controller{
	private $teacher_id = -1;
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('xss_helper');
		$this->load->helper('messages');
		$this->load->helper('cookie');
		if($this->auth->check_auth( array(2) ) !== true){
			exit('Yetkiniz Yok!');
		}
		$this->teacher_id = $this->session->userdata('user')->user_id;
	}

	public function home($page = 1){
		$data = array();
		$this->load->model('notice_model');
		$result = $this->notice_model->GetNotices($page);
		$data['notices'] = $result['limited'];
		$data['all_count'] = $result['all_count'];

		$this->load->model('teacher_model');
		$data['teacher_count'] = $this->teacher_model->GetTeacherCount();

		$this->load->model('student_model');
		$data['student_count'] = $this->student_model->GetStudentCount();

		$this->load->model('course_model');
		$data['course_count'] = $this->course_model->GetCourseCount();

		$this->load->model('departments_model');
		$data['department_count'] = $this->departments_model->GetDepartmentCount();

		$config['base_url'] = site_url() . '/admin/home';
		$config['total_rows'] = $data['all_count'];
		$config['per_page'] = 5;
		$this->load->library('defaultpagination');
		$data['pagination'] = $this->defaultpagination->create_links($config);


		$this->load->view('teacher/home', $data);
	}

	public function weekly_programs($page = 1){
		$data = array();
		$this->load->model('departments_model');
		$data['departments'] = $this->departments_model->GetDepartments();

		$this->load->model('teacher_model');
		$program = $this->teacher_model->GetWeeklyProgram($this->session->userdata('user')->user_id);
		//exit(var_dump($program));
		$data['program'] = ($program === null ) ? array() : $program;

		if($this->input->post('days') != null && is_array($this->input->post('days'))){	//program belirlenmis
			$days = $this->input->post('days');
			for($i=0; $i<count($days); $i++){
				for($j=0;$j<8; $j++){
					if($days[$i][$j] == '-1')
						$days[$i][$j] = 0;
				}
			}
			$result = $this->teacher_model->UpdateWeeklyProgram(
				$this->session->userdata('user')->user_id,
				$days
			);
			if($result === true)
				set_success_msg('Program güncellendi.');
			else
				set_error_msg('Program güncellenirken hata!');
		}

		$data['assigned_courses'] = $this->teacher_model->GetAssignedCourses($this->teacher_id);

		//exit(var_dump($data['assigned_courses']));
		

		$this->load->view('teacher/weekly_programs', $data);
	}

	public function attendance(){
		$data = array();

		$this->load->model('teacher_model');
		$data['program'] = $this->teacher_model->GetWeeklyProgram($this->session->userdata('user')->user_id);


		$this->load->view('teacher/attendance', $data);
	}


}
?>