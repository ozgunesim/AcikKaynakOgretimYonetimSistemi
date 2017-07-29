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
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">

  <!-- Theme CSS -->
  <link href="<?php echo $base; ?>css/style.css" rel="stylesheet">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">

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
  <h3 class="text-center">Özgün EŞİM</h3>
  <h5 class="text-center">Sistem Yöneticisi</h5>
</div>
<i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

<div class="menu-list">

  <ul id="menu-content" class="menu-content collapse out">
      <li>
        <a href="#">
        <i class="fa fa-home fa-lg"></i> Anasayfa
        </a>
      </li>

      <li  data-toggle="collapse" data-target="#products" class="collapsed">
        <a href="#"><i class="fa fa-book fa-lg"></i> Dersler <span class="arrow"></span></a>
      </li>
      <ul class="sub-menu collapse" id="products">
          <li><a href="#">Ders Ekle</a></li>
          <li><a href="#">Ders Sil</a></li>
      </ul>


      <li data-toggle="collapse" data-target="#service" class="collapsed">
        <a href="#"><i class="fa fa-graduation-cap fa-lg"></i> Öğretmenler <span class="arrow"></span></a>
      </li>  
      <ul class="sub-menu collapse" id="service">
        <li>Öğretmen Ekle</li>
        <li>Erişim Ayarları</li>
      </ul>


      <li data-toggle="collapse" data-target="#new" class="collapsed">
        <a href="#"><i class="fa fa-child fa-lg"></i> Öğrenciler <span class="arrow"></span></a>
      </li>
      <ul class="sub-menu collapse" id="new">
        <li>Öğrenci Ekle</li>
        <li>Erişim Ayarları</li>
      </ul>


       <li>
        <a href="#">
        <i class="fa fa-bullhorn fa-lg"></i> Duyurular
        </a>
        </li>

       <li>
        <a href="#">
        <i class="fa fa-gear fa-lg"></i> Kişisel Ayarlar
        </a>
      </li>

      <li>
        <a href="#">
        <i class="fa fa-sign-out fa-lg"></i> Çıkış Yap
        </a>
      </li>
  </ul>
</div>
</div>

















        <!--button class="btn btn-lg btn-block btn-default visible-sm visible-xs toggle-menu">MENÜ</button>
        <ul class="menu-list">
          <a href="#"><li style="margin-bottom: 15px;"><i class="fa fa-home"></i> Anasayfa <i class="fa fa-caret-right" aria-hidden="true"></i></li></a>
          <li class="menu-header">
            <i class="fa fa-book"></i> Dersler
          </li>

          <a href="#"><li><i class="fa fa-plus"></i> Ders Ekle <i class="fa fa-caret-right" aria-hidden="true"></i></li></a>
          <a href="#"><li><i class="fa fa-minus"></i> Ders Sil <i class="fa fa-caret-right" aria-hidden="true"></i></li></a>

          <li class="menu-header">
            <i class="fa fa-graduation-cap"></i> Öğretmenler
          </li>

          <a href="#"><li><i class="fa fa-plus"></i> Öğretmen Ekle <i class="fa fa-caret-right" aria-hidden="true"></i></li></a>
          <a href="#"><li><i class="fa fa-minus"></i> Öğretmen Sil <i class="fa fa-caret-right" aria-hidden="true"></i></li></a>

          <li class="menu-header">
            <i class="fa fa-child"></i> Öğrenciler
          </li>
          
          <a href="#"><li><i class="fa fa-plus"></i> Öğrenci Ekle <i class="fa fa-caret-right" aria-hidden="true"></i></li></a>
          <a href="#"><li><i class="fa fa-minus"></i> Öğrenci Engelle / Aktifleştir <i class="fa fa-caret-right" aria-hidden="true"></i></li></a>

          <a href="#"><li style="margin-top: 15px;"><i class="fa fa-sitemap"></i> Yetkilendirmeler <i class="fa fa-caret-right" aria-hidden="true"></i></li></a>
          <a href="#"><li><i class="fa fa-bullhorn"></i> Duyurular <i class="fa fa-caret-right" aria-hidden="true"></i></li></a>
          <a href="#"><li><i class="fa fa-gear"></i> Kişisel Ayarlar <i class="fa fa-caret-right" aria-hidden="true"></i></li></a>
          <a href="#"><li style="margin-top: 15px;"><i class="fa fa-sign-out"></i> Çıkış Yap <i class="fa fa-caret-right" aria-hidden="true"></i></li></a>

        </ul-->

        <footer style="margin-top: 15px;" class="hidden-sm hidden-xs"><h6 class="text-center" style="padding: 15px;"><small>Copyright <?php echo date('Y'); ?> | Developed by Özgün EŞİM<br>Bu proje akademik amaçlar da dahil olmak üzere hiçbir şekilde izinsiz kullanılamaz. Bu siteyi görüntüleyen herkes lisans sözleşmesini kabul etmiş sayılır. <a href="<?php echo base_url(); ?>license.txt">Lisans Sözleşmesi</a></small></h6></footer>



      </div>
      <div class="col-md-10 main-container">