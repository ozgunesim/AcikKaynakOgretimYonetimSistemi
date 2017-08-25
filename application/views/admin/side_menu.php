<li>
  <a href="<?php echo site_url() . 'admin/home'?>">
    <i class="fa fa-home fa-lg"></i> Anasayfa
  </a>
</li>

<li  data-toggle="collapse" data-target="#courses" class="collapsed">
  <a href="#"><i class="fa fa-book fa-lg"></i> Dersler <span class="arrow"></span></a>
</li>
<ul class="sub-menu collapse" id="courses">
  <a href="<?php echo site_url() . 'admin/add_course'?>"><li>Ders Ekle</li></a>
  <a href="<?php echo site_url() . 'admin/delete_course'?>"><li>Ders Sil</li></a>
</ul>

<li data-toggle="collapse" data-target="#teacher" class="collapsed">
  <a href="#"><i class="fa fa-graduation-cap fa-lg"></i> Öğretmenler <span class="arrow"></span></a>
</li>  
<ul class="sub-menu collapse" id="teacher">
  <a href="<?php echo site_url() . 'admin/add_teacher'?>"><li>Öğretmen Ekle</li></a>
  <a href="<?php echo site_url() . 'admin/assign_course'?>"><li>Öğretmene Ders/Şube Ata</li></a>
  <a href="<?php echo site_url() . 'admin/delete_assignment'?>"><li>Öğretmenden Şube Sil</li></a>
  <a href="<?php echo site_url() . 'admin/delete_teacher'?>"><li>Erişim Ayarları</li></a>
  <a href="<?php echo site_url() . 'admin/activate_teacher'?>"><li>Öğretmen Kaydını Kabul Et</li></a>
</ul>

<li data-toggle="collapse" data-target="#student" class="collapsed">
  <a href="#"><i class="fa fa-child fa-lg"></i> Öğrenciler <span class="arrow"></span></a>
</li>
<ul class="sub-menu collapse" id="student">
  <a href="<?php echo site_url() . 'admin/add_student'?>"><li>Öğrenci Ekle</li></a>
  <a href="<?php echo site_url() . 'admin/delete_student'?>"><li>Erişim Ayarları</li></a>
</ul>

<li data-toggle="collapse" data-target="#semester" class="collapsed">
  <a href="#"><i class="fa fa-flag fa-lg"></i> Dönemler <span class="arrow"></span></a>
</li>
<ul class="sub-menu collapse" id="semester">
  <a href="<?php echo site_url() . 'admin/add_semester'?>"><li>Eğitim/Öğretim Yarıyılı Ekle</li></a>
</ul>

<li data-toggle="collapse" data-target="#notices" class="collapsed">
  <a href="#"><i class="fa fa-bullhorn fa-lg"></i> Duyurular <span class="arrow"></span></a>
</li>
<ul class="sub-menu collapse" id="notices">
  <a href="<?php echo site_url() . 'admin/add_notice'?>"><li>Duyuru Ekle</li></a>
  <a href="<?php echo site_url() . 'admin/delete_notice'?>"><li>Duyuru Sil</li></a>
</ul>


<li>
  <a href="<?php echo site_url() . 'user/settings'?>">
    <i class="fa fa-gear fa-lg"></i> Kişisel Ayarlar
  </a>
</li>

<li>
  <a href="<?php echo site_url() . 'user/logout'?>">
    <i class="fa fa-sign-out fa-lg"></i> Çıkış Yap
  </a>
</li>