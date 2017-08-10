<?php $this->load->view('static/header');?>
<h2 class="page-title">Ders Programı Ayarla</h2>


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
	$this->load->view('messages');
	function printCell($str){
		echo '<td>' . $str . '</td>';
	}
	function printPreviousData(&$_var){
		if(isset($_var)){
			echo $_var;
		}
	}

	if(isset($assigned_courses)){
		?>
		
		<div class="row">
			<button id="wp-toggle-menu" class="btn btn-warning">
				<span class="hide-span"><i class="fa fa-angle-left" aria-hidden="true"></i> Yan menüyü gizle</span>
				<span class="show-span hidden"><i class="fa fa-angle-right" aria-hidden="true"></i> Yan menüyü göster</span>
			</button>
			<hr>
		</div>

		<div class="row">
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
					for($i = 0; $i<count($assigned_courses); $i++){
						$assigned_courses[$i]->color = create_rgb();
					}
					$hours = array(
						'09:00 - 09:45', '10:00 - 10:45', '11:00 - 11:45', '12:00 - 12:45', 
						'13:00 - 13:45', '14:00 - 14:45', '15:00 - 15:45', '16:00 - 16:45', 
						);
					
					$course_types = array('( Teorik )', '( Pratik )');
					for($i = 0; $i<8; $i++) : ?>
					<tr>
						<td>(<?=($i+1);?>)</td><td><?=$hours[$i];?></td>
						<?php for($j = 0; $j<5; $j++) : ?>
							<td>
								<select id="prog-select-<?=$i.$j;?>" name="days[<?=$j;?>][]" class="form-control input-sm course-select">
									<option selected value="-1">Boş</option>
									<?php foreach ($assigned_courses as $c) :
									?>
									<option value="<?=$c->acd_id;?>"><?=$c->lesson_name.' '.$course_types[$c->type-1].' - Şube: '.$c->subclass;?></option>
									<!--option style="font-size: 1pt; background-color: #000000;" disabled>&nbsp;</option-->
								<?php endforeach;

								foreach ($program as $p) {
									if($p->hour == $i && $p->day == $j){
										?>
										<script>
											selected_courses.push({
												elem: '#prog-select-<?=$i.$j;?>',
												index: <?=$p->assigned_course;?>,
												val: <?=$p->assigned_course_data;?>
											});
													/*$('#prog-select-<?=$i.$j;?>').val('<?=$p->assigned_course;?>');
													set_selection($('#prog-select-<?=$i.$j;?>'));*/
												</script>

												<?php
												break;
											}
										}

										?>
									</select>
									<button type="button" class="btn btn-sm btn-danger btn-block clear-class" style="display: none;">Bu dersi sil</button>
								</td>
							<?php endfor; ?>

						</tr>
					<?php endfor; ?>

				</table>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
				<div class="text-right"><button type="submit" class="btn btn-primary">Kaydet</button><hr></div>
			</form>
		</div>

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






<?php $this->load->view('static/footer'); ?>

