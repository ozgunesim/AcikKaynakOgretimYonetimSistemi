<?php $this->load->view('static/header');?>
<h2 class="page-title">Öğretmen Başvurularını Onayla/Reddet</h2>



<div class="container-fluid">
	<div class="alert alert-info">
		<strong>Bilgi:</strong> Öğretmen kaydı tamamen silinmez. Öğretmenin sisteme girişi engellenir.<br>
		<strong>Birden fazla ölçütü bir arada kullanarak arama yapabilirsiniz</strong>
	</div>

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
	if(isset($search_result)){
		?>
		<h4 style="text-align: right;">Bulunan Sonuç Sayısı: <span class="badge"><?php echo $all_count; ?></span></h4>
		<div class="row">
			<div class="col-md-12">
				<h3>İzin bekleyen öğretmen üyelikleri:</h3>
				<table class="table table-condensed table-hover table-striped">
					<form action="<?php echo site_url() . '/admin/delete_teacher'; ?>" method="post">
						<tr>
							<th>Ad Soyad</th><th>Ünvan</th><th>Bölüm</th><th>Yetki</th><th>Üyelik Durumu</th><th>(İşlem?)</th>
						</tr>
						<?php
						foreach ($search_result as $s) {
							echo "<tr>";
							printCell($s->user_name);
							printCell($s->honour_name);
							printCell($s->department_acronym.$s->department_code);
							printCell($s->auth_name);
							if($s->isActive === '0')
								printCell('<span class="text-danger">Aktif Değil</span>');
							else
								printCell('<span class="text-success">Aktif</span>');

							if($s->isActive === '1')
								printCell('<button type="submit" name="delete_id" value = "' . $s->user_id . '" class="btn btn-xs btn-danger">Engelle</button>');
							else
								printCell('<button type="submit" name="activate_id" value = "' . $s->user_id . '" class="btn btn-xs btn-success">Aktifleştir</button>');
							echo "</tr>";
						}
						?>
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
					</form>
				</table>

				<?php
					echo $pagination;
				?>
			</div>
		</div>
		<?php
	}
	?>





</div>




<?php $this->load->view('static/footer'); ?>
<script>
	$(document).ready(function(){
		$('.clear-dept').click(function(){
			$('select[name=teacher_dept] option').eq(0).prop('selected', true);
		});
		$('.clear-name').click(function(){
			$('input[name=teacher_name]').val('');
		});
		$('.clear-honour').click(function(){
			$('select[name=teacher_honour] option').eq(0).prop('selected', true);
		});
		$('.clear-email').click(function(){
			$('input[name=teacher_email]').val('');
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