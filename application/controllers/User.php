<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
Class User extends CI_Controller{
	//Bu class tum kullancilar icin gecerli ortak ozellikler uzerinde kontrol saglamak uzere olusturuldu

	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('messages');
		define('USER_ACTIVATION_ENABLED',  $this->config->item('enable_email_activation'));
		define('CAPTCHA_ENABLED', $this->config->item('enable_captcha'));
		if(CAPTCHA_ENABLED === true)
			$this->load->library('recaptcha');
		$this->load->helper('xss_helper');
	}

	public function index(){
		$this->redirectUser();
	}

	public function login(){
		$this->redirectUser();	//kullanici zaten giris yapmissa yonlendirilecek

		//kullanici girisi bu alanda kontrol edilecek
		if($this->input->post('email')){

			if(CAPTCHA_ENABLED === true){
				$this->load->library('recaptcha');
			// captcha cevabi aliniyor
				$captcha_answer = $this->input->post('g-recaptcha-response');
			// cevap sorgulaniyor
				$response = $this->recaptcha->verifyResponse($captcha_answer);
			}else{
				$response['success'] = true;
			}

			// cevaba gore giris islemine devam ediliyor
			if ((isset($response) && $response['success'])){
				$unsecureEmail = trim($this->input->post('email'));
				$unsecurePw = trim($this->input->post('password'));
				$email = $this->security->xss_clean($unsecureEmail);
				$pw = $this->security->xss_clean($unsecurePw);
				$this->load->model('user_model');
				$user = $this->user_model->GetUser($email, $pw);
				if($user == null){
					//boyle bir kullanici yok
					set_error_msg('Böyle bir kullanıcı yok!');
				}else if($user == '_EMPTY'){
					//bos alan var
					set_error_msg('Eksik alan(lar)var!');
				}else{
					//giris basarili
					//kullanici aktiflestirilmis mi kontrol ediliyor
					if((string)$user->isActive !== '1'){
						set_error_msg('Kullanıcının yönetici iznine ihtiyacı var ya da yasaklanmış!');
					}else{
						$this->session->set_userdata('user', $user);
						set_success_msg('Hoşgeldiniz ' . $user->user_name);
						$this->redirectUser();
					}
					
				}

			} else {
				set_error_msg('Captcha Hatası!');
			}
		}
		$this->load->view('user/login');
	}

	public function logout(){
		session_destroy();
		redirect('/user/login', 'refresh');
	}

	private function redirectUser(){
		$user_sess = $this->session->userdata('user');
		if($user_sess != null){
			if($user_sess->user_auth == 1){//admin
				redirect('/admin/home', 'refresh');
			}else if($user_sess->user_auth == 2){//ogretmen
				redirect('/teacher/home', 'refresh');
			}else if($user_sess->user_auth == 3){//ogrenci
				redirect('/student/home', 'refresh');
			}
		}else{
			$controller= $this->uri->segment(1); // controller
			$action = $this->uri->segment(2);	//method
			//exit($controller . ':' . $action);
			if($controller != 'user' && $action != 'login')
				redirect('user/login');
		}
		
	}



	public function sign_up(){
		//kullanici kaydi bu alanda yapilacak
	}

	public function settings(){
		//sifre, email degisikligi gibi kisisel ayarlar bu alandan yonlendirilecek
		$data = array();

		$user_sess = $this->session->userdata('user');
		if($user_sess != null){
			if($user_sess->user_auth == 1){//admin
				redirect('/admin/settings', 'refresh');
			}else if($user_sess->user_auth == 2){//ogretmen
				redirect('/teacher/settings', 'refresh');
			}else if($user_sess->user_auth == 3){//ogrenci
				redirect('/student/settings', 'refresh');
			}else{
				exit('beklenmeyen hata!');
			}
		}else{
			redirect('/user/login', 'refresh');
		}
	}

	public function teacher_sign_up(){
		$data = array();
		$this->load->model('honour_model');
		$data['honours'] = $this->honour_model->GetHonours();
		$this->load->model('departments_model');
		$data['departments'] = $this->departments_model->GetDepartments();

		if($this->input->post('email') != null){
			if(xss_check()){
				
				$this->load->model('user_model');
				$user = new stdClass();
				$user->name = trim($this->input->post('name'));
				$user->email = trim($this->input->post('email'));
				$user->department = trim($this->input->post('department'));
				$user->honour = trim($this->input->post('honour'));
				$user->bio = trim(str_replace("\n", "<br>", strip_tags($this->input->post('bio'))));

				if(
					filter_var($user->email, FILTER_VALIDATE_EMAIL)
					/*kullanıcıdan gelen verinin iceriginin gecerliligi kontrol ediliyor */)
				{
					$result = $this->user_model->AddUser($user,2);
					if($result === true){
						set_success_msg('Öğretmen kaydı alındı. Sistem yöneticisinin izni alınana kadar sisteme giriş <strong>yapamazsınız!</strong>');
						redirect('/user/login', 'refresh');
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

		$this->load->view('teacher/sign_up', $data);
	}

	public function student_sign_up(){
		//excel tablosundan gelen verilen bu alanda parse edilip veritabanina eklenecek
		//$this->load->view('admin/excel');
		$this->load->model('departments_model');
		$data = array(
			'departments' => $this->departments_model->GetDepartments()
			);

		if($this->input->post('manuel_email') != null){		//ogrenci bilgileri el ile girildi
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
						redirect('/user/login', 'refresh');
					}else{
						set_error_msg($result);
					}
					//exit(var_dump($result));
				}else{
					set_error_msg('Girilen bilgilerde hata var!');
				}
			}else{
				set_error_msg('Başarısız XSS denemesi!');
			}


		}

		$this->load->view('student/sign_up', $data);
	}
	

}
?>