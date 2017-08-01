<?php $this->load->view('static/header');?>
<h2 class="page-title">Sisteme Ders Ekle</h2>
<div class="container-fluid">

<?php $this->load->view('messages'); ?>

<form action="" method="post">
	<label style="display: block;">Dersin Optik Kodu:
		<input type="text" required  pattern="\d{3}" placeholder="3 karakter numerik optik kod girin..." name="optic" class="form-control" />
	</label>
	<label style="display: block;">Dersin Adı:
		<input type="text" required name="name" class="form-control" />
	</label>
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