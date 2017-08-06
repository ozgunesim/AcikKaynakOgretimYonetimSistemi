<?php $this->load->view('static/header');?>
<h2 class="page-title">Duyuru Ekle</h2>
<div class="container-fluid">

	<?php $this->load->view('messages'); ?>

	<form action="" method="post">
		<label style="display: block;">Duyuru Metnini Girin:
			<textarea rows="5" maxlength="400" required name="content" class="form-control"></textarea>
		</label>
		<label style="display: block;">Duyuru Rengi:
			<select id="colorselector" name="type">
				<option value="1" data-color="#dc143c">KIRMIZI</option>
				<option value="2" data-color="#ffd700">SARI</option>
				<option value="3" data-color="#6495ed">MAVİ</option>
				<option value="4" data-color="#32cd32">YEŞİL</option>
			</select>

		</label>

		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
		<button class="btn btn-primary pull-right">Kaydet</button>
		<div class="clearfix"></div>
		<br>
	</form>
</div>

<?php $this->load->view('static/footer'); ?>


<?php $base = base_url() ."assets/" ?>
<link rel="stylesheet" type="text/css" href="<?php echo $base; ?>css/bootstrap-colorselector.min.css" />
<script src="<?php echo $base; ?>js/bootstrap-colorselector.min.js"></script>

<script>
	$('#colorselector').colorselector();
</script>