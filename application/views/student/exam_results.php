<?php $this->load->view('static/header');?>
<h2 class="page-title">Sınav Notlarını İncele</h2>

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

		<div class="row" id="select-course-row">
			<div class="col-md-12">
				<h3>Sınav notunu göreceğiniz dersi seçin:</h3>
				<form action="" method="post">
					<select name="selected_course" class="form-control">
						<option disabled selected value>Bir ders seçin...</option>
						<?php
						foreach ($enrolments as $enr) {
							echo "<option value='$enr->lesson_id-$enr->subclass-$enr->assign_id' >" .
							$enr->department_acronym . $enr->lesson_code . ' - ' . $enr->lesson_name . ' - Şube: ' . $enr->subclass .
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
		if(isset($view_prev_exam)){
		?>
		<div class="row">
			<div class="col-md-12">
					<h3>Sınav: <?=$exam_list[0]->exam_name;?></h3>
					<h3>Sınıf Notları:</h3>

					<table class="table table-striped">
					<tr>
						<th>Numara</th><th>Ad Soyad</th><th>Bölüm</th><th class="text-right">PUAN</th>
					</tr>
					<?php
					//var_dump($current_attendance);
					foreach ($exam_list as $ex) {
						$style='';
						if($ex->user_id == $this->session->userdata('user')->user_id)
							$style = ' style="color: red; font-weight:bold; border-color: red;" ';
						echo "<tr$style>";
						echo printCell($ex->number);
						echo printCell($ex->user_name);
						echo printCell($ex->department_acronym.$ex->department_code);
						echo printCell($ex->result);
						echo '</tr>';
					}
					?>
					</table>

			</div>
		</div>
		<?php
		}else{
		?>

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
						<h3>Sınav Seç:</h3>
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
								<button type="submit" name="view_prev_exam" value="1" class="btn btn-primary">Seç</button>
							</div>
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
