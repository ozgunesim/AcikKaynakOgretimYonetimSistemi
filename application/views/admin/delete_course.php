<?php $this->load->view('static/header');?>
<h2 class="page-title">Dersi Sistemden Kaldır</h2>



<div class="container-fluid">
	<div class="alert alert-info">
		<strong>Bilgi:</strong> Silinen ders sistemden tamamen kaldırılır.<br>
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
		<h4 style="text-align: right;">Bulunan Sonuç Sayısı: <span class="badge"><?php echo $all_count; ?></span> - <button id="new-search" class="btn btn-warning">Sonuçları Temizle</button></h4>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-condensed table-hover table-striped">
					<form action="<?php echo site_url() . '/admin/delete_teacher'; ?>" method="post">
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


	<form action="<?php echo site_url() . '/admin/delete_course'; ?>" method="post">
		<div class="row">

			<div class="col-md-6" id="email-tab">

				<div class="panel panel-default">
					<div class="panel-heading">Optik Koda Göre Ara:</div>
					<div class="panel-body">
						<div class="form-group">
							<div class="input-group">
								<input type="text" name="optic" pattern="\d{3}" class="form-control" />

								<span class="input-group-btn">
									<button type="button" class="btn btn-default btn-search clear-optic"><i class="fa fa-eraser"></i> Temizle</button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6" id="dept-tab">

				<div class="panel panel-default">
					<div class="panel-heading">Bölüme Göre Ara:</div>
					<div class="panel-body">
						<div class="form-group">
							<div class="input-group">
								<select name="course_dept" class="form-control">
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
		</div>

		<div class="row">
			<div class="col-md-12" id="name-tab">

				<div class="panel panel-default">
					<div class="panel-heading">Ders Adına Göre Ara:</div>
					<div class="panel-body">
						<div class="form-group">
							<div class="input-group">
								<input type="text" name="course_name" class="form-control" />

								<span class="input-group-btn">
									<button type="button" class="btn btn-default btn-search clear-name"><i class="fa fa-eraser"></i> Temizle</button>
								</span>
							</div>
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
			$('input[name=course_name]').val('');
		});
		$('.clear-optic').click(function(){
			$('input[name=optic]').val('');
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