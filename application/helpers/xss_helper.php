<?php

function xss_check(){
	if(isset($_POST)){
		$CI =& get_instance();
		foreach ($_POST as $p) {
			if($CI->security->xss_clean($p, TRUE) === false){
				return false;
			}
		}
		return true;
	}else{
		return true;
	}

}

?>