<?php $this->load->view('static/header');
$this->load->view('messages');
?>
<form action="" method="post" enctype="multipart/form-data">
	<?php if(isset($table)) { ?>
	<div class="btn-group pull-right">
		<button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Öğrencileri Veritabanına Ekle</button>
	</div>
	<?php } ?>
	<div class="btn-group">
		<label class="btn btn-default">
			Dosya Aç . . . <input type="file" name="excel_file" hidden style="display: none;">
		</label>
		<input type="submit" class="btn btn-primary" value="Yükle" name="upload_submit">
	</div>
</form><br>
<?php
if(isset($table)){
	?>
	<div class="clearfix"></div><br>
	<table class="table table-condensed table-hover table-striped table-bordered">
		<tr>
			<th>Sıra</th><th>Öğrenci Numarası</th><th>* , +</th><th>Soyadı</th><th>Adı</th><th>Bölüm Kodu</th><th>Email</th><th>Notu</th><th>Büt.Notu</th><th>Ders Kaydı Onay Durumu</th>
		</tr>
		<?php
		foreach ($table as $student) {
			echo '<tr>';
			printCell($student->index);
			printCell($student->failure);
			printCell($student->num);
			printCell($student->surname);
			printCell($student->name);
			printCell($student->department);
			printCell($student->email . '<small><span class="send-mail" style="color: red;cursor:pointer;" data-mail="' . $student->email . '"> [mail gönder]</span></small>');
			printCell($student->grade);
			printCell($student->retake);
			printCell($student->state);
			echo '</tr>';
		}
		?>
	</table>



	<?php
}
function printCell($str){
	echo '<td>'.$str.'</td>';
}
?>

<div id="mail-modal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<form action="mail" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Mail Gönder</h4>
				</div>
				<div class="modal-body">
					<Label style='display: block;'>
						Alıcı:
						<input type="text" id="mail-target" name="mail-target" class="form-control" readonly style='width: 100%;' />
					</Label>

					<Label style='display: block;'>
						İçerik:
						<textarea name="mail-content" class="form-control" autofocus rows=10></textarea>
					</Label>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
					<button class="btn btn-primary">Mail Gönder</button>
				</div>

			</form>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php $this->load->view('static/footer'); ?>

<script>
	$(document).ready(function(){
		$('.send-mail').click(function(){
			var email = $(this).data('mail');
			$('#mail-target').val(email);
			$('#mail-modal').modal('show');
		});
	});
</script>
