<?php $base = base_url() ."assets/" ?>
<?php $base = base_url() ."assets/" ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="description" content="">
	<meta name="author" content="">

	<title>MTK473 Proje</title>

	<!-- Bootstrap Core CSS -->
	<link href="<?=$base?>css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="<?=$base?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="<?=$base?>css?family=Open+Sans|Roboto" rel="stylesheet">

	<!-- Theme CSS -->
	<link href="<?=$base?>css/style.css" rel="stylesheet">

	<link href="<?=$base?>css/animate.css" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default" style="margin-top: 25%;box-shadow: 0 5px 10px #ddd;">
					<div class="panel-heading">
						<h3 class="panel-title">Lütfen Giriş Yapın</h3>
					</div>
					<div class="panel-body">
						<?php $this->load->view('messages'); ?>
						<form role="form" action="" method="post">
							<fieldset>
								<div class="form-group">
									<input class="form-control" placeholder="E-mail" required name="email" type="email" autofocus>
								</div>
								<div class="form-group">
									<input class="form-control" placeholder="Şifre" required name="password" type="password" value="">
								</div>
								<?php if(CAPTCHA_ENABLED === true): ?>
									<div class="captcha-box" style="margin-bottom: 15px;">
										<?php echo $this->recaptcha->render(); ?>
									</div>
								<?php endif; ?>
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
								<!-- Change this to a button or input when using this as a form -->
								<button href="index.html" class="btn btn-success btn-block">Giriş Yap</button>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>


</body>
<script src="<?=$base?>js/jquery.min.js"></script>

<script src="<?=$base?>js/bootstrap.min.js"></script>
</html>