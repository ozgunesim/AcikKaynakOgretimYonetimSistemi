<?php $this->load->view('static/header');?>
<h2 class="page-title">Öğrenci Anasayfası</h2>
<div class="container-fluid">
	<div class="col-md-8">
		<div class="row">
			<div class="col-md-12" style="padding-left: 5px;padding-right: 5px;">
				<section class="awNotices">

					<?php
					foreach ($notices as $ntc) {
						?>
						<a notice-color="dark"><i class="fa fa-bullhorn"></i><?=$ntc->notice_text;?></a>

						<?php
					}
					?>
				</section>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="row" style="margin-top: 45px;">
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
					<div class="panel-heading"><i class="fa fa-chevron-right"></i> Hızlı Erişim</div>
					<div class="panel-body">
						<?php $this->load->view('messages'); ?>
						<h4>Dersler</h4>
						<a href="<?=site_url() . 'admin/add_course';?>" class="btn btn-link"><i class="fa fa-arrow-circle-right"></i> Ders Ekle</a> <a href="<?=site_url() . 'admin/delete_course';?>" class="btn btn-link"><i class="fa fa-arrow-circle-right"></i> Ders Sil</a><hr>
						<h4>Öğrenciler</h4>
						<a href="<?=site_url() . 'admin/add_student';?>" class="btn btn-link"><i class="fa fa-arrow-circle-right"></i> Öğrenci Ekle</a> <a href="<?=site_url() . 'admin/delete_student';?>" class="btn btn-link"><i class="fa fa-arrow-circle-right"></i> Erişim Ayarları</a><hr>
						<h4>Öğretmenler</h4>
						<a href="#" class="btn btn-link"><i class="fa fa-arrow-circle-right"></i> Öğretmen Ekle</a> <a href="#" class="btn btn-link"><i class="fa fa-arrow-circle-right"></i> Öğretmene Ders/Şube Ata</a> <a href="#" class="btn btn-link"><i class="fa fa-arrow-circle-right"></i> Öğretmenden Şube Sil</a> <a href="#" class="btn btn-link"><i class="fa fa-arrow-circle-right"></i> Erişim Ayarları</a><hr>
						<h4>Duyurular</h4>
						<a href="#" class="btn btn-link"><i class="fa fa-arrow-circle-right"></i> Duyuru Ekle</a> <a href="#" class="btn btn-link"><i class="fa fa-arrow-circle-right"></i> Duyuru Sil</a><hr>
					</div>
				</div>
			</div>
		</div>

	</div>
	<div class="col-md-4" style="padding-right: 0;">
		<!--div class="panel panel-default">
			<div class="panel-heading"><i class="fa fa-bullhorn"></i> Duyuru Arşivi:</div>
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
		</div-->
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
<link rel="stylesheet" type="text/css" href="<?php echo $base; ?>css/ticker.css">
<script src="<?php echo $base; ?>js/zabuto_calendar.min.js"></script>
<script src="<?php echo $base; ?>js/ticker.js"></script>
<script type="application/javascript">
	function awNotice() {
		if(!$('.awNotices').hasClass('stopped')){
			var $active = $('.awNotices a.active');
			var $next = $active.next('a');    

			if ($next.length){
				$next.addClass('active');
				$active.removeClass('active');
			}else{
				$active.removeClass('active');
				$('.awNotices a:first-of-type').addClass('active');
			}
		}
	}

	$(document).ready(function () {
		$("#my-calendar").zabuto_calendar({
			language: "tr",
			today: true
		});


		$('.awNotices').append('<span class="controller fa fa-pause"></span>');
		$('.awNotices a:nth-of-type(1)').addClass('active');



		$('.awNotices .controller').click(function(){
			$(this).toggleClass('fa-pause fa-play');
			$('.awNotices').toggleClass('stopped');
		})

		function awNotices(timer){
			setInterval( "awNotice()", timer);
		}

		awNotices(4500);



	});
</script>

