<?php $this->load->view('static/header');?>
<h2 class="page-title">Sisteme Ders Ekle</h2>
<div class="container-fluid">
<?php $base = base_url() ."assets/" ?>
<?php $this->load->view('messages'); ?>

<link href="<?=$base?>css/bootstrap-datepicker.min.css" rel="stylesheet">
<script src="<?=$base?>js/bootstrap-datepicker.min.js"></script>
<script src="<?=$base?>js/locales/bootstrap-datepicker.tr.js"></script>

<form action="" method="post">
	<label style="display: block;">Dönemin Başlangıç Tarihi (<small class="text-info">Ders kayıt/ders programı oluşturma ve benzeri için</small>):
		<input class="datepicker form-control" required name="start_date" />
	</label><br>
	<label style="display: block;">Ders Dönemi Başlangıç Tarihi (<small class="text-info">Aktif ders dönemi başlangıç tarihi</small>):
		<input class="datepicker form-control" required name="courses_start_date" />
	</label><br>
	<label style="display: block;">Ders Dönemi Bitiş Tarihi (<small class="text-info">Aktif ders dönemi bitiş tarihi</small>):
		<input class="datepicker form-control" required name="courses_end_date" />
	</label><br>
	<label style="display: block;">Dönemin Bitiş Tarihi (<small class="text-info">Not girişi vb işlemler için son tarih</small>):
		<input class="datepicker form-control" required name="end_date" />
	</label><br>
	<script>
		$('.datepicker').datepicker({
			language: "tr"
		});
	</script>

	<label style="display: block;">Dönemin Adı:
		<input type="text" required placeholder="örn: 2017 - 2018 Bahar Dönemi" name="name" class="form-control" />
	</label><br>

	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
	<button class="btn btn-primary pull-right">Kaydet</button>
	<div class="clearfix"></div>
	<br>
</form>
</div>

<?php $this->load->view('static/footer'); ?>

