<?php $base = base_url() ."assets/" ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>MTK473 Proje</title>

  <!-- Bootstrap Core CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

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
      <h3 class="text-center">Özgün EŞİM</h3>
      <h5 class="text-center">Sistem Yöneticisi</h5>

        <button class="btn btn-lg btn-block btn-default visible-sm visible-xs toggle-menu">MENÜ</button>
        <ul class="menu-list">
          <a href="#"><li style="margin-bottom: 15px;"><i class="fa fa-home"></i> Anasayfa <i class="fa fa-caret-right" aria-hidden="true"></i></li></a>
          <li class="menu-header">
            <i class="fa fa-book"></i> Dersler
            <ul>
              <a href="#"><li><i class="fa fa-plus"></i> Ders Ekle <i class="fa fa-caret-right" aria-hidden="true"></i></li></a>
              <a href="#"><li><i class="fa fa-minus"></i> Ders Sil <i class="fa fa-caret-right" aria-hidden="true"></i></li></a>
            </ul>
          </li>

          <li class="menu-header">
            <i class="fa fa-graduation-cap"></i> Öğretmenler
            <ul>
              <a href="#"><li><i class="fa fa-plus"></i> Öğretmen Ekle <i class="fa fa-caret-right" aria-hidden="true"></i></li></a>
              <a href="#"><li><i class="fa fa-minus"></i> Öğretmen Sil <i class="fa fa-caret-right" aria-hidden="true"></i></li></a>
            </ul>
          </li>

          <li class="menu-header">
            <i class="fa fa-child"></i> Öğrenciler
            <ul>
              <a href="#"><li><i class="fa fa-plus"></i> Öğrenci Ekle <i class="fa fa-caret-right" aria-hidden="true"></i></li></a>
              <a href="#"><li><i class="fa fa-minus"></i> Öğrenci Sil <i class="fa fa-caret-right" aria-hidden="true"></i></li></a>
            </ul>
          </li>

          <a href="#"><li style="margin-top: 15px;"><i class="fa fa-sitemap"></i> Yetkilendirmeler <i class="fa fa-caret-right" aria-hidden="true"></i></li></a>
          <a href="#"><li><i class="fa fa-bullhorn"></i> Duyurular <i class="fa fa-caret-right" aria-hidden="true"></i></li></a>
          <a href="#"><li><i class="fa fa-gear"></i> Kişisel Ayarlar <i class="fa fa-caret-right" aria-hidden="true"></i></li></a>
          <a href="#"><li style="margin-top: 15px;"><i class="fa fa-sign-out"></i> Çıkış Yap <i class="fa fa-caret-right" aria-hidden="true"></i></li></a>

        </ul>

        <footer style="margin-top: 15px;"><h6 class="text-center no-margin"><small>Copyright <?php echo date('Y'); ?> | Developed by Özgün EŞİM</small></h6></footer>



      </div>
      <div class="col-md-10 main-container">