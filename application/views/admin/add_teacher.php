<?php $this->load->view('static/header');?>
<h2 class="page-title">Sisteme Öğretmen Ekle</h2>
<div class="container-fluid">

<?php $this->load->view('messages'); ?>

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

<?php $this->load->view('static/footer'); ?>