<?php $this->load->view('static/header');?>
<h2 class="page-title">Admin Anasayfası</h2>
<div class="container-fluid">
	<div class="col-md-8">
		<div class="row">
			<div class="col-md-3 admin-home-box-container">
				<div class="admin-home-box bg-red"><i class="fa fa-graduation-cap fa-lg"></i> <span class="countup"><?php echo $teacher_count; ?></span>
					<div class="admin-home-box-footer">Aktif Öğretmen</div>
				</div>
			</div>
			<div class="col-md-3 admin-home-box-container">
				<div class="admin-home-box bg-green"><i class="fa fa-child fa-lg"></i> <span class="countup"><?php echo $student_count; ?></span>
					<div class="admin-home-box-footer">Aktif Öğrenci</div>
				</div>
			</div>
			<div class="col-md-3 admin-home-box-container">
				<div class="admin-home-box bg-blue"><i class="fa fa-book fa-lg"></i> <span class="countup"><?php echo $course_count; ?></span>
					<div class="admin-home-box-footer">Toplam Ders</div>
				</div>
			</div>
			<div class="col-md-3 admin-home-box-container">
				<div class="admin-home-box bg-yellow"><i class="fa fa-building fa-lg"></i> <span class="countup"><?php echo $department_count; ?></span>
					<div class="admin-home-box-footer">Akademik Bölüm</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div style="padding: 5px;">
				<div class="panel panel-default">
					<div class="panel-heading"><i class="fa fa-chevron-right"></i> Hızlı Ulaşım</div>
					<div class="panel-body">
						<h4>Dersler</h4>
						<a href="#" class="btn btn-default"><i class="fa fa-arrow-circle-right"></i> Ders Ekle</a> <a href="#" class="btn btn-default"><i class="fa fa-arrow-circle-right"></i> Ders Sil</a><br><br>
						<h4>Öğrenciler</h4>
						<a href="#" class="btn btn-default"><i class="fa fa-arrow-circle-right"></i> Öğrenci Ekle</a> <a href="#" class="btn btn-default"><i class="fa fa-arrow-circle-right"></i> Erişim Ayarları</a><br><br>
						<h4>Öğretmenler</h4>
						<a href="#" class="btn btn-default"><i class="fa fa-arrow-circle-right"></i> Öğretmen Ekle</a> <a href="#" class="btn btn-default"><i class="fa fa-arrow-circle-right"></i> Öğretmene Ders Ata</a> <a href="#" class="btn btn-default"><i class="fa fa-arrow-circle-right"></i> Erişim Ayarları</a><br><br>
						<h4>Duyurular</h4>
						<a href="#" class="btn btn-default"><i class="fa fa-arrow-circle-right"></i> Duyuru Ekle</a> <a href="#" class="btn btn-default"><i class="fa fa-arrow-circle-right"></i> Duyuru Sil</a><br><br>
					</div>
				</div>
			</div>
		</div>

	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading"><i class="fa fa-bullhorn"></i> Duyurular:</div>
			<div class="panel-body">
				<?php
				$types = array(
					'1' => 'danger',
					'2' => 'warning',
					'3' => 'info',
					'4' => 'success'
					);
				foreach ($notices as $ntc) {
					?>
					<div class="alert alert-<?php echo $types[$ntc->notice_type]; ?>" style="padding: 10px;margin-bottom: 5px;">
						<?php echo $ntc->notice_text ?>
					</div>

					<?php
				}
				if(isset($pagination))
					echo $pagination;
				?>

			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading"><i class="fa fa-calendar"></i> Takvim:</div>
			<div class="panel-body">
				<div id="my-calendar"></div>
			</div>
		</div>
	</div>

</div>

<?php $this->load->view('static/footer'); ?>

<?php $base = base_url() ."assets/" ?>
<link rel="stylesheet" type="text/css" href="<?php echo $base; ?>css/zabuto_calendar.min.css" />
<script src="<?php echo $base; ?>js/zabuto_calendar.min.js"></script>
<script src="<?php echo $base; ?>js/countUp.min.js"></script>

<script type="application/javascript">
	$(document).ready(function () {
		$("#my-calendar").zabuto_calendar({
			language: "tr",
			today: true
		});
	});
</script>