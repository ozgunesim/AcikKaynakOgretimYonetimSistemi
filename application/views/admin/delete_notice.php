<?php $this->load->view('static/header');?>
<h2 class="page-title">Duyuru Kaldır</h2>



<div class="container-fluid">

	<?php
	if(isset($notices)){
		if(!empty($notices)){
			$types = array(
				'1' => 'danger',
				'2' => 'warning',
				'3' => 'info',
				'4' => 'success'
				);
			foreach ($notices as $ntc) {
				?>
				<div class="alert alert-<?php echo $types[$ntc->notice_type]; ?>" style="padding: 10px;margin-bottom: 5px;position: relative;">
					<div style="position: absolute; right: 10px; top: 10px; width: auto; height: auto;">
						<form action="" method="post">
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
							<button name="delete_notice" type="submit" value="<?=$ntc->notice_id?>" class="btn btn-xs btn-danger">Sil</button>
						</form>
					</div>
					<?php echo $ntc->notice_text ?>
				</div>

				<?php
			}
			if(isset($pagination))
				echo $pagination;
			
		}else{
			?>
			<div class="alert alert-info">Hiç Duyuru yok.</div>
			<?php
		}
		

	}else{
		?>
		<div class="alert alert-info">Hiç Duyuru yok.</div>
		<?php
	}
	?>

</div>
<?php $this->load->view('static/footer');?>