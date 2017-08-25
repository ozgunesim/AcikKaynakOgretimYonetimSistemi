<li>
  <a href="<?php echo site_url() . 'student/home'?>">
    <i class="fa fa-home fa-lg"></i> Anasayfa
  </a>
</li>

<li  data-toggle="collapse" data-target="#courses" class="collapsed">
  <a href="#"><i class="fa fa-book fa-lg"></i> Dersler <span class="arrow"></span></a>
</li>
<ul class="sub-menu collapse" id="courses">
  <a href="<?php echo site_url() . 'student/weekly_program'?>"><li>Ders Programı</li></a>
  <a href="<?php echo site_url() . 'student/enrolment'?>"><li>Derse Kaydol</li></a>
</ul>

<li>
  <a href="<?php echo site_url() . 'student/attendance'?>">
    <i class="fa fa-check fa-lg"></i> Devamsızlık Durumu
  </a>
</li>

<li>
  <a href="<?php echo site_url() . 'student/exam_results'?>">
    <i class="fa fa-pencil fa-lg"></i> Sınav Sonuçları
  </a>
</li>

<li>
  <a href="<?php echo site_url() . 'student/messages'?>">
    <i class="fa fa-comments fa-lg"></i> Mesajlar <strong>(<?=$msg_count;?>)</strong>
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