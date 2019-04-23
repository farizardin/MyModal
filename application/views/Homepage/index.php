<!DOCTYPE html>
<html >
<head>
  <!-- Site made with Mobirise Website Builder v4.8.1, https://mobirise.com -->

  <title>Home</title>
  <?php require_once 'header.php' ?>

</head>
<body>


<section class="engine"><a href="https://mobiri.se/u">bootstrap website templates</a></section><section class="cid-qYTIcKJYu9 mbr-fullscreen mbr-parallax-background" id="header2-b">

    

    <div class="mbr-overlay" style="opacity: 0.4; background-color: rgb(118, 118, 118);"></div>

    <div class="container align-center">
        <div class="row justify-content-md-center">
            <div class="mbr-white col-md-10" >
                <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1">
                MyModal</h1>
                
<br>
                <div class="mbr-section-btn"><a class="btn btn-md btn-white-outline display-4" href="<?php echo site_url("Home/profile"); ?>">PROFIL</a></div>
            </div>
        </div>
    </div>
    <div class="mbr-arrow hidden-sm-down" aria-hidden="true" style="background:rgba(15, 118, 153, 0.5)">
        <a href="#next">
            <i class="mbri-down mbr-iconfont"></i>
        </a>
    </div>
</section>
<section style="height:10px;">
</section>
<section class="testimonials4 cid-qYU7efzH2o" id="testimonials4-1p">
  <div class="container">
    <div class="col-md-10 testimonials-container"> 
    <div class="testimonials-item">
    <?php foreach ($getBerita->result() as $row)
                {
          ?> 
        <div class="user row">
          <div class="col-lg-3 col-md-4">
            <div class="user_image">
              <img src="assets/images/images-225x225.png" alt="" title="">
            </div>
          </div>
             
                <div class="testimonials-caption col-lg-9 col-md-8">
                <div class="user_name mbr-bold mbr-fonts-style align-left pt-3 display-7"><a href="BeritaDetail.html"><strong><?php echo $row->judul_berita ?></strong></a></div>
                  <div class="user_text ">
                    <p class="mbr-fonts-style  display-7">
                      <em>"<?php echo $row->isi_berita ?>"</em>
                    </p>
                  </div>
                  <div class="user_desk mbr-light mbr-fonts-style align-left pt-2 display-7">
                    <?php echo $row->nama_user ?></div>
                </div>
              </div>  
              <?php
                }
                ?>
  </div>
</section>

</body>

<footer>
  <?php require_once 'footer.php' ?>

</footer>
</html>