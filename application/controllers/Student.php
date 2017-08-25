<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Student extends CI_Controller{
	private $data = array();
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('xss_helper');
		$this->load->helper('messages');
		$this->load->helper('cookie');
		if($this->auth->check_auth( array(3) ) !== true){
			exit('Yetkiniz Yok!');
		}
		$this->load->model('messages_model');
		$this->load->model('student_model');
		//$data = array();
		$this->data['msg_count'] = $this->messages_model->GetUnreadedMsgCount($this->session->userdata('user')->user_id);
	}

	public function home($page = 1){
		$data =& $this->data;
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


		$this->load->view('student/home', $data);
	}

	public function messages(){
		$data =& $this->data;
		$flash = $this->session->flashdata('data');
		if($flash != null){
			$data = array_merge($data, $flash);
			//exit(var_dump($flash));
		}

		$this->load->model('messages_model');
		$data['msg_list'] = $this->messages_model->LoadLastMessagesList($this->session->userdata('user')->user_id);
		$this->load->model('student_model');
		$data['student_list'] = $this->student_model->GetAllStudents();

		if($this->input->post('start_chat') != null || (isset($data['chat_target']) && $data['chat_target'] != null) ){
			$sender = (!isset($data['chat_target'])) ? $this->input->post('start_chat') : $data['chat_target'];
			$last100 = $this->messages_model->GetMesagesBySender($sender, $this->session->userdata('user')->user_id);
			//exit(var_dump($last100));
			$data['last100'] = $last100;
			$data['chat_target'] = $sender;

			if($this->input->post('start_chat') != null){
				$this->session->set_flashdata('data', $data);
				redirect('student/messages');
			}
			

		}else if($this->input->post('message_content') != null){
			$content = $this->input->post('message_content');
			$target = $this->input->post('msg-target');
			$sender = $this->session->userdata('user')->user_id;

			$result = $this->messages_model->SendMessage($sender, $target, $content);
			if($result === false)
				set_error_msg('Beklenmeyen hata!');

			$sender = $target;
			$last100 = $this->messages_model->GetMesagesBySender($sender, $this->session->userdata('user')->user_id, false);
			//exit(var_dump($last100));
			$data['last100'] = $last100;
			$data['chat_target'] = $sender;

			$this->session->set_flashdata('data', $data);
			redirect('student/messages');

		}
		$this->load->view('student/messages', $data);
	}

	public function settings(){
		$data =& $this->data;
		if($this->input->post('user_name') != null){
			if(xss_check()){
				$this->load->model('user_model');
				$result = $this->user_model->ChangeUserName(
					strip_tags($this->input->post('user_name')),
					$this->user_sess->user_id
					);
				if($result === true)
					set_success_msg('Ad soyad başarıyla değiştirildi.');
				else
					set_error_msg('Beklenmeyen hata!');
			}

		}else if($this->input->post('user_email') != null){
			if(xss_check()){
				$email = $this->input->post('user_email');
				if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$this->load->model('user_model');
					$result = $this->user_model->ChangeEmail(
						strip_tags($email),
						$this->user_sess->user_id
						);
					if($result === true)
						set_success_msg('Email başarıyla değiştirildi.');
					else
						set_error_msg('Beklenmeyen hata!');
				}else{
					set_error_msg('Geçersiz email!');
				}

			}

		}
		$this->load->view('student/settings', $data);
	}

	public function enrolment(){
		$data =& $this->data;
		$this->load->model('teacher_model');
		$assigned_courses = $this->teacher_model->GetAllAssignedCourses(true);
		if($assigned_courses != null){
			$data['assigned_courses'] = $assigned_courses;

			if($this->input->post('selected_course') != null){
				$temp = explode("-", $this->input->post('selected_course'));
				$result = $this->student_model->EnrolStudent(
					$temp[0],
					$temp[1],
					$this->session->userdata('user')->user_id
				);
				if($result === true)
					set_success_msg('Derse başarıyla kaydoldunuz.');
				else
					set_error_msg($result);
			}

		}else{
			set_error_msg('Sistemde henüz ders yok!');
		}

		$this->load->view('student/enrolment', $data);
	}

	public function weekly_program(){
		$data =& $this->data;
		$enrolments = $this->student_model->GetEnrolmentsByUserID($this->session->userdata('user')->user_id);
		$progArray = array();

		foreach ($enrolments as $enr) {
			$prog = $this->student_model->GetWeeklyProgramByAssignedCourse($enr->assigned_course);
			array_push($progArray, $prog);
		}

		/*echo "<pre>";
		var_dump($progArray);
		echo "</pre>";*/

		$data['prog_array'] = $progArray;

		$this->load->view('student/weekly_program', $data);
	}

	public function attendance(){
		$data =& $this->data;
		$enrolments = $this->student_model->GetEnrolmentsByUserID($this->session->userdata('user')->user_id);
		$data['enrolments'] = $enrolments;

		if($this->input->post('selected_course') != null){
			$this->load->model('teacher_model');
			$selected_course = $this->input->post('selected_course');
			$student_id = $this->session->userdata('user')->user_id;
			$user_att = $this->teacher_model->GetUserAttendance($student_id, $selected_course);
			if($user_att !== null){
				$data['user_att'] = $user_att;
			}else{
				set_error_msg('Bu derse ait yoklama bulunamadı!');
			}

		}

		$this->load->view('student/attendance', $data);
	}

	public function exam_results(){
		$data =& $this->data;
		$this->load->model('course_model');
		$this->load->model('teacher_model');
		$semester = $this->course_model->GetCurrentSemester();
		if($semester != null){

			$enrolments = $this->student_model->GetEnrolmentsByUserID($this->session->userdata('user')->user_id);
			$data['enrolments'] = $enrolments;

			$data['assigned_courses'] = $this->teacher_model->GetAssignedCourses(
				$this->session->userdata('user')->user_id,
				$semester->semester_id,
				true //gruplama icin parametre
			);

			/*if($this->input->post('create_new_exam') != null){
				$data['new_exam'] = true;
				$this->load->model('student_model');
				$assign_id = $this->input->post('assign_id');
				$subclass = $this->input->post('subclass');
				$data['assign_id'] = $assign_id;
				$class_list =  $this->student_model->GetEnrolmentsByAssignedCourse($assign_id);
				if($class_list != null){
					$data['class_list'] = $class_list;
				}else{
					set_error_msg('Bu sınıfa henüz öğrenci kayıt olmamış.');
				}

			}*//*else if($this->input->post('save_exam') != null){
				//exit(var_dump($_POST));
				$exam_id = $this->input->post('exam_id');
				if($exam_id == null){
					$isSuccess = $this->teacher_model->SaveExam(
						$this->input->post('assign_id'),
						$this->input->post('new_exam_name'),
						$this->input->post('results')
					);
				}else{
					$isSuccess = $this->teacher_model->SaveExam(
						$this->input->post('assign_id'),
						$this->input->post('new_exam_name'),
						$this->input->post('results'),
						$exam_id
					);
				}
				
				//exit(var_dump($isSuccess));
				if($isSuccess === true){
					set_success_msg('Sınav sonuçları kaydedildi.');
				}else{
					set_error_msg('Sınav sonucu kaydedilirken beklenmeyen hata!');
				}
			}*/ /*else*/ if($this->input->post('view_prev_exam') != null){
				$exam_id = $this->input->post('selected_exam');
				$data['view_prev_exam'] = true;
				$this->load->model('student_model');
				$assign_id = $this->input->post('assign_id');
				$subclass = $this->input->post('subclass');
				$data['assign_id'] = $assign_id;
				$data['exam_id'] = $exam_id;
				//$class_list =  $this->student_model->GetEnrolmentsByAssignedCourse($assign_id);
				$exam = $this->teacher_model->GetResults($exam_id);
				if($exam != null){
					$data['exam_list'] = $exam;
				}else{
					set_error_msg('Böyle bir sınav yok!');
				}
			}else if($this->input->post('selected_course') != null){
				$temp = explode('-', $this->input->post('selected_course'));
				if(count($temp) == 3){
					$assign_id = $temp[2];
					$subclass = $temp[1];
					$exam_list = $this->teacher_model->GetExams($assign_id);
					$exam_list = ($exam_list == null) ? array() : $exam_list;
					$data['exam_list'] = $exam_list;
					$data['assign_id'] = $assign_id;
					$data['subclass'] = $subclass;
				}	
			}
		

		}else{
			set_error_msg('Henüz aktif bir dönemde değilsiniz!');
		}


		$this->load->view('student/exam_results', $data);
	}



	
	

}
?>