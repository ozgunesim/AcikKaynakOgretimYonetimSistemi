<li>
  <a href="<?php echo site_url() . 'teacher/home'?>">
    <i class="fa fa-home fa-lg"></i> Anasayfa
  </a>
</li>

<li  data-toggle="collapse" data-target="#courses" class="collapsed">
  <a href="#"><i class="fa fa-book fa-lg"></i> Dersler <span class="arrow"></span></a>
</li>
<ul class="sub-menu collapse" id="courses">
  <a href="<?php echo site_url() . 'teacher/weekly_programs'?>"><li>Ders Programı Belirle</li></a>
  <a href="<?php echo site_url() . 'teacher/attendance'?>"><li>Yoklama Gir</li></a>
  <a href="<?php echo site_url() . 'admin/add_course'?>"><li>Sınav Sonucu Açıkla</li></a>
  <a href="<?php echo site_url() . 'admin/add_course'?>"><li>Başarı Durumu</li></a>
</ul>

<!--li data-toggle="collapse" data-target="#student" class="collapsed">
  <a href="#"><i class="fa fa-child fa-lg"></i> Öğrenciler <span class="arrow"></span></a>
</li>
<ul class="sub-menu collapse" id="student">
  <a href="<?php echo site_url() . 'admin/add_student'?>"><li>Öğrenciyi Derse Ekle</li></a>
  <a href="<?php echo site_url() . 'admin/delete_student'?>"><li>Öğrenciyi Dersten Çıkar</li></a>
</ul-->

<li>
  <a href="<?php echo site_url() . 'user/settings'?>">
    <i class="fa fa-comments fa-lg"></i> Sorular <strong>(0)</strong>
  </a>
</li>

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