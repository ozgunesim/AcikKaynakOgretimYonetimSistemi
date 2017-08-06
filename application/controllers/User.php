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
			}

			// cevaba gore giris islemine devam ediliyor
			if (CAPTCHA_ENABLED !== true || (isset($response) && $response['success'])){
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
					if($user->isActive !== '1' && USER_ACTIVATION_ENABLED){
						set_error_msg('Kullanıcı aktifleştirilmemiş! Mail adresinizi kontrol edin.');
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

	public function activation($key){
		
	}

	

}
?>