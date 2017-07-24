<?php $this->load->view('static/header');?>
<h2>Öğrenci Kaydı Sil</h2>
<div class="alert alert-info">
	<strong>Bilgi:</strong> Öğrenci kaydı tamamen silinmez. Öğrencinin sisteme girişi engellenir.
</div>
<?php
$this->load->view('messages');
?>

<h3>Silmek istediğiniz öğrenciyi bulun:</h3><hr>
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active"><a href="#name-tab" aria-controls="name-tab" role="tab" data-toggle="tab">İsme Göre</a></li>
	<li role="presentation"><a href="#num-tab" aria-controls="num-tab" role="tab" data-toggle="tab">Numaraya Göre</a></li>
	<li role="presentation"><a href="#dept-tab" aria-controls="dept-tab" role="tab" data-toggle="tab">Bölüme Göre</a></li>
	<li role="presentation"><a href="#email-tab" aria-controls="email-tab" role="tab" data-toggle="tab">Email Adresine Göre</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="name-tab">
		<form action="" method="post">
			<h4>İsim Girin:</h4>
			<input type="text" required name="student_name" class="form-control" />
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
			<div class="clearfix"></div><br>
			<button class="btn pull-right btn-default"><i class="fa fa-search" aria-hidden="true"></i> Ara</button>
			<div class="clearfix"></div>
		</form>
	</div>
	<div role="tabpanel" class="tab-pane" id="num-tab">
		<form action="" method="post">
			<h4>Numara Girin:</h4>
			<input type="text" required name="student_num" class="form-control" />
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
			<div class="clearfix"></div><br>
			<button class="btn pull-right btn-default"><i class="fa fa-search" aria-hidden="true"></i> Ara</button>
			<div class="clearfix"></div>
		</form>
	</div>
	<div role="tabpanel" class="tab-pane" id="dept-tab">
		<form action="" method="post">
			<h4>Bölüm Seçin:</h4>
			<select name="student_dept" class="form-control">
				<?php
				foreach ($departments as $dep) {
					echo "<option value='$dep->department_code'>" . $dep->department_acronym . '-' . $dep->department_code . '</option>';
				}
				?>
			</select>
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
			<div class="clearfix"></div><br>
			<button class="btn pull-right btn-default"><i class="fa fa-search" aria-hidden="true"></i> Ara</button>
			<div class="clearfix"></div>
		</form>
	</div>
	<div role="tabpanel" class="tab-pane" id="email-tab">
		<form action="" method="post">
			<h4>Email Girin:</h4>
			<input type="text" required name="student_email" class="form-control" />
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
			<div class="clearfix"></div><br>
			<button class="btn pull-right btn-default"><i class="fa fa-search" aria-hidden="true"></i> Ara</button>
			<div class="clearfix"></div>
		</form>
	</div>
</div>


<?php $this->load->view('static/footer'); ?>
