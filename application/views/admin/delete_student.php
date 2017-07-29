<?php $this->load->view('static/header');?>
<h2 class="page-title">Öğrenci Engelle / Geri Getir</h2>



<div class="container-fluid">
	<div class="alert alert-info">
		<strong>Bilgi:</strong> Öğrenci kaydı tamamen silinmez. Öğrencinin sisteme girişi engellenir.<br>
		<strong>Birden fazla ölçütü bir arada kullanarak arama yapabilirsiniz</strong>
	</div>

	<?php
	$this->load->view('messages');
	function printCell($str){
		echo '<td>' . $str . '</td>';
	}
	function printPreviousData(&$_var){
		if(isset($_var)){
			echo $_var;
		}
	}
	if(isset($search_result)){
		?>
		<h4 style="text-align: right;">Bulunan Sonuç Sayısı: <span class="badge"><?php echo $all_count; ?></span></h4>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-condensed table-hover table-striped">
					<form action="<?php echo site_url() . '/admin/delete_student'; ?>" method="post">
						<tr>
							<th>Ad Soyad</th><th>Numara</th><th>Bölüm</th><th>Yetki</th><th>Üyelik Durumu</th><th>(İşlem?)</th>
						</tr>
						<?php
						foreach ($search_result as $s) {
							echo "<tr>";
							printCell($s->user_name);
							printCell($s->number);
							printCell($s->department_acronym.$s->department_code);
							printCell($s->auth_name);
							if($s->isActive === '0')
								printCell('<span class="text-danger">Aktif Değil</span>');
							else
								printCell('<span class="text-success">Aktif</span>');

							if($s->isActive === '1')
								printCell('<button type="submit" name="delete_id" value = "' . $s->user_id . '" class="btn btn-xs btn-danger">Engelle</button>');
							else
								printCell('<button type="submit" name="activate_id" value = "' . $s->user_id . '" class="btn btn-xs btn-success">Aktifleştir</button>');
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


	<form action="<?php echo site_url() . '/admin/delete_student'; ?>" method="post">
		<div class="row">
			<div class="col-md-6 active" id="name-tab">

				<div class="panel panel-default">
					<div class="panel-heading">Ad Soyada Göre Ara:</div>
					<div class="panel-body">
						<div class="form-group">
							<div class="input-group">
								<input type="text" name="student_name" class="form-control" />

								<span class="input-group-btn">
									<button type="button" class="btn btn-default btn-search clear-name"><i class="fa fa-eraser"></i> Temizle</button>
								</span>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="col-md-6" id="num-tab">
				<div class="panel panel-default">
					<div class="panel-heading">Numaraya Göre Ara:</div>
					<div class="panel-body">
						<div class="form-group">
							<div class="input-group">
								<input type="text" pattern="\d*" name="student_num"  class="form-control" />

								<span class="input-group-btn">
									<button type="button" class="btn btn-default btn-search clear-num"><i class="fa fa-eraser"></i> Temizle</button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6" id="dept-tab">

				<div class="panel panel-default">
					<div class="panel-heading">Bölüme Göre Ara:</div>
					<div class="panel-body">
						<div class="form-group">
							<div class="input-group">
								<select name="student_dept" class="form-control">
									<option disabled selected value>Bir bölüm seçin...</option>
									<?php
									foreach ($departments as $dep) {
										echo "<option value='$dep->department_code' >" . $dep->department_acronym . '-' . $dep->department_code . '</option>';
									}
									?>
								</select>

								<span class="input-group-btn">
									<button type="button" class="btn btn-default btn-search clear-select"><i class="fa fa-eraser"></i> Temizle</button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6" id="email-tab">

				<div class="panel panel-default">
					<div class="panel-heading">Emaile Göre Ara:</div>
					<div class="panel-body">
						<div class="form-group">
							<div class="input-group">
								<input type="email" name="student_email" class="form-control" />

								<span class="input-group-btn">
									<button type="button" class="btn btn-default btn-search clear-email"><i class="fa fa-eraser"></i> Temizle</button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-offset-4 col-md-4">
				<div class="col-md-12 text-center text-info">Boş bıraktığınız alanlar aramaya dahil edilmez.</div>
				<button type="submit" name="search_btn" value="1" class="btn btn-primary btn-block"><i class="fa fa-search"></i> Ara</button><br>
			</div><br>
		</div>
		<!--input type="hidden" style="display: none;" name="page" value="1" /-->
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
	</form>


</div>




<?php $this->load->view('static/footer'); ?>
<script>
	$(document).ready(function(){
		$('.clear-select').click(function(){
			$('select option').eq(0).prop('selected', true);
		});
		$('.clear-name').click(function(){
			$('input[name=student_name]').val('');
		});
		$('.clear-num').click(function(){
			$('input[name=student_num]').val('');
		});
		$('.clear-email').click(function(){
			$('input[name=student_email]').val('');
		});
	});
</script>