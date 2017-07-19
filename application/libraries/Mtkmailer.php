<?php
/*
bu dokumandaki kodlar tarafıma (özgün eşim) aittir. izinsiz kullanılamaz!
ozgunesim@gmail.com
http://inoverse.com
*/
if (!defined('BASEPATH')) exit('No direct script access allowed');
class MtkMailer{
	public function sendMail($to, $content){
		//exit($to);
		set_time_limit(0);
		$CI =& get_instance();
		$CI->load->config('mtk_mail');
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Mailer = 'smtp';
		$mail->SMTPAuth = true;
		$mail->Host = $CI->config->item('host'); 
		$mail->Port = 465;
		$mail->SMTPSecure = 'ssl';

		$mail->Username = $CI->config->item('username');
		$mail->Password = $CI->config->item('password');
		//$mail->From = "ozgunesim@gmail.com";
		
		$mail->FromName = "MKT473";
		$mail->isHTML(true);

		//gidecek kisi
		$mail->AddAddress($to);
		$mail->CharSet = 'UTF-8';
		$mail->Subject = 'MTK473 Bilgi Maili';
		$mail->MsgHTML($content);
		if($mail->Send()) {
			return true;
		} else {
		    // bir sorun var, sorunu ekrana bastıralım
		    //echo $mail->ErrorInfo;
			return false;
		}
	}
}

?>