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
		if($this->input->post('login_form')){
			// captcha cevabi aliniyor
			$captcha_answer = $this->input->post('g-recaptcha-response');
			// cevap sorgulaniyor
			$response = $this->recaptcha->verifyResponse($captcha_answer);

			// cevaba gore giris islemine devam ediliyor
			if ($response['success']) {
			    

			} else {
			    

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