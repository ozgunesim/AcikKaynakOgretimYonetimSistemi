<?php $this->load->view('static/header');?>
<h2 class="page-title">Yoklama Listesini Gör</h2>

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

			<button class="btn btn-warning toggle-menu-btn"></button>
			<hr>



			<h3>Yoklama listesi için dersi seçin:</h3>
			<form action="" method="post">
				<select name="selected_course" class="form-control">
					<option disabled selected value>Bir ders seçin...</option>
					<?php
					foreach ($assigned_courses as $c) {
						echo "<option value='$c->assign_id' >" .
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
	if(isset($att_result))
	{
	?>
	<hr>
	<div class="row">
		<div class="col-md-12">
			<form action="" method="post" target="start_inspect" id="att_table_form">
				<input type="hidden" name="selected_course" value="<?=$selected_course;?>">
				<table class="table table-striped table-hover table-condensed">
					<tr>
					<th>Numara</th>
					<th>Ad Soyad</th>

					<th>Yoklama Alınan Teorik Ders</th>
					<th>Teorik Devamsızlık</th>
					<th>Teorik Devam Yüzdesi</th>

					<th>Yoklama Alınan Pratik Ders</th>
					<th>Pratik Devamsızlık</th>
					<th>Pratik Devam Yüzdesi</th>

					<th>Devamsızlıktan Kaldı?</th>
					<th>İşlem?</th>
					</tr>
				<?php
				$tp = array(1 => 'Teorik', 2 => 'Pratik');
				for ($i = 0; $i< count($att_result); $i+=2) {
					$row = $att_result[$i];
					$nextRow = $att_result[$i+1];
					echo '<tr>';

					echo printCell($row->number);
					echo printCell($row->user_name);

					echo printCell($row->total_att);
					echo printCell(($row->total_att - $row->total_state));
					echo printCell('%' . ceil((100 * $row->att_percent)),2);

					echo printCell($nextRow->total_att);
					echo printCell(($nextRow->total_att - $nextRow->total_state));
					echo printCell('%' . ceil((100 * $nextRow->att_percent)),2);

					//0.7 teorik ders minimum devam zorunlulugu
					//0.8 pratik ders minimum devam zorunlulugu
					if((double)$row->att_percent < 0.7 || (double)$nextRow->att_percent < 0.8){
						$tp_info = ' ';
						if((double)$row->att_percent < 0.7) $tp_info .= '(T) ';
						if((double)$nextRow->att_percent < 0.8) $tp_info .= '(P) ';
						echo printCell('<span class="text-danger"><strong>EVET' . $tp_info . '</strong></span>');
					}else{
						echo printCell('<span class="text-success">HAYIR</span>');
					}
					echo printCell('<button type="submit" name="inspect_att" value="' . $row->user_id . '" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> İncele</button>');
					echo '</tr>';
				}
				?>
				</table>
			</form>
		</div>
	</div>
	<?php
	}
	?>

	<?php
	if(isset($user_att)){
		//var_dump($user_att);
	?>
	<div class="row">
		<div class="col-xs-6">
			<h4><strong class="text-info">Öğrenci:</strong> <?=$user_att[0]->user_name;?></h4>
		</div>
		<div class="col-xs-6">
			<h4><strong class="text-info">Numara:</strong> <?=$user_att[0]->number;?></h4>
		</div>
	</div><hr>

	<table class="table table-striped table-hover table-condensed">
	<tr>
		<th>Tarih</th><th>Saat</th><th>Ders Adı</th><th>T-P</th><th>Yoklama Durumu</th>
	</tr>
	<?php
	$tpArray = array(1 => '(T)', 2 => '(P)');
	foreach ($user_att as $att) {
		echo '<tr>';
		echo printCell(date('d.m.Y', strtotime($att->date)));
		echo printCell(date('H:i' , strtotime($att->hour)));
		echo printCell($att->lesson_name);
		echo printCell($tpArray[$att->type]);
		if((string)$att->state === '1'){
			echo printCell('<span class="text-success"><i class="fa fa-check"></i></span>');
		}else{
			echo printCell('<span class="text-danger"><i class="fa fa-times"></i></span>');
		}
		echo '</tr>';
	}
	?>
	</table>
	<button type="button" class="btn btn-primary btn-block" id="close-window" data-dismiss="modal">KAPAT</button>

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

	$('button[name=inspect_att]').click(function(){
		  window.open('', 'start_inspect', 'width=800,height=600');
		  document.getElementById('att_table_form').submit();
	});
});
</script>
