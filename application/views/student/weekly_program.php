<?php $this->load->view('static/header');?>
<h2 class="page-title">Ders Programınıza Gözatın</h2>



<div class="container-fluid">
	<?php $this->load->view('messages');?>

	<div class="row">
		<div class="col-md-12">
			<?php
			if(isset($prog_array)){
				?>
				<table class="table table-condensed table-hover table-bordered table-striped">
				<tr>
					<th>Saat</th>
					<th>Pazartesi</th>
					<th>Salı</th>
					<th>Çarşamba</th>
					<th>Perşembe</th>
					<th>Cuma</th>
				</tr>
				<?php
				$true_hours = array(
						'09:00 - 09:45', '10:00 - 10:45', '11:00 - 11:45', '12:00 - 12:45', 
						'13:00 - 13:45', '14:00 - 14:45', '15:00 - 15:45', '16:00 - 16:45', 
						);
				for($hour=0; $hour<8; $hour++){
					echo '<tr>';
					echo '<td>'.$true_hours[$hour].'</td>';
					for($day = 0; $day < 5; $day++){
						echo '<td>';
						foreach ($prog_array as $prog) {
							//exit(var_dump($prog_array));
							foreach ($prog as $p) {
								if($p->day == $day && $p->hour == $hour){
									echo $p->lesson_name.' - Şube: ' . $p->subclass . ' <br>';
								}
							}
						}
						echo '</td>';
					}
					echo '</tr>';
				}
				
				?>
				</table>
				<?php
			}
			?>

		</div>
	</div>

</div>
<?php $this->load->view('static/footer');?>