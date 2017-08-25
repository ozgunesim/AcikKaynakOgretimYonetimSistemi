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
<div class="col-md-6 col-md-offset-3">

<h1 class="text-center">Öğrenci Kaydı Oluşturma Ekranı</h1><hr>
<?php
$this->load->view('messages');
?>



<form action="" method="post">
	<label style="display: block;">Email Adresi:
		<input type="email" required name="manuel_email" class="form-control" />
	</label>
	<label style="display: block;">Adı Soyadı:
		<input type="text" required name="manuel_name" class="form-control" />
	</label>
	<label style="display: block;">Okul Numarası:
		<input type="text" pattern="\d*" required name="manuel_number" class="form-control" />
	</label>
	<label style="display: block;">Bölümü:
		<select name="manuel_department" class="form-control">
			<?php
			foreach ($departments as $dep) {
				echo "<option value='$dep->department_code'>" . $dep->department_acronym . '-' . $dep->department_code . '</option>';
			}
			?>
		</select>
	</label>
	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
	<button class="btn btn-primary pull-right">Kaydet</button>
	<div class="clearfix"></div>
	<br>
</form>



<?php
function printCell($str){
	echo '<td>'.$str.'</td>';
}
?>

<div id="mail-modal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<form action="mail" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Mail Gönder</h4>
				</div>
				<div class="modal-body">
					<Label style='display: block;'>
						Alıcı:
						<input type="text" id="mail-target" name="mail-target" class="form-control" readonly style='width: 100%;' />
					</Label>

					<Label style='display: block;'>
						İçerik:
						<textarea name="mail-content" id="mail-content" class="form-control" autofocus rows=10></textarea>
					</Label>
				</div>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
					<button class="btn btn-primary">Mail Gönder</button>
				</div>

			</form>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</div>
</div>
</body>
<script src="<?=$base?>js/jquery.min.js"></script>

<script src="<?=$base?>js/bootstrap.min.js"></script>
</html>