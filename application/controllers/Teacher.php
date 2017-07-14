<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Teacher extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('session');
	}

	public function attendance(){
		//ogretmen yoklamayı bu alanda alacak
	}

	public function info(){
		//ogretmen uzerindeki dersleri, bu dersteki ogrencileri, vb bilg,leri bu alanda gorecek
	}
}
?>