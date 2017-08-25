<?php $this->load->view('static/header');?>
<h2 class="page-title">Derse Kaydol</h2>



<div class="container-fluid">
	<?php $this->load->view('messages');?>

	<div class="row">
		<div class="col-md-12">
			<h3>Kaydolacağınız Dersi Seçin:</h3>
			<form action="" method="post">
				<select name="selected_course" class="form-control">
					<option disabled selected value>Bir ders seçin...</option>
					<?php
					foreach ($assigned_courses as $c) {
						echo "<option value='$c->assign_id-$c->lesson_id' >" .
						$c->department_acronym . $c->lesson_code . ' - ' . $c->lesson_name . ' - Şube: ' . $c->subclass .
						'</option>';
					}
					?>
				</select>
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
				<div class="text-right"><br>
					<button type="submit" class="btn btn-primary">Derse Kaydol</button>
				</div>
			</form>


		</div>
	</div>

</div>
<?php $this->load->view('static/footer');?>