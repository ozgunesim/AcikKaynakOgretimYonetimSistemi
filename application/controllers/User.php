<?php
Class User extends CI_Controller{
	//Bu class tum kullancilar icin gecerli ortak ozellikler uzerinde kontrol saglamak uzere olusturuldu

	function __construct(){
		parent::__construct();
		$this->load->library('session');
	}

	public function login(){
		//kullanici girisi bu alanda kontrol edilecek
	}

	public function sign_up(){
		//kullanici kaydi bu alanda yapilacak
	}

	public function settings(){
		//sifre, email degisikligi gibi kisisel ayarlar bu alanda yapilacak
	}
}
?>