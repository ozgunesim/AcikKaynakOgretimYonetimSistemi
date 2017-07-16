<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
Class password{
	private $checkResult = array();
	private $_min, $_max  ="";
	private $restrictedChar = false;
	private $weakPassword = false;
	private $_password = "";
	private $message = "";

	function __construct(){
		$this->message = "";
		$this->_max = "";
		$this->_min = "";
		$this->restrictedChar = false;
		$this->weakPassword = false;
	}


	public function check_and_compare($pw1="", $pw2="", $min=6, $max=10){
		$this->reset();
		$this->_max = $max;
		$this->_min = $min;
		$pw1 = trim($pw1);
		$pw2 = trim($pw2);
		if($pw1 != null && $pw1 != null && $pw1 != "" && $pw2 != ""){
			if($pw1 == $pw2){
				$this->_password = $pw1;
				if(strlen($pw1) >= $min){
					if(strlen($pw1) <= $max){
						if($this->is_valid() === true){
							$this->push_msg( "VALID" );
						}else{
							$this->push_msg( "RESTRICTED_CHAR" );
						}
					}else{
						$this->push_msg( "TOO_LONG" );
					}
				}else{
					$this->push_msg( "TOO_SHORT" );
				}
			}else{
				$this->push_msg( "DOESNT_MATCH" );
			}
		}else{
			$this->push_msg( "EMPTY" );
		}
		return $this;
	}

	private function reset(){
		$this->checkResult = array();
		$this->_max = "";
		$this->_min = "";
		$this->restrictedChar = false;
		$this->weakPassword = false;
		$this->_password = "";
		$this->message = "";
	}

	public function check($pw1="", $min=6, $max=10){
		$this->reset();
		$this->_max = $max;
		$this->_min = $min;
		$pw1 = trim($pw1);
		if($pw1 != null && $pw1 != ""){
			$this->_password = $pw1;
			if($this->is_valid() === true){
				if(strlen($pw1) >= $min){
					if(strlen($pw1) <= $max){
						$this->push_msg( "VALID" );
					}else{
						$this->push_msg( "TOO_LONG" );
					}
				}else{
					$this->push_msg( "TOO_SHORT" );
				}
			}else{
				$this->push_msg( "RESTRICTED_CHAR" );
			}
			
		}else{
			$this->push_msg( "EMPTY" );
		}
		return $this;
	}

	public function result(){
		if(
			$this->restrictedChar === false &&
			$this->weakPassword !== true &&
			count($this->checkResult) == 1 &&
			$this->checkResult[0] == "VALID"
		){
			return true;
		}else{
			return false;
		}
	}

	public function get_message(){
		$this->stringfy_messages();
		return $this->message;
	}

	private function is_valid(){
		$str = $this->_password;
		$charArray = array('q','w','e','r','t','y','u','o','p','i','l','k','j','h','g','f','d','s','a','z','x','c','v','b','n','m','Q','W','E','R','T','Y','U','I','O','P','L','K','J','H','G','F','D','S','A','Z','X','C','V','B','N','M');
		$numberArray = array('1','2','3','4','5','6','7','8','9','0');
		$symbolArray = array('!','"','#','$','%','&','\'','(',')','*','+',',','-','.','/',':',';','<','=','>','?','@','[','\\',']','^','_','`','{','|','}','~');

		for($i=0; $i<strlen($str); $i++){
			$c = substr($str, $i, 1);
			if(in_array($c, $charArray)){
				continue;
			}else if(in_array($c, $numberArray)){
				continue;
			}else if(in_array($c, $symbolArray)){
				continue;
			}else{
				$this->restrictedChar = true;
				return false;
			}
		}
		return true;
	}

	public function is_strong(){
		if(!$this->restrictedChar){
			$str = $this->_password;
			$charArray = array('q','w','e','r','t','y','u','o','p','i','l','k','j','h','g','f','d','s','a','z','x','c','v','b','n','m','Q','W','E','R','T','Y','U','I','O','P','L','K','J','H','G','F','D','S','A','Z','X','C','V','B','N','M');
			$numberArray = array('1','2','3','4','5','6','7','8','9','0');
			$symbolArray = array('!','"','#','$','%','&','\'','(',')','*','+',',','-','.','/',':',';','<','=','>','?','@','[','\\',']','^','_','`','{','|','}','~');

			$charExists = false;
			$numberExists = false;
			$symbolExists = false;
			for($i=0; $i<strlen($str); $i++){
				$c = substr($str, $i, 1);
				if(in_array($c, $charArray)){
					$charExists = true;
				}else if(in_array($c, $numberArray)){
					$numberExists = true;
				}else if(in_array($c, $symbolArray)){
					$symbolExists = true;
				}else{
					$this->restrictedChar = true;
					break;
				}
			}
			
			if(!($charExists && $numberExists && $symbolExists)){
				$this->weakPassword = true;
				$this->push_msg("WEAK_PASSWORD");
			}
			return $this;
			
		}
		
		
	}

	private function push_msg($msg){
		array_push($this->checkResult, $msg);
	}

	private function stringfy_messages(){
		$msg = "";
		//$msg = "<ul>";
		foreach ($this->checkResult as $m) {
			if($m == "VALID"){
				if(count($this->checkResult) == 1)
					$msg .= "Şifre Geçerli.<br>";
			}else if($m ==  "TOO_LONG"){
				$msg .= "Şifre ". $this->_max ." karakterden uzun!<br>";
			}else if($m ==  "TOO_SHORT"){
				$msg .= "Şifre ". $this->_min ." karakterden kısa!<br>";
			}else if($m ==  "DOESNT_MATCH"){
				$msg .= "Şifreler Uyuşmuyor!<br>";
			}else if($m ==  "EMPTY"){
				$msg .= "Eksik alan var!<br>";
			}else if($m ==  "RESTRICTED_CHAR"){
				$msg .= "Şifre geçersiz karakter içeriyor.<br>";
			}else if($m == "WEAK_PASSWORD"){
				$msg .= "Şifre çok zayıf!<br>";
			} else{
				$msg .= "Bilinmeyen HATA!<br>";
			}
		}
		//$msg .= "</ul>";
		$this->message = $msg;
	}

}


?>