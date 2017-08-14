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

		$this->load->model('course_model');
		$semester = $this->course_model->GetCurrentSemester();
		if($semester != null){
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


			$data['assigned_courses'] = $this->teacher_model->GetAssignedCourses($this->teacher_id, $semester->semester_id);

		}else{
			set_error_msg('Henüz ders dönemi doluşturulmamış!');
		}

		

		//exit(var_dump($data['assigned_courses']));
		

		$this->load->view('teacher/weekly_programs', $data);
	}

	public function attendance(){
		$data = array();

		$this->load->model('teacher_model');
		$data['program'] = $this->teacher_model->GetWeeklyProgram($this->session->userdata('user')->user_id);

		$this->load->model('course_model');
		$semester = $this->course_model->GetCurrentSemester();
		if($semester != null){

			$data['assigned_courses'] = $this->teacher_model->GetAssignedCourses(
				$this->session->userdata('user')->user_id,
				$semester->semester_id,
				true //gruplama icin parametre
			);

			//exit(var_dump($data['assigned_courses'] ));

			$course_start = date('Y-m-d', strtotime($semester->courses_start_date));
			$course_end = date('Y-m-d', strtotime($semester->courses_end_date));
			$calendar = array();
			//exit(var_dump($data['program']));

			//{date: yyyy-mm-dd, badge: boolean, title: string, body: string: footer: string, classname: string}
			$course = $this->input->post('selected_course');
			if($course != null){
				$selected_course = new stdClass();
				$temp = explode('-', $course);
				$selected_course->course = $temp[0];
				$selected_course->subclass = $temp[1];
				$selected_course->acd_id = $temp[2];
				$data['selected_course'] = $selected_course;
			}
			foreach ($data['program'] as $prog) {
				if($course != null){
					//exit(var_dump($data['program'] ));
					if($selected_course->course != $prog->course || $selected_course->subclass != $prog->subclass)
						continue;

					$day_space = $prog->day;
					$_date = date('Y-m-d', strtotime($course_start . ' + ' . $day_space . ' days'));
					while($_date <= $course_end){
						$calendar_day = array(
							'date' => $_date,
							/*'badge' => 'true',*/
							/*'title' => 'Ders Var!',*/
							'classname' => 'calendar-day'
						);
						array_push($calendar, $calendar_day);
						$_date = date('Y-m-d', strtotime($_date . ' + 7 days'));
					}

				}
				
			}
			//exit(var_dump($calendar));
			$data['calendar'] = $calendar;

			if($this->input->post('selected_date') != null){
				$selected_date = $this->input->post('selected_date');
				$day = date('w', strtotime($selected_date));
				//gun bilgisi veritabanindaki formata gore duzenleniyor...
				//0: pazartesi
				if($day == 0)
					$day = 7;
				$day--;

				$final_assigned_course = $this->input->post('final_assigned_course');
				$final_subclass = $this->input->post('final_subclass');
				$final_course = $this->input->post('final_course');

				$subclass_list = $this->course_model->GetSubclassByDay(
					$day,
					$this->session->userdata('user')->user_id,
					$final_course,
					$final_subclass
				);

				$data['subclass_list'] = $subclass_list;
				$data['final_date'] = $selected_date;
				$data['final_assigned_course'] = $final_assigned_course;

				//exit(var_dump($subclass_list));
			}else if($this->input->post('final_hour_acd')){
				$temp = explode("-", $this->input->post('final_hour_acd'));
				$final_hour = $temp[0];
				$final_acd = $temp[1];
				$final_date = $this->input->post('final_date');
				$final_day = $this->input->post('final_day');

				$true_hours = array(
					'09:00', '10:00', '11:00', '12:00', 
					'13:00', '14:00', '15:00', '16:00'
				);

				$final_hour = $true_hours[$final_hour];

				$attendance_data = new stdClass();
				$attendance_data->acd_id = $final_acd;
				$attendance_data->date = $final_date;
				$attendance_data->day = $final_day;
				$attendance_data->hour = $final_hour;
				$data['att_data'] = $attendance_data;
				//exit(var_dump($attendance_data));

				$current_attendance = $this->teacher_model->GetAttendance(
					$attendance_data->date,
					$attendance_data->hour,
					$attendance_data->acd_id
				);
				$data['current_attendance'] = $current_attendance;
				$data['ready_to_att'] = true;

				$this->load->model('student_model');
				$class_list =  $this->student_model->GetEnrolmentsByAssignedCourseData($attendance_data->acd_id);
				$data['enrolments'] = ($class_list != null) ? $class_list : array();

				//$data['attendance_data'] = $attendance_data;


			}else if($this->input->post('finish_att') != null){
				$checked_users = $this->input->post('att_check');
				$date = $this->input->post('date');
				$acd_id = $this->input->post('acd_id');
				$hour = $this->input->post('hour');
				$this->load->model('student_model');
				$class_list =  $this->student_model->GetEnrolmentsByAssignedCourseData($acd_id);
				$att_array = array();
				foreach ($class_list as $student) {
					$att_row = array();
					$att_row['student_id'] = $student->user_id;
					$att_row['date'] = $date;
					$att_row['hour'] = $hour;
					$att_row['state'] = '0';
					$att_row['assigned_course_data'] = $acd_id;
					if($checked_users != null && is_array($checked_users)){
						foreach ($checked_users as $usr) {
							if($usr == $student->user_id){
								$att_row['state'] = '1';
								break 1;
							}
						}
					}
					array_push($att_array, $att_row);
				}

				$isSuccess = $this->teacher_model->UpdateAttendanceFromArray($att_array);

				if($isSuccess === true){
					set_success_msg('Yoklama başarıyla kaydedildi.');
				}else{
					set_error_msg('Yoklama kaydedilirken beklenmeyen hata!');
				}
			}
		}else{
			set_error_msg('Henüz aktif bir dönemde değilsiniz!');
		}


		$this->load->view('teacher/attendance', $data);
	}


}
?>