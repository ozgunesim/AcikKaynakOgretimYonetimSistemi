<?php $this->load->view('static/header');?>
<h2 class="page-title">Devamsızlık Durumunu İncele</h2>



<div class="container-fluid">
	<?php $this->load->view('messages');?>
	<?php
	function printCell($str){
		echo '<td>' . $str . '</td>';
	}
	?>
	<div class="row">
		<div class="col-md-12">
			<h3>Devam durumu incelenecek dersi seçin:</h3>
			<form action="" method="post">
				<select name="selected_course" class="form-control">
					<option disabled selected value>Bir ders seçin...</option>
					<?php
					foreach ($enrolments as $enr) {
						echo "<option value='$enr->assign_id-$enr->lesson_id' >" .
						$enr->department_acronym . $enr->lesson_code . ' - ' . $enr->lesson_name . ' - Şube: ' . $enr->subclass .
						'</option>';
					}
					?>
				</select>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
				<div class="text-right"><br>
					<button type="submit" class="btn btn-primary">Seç</button>
				</div>
			</form>
			<?php
			if(isset($user_att)){
				?>
					<div class="alert alert-danger hidden" id="att_result_div"></div>
					<table class="table table-striped table-hover table-condensed">
						<tr>
							<th>Tarih</th><th>Saat</th><th>Ders Adı</th><th>T-P</th><th>Yoklama Durumu</th>
						</tr>
						<?php
						$tpArray = array(1 => '(T)', 2 => '(P)');
						$totalP = 0;
						$pCount = 0;
						$totalT = 0;
						$tCount = 0;
						foreach ($user_att as $att) {
							echo '<tr>';
							echo printCell(date('d.m.Y', strtotime($att->date)));
							echo printCell(date('H:i' , strtotime($att->hour)));
							echo printCell($att->lesson_name);
							echo printCell($tpArray[$att->type]);

							if((string)$att->type === '1')
								$totalT++;
							else
								$totalP++;

							if((string)$att->state === '1'){
								if((string)$att->type === '1')
								$tCount++;
							else
								$pCount++;

								echo printCell('<span class="text-success"><i class="fa fa-check"></i></span>');
							}else{
								echo printCell('<span class="text-danger"><i class="fa fa-times"></i></span>');
							}
							echo '</tr>';
						}

						?>
					</table>

				<?php
				$avgT = $tCount / $totalT;
				$avgP = $pCount / $totalP;
				//exit("t: $avgT - p: $avgP");
				$msgArray = array();
				if($avgT < 0.7){
					array_push($msgArray,'Teorik derslere katılım yüzdeniz %70in altında. Bu dersten şuan için kalmış görünüyorsunuz.');
				}
				if($avgP < 0.8){
					array_push($msgArray,'Pratik derslere katılım yüzdeniz %80in altında. Bu dersten şuan için kalmış görünüyorsunuz.');
				}
				//exit('<h1>'.var_dump($msgArray).'</h1>');
				if(count($msgArray) > 0){
					?>
					<script>
						$('#att_result_div').removeClass('hidden').html('<?= implode('<br>', $msgArray); ?>');
					</script>
					<?php
				}

			}
			?>

		</div>
	</div>

</div>
<?php $this->load->view('static/footer');?>