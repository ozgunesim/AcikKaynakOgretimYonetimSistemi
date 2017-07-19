<?php $this->load->view('static/header'); ?>


<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default" style="margin-top: 25%;box-shadow: 0 5px 10px #ddd;">
				<div class="panel-heading">
					<h3 class="panel-title">Lütfen Giriş Yapın</h3>
				</div>
				<div class="panel-body">
					<?php $this->load->view('messages'); ?>
					<form role="form" action="" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" required name="email" type="email" autofocus>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Şifre" required name="password" type="password" value="">
							</div>
							<!--div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Beni Hatırla
								</label>
							</div-->
							<div class="captcha-box" style="margin-bottom: 15px;">
								<?php echo $this->recaptcha->render(); ?>
							</div>

							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
							<!-- Change this to a button or input when using this as a form -->
							<button href="index.html" class="btn btn-success btn-block">Giriş Yap</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<form action="" method="post">


</form>

<?php $this->load->view('static/footer'); ?>