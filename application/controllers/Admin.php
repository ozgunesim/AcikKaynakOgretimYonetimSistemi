<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Admin extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->library('Auth');
		if($this->Auth->check_auth( array(1) ) !== true){
			$this->load->view('auth_error');
		}
	}

	public function excel(){
		//excel tablosundan gelen verilen bu alanda parse edilip veritabanina eklenecek

	}

	public function courses(){
		//ogretmenler ile dersler bu alanda iliskilendirilecek

	}
}
?>