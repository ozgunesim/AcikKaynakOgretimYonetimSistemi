<?php $this->load->view('static/header');?>
<h2 class="page-title">Sisteme Ders Ekle</h2>
<div class="container-fluid">
<?php $base = base_url() ."assets/" ?>
<?php $this->load->view('messages'); ?>

<link href="<?=$base?>css/bootstrap-datepicker.min.css" rel="stylesheet">
<script src="<?=$base?>js/bootstrap-datepicker.min.js"></script>
<script src="<?=$base?>js/locales/bootstrap-datepicker.tr.js"></script>

<form action="" method="post">
	<label style="display: block;">Dersin Optik Kodu:
		<input type="text" required  pattern="\d{3}" placeholder="3 karakter numerik optik kod girin..." name="optic" class="form-control" />
	</label><br>
	<label style="display: block;">Teorik Ders Saati:
		<input type="text" required  pattern="\d{1,2}" placeholder="yalnızca rakam" name="theoric" class="form-control" />
	</label><br>
	<label style="display: block;">Pratik Ders Saati:
		<input type="text" required  pattern="\d{1,2}" placeholder="yalnızca rakam" name="practice" class="form-control" />
	</label><br>
	<label style="display: block;">AKTS:
		<input type="text" required  pattern="\d*" placeholder="yalnızca rakam" name="akts" class="form-control" />
	</label><br>
	<label style="display: block;">Dersin Adı:
		<input type="text" required name="name" class="form-control" />
	</label><br>
	<label style="display: block;">Hafta Sayısı:
		<input type="text" required  pattern="\d*" placeholder="yalnızca rakam" value="13" name="weeks" class="form-control" />
	</label><br>
	<label style="display: block;">Dersin Başlangıç Tarihi:
		<input class="datepicker form-control" required name="start_date" />
	</label><br>
	<script>
		$('.datepicker').datepicker({
			language: "tr"
		});
	</script>
	<label style="display: block;">Dersi Açan Bölüm:
		<select name="department" class="form-control">
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
</div>

<?php $this->load->view('static/footer'); ?>

