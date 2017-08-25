<?php $this->load->view('static/header');?>
<h2 class="page-title">Sınav Notlarını Duyur</h2>

<script>

	function goToByScroll(id){
    //id = id.replace("link", "");
    // Scroll
    $('html,body').animate({
        scrollTop: ($("#"+id).offset().top + $('#'+id).height())},
        'slow');
	}
</script>

<div class="container-fluid">
	
	<?php
	$hours = array(
	'09:00 - 09:45', '10:00 - 10:45', '11:00 - 11:45', '12:00 - 12:45', 
	'13:00 - 13:45', '14:00 - 14:45', '15:00 - 15:45', '16:00 - 16:45'
	);
	$days = array(
		'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'cumartesi', 'Pazar'
	);

	//var_dump($_POST);

	$this->load->view('messages');
	function printCell($str){
		echo '<td>' . $str . '</td>';
	}
	function printPreviousData(&$_var){
		if(isset($_var)){
			echo $_var;
		}
	}
	?>

		<?php
		if(isset($new_exam)){
		?>
		<div class="row">
			<div class="col-md-12">
				<form actiob="" method="post">
					<h3>Sınava isim verin:</h3>
					<label style="display: block;">
						<input type="text" required placeholder="Örn: I. Vize, II. Vize, Final, vb..." name="new_exam_name" class="form-control" />
					</label>
					<input type="hidden" name="assign_id" value="<?=$assign_id;?>">
					<h3>Notları Girin:</h3>

					<table class="table table-striped">
					<tr>
						<th>Numara</th><th>Ad Soyad</th><th>Bölüm</th><th class="text-right">PUAN</th>
					</tr>
					<?php
					//var_dump($current_attendance);
					foreach ($class_list as $enr) {
						echo '<tr>';
						echo printCell($enr->number);
						echo printCell($enr->user_name);
						echo printCell($enr->department_acronym.$enr->department_code);
						echo printCell('<div class="text-right"><input type="text" required pattern="\d*" name="results[' . $enr->user_id . ']" class="form-control"></div>');
						echo '</tr>';
					}
					?>
					</table>

					<button type="submit" name="save_exam" value="1" class="btn btn-primary btn-block">Sonuçları Duyur</button><hr>
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />

				</form>
			</div>
		</div>
		<?php
		}else if(isset($edit_prev_exam)){
		?>
		<div class="row">
			<div class="col-md-12">
				<form actiob="" method="post">
					<h3>Sınava isim verin:</h3>
					<label style="display: block;">
						<input type="text" required placeholder="Örn: I. Vize, II. Vize, Final, vb..." name="new_exam_name" class="form-control" value="<?=$exam_list[0]->exam_name;?>" />
					</label>
					<input type="hidden" name="assign_id" value="<?=$assign_id;?>">
					<input type="hidden" name="exam_id" value="<?=$exam_id;?>">
					<h3>Notları Girin:</h3>

					<table class="table table-striped">
					<tr>
						<th>Numara</th><th>Ad Soyad</th><th>Bölüm</th><th class="text-right">PUAN</th>
					</tr>
					<?php
					//var_dump($current_attendance);
					foreach ($exam_list as $ex) {
						echo '<tr>';
						echo printCell($ex->number);
						echo printCell($ex->user_name);
						echo printCell($ex->department_acronym.$ex->department_code);
						echo printCell('<div class="text-right"><input type="text" value="' . $ex->result . '" required pattern="\d*" name="results[' . $ex->student . ']" class="form-control"></div>');
						echo '</tr>';
					}
					?>
					</table>

					<button type="submit" name="save_exam" value="1" class="btn btn-primary btn-block">Sonuçları Duyur</button><hr>
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />

				</form>
			</div>
		</div>
		<?php
		}else{
		?>


		<div class="row" id="select-course-row">
			<div class="col-md-12">
				<h3>Sınav notu gireceğiniz dersi seçin:</h3>
				<form action="" method="post">
					<select name="selected_course" class="form-control">
						<option disabled selected value>Bir ders seçin...</option>
						<?php
						foreach ($assigned_courses as $c) {
							echo "<option value='$c->lesson_id-$c->subclass-$c->assign_id' >" .
							$c->department_acronym . $c->lesson_code . ' - ' . $c->lesson_name . ' - Şube: ' . $c->subclass .
							'</option>';
						}
						?>
					</select>
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
					<div class="text-right"><br>
						<button type="submit" name="select_course" value="1" class="btn btn-primary">Seç</button>
					</div>
				</form>

			</div>
		</div>

		<?php
		if(isset($exam_list)){
		?>
		<div class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">İşlem Seçin:</h4>
					</div>
					<div class="modal-body">
						<h3>Önceki Sınavları Düzenle</h3>
						<form action="" method="post">
							<input type="hidden" name="assign_id" value="<?=$assign_id;?>">
							<input type="hidden" name="subclass" value="<?=$subclass;?>">
							<select name="selected_exam" class="form-control">
								<?php $default_opt = (empty($exam_list)) ? 'Hiç sınav girilmemiş' : 'Bir sınav seçin...'; ?>
								<option disabled selected value><?=$default_opt;?></option>
								<?php
								foreach ($exam_list as $e) {
									echo "<option value='$e->exam_id'>" .
									$e->exam_name . '</option>';
								}
								?>
							</select>
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
							<div class="text-right"><br>
								<button type="submit" name="edit_prev_exam" value="1" class="btn btn-primary">Seç</button>
							</div>
						</form>
						<div class="text-center text-danger"><h3>ya da</h3></div>
						<hr>
						<h3>Yeni Sınav Sonucu Ekle</h3>
						<form action="" method="post">
							<button name="create_new_exam" value="1" class="btn btn-primary btn-block">Yeni Sınav Ekle</button>
							<input type="hidden" name="assign_id" value="<?=$assign_id;?>">
							<input type="hidden" name="subclass" value="<?=$subclass;?>">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
						</form>
					</div>
					<!--div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
						<button type="submit" class="btn btn-primary">Kaydet</button>
					</div-->

				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<?php
		}
		?>



		<?php
		}
		?>


		




</div>


<?php $this->load->view('static/footer');

$base = base_url() ."assets/" ?>
<link href="<?=$base?>css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="<?=$base?>js/bootstrap-toggle.min.js"></script>




<script>
$(document).ready(function(){

	$('.modal').modal('show');


	$('#close-window').click(function(){
		window.close();
	});

	$('.start-att-btn').click(function(){
		$('#acd-holder').val($(this).val());
		  window.open('', 'start_att', 'width=800,height=600');
		  document.getElementById('select-course-form').submit();
	});
});
</script>
