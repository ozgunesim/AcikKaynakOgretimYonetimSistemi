<?php
/*
bu dokumandaki kodlar tarafıma (özgün eşim) aittir. izinsiz kullanılamaz!
ozgunesim@gmail.com
http://inoverse.com
*/
if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Auth{
	var $CI = null;
	function __construct(){
		$this->CI =& get_instance();
	}

	public function check_auth($allowed = array()){
		//bu alanda kisinin yetkilerinin ilgili sayfayi görmek icin yeterli olup olmadigi kontrol ediliyor
		if($this->check_session()){
			$user = $this->session->userdata('user');
			return in_array($user->auth_id, $allowed);
		}else{
			return false;
		}

	}

	public function check_session(){
		//bu alanda oturum kontrolu yapiliyor
		return $this->CI->session->userdata('user') !== null;
	}

}

?>