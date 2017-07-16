<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
function check_session(){
	if(!isset($_SESSION))
		session_start();
}
function set_error_msg($msg){
	check_session();
	$_SESSION['err_msg'] = $msg;
}

function set_success_msg($msg){
	check_session();
	$_SESSION['success_msg'] = $msg;
}

?>