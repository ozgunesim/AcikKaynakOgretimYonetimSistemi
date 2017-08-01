<?php
define('MYSQL_CODE_DUPLICATE_KEY', 1062);
function special_insert($table_name, $insertArray){
	try{
		$CI =& get_instance();

		//$db_debug = $CI->db->db_debug;
		//$CI->db->db_debug = false;
		$CI->db->insert($table_name, $insertArray);
		//$CI->db->db_debug = $db_debug;

		if($CI->db->affected_rows() > 0){
			return true;
		}else{
			if( mysql_errno() == MYSQL_CODE_DUPLICATE_KEY) {
				return 'Böyle bir kayıt zaten var!';
			} else {
				return 'Kayıt eklenirken beklenmeyen hata. Bu kayıt zaten eklenmiş olabilir.';
			}
		}
	}catch(Exception $e){
		if( mysql_errno() == MYSQL_CODE_DUPLICATE_KEY) {
			return 'Böyle bir kayıt zaten var!';
		} else {
			return 'Kayıt eklenirken beklenmeyen hata. Bu kayıt zaten eklenmiş olabilir.';
		}
	}
}

?>