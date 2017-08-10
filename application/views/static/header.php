<?php $base = base_url() ."assets/" ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="description" content="">
  <meta name="author" content="">

  <title>MTK473 Proje</title>

  <!-- Bootstrap Core CSS -->
  <link href="<?=$base?>css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="<?=$base?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Theme CSS -->
  <link href="<?=$base?>css/style.css" rel="stylesheet">

  <link href="<?=$base?>css/animate.css" rel="stylesheet">
  
  <!-- jQuery -->
  <script src="<?=$base?>js/jquery.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

  </head>
  <body>
    <div class="container-fluid no-margin no-padding">
      <div class="col-md-2 left-side">

      <div class="nav-side-menu">
      <div class="brand">
        <h3 class="text-center"><?=($this->session->userdata('user')->user_name);?></h3>
        <h5 class="text-center"><?=($this->session->userdata('user')->auth_name);?></h5>
      </div>
      <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

      <div class="menu-list">

        <ul id="menu-content" class="menu-content collapse out">
            <?php
            $user_sess = $this->session->userdata('user');
            if($user_sess != null){
              if($user_sess->user_auth == 1){//admin
                $this->load->view('admin/side_menu');
              }else if($user_sess->user_auth == 2){//ogretmen
                $this->load->view('teacher/side_menu');
              }else if($user_sess->user_auth == 3){//ogrenci
                $this->load->view('student/side_menu');
              }
            }
            ?>
            
        </ul>
      </div>
      </div>


  <footer class="hidden-sm hidden-xs legal-notice"><div class="text-center"><small style="color: #fff;font-size: 9px;">Copyright <?php echo date('Y'); ?> ©<br>Bu proje akademik amaçlar da dahil olmak üzere hiçbir şekilde izinsiz kullanılamaz. Bu siteyi görüntüleyen herkes lisans sözleşmesini kabul etmiş sayılır. <a href="<?php echo base_url(); ?>license.txt">Lisans Sözleşmesi</a><br>İletişim: <a href="mailto:ozgunesim@gmail.com">ozgunesim@gmail.com</a><br>Özgün EŞİM tarafından geliştirilmiştir.</small></div></footer>



</div>
<div class="col-md-10 main-container">