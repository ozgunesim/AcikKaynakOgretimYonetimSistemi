<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
Class User extends CI_Controller{
	//Bu class tum kullancilar icin gecerli ortak ozellikler uzerinde kontrol saglamak uzere olusturuldu

	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('messages');
	}

	public function login(){
		//kullanici girisi bu alanda kontrol edilecek
		$this->load->library('recaptcha');
		if($this->input->post('email')){
			// captcha cevabi aliniyor
			$captcha_answer = $this->input->post('g-recaptcha-response');
			// cevap sorgulaniyor
			$response = $this->recaptcha->verifyResponse($captcha_answer);

			// cevaba gore giris islemine devam ediliyor
			if ($response['success']) {
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
					$this->session->set_userdata('user', $user);
					set_success_msg('başarılı!');
				}

			} else {
				set_error_msg('Captcha Hatası!');
			}
		}
		$this->load->view('login');
	}

	public function sign_up(){
		//kullanici kaydi bu alanda yapilacak
	}

	public function settings(){
		//sifre, email degisikligi gibi kisisel ayarlar bu alanda yapilacak
	}

	

}
?>