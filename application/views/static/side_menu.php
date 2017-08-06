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
            <li>
              <a href="<?php echo site_url() . '/admin/home'?>">
                <i class="fa fa-home fa-lg"></i> Anasayfa
              </a>
            </li>

            <li  data-toggle="collapse" data-target="#courses" class="collapsed">
              <a href="#"><i class="fa fa-book fa-lg"></i> Dersler <span class="arrow"></span></a>
            </li>
            <ul class="sub-menu collapse" id="courses">
                <a href="<?php echo site_url() . '/admin/add_course'?>"><li>Ders Ekle</li></a>
                <a href="<?php echo site_url() . '/admin/delete_course'?>"><li>Ders Sil</li></a>
            </ul>


            <li data-toggle="collapse" data-target="#teacher" class="collapsed">
              <a href="#"><i class="fa fa-graduation-cap fa-lg"></i> Öğretmenler <span class="arrow"></span></a>
            </li>  
            <ul class="sub-menu collapse" id="teacher">
              <a href="<?php echo site_url() . '/admin/add_teacher'?>"><li>Öğretmen Ekle</li></a>
              <a href="<?php echo site_url() . '/admin/assign_course'?>"><li>Öğretmene Ders Ata</li></a>
              <a href="<?php echo site_url() . '/admin/delete_teacher'?>"><li>Erişim Ayarları</li></a>
            </ul>


            <li data-toggle="collapse" data-target="#student" class="collapsed">
              <a href="#"><i class="fa fa-child fa-lg"></i> Öğrenciler <span class="arrow"></span></a>
            </li>
            <ul class="sub-menu collapse" id="student">
              <a href="<?php echo site_url() . '/admin/add_student'?>"><li>Öğrenci Ekle</li></a>
              <a href="<?php echo site_url() . '/admin/delete_student'?>"><li>Erişim Ayarları</li></a>
            </ul>

            <li data-toggle="collapse" data-target="#notices" class="collapsed">
              <a href="#"><i class="fa fa-bullhorn fa-lg"></i> Duyurular <span class="arrow"></span></a>
            </li>
            <ul class="sub-menu collapse" id="notices">
              <a href="<?php echo site_url() . '/admin/add_notice'?>"><li>Duyuru Ekle</li></a>
              <a href="<?php echo site_url() . '/admin/delete_notice'?>"><li>Duyuru Sil</li></a>
            </ul>


             <li>
              <a href="<?php echo site_url() . '/user/settings'?>">
              <i class="fa fa-gear fa-lg"></i> Kişisel Ayarlar
              </a>
            </li>

            <li>
              <a href="<?php echo site_url() . '/user/logout'?>">
              <i class="fa fa-sign-out fa-lg"></i> Çıkış Yap
              </a>
            </li>
        </ul>
      </div>
      </div>


  <footer class="hidden-sm hidden-xs legal-notice"><h6 class="text-center"><small>Copyright <?php echo date('Y'); ?> | Developed by Özgün EŞİM<br>Bu proje akademik amaçlar da dahil olmak üzere hiçbir şekilde izinsiz kullanılamaz. Bu siteyi görüntüleyen herkes lisans sözleşmesini kabul etmiş sayılır. <a href="<?php echo base_url(); ?>license.txt">Lisans Sözleşmesi</a><br>İletişim: <a href="mailto:ozgunesim@gmail.com">ozgunesim@gmail.com</a></small></h6></footer>



</div>
<div class="col-md-10 main-container">