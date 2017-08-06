<?php $this->load->view('static/header');?>
<h2 class="page-title">Öğretmene Ders/Şube Ata</h2>



<div class="container-fluid">
	<div class="alert alert-info">
		<strong>Atanan her ders yeni bir şubedir. Şube eklemek için dersi ve hocayı seçerek tekrar atama yapın.</strong>
		<h4>Bu öğretmen bu derse daha önce atanmış ise otomatik olarak yeni şube açılır.</h4>
		<strong>Şubeleri menüde "Öğretmenden Şube Sil" linkini seçerek inceleyebilir/silebilirsiniz.</strong>
	</div>

	<?php
	$this->load->view('messages');
	function printCell($str){
		echo '<td>' . $str . '</td>';
	}

	if(isset($search_result)){
		?>
		<h4 style="text-align: right;">Bulunan Sonuç Sayısı: <span class="badge"><?php echo $all_count; ?></span> - <button id="new-search" class="btn btn-warning">Sonuçları Temizle</button></h4>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-condensed table-hover table-striped">
					<form action="<?php echo site_url() . '/admin/delete_course'; ?>" method="post">
						<tr>
							<th>Ders Adı</th><th>Optik Kodu</th><th>Bölüm</th><th>(İşlem?)</th>
						</tr>
						<?php
						foreach ($search_result as $s) {
							echo "<tr>";
							printCell($s->lesson_name);
							printCell($s->lesson_code);
							printCell($s->department_acronym.$s->department_code);
							printCell('<button type="submit" name="delete_id" value = "' . $s->lesson_id . '" class="btn btn-xs btn-danger">Sil</button>');

							echo "</tr>";
						}
						?>
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
					</form>
				</table>

				<?php
				echo $pagination;
				?>
			</div>
		</div>
		<?php
	}
	?>


	<form action="" method="post">
		<div class="row">

			<div class="col-md-5" id="email-tab">

				<div class="panel panel-default">
					<div class="panel-heading">Öğretmen Seç:</div>
					<div class="panel-body">
						<div class="form-group">
							<div class="input-group">
								<select name="teacher" class="form-control">
									<option disabled selected value>Bir öğretmen seçin...</option>
									<?php
									foreach ($teachers as $t) {
										echo "<option value='$t->user_id' >" . $t->user_name . '</option>';
									}
									?>
								</select>

								<span class="input-group-btn">
									<button type="button" class="btn btn-default btn-search clear-teacher"><i class="fa fa-eraser"></i> Temizle</button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-2 text-center">
				<h1 style="line-height: 90px;"><i class="fa fa-exchange fa-lg"></i></h1>
			</div>

			<div class="col-md-5" id="dept-tab">

				<div class="panel panel-default">
					<div class="panel-heading">Ders Seç:</div>
					<div class="panel-body">
						<div class="form-group">
							<div class="input-group">
								<select name="course" class="form-control">
									<option disabled selected value>Bir ders seçin...</option>
									<?php
									foreach ($courses as $c) {
										echo "<option value='$c->lesson_id' >" . $c->department_acronym . $c->lesson_code . ' - ' . $c->lesson_name . '</option>';
									}
									?>
								</select>

								<span class="input-group-btn">
									<button type="button" class="btn btn-default btn-search clear-course"><i class="fa fa-eraser"></i> Temizle</button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<!--input type="hidden" style="display: none;" name="page" value="1" /-->
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />

		<div class="row">
			<div class="col-md-offset-4 col-md-4">
				<div class="col-md-12 text-center text-info"><hr><strong>Atanan her ders yeni bir şubedir. Şube eklemek için dersi ve hocayı seçerek tekrar atama yapın.</strong><hr></div>
				<div class="col-md-12 text-center text-info">Dersin günü ve saatini öğretmen belirleyecektir.</div>
				<button type="submit" name="search_btn" value="1" class="btn btn-primary btn-block"><i class="fa fa-link"></i> Ders Ata</button><br>
			</div><br>
		</div>
	</form>






</div>






<?php $this->load->view('static/footer'); ?>
<script>
	$(document).ready(function(){
		$('.clear-course').click(function(){
			$('select[name=course] option').eq(0).prop('selected', true);
		});
		$('.clear-teacher').click(function(){
			$('select[name=teacher] option').eq(0).prop('selected', true);
		});
		
	});
</script>