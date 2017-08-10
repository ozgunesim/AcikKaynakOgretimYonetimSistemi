<?php
if(!isset($_SESSION))
	session_start();
function has_msg(){
	return (isset($_SESSION) && (isset($_SESSION['err_msg']) || isset($_SESSION['success_msg'])) ) ? true : false;
}

function destroy_messages(){
	if(isset($_SESSION['err_msg']))
		unset($_SESSION['err_msg']);
	if(isset($_SESSION['success_msg']))
		unset($_SESSION['success_msg']);
	if(isset($_SESSION['msg_redirected']))
		unset($_SESSION['msg_redirected']);
}

if(has_msg()){
	if(isset($_SESSION['msg_redirected']) && $_SESSION['msg_redirected'] == '1'){

		if(isset($_SESSION['err_msg'])){
			?>
				<div class="alert animated pulse alert-danger text-center"><?php echo $_SESSION['err_msg']; ?></div>
			<?php
		}
		if(isset($_SESSION['success_msg'])){
			?>
				<div class="alert animated pulse alert-success text-center"><?php echo $_SESSION['success_msg']; ?></div>
			<?php
		}
		destroy_messages();

	}else{
		$_SESSION['msg_redirected'] = '1';
		header('Location: '. $_SERVER['REQUEST_URI']);
		//redirect(base_url(uri_string()) , 'refresh'); 
	}
}


?>