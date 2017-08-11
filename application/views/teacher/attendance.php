<?php $this->load->view('static/header');?>
<h2 class="page-title">Yoklama Gir</h2>


<script>

	var selected_courses = [];

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

	$this->load->view('messages');
	function printCell($str){
		echo '<td>' . $str . '</td>';
	}
	function printPreviousData(&$_var){
		if(isset($_var)){
			echo $_var;
		}
	}

	var_dump($_POST);

	if(isset($program)){
		//exit(var_dump($program));
		?>
		
		<div class="row">
			<button id="wp-toggle-menu" class="btn btn-warning">
				<span class="hide-span"><i class="fa fa-angle-left" aria-hidden="true"></i> Yan menüyü gizle</span>
				<span class="show-span hidden"><i class="fa fa-angle-right" aria-hidden="true"></i> Yan menüyü göster</span>
			</button>
			<hr>
		</div>

		<div class="row">
			<h3>Hafta Seçin:</h3>
			<div class="btn-group colors" data-toggle="buttons">
				<label class="btn btn-success active">
					<input type="radio" name="options" value="red" autocomplete="off" checked> Red
				</label>
				<label class="btn btn-success">
					<input type="radio" name="options" value="orange" autocomplete="off"> Orange
				</label>
				<label class="btn btn-success">
					<input type="radio" name="options" value="yellow" autocomplete="off"> Yellow
				</label>
			</div>
			<hr>

		</div>

		<div class="row">
			<h3>Ders Saati Seçin:</h3>
			<form action="" method="post">
				<table class="prog_table table table-condensed table-hover table-striped">
					<tr>
						<td>Ders</td>
						<td>Saat</td>
						<td>Pazartesi</td>
						<td>Salı</td>
						<td>Çarşamba</td>
						<td>Perşembe</td>
						<td>Cuma</td>
					</tr>
					<?php
					function create_rgb(){
						return (string)(rand(50,220).','.rand(50,220).','.rand(50,220));
					}
					for($i = 0; $i<count($program); $i++){
						$program[$i]->color = create_rgb();
					}
					

					$course_types = array('( Teorik )', '( Pratik )');
					for($i = 0; $i<8; $i++) : ?>
					<tr>
						<td>(<?=($i+1);?>)</td><td><?=$hours[$i];?></td>
						<?php for($j = 0; $j<5; $j++) : ?>
							<td>
								<?php 
								$isEmpty = true;
								foreach ($program as $c){
									if($c->day == $j && $c->hour == $i){
										$isEmpty = false;
										break;
									}
								}
								if(!$isEmpty){
									?>
									<button type="submit" name="weekly_program_data" value="<?=$c->p_data_id;?>" class="btn btn-sm btn-primary btn-block"><?=$c->lesson_name.' '.$course_types[$c->type-1].' - Şube: '.$c->subclass;?></button>
									<?php
								}else{
									?>
									<button type="button" class="btn btn-sm btn-default btn-block" disabled="disabled">BOŞ</button>
									<?php
								}


								?>

							</td>
						<?php endfor; ?>

					</tr>
				<?php endfor; ?>

			</table>
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
		</form>
	</div>


	<?php if(isset($student_list)){ ?>
	<div class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<form action="" method="post">
					<input name="day" type="hidden" value="<?=$student_list[0]->day;?>">
					<input name="hour" type="hidden" value="<?=$student_list[0]->hour;?>">
					<input name="p_data_id" type="hidden" value="<?=$p_data_id;?>">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Bu Derse Yoklama Gir:</h4>
					</div>
					<div class="modal-body">
						<h3>Hafta Seçin:</h3>
						<div class="btn-group colors" data-toggle="buttons">
							<?php
							var_dump($course_data);
							for($i=0; $i<$course_data->weeks; $i++){
							?>
							<label class="btn btn-default">
								<input type="radio" name="week" value="<?=($i+1);?>" autocomplete="off"> <?=($i+1).'. Hafta';?>
							</label>
							<?php
							}
							?>
						</div>
						<h3>Gün:</h3>
						<?=$days[$student_list[0]->day];?>
						<h3>Saat:</h3>
						<?=$hours[$student_list[0]->hour];?>
						<hr>

						<?php
						//var_dump($student_list);
						?>
						<table class="prog_table table table-condensed table-hover table-striped">
						<tr>
							<th>Numara</th><th>Ad Soyad</th><th>Bölüm</th><th>Derse Katılım</th>
						</tr>
						<?php
						foreach ($student_list as $s) {
						?>
						<tr>
							<td><?=$s->number;?></td>
							<td><?=$s->user_name;?></td>
							<td><?=$s->department_acronym.$s->department_code;?></td>
							<td><input type="checkbox" class="att-check" name="att_data[]" data-toggle="toggle" data-on="EVET" data-off="HAYIR" data-onstyle="success" data-offstyle="default" value="<?=$s->user_id;?>"></td>
						</tr>
						<?php
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
	<script>
	$(document).ready(function(){
		/*$('.att-check').change(function(){
			if( $(this).prop('checked') ){
				$(this).val('1');
			}else{
				$(this).val('-1');
			}
		});*/
	});
	</script>
	<?php
	}
	?>

	<script>
		for(var i=0; i<selected_courses.length; i++){
			$(selected_courses[i].elem).val(selected_courses[i].val);
			set_selection($(selected_courses[i].elem));
		}
	</script>


	<?php
}
?>




</div>






<?php $this->load->view('static/footer');

$base = base_url() ."assets/" ?>
<link href="<?=$base?>css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="<?=$base?>js/bootstrap-toggle.min.js"></script>

<?php
if(isset($student_list)){
?>
<script>
	$('.modal').modal('show');
</script>
<?php
}
?>