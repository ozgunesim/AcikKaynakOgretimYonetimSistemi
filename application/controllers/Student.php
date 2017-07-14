<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Student extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('session');
	}

	public function info(){
		//ogrenci bu alanda aldigi dersleri ve bu derslerin sorumlularini görecek
	}
}
?>