<?php $this->load->view('static/header');?>
<h2 class="page-title">Yoklama Gir</h2>

<script>

	var selected_courses = [];

	function goToByScroll(id){
    //id = id.replace("link", "");
    // Scroll
    $('html,body').animate({
        scrollTop: ($("#"+id).offset().top + $('#'+id).height())},
        'slow');
	}


	function set_selection(elem){
		var index = $(elem).prop('selectedIndex');
		if(index != 0){
			$('.course-select').not(elem).find('option:eq(' + index + ')').attr('disabled','disabled');
			$(elem).attr('data-selection', index);

			var txt = $(elem).find('option:eq(' + index + ')').text();
			$(elem).hide();
			$(elem).next().show().html('<i class="fa fa-times"></i> ' + txt);
		}
	}

	function clear_selected(elem){
		$(elem).hide();
		$(elem).prev().show();
		$(elem).prev().prop('selectedIndex', 0);
		var selected = $(elem).prev().attr('data-selection');
		$('.course-select').find('option:eq(' + selected + ')').removeAttr('disabled');
	}

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
		$('button[name=course_id]').click(function(){
			$('.modal').modal('show');
		});
		/*$('select').change(function(){
			$(this).css('color', $(this).find( "option:selected" ).css('background-color'));
		}); ?>*/


		$('.course-select').change(function(){
			set_selection($(this));
			/*var index = $(this).prop('selectedIndex');
			if(index != 0){
				$('.course-select').not(this).find('option:eq(' + index + ')').attr('disabled','disabled');
				$(this).attr('data-selection', index);

				var txt = $(this).find('option:eq(' + index + ')').text();
				$(this).hide();
				$(this).next().show().html('<i class="fa fa-times"></i> ' + txt);
			}*/
			
		});

		$('.clear-class').click(function(){
			clear_selected($(this));
			/*$(this).hide();
			$(this).prev().show();
			$(this).prev().prop('selectedIndex', 0);
			var selected = $(this).prev().attr('data-selection');
			$('.course-select').find('option:eq(' + selected + ')').removeAttr('disabled');*/
		});


		$('#wp-toggle-menu').click(function(){
			$('.left-side').toggleClass('hidden');
			$('.main-container').toggleClass('col-md-10').toggleClass('col-md-12');
			$(this).find('span').toggleClass('hidden');
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


<div class="container-fluid">
	
	<?php
	$hours = array(
	'09:00 - 09:45', '10:00 - 10:45', '11:00 - 11:45', '12:00 - 12:45', 
	'13:00 - 13:45', '14:00 - 14:45', '15:00 - 15:45', '16:00 - 16:45'
	);
	$days = array(
		'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'cumartesi', 'Pazar'
	);

	var_dump($_POST);

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
		
		<div class="row">
			<button id="wp-toggle-menu" class="btn btn-warning">
				<span class="hide-span"><i class="fa fa-angle-left" aria-hidden="true"></i> Yan menüyü gizle</span>
				<span class="show-span hidden"><i class="fa fa-angle-right" aria-hidden="true"></i> Yan menüyü göster</span>
			</button>
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
					<form action="" method="post">
						<input name="final_day" type="hidden" value="<?=$subclass_list[0]->day;?>">
						<input name="final_date" type="hidden" value="<?=$final_date;?>">
						<input name="final_assigned_course" type="hidden" value="<?=$final_assigned_course;?>">
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
								echo printCell('<button class="btn btn-primary" name="final_hour_acd" value="' . $sub->hour . '-' . $sub->acd_id . '"><i class="fa fa-pencil"></i> Yoklama Al</button>');
								echo '</tr>';
							}
							?>
							</table>


						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
							<button type="submit" class="btn btn-primary">Kaydet</button>
						</div>
					</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->


		<?php } ?>



		<?php if(isset($ready_to_att)){
		?>
		<div class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<form action="" method="post">
						<input type="hidden" name="date" value="<?=$att_data->date;?>">
						<input type="hidden" name="hour" value="<?=$att_data->hour;?>">
						<input type="hidden" name="acd_id" value="<?=$att_data->acd_id;?>">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Yoklama Girin:</h4>
						</div>
						<div class="modal-body">
							<?php
							if(!isset($enrolments) || empty($enrolments)){
							?>
							<div class="alert alert-warning">Bu derse henüz öğrenci kayıt olmamış.</div>
							<?php
							}else{
							?>


							<table class="table table-striped">
							<tr>
								<th>Numara</th><th>Ad Soyad</th><th>Bölüm</th><th>Katılım?</th>
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
								echo printCell('<input type="checkbox" ' . $checked . ' data-width="100" name="att_check[]" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="BURADA" data-off="YOK" value="' . $enr->user_id . '">');
								echo '</tr>';
							}
							?>
							</table>


							<?php
							}
							?>
							


						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
							<button type="submit" name="finish_att" value="1" class="btn btn-primary">Kaydet</button>
						</div>
					</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<?php } ?>

		<div class="row">
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
}else{
?>
<div class="alert alert-warning">Henüz bir ders programınız yok.</div>
<?php
}
?>




</div>






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
});
</script>
