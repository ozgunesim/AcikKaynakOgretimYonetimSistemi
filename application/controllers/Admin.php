<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Admin extends CI_Controller{
	//public $file = '';
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('xss_helper');
		/*if($this->auth->check_auth( array(1) ) !== true){
			exit('Yetkiniz Yok!');
		}*/
	}

	public function add_student(){
		//excel tablosundan gelen verilen bu alanda parse edilip veritabanina eklenecek
		//$this->load->view('admin/excel');
		$this->load->model('departments_model');
		$data = array(
			'departments' => $this->departments_model->GetDepartments()
			);

		if(isset($_FILES['excel_file'])){		//dosya secilmis. parse edilip kullaniciya gosterilecek
			$config['upload_path']    = './temp_upload/';
			$config['allowed_types']  = '*';
			$config['max_size']       = 10240;
			$config['overwrite'] = TRUE;	
			$config['detect_mime'] = FALSE;	
			/*

			!!!!!!!!!!!!!!!!!!!!!!!!!! ONEMLI!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

			-> $config['detect_mime'] = FALSE; TRUE olmalı.

			-> $config['allowed_types']  = 'xls|xlsx|txt|csv'; olmalı

			!!GUVENLIK ACIGI!! DOSYA FORMATININ GARIPLIGI YUZUNDEN GEREKLI.

			*/

			$this->load->library('upload', $config);
			$this->load->helper('messages');

			if ( ! $this->upload->do_upload('excel_file'))
			{
        //$error = array('error' => $this->upload->display_errors());
				set_error_msg($this->upload->display_errors());
			}
			else
			{
				//$uploadData = array('upload_data' => $this->upload->data());
				$filePath = $this->upload->data()['full_path'];
				//set_success_msg('Yüklendi: ' . $filePath);
				$this->load->helper('student_excel_parser');
				$data['table'] = parseStudentExcel($filePath);
				if($data['table'] === false)
					set_error_msg('Desteklenmeyen dosya biçimi!');

			}
		}else if($this->input->post('table_json') != null){		//ogrenciler dosyadan yukleniyor
			$this->load->model('user_model');
			$this->load->helper('messages');
			//exit('gelen:' . var_dump($this->input->post('table_json')));
			$result = $this->user_model->AddUserList(json_decode($this->input->post('table_json')), 3);
			//exit('son');
			if($result === true){
				set_success_msg('Kayıtlar eklendi!');
			}else{
				set_error_msg($result);
			}
		}else if($this->input->post('manuel_email') != null){		//ogrenci bilgileri el ile girildi
			$this->load->helper('messages');
			if(xss_check()){
				$this->load->model('user_model');
				$user = new stdClass();
				$user->name = trim($this->input->post('manuel_name'));
				$user->email = trim($this->input->post('manuel_email'));
				$user->department = trim($this->input->post('manuel_department'));
				$user->number = trim($this->input->post('manuel_number'));

				if(
					strlen($user->number) == 8 &&
					is_numeric($user->number) &&
					filter_var($user->email, FILTER_VALIDATE_EMAIL) &&
					is_numeric($user->number)
					/*kullanıcıdan gelen verinin iceriginin gecerliligi kontrol ediliyor */)
				{
					$result = $this->user_model->AddUser($user,3);
					if($result === true){
						set_success_msg('Öğrenci eklendi!');
					}else{
						set_error_msg($result);
					}
				}else{
					set_error_msg('Girilen bilgilerde hata var!');
				}
			}else{
				set_error_msg('Başarısız XSS denemesi!');
			}


		}

		$this->load->view('admin/add_student', $data);



	}


	public function delete_student($page = 1){
		$data = array();
		$this->load->model('departments_model');
		$data['departments'] = $this->departments_model->GetDepartments();

		if($this->input->post('delete_id') != null){
			$this->load->helper('messages');
			$this->load->model('user_model');
			$result = $this->user_model->BanUser($this->security->xss_clean($this->input->post('delete_id')));
			if($result === true){
				set_success_msg('Kullanıcı başarıyla sistemden kaldırıldı.');
			}else{
				set_error_msg('Beklenmeyen hata!');
			}
		}else if($this->input->post('activate_id') != null){
			$this->load->helper('messages');
			$this->load->model('user_model');
			$result = $this->user_model->ActivateUser($this->security->xss_clean($this->input->post('activate_id')));
			if($result === true){
				set_success_msg('Kullanıcı başarıyla aktifleştirildi.');
			}else{
				set_error_msg('Beklenmeyen hata!');
			}
		}else{
			$search = array();

			$newSearch = ($this->input->post('search_btn') != null);
			if($this->input->post('student_name') != null){
				$search['name'] = trim($this->input->post('student_name'));
				$data['name'] = $search['name'];
			}
			if($this->input->post('student_num') != null){
				$search['number'] = trim($this->input->post('student_num'));
				$data['number'] = $search['number'];
			}
			if($this->input->post('student_dept') != null){
				$search['dept'] = trim($this->input->post('student_dept'));
				$data['dept'] = $search['dept'];
			}
			if($this->input->post('student_email') != null){
				$search['email'] = trim($this->input->post('student_email'));
				$data['email'] = $search['email'];
			}

			if(isset($_SESSION['last_search']) && !$newSearch)
				$search = $this->session->userdata('last_search');
			else if($newSearch === true)
				$page = 1;


			$this->session->set_userdata('last_search', $search);

			//exit(var_dump($search));

			if(!empty($search)){
				$this->load->model('student_model');
				$result = $this->student_model->SearchStudent($search, $page);
				//exit("page:" . $page);
				$data['search_result'] = $result['limited'];
				$data['all_count'] = $result['all_count'];

				$config['base_url'] = site_url() . '/admin/delete_student/';
				$config['total_rows'] = $data['all_count'];
				$this->load->library('defaultpagination');
				$data['pagination'] = $this->defaultpagination->create_links($config);
			}
		}

		$this->load->view('admin/delete_student', $data);
	}

	public function mail(){
		//MAIL GONDERMEK ICIN PHP OPENSSL EKLENTISI AKTIF OLMALIDIR! -> PHP.INI
		if($this->input->post('mail-target') != null){
			$this->load->library('MtkMailer');
			$mail = new MtkMailer();
			$isSent = $mail->sendMail(
				/*$this->input->post('mail-target')*/
				'ozgunesim@gmail.com',
				$this->input->post('mail-content')
				);

			$this->load->helper('messages');
			if($isSent === true){
				set_success_msg('Mail başarıyla gönderildi.');
			}else{
				set_error_msg('Mail gönderilirken hata oluştu!');
			}

			//$this->load->view('falanfilan');

		}else{
			exit('hata!');
		}
	}

	public function add_teacher(){
		$data = array();
		$this->load->model('honour_model');
		$data['honours'] = $this->honour_model->GetHonours();
		$this->load->model('departments_model');
		$data['departments'] = $this->departments_model->GetDepartments();
		$this->load->helper('messages');

		if($this->input->post('email') != null){
			if(xss_check()){
				
				$this->load->model('user_model');
				$user = new stdClass();
				$user->name = trim($this->input->post('name'));
				$user->email = trim($this->input->post('email'));
				$user->department = trim($this->input->post('department'));
				$user->honour = trim($this->input->post('honour'));
				$user->bio = trim($this->input->post('bio'));

				if(
					filter_var($user->email, FILTER_VALIDATE_EMAIL)
					/*kullanıcıdan gelen verinin iceriginin gecerliligi kontrol ediliyor */)
				{
					$result = $this->user_model->AddUser($user,2);
					if($result === true){
						set_success_msg('Öğretmen başarıyla sisteme eklendi!');
					}else{
						set_error_msg('Beklenmeyen hata!');
					}
				}else{
					set_error_msg('Girilen veriler hatalı!');
				}

			}else{
				set_error_msg('Başarısız XSS denemesi!');
			}
			
		}

		$this->load->view('admin/add_teacher', $data);
	}

	public function delete_teacher($page = 1){
		$data = array();
		$this->load->model('departments_model');
		$data['departments'] = $this->departments_model->GetDepartments();

		$this->load->model('honour_model');
		$data['honours'] = $this->honour_model->GetHonours();

		if($this->input->post('delete_id') != null){
			$this->load->helper('messages');
			$this->load->model('user_model');
			$result = $this->user_model->BanUser($this->security->xss_clean($this->input->post('delete_id')));
			if($result === true){
				set_success_msg('Kullanıcı başarıyla sistemden kaldırıldı.');
			}else{
				set_error_msg('Beklenmeyen hata!');
			}
		}else if($this->input->post('activate_id') != null){
			$this->load->helper('messages');
			$this->load->model('user_model');
			$result = $this->user_model->ActivateUser($this->security->xss_clean($this->input->post('activate_id')));
			if($result === true){
				set_success_msg('Kullanıcı başarıyla aktifleştirildi.');
			}else{
				set_error_msg('Beklenmeyen hata!');
			}
		}else{
			$search = array();

			$newSearch = ($this->input->post('search_btn') != null);
			if($this->input->post('teacher_name') != null){
				$search['name'] = trim($this->input->post('teacher_name'));
				$data['name'] = $search['name'];
			}
			if($this->input->post('teacher_honour') != null){
				$search['honour'] = trim($this->input->post('teacher_honour'));
				$data['honour'] = $search['honour'];
			}
			if($this->input->post('teacher_dept') != null){
				$search['dept'] = trim($this->input->post('teacher_dept'));
				$data['dept'] = $search['dept'];
			}
			if($this->input->post('teacher_email') != null){
				$search['email'] = trim($this->input->post('teacher_email'));
				$data['email'] = $search['email'];
			}

			if(isset($_SESSION['last_search']) && !$newSearch)
				$search = $this->session->userdata('last_search');
			else if($newSearch === true)
				$page = 1;


			$this->session->set_userdata('last_search', $search);

			//exit(var_dump($search));

			if(!empty($search)){
				$this->load->model('teacher_model');
				$result = $this->teacher_model->SearchTeacher($search, $page);
				//exit("page:" . $page);
				$data['search_result'] = $result['limited'];
				$data['all_count'] = $result['all_count'];

				$config['base_url'] = site_url() . '/admin/delete_teacher/';
				$config['total_rows'] = $data['all_count'];
				$this->load->library('defaultpagination');
				$data['pagination'] = $this->defaultpagination->create_links($config);
			}
		}

		$this->load->view('admin/delete_teacher', $data);
	}


	public function courses(){
		//ogretmenler ile dersler bu alanda iliskilendirilecek

	}


}
?>