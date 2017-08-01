<?php $this->load->view('static/header');?>
<h2 class="page-title">Öğretmen Engelle / Geri Getir</h2>



<div class="container-fluid">
	<div class="alert alert-info">
		<strong>Bilgi:</strong> Öğretmen kaydı tamamen silinmez. Öğretmenin sisteme girişi engellenir.<br>
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
					<form action="<?php echo site_url() . '/admin/delete_teacher'; ?>" method="post">
						<tr>
							<th>Ad Soyad</th><th>Ünvan</th><th>Bölüm</th><th>Yetki</th><th>Üyelik Durumu</th><th>(İşlem?)</th>
						</tr>
						<?php
						foreach ($search_result as $s) {
							echo "<tr>";
							printCell($s->user_name);
							printCell($s->honour_name);
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


	<form action="<?php echo site_url() . '/admin/delete_teacher'; ?>" method="post">
		<div class="row">
			<div class="col-md-6 active" id="name-tab">

				<div class="panel panel-default">
					<div class="panel-heading">Ad Soyada Göre Ara:</div>
					<div class="panel-body">
						<div class="form-group">
							<div class="input-group">
								<input type="text" name="teacher_name" class="form-control" />

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
					<div class="panel-heading">Ünvana Göre Ara:</div>
					<div class="panel-body">
						<div class="form-group">
							<div class="input-group">
								<select name="teacher_honour" class="form-control">
									<option disabled selected value>Bir ünvan seçin...</option>
									<?php
									foreach ($honours as $hon) {
										echo "<option value='$hon->honour_id' >" . $hon->honour_name . '</option>';
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
		</div>

		<div class="row">
			<div class="col-md-6" id="dept-tab">

				<div class="panel panel-default">
					<div class="panel-heading">Bölüme Göre Ara:</div>
					<div class="panel-body">
						<div class="form-group">
							<div class="input-group">
								<select name="teacher_dept" class="form-control">
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
								<input type="email" name="teacher_email" class="form-control" />

								<span class="input-group-btn">
									<button type="button" class="btn btn-default btn-search clear-email"><i class="fa fa-eraser"></i> Temizle</button>
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
				<div class="col-md-12 text-center text-info">Boş bıraktığınız alanlar aramaya dahil edilmez.</div>
				<button type="submit" name="search_btn" value="1" class="btn btn-primary btn-block"><i class="fa fa-search"></i> Ara</button><br>
			</div><br>
		</div>
	</form>


</div>




<?php $this->load->view('static/footer'); ?>
<script>
	$(document).ready(function(){
		$('.clear-select').click(function(){
			$('select option').eq(0).prop('selected', true);
		});
		$('.clear-name').click(function(){
			$('input[name=teacher_name]').val('');
		});
		$('.clear-num').click(function(){
			$('input[name=teacher_num]').val('');
		});
		$('.clear-email').click(function(){
			$('input[name=teacher_email]').val('');
		});
	});
</script>