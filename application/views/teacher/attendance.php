<?php $this->load->view('static/header');?>
<h2 class="page-title">Yoklama Gir</h2>

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


	if(isset($program)){
		?>
		
		<div class="row wp-toggle-menu-row">
			<button class="btn btn-warning toggle-menu-btn"></button>
			<hr>
		</div>


		<div class="row">
			<?php if($this->input->post('selected_course') != null){ ?>

			<form action="" method="post" id="calendar-form">
				<h3><strong></strong> Dersinizin Gününü Seçin:</h3>

				<div id="att_calendar"></div>
				<input type="hidden" id="selected-date-input" name="selected_date" />
				<input type="hidden" name="final_course" value="<?=$selected_course->course;?>">
				<input type="hidden" name="final_assigned_course" value="<?=$selected_course->acd_id;?>">
				<input type="hidden" name="final_subclass" value="<?=$selected_course->subclass;?>">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
				<script>
					goToByScroll('att_calendar');
				</script>
			</form>
			<?php } ?>


		</div>


		<?php if(isset($subclass_list)){ ?>
		<div class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<form action="" method="post" target="start_att" id="select-course-form">
						<input name="final_day" type="hidden" value="<?=$subclass_list[0]->day;?>">
						<input name="final_date" type="hidden" value="<?=$final_date;?>">
						<input name="final_assigned_course" type="hidden" value="<?=$final_assigned_course;?>">
						<input type="hidden" name="final_hour_acd" id="acd-holder">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Saat Seçin:</h4>
						</div>
						<div class="modal-body">
							<table class="table table-striped">
							<tr>
								<th>Gün</th><th>Saat</th><th>Ders</th><th>Şube</th><th>İşlem</th>
							</tr>
							<?php
							foreach ($subclass_list as $sub) {
								echo '<tr>';
								echo printCell($days[$sub->day]);
								echo printCell($hours[$sub->hour]);
								echo printCell($sub->lesson_name);
								echo printCell($sub->subclass);
								echo printCell('<button class="btn btn-primary start-att-btn" type="button" name="final_hour_acd" value="' . $sub->hour . '-' . $sub->acd_id . '"><i class="fa fa-pencil"></i> Yoklama Al</button>');
								echo '</tr>';
							}
							?>
							</table>


						</div>
						<!--div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
							<button type="submit" class="btn btn-primary">Kaydet</button>
						</div-->
					</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->


		<?php } ?>



		<?php if(isset($ready_to_att)){
			$this->load->config('config');
			$force_date = $this->config->item('force_attendance_date');
			if($att_data->date <= date('Y-m-d') || !$force_date){
			?>
			<form action="" method="post">
				<input type="hidden" name="date" value="<?=$att_data->date;?>">
				<input type="hidden" name="hour" value="<?=$att_data->hour;?>">
				<input type="hidden" name="acd_id" value="<?=$att_data->acd_id;?>">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
				<?php
				if(!isset($enrolments) || empty($enrolments)){
				?>
					<div class="alert alert-warning">Bu derse henüz öğrenci kayıt olmamış.</div>
				<?php
				}else{
				?>
					<div class="row">
						<div class="col-xs-6">
							<h4><strong class="text-info">Tarih:</strong> <?=$att_data->date;?></h4>
						</div>
						<div class="col-xs-6">
							<h4><strong class="text-info">Saat:</strong> <?=$att_data->hour;?></h4>
						</div>
					</div><hr>

					<table class="table table-striped">
					<tr>
						<th>Numara</th><th>Ad Soyad</th><th>Bölüm</th><th class="text-right">Katılım?</th>
					</tr>
					<?php
					//var_dump($current_attendance);
					foreach ($enrolments as $enr) {
						echo '<tr>';
						echo printCell($enr->number);
						echo printCell($enr->user_name);
						echo printCell($enr->department_acronym.$enr->department_code);
						$checked = "";
						if(isset($current_attendance) && $current_attendance != null){
							foreach ($current_attendance as $cur_att) {
								if($cur_att->student_id == $enr->user_id && $cur_att->state === '1'){
									$checked = "checked";
									break 1;
								}
							}
						}
						echo printCell('<div class="text-right"><input type="checkbox" ' . $checked . ' data-width="100" name="att_check[]" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="BURADA" data-off="YOK" value="' . $enr->user_id . '"></div>');
						echo '</tr>';
					}
					?>
					</table>


				<?php
				}
				?>
				<hr>
				<div class="text-right">
					<button type="button" class="btn btn-default" id="close-window" data-dismiss="modal">Vazgeç</button>
					<button type="submit" name="finish_att" value="1" class="btn btn-primary">Kaydet</button>
				</div>
			</form>
			<?php
			}else{
			?>
				<div class="alert alert-danger text-center"><h3>İleri bir tarihe yoklama alamazsınız!</h3></div>
			<?php
			}
		?>
				
		<?php } ?>

		<div class="row" id="select-course-row">
			<hr>
			<form action="" method="post">
				<select name="selected_course" class="form-control">
					<option disabled selected value>Bir ders seçin...</option>
					<?php
					foreach ($assigned_courses as $c) {
						echo "<option value='$c->lesson_id-$c->subclass-$c->acd_id' >" .
						$c->department_acronym . $c->lesson_code . ' - ' . $c->lesson_name . ' - Şube: ' . $c->subclass .
						'</option>';
					}
					?>
				</select>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
				<div class="text-right"><br>
					<button type="submit" class="btn btn-primary">Ders Takvimini Getir</button>
				</div>
			</form>
		</div>


	<?php
	}
	?>
</div>


<?php
if(isset($ready_to_att)){
?>
<script>
	$('.left-side').hide();
	$('.wp-toggle-menu-row').hide();
	$('.main-container').removeClass('col-md-10').addClass('col-md-12');
	$('#select-course-row').hide();
	$('.page-title').hide();
</script>
<?php
}
?>




<?php $this->load->view('static/footer');

$base = base_url() ."assets/" ?>
<link href="<?=$base?>css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="<?=$base?>js/bootstrap-toggle.min.js"></script>




<script>
function calendar_click(id){
	var hasEvent = $("#" + id).data("hasEvent");
	if(hasEvent){
		var date = $("#" + id).data("date");
		$('#selected-date-input').val(date);
		$('#calendar-form').submit();
		//alert(date);
	}else{
		alert('Bu tarih boş görünüyor!');
	}
	
}

$(document).ready(function(){

	$('.modal').modal('show');

	$("#att_calendar").zabuto_calendar({
		cell_border: true,
    today: true,
    show_days: true,
    weekstartson: 1,
    /*nav_icon: {
      prev: '<i class="fa fa-chevron-circle-left"></i>',
      next: '<i class="fa fa-chevron-circle-right"></i>'
    },*/
    legend: [{type: "block", label: "Dersinizin Olduğu Gün", classname: "blue-legend"}],
    data: <?php echo json_encode($calendar); ?>,
    language: 'tr',
    action: function(){
    	calendar_click(this.id);
    }
	});

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
