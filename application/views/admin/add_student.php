<?php $this->load->view('static/header');?>
<h2>Sisteme Öğrenci Ekle</h2>
<div class="alert alert-info">
	Bu bölümde öğrenci listelerini doğrudan excel tablosu ile yükleyebilirsiniz. Ayrıca kendiniz de yeni kayıt ekleyebilirsiniz.
</div>
<?php
$this->load->view('messages');
?>


<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
	<li role="presentation" id="manuel_tab" class="active"><a href="#manuel" aria-controls="manuel" role="tab" data-toggle="tab">Manuel Ekle</a></li>
	<li role="presentation" id="table_tab"><a href="#upload_table" aria-controls="upload_table" role="tab" data-toggle="tab">Tablo Yükle</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="manuel">
		<br>
		<form action="" method="post">
			<label style="display: block;">Email Adresi:
				<input type="email" required name="manuel_email" class="form-control" />
			</label>
			<label style="display: block;">Adı Soyadı:
				<input type="text" required name="manuel_name" class="form-control" />
			</label>
			<label style="display: block;">Okul Numarası:
				<input type="text" pattern="\d*" required name="manuel_number" class="form-control" />
			</label>
			<label style="display: block;">Bölümü:
				<select name="manuel_department" class="form-control">
					<?php
					foreach ($departments as $dep) {
						echo "<option value='$dep->department_code'>" . $dep->department_acronym . '-' . $dep->department_code . '</option>';
					}
					?>
				</select>
			</label>
			<button class="btn btn-primary pull-right">Kaydet</button>
			<div class="clearfix"></div>
			<br>
		</form>
	</div>
	<div role="tabpanel" class="tab-pane" id="upload_table">
		<br>
		<form action="" method="post" enctype="multipart/form-data">
			<label>Dosyayı Aç:<br>
				<div class="btn-group">
					<label class="btn btn-default">
						<i class="fa fa-file-excel-o" aria-hidden="true"></i> <span id="fake-open-btn">Elektronik Tablo Dosyasını Seç ...</span>
						<input type="file" id="file-input" name="excel_file" hidden style="display: none;">
					</label>
					<button id="upload-btn" disabled='disabled' class="btn btn-primary" name="upload_submit" value="1">
						<i class="fa fa-upload" aria-hidden="true"></i> Yükle
					</button>
				</div>
			</label>
		</form><br>

		<?php
		if(isset($table)){
			?>
			<div class="row">
				<div class="col-md-12">
					<form action="" method="post">

						<input type="hidden" hidden name="table_json" value="<?php echo htmlentities(json_encode($table)); ?>" />
						<div class="alert alert-warning">
							Öğrenciler bölüm kodlarına göre kaydedilecektir. Kayıt sonrası öğrencilerin mail adreslerine aktivasyon maili gönderilecektir. Mailinde yer alan linke tıklayan kullanıcılar sisteme giriş yapabilirler.


							<div class="clearfix"></div>
							<div class="pull-right">
								<button class="btn btn-success"><i class="fa fa-plus"></i> Anladım. Öğrencileri Veritabanına Ekle</button>
							</div>
							<div class="clearfix"></div>

						</div>



					</form>

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
							printCell($student->number);
							printCell($student->surname);
							printCell($student->name);
							printCell($student->department);
							printCell($student->email/* . '<small><span class="send-mail" style="color: red;cursor:pointer;" data-mail="' . $student->email . '"> [mail gönder]</span></small>'*/);
							printCell($student->grade);
							printCell($student->retake);
							printCell($student->state);
							echo '</tr>';
						}
						?>
					</table>




					<?php
				}?>
			</div>
		</div>



	</div>
</div>



<?php
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
						<textarea name="mail-content" id="mail-content" class="form-control" autofocus rows=10></textarea>
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

		$('#mail-modal').on('shown', function () {
			$('#mail-content').focus();
		});

		$("#file-input").change(function (){
			var fileName = $(this).val();
			if(fileName != ''){
				$('#upload-btn').removeAttr('disabled');
				$('#fake-open-btn').text(shortName(getFileName(fileName)));
			}
		});

		<?php
		if(isset($table)){
			?>
			$('#table_tab a').tab('show');
			<?php
		}else{
			?>
			$('#manuel_tab a').tab('show');
			<?php
		}
		?>

	});

	function getFileName(str){
		var startIndex = (str.indexOf('\\') >= 0 ? str.lastIndexOf('\\') : str.lastIndexOf('/'));
		var f = str.substring(startIndex);
		if (f.indexOf('\\') === 0 || f.indexOf('/') === 0) {
			f = f.substring(1);
		}
		return f;
	}

	function shortName(str){
		if(str.length > 20){
			str=str.substring(0,20) + '...';
		}
		return str;
	}

</script>