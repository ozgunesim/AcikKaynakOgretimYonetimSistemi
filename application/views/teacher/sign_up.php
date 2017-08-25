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
	<div class="container-fluid">
	<h1 class="text-center">Öğretmen Kaydı Oluşturma Ekranı</h1><hr>

<?php $this->load->view('messages'); ?>
<div class="col-md-6 col-md-offset-3">
<form action="" method="post">
	<label style="display: block;">Email Adresi:
		<input type="email" required name="email" class="form-control" />
	</label>
	<label style="display: block;">Adı Soyadı:
		<input type="text" required name="name" class="form-control" />
	</label>
	<label style="display: block;">Bölümü:
		<select name="department" class="form-control">
			<?php
			foreach ($departments as $dep) {
				echo "<option value='$dep->department_code'>" . $dep->department_acronym . '-' . $dep->department_code . '</option>';
			}
			?>
		</select>
	</label>

	<label style="display: block;">Ünvan:
		<select name="honour" class="form-control">
			<?php
			foreach ($honours as $hon) {
				echo "<option value='$hon->honour_id'>" . $hon->honour_name . '</option>';
			}
			?>
		</select>
	</label>

	<label style="display: block;">Özgeçmiş:
		<textarea class="form-control" name="bio" rows=5></textarea>
	</label>

	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
	<button class="btn btn-primary pull-right">Kaydet</button>
	<div class="clearfix"></div>
	<br>
</form>
</div>
</div>

</body>
<script src="<?=$base?>js/jquery.min.js"></script>

<script src="<?=$base?>js/bootstrap.min.js"></script>
</html>