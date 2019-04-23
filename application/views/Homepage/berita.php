<!DOCTYPE php>
<php >
<head>
    <title>Berita</title>
    <?php require_once'header.php';?>
</head>
<body>
<section class="engine"><a href="https://mobiri.se/b">create your own website</a></section><section class="mbr-section content5 cid-qYTT5W5QQT" id="content5-s">

    

    <div class="mbr-overlay" style="opacity: 0.4; background-color: rgb(35, 35, 35);">
    </div>

    <div class="container">
        <div class="media-container-row">
            <div class="title col-12 col-md-8">
                <h2 class="align-center mbr-bold mbr-white pb-3 mbr-fonts-style display-1">BERITA KESELURUHAN</h2>
                
                
                
            </div>
        </div>
    </div>
</section>

<section class="testimonials4 cid-qYU91ZnuMX" id="testimonials4-1q">

  

  
  <div class="container">
    
    
    <div class="col-md-10 testimonials-container">        
      <div class="testimonials-item">
      <?php foreach ($getBerita->result() as $row)
                {
          ?> 
        <div class="user row">
          <div class="col-lg-3 col-md-4">
            <div class="user_image">
            <img src="<?php echo base_url("assets/images/images-225x225.png") ?> " alt="" title="">
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
</php>