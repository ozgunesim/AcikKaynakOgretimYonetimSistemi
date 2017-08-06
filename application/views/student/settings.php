<?php $this->load->view('static/header');?>
<h2 class="page-title">Kişisel Ayarları Yapılandır</h2>



<div class="container-fluid">
	<div class="alert alert-info">
		<strong>Bilgi:</strong> Boş bırakılan alanlar görmezden gelinir.
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Ad Soyad Değiştir:</div>
				<div class="panel-body">
					<div class="form-group">
						<div class="input-group">
							<input type="text" required pattern=".{3,}" name="user_name" class="form-control" placeholder="en az 3 karakter." />

							<span class="input-group-btn">
								<button type="submit" class="btn btn-primary">Değiştir</button>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Email Değiştir:</div>
				<div class="panel-body">
					<div class="form-group">
						<div class="input-group">
							<input type="email" name="user_email" required class="form-control" />

							<span class="input-group-btn">
								<button type="submit" class="btn btn-primary">Değiştir</button>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<?php $this->load->view('static/footer');?>