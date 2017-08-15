<?php $this->load->view('static/header');?>
<h2 class="page-title">Öğretmenden Şube Sil</h2>



<div class="container-fluid">
	<div class="alert alert-info">
		<strong>Birden fazla ölçütü bir arada kullanarak arama yapabilirsiniz.</strong>
		<h4>BİR ŞUBE SİLİNDİKTEN SONRA O DERSE AİT DİĞER ŞUBELER YENİDEN NUMARALANDIRILIR.</h4>
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
		/*if(!empty($search_result))
			echo '<pre>' . var_dump($search_result) . '</pre>';*/
		?>
		<h4 style="text-align: right;">Bulunan Sonuç Sayısı: <span class="badge"><?php echo $all_count; ?></span> - <button id="new-search" class="btn btn-warning">Sonuçları Temizle</button></h4>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-condensed table-hover table-striped">
					<form action="" method="post">
						<tr>
							<th>Ad Soyad</th><th>Verdiği Ders</th><th>Dersin Optik Kodu</th><th>Şubesi</th><th>Dersi Veren Bölüm</th><th>Teorik</th><th>Pratik</th><th>AKTS</th><th>(İşlem?)</th>
						</tr>
						<?php
						foreach ($search_result as $s) {
							echo "<tr>";
							printCell($s->user_name);
							printCell($s->lesson_name);
							printCell($s->lesson_code);
							printCell($s->subclass);
							printCell($s->department_acronym.$s->department_code);
							printCell($s->theoric_hours);
							printCell($s->practice_hours);
							printCell($s->akts);
							printCell('<button type="submit" name="delete_id" value = "' . $s->assign_id . '" class="btn btn-xs btn-danger">Şubeyi Sil</button>');
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
									<button type="button" class="btn btn-default btn-search clear-honour"><i class="fa fa-eraser"></i> Temizle</button>
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
					<div class="panel-heading">Öğretmenin Bölümüne Göre Ara:</div>
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
									<button type="button" class="btn btn-default btn-search clear-dept"><i class="fa fa-eraser"></i> Temizle</button>
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
		$('.clear-dept').click(function(){
			$('select[name=teacher_dept] option').eq(0).prop('selected', true);
		});
		$('.clear-name').click(function(){
			$('input[name=teacher_name]').val('');
		});
		$('.clear-honour').click(function(){
			$('select[name=teacher_honour] option').eq(0).prop('selected', true);
		});
		$('.clear-email').click(function(){
			$('input[name=teacher_email]').val('');
		});
		$('#new-search').click(function(){
			$('select option').eq(0).prop('selected', true);
			var csrf = $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>').val();
			$('input').val('');
			$('input[name=<?php echo $this->security->get_csrf_token_name(); ?>').val(csrf);
			$('button[name=search_btn]').click();
		});
	});
</script>