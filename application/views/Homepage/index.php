<!DOCTYPE html>
<html>

<head>
    <!-- Site made with Mobirise Website Builder v4.8.1, https://mobirise.com -->

    <title>Home</title>
    <?php require_once 'header.php' ?>

</head>

<body>


    <section class="engine"><a href="https://mobiri.se/u">bootstrap website templates</a></section>
    <section class="cid-qYTIcKJYu9 mbr-fullscreen mbr-parallax-background" id="header2-b">



        <div class="mbr-overlay" style="opacity: 0.4; background-color: rgb(118, 118, 118);"></div>

        <div class="container align-center">
            <div class="row justify-content-md-center">
                <div class="mbr-white col-md-10">
                    <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1">
                        MyModal</h1>
                    <br>
                    <?php if(!$this->session->id_role) {
                        echo '<div class="mbr-section-btn"><a class="btn btn-md btn-white-outline display-4" href="'.site_url("Authentication").'">Cari Pemodal</a></div>';
                    }else{
                        switch ($this->session->id_role) {
    
                            case 1:
                            echo '<div class="mbr-section-btn"><a class="btn btn-md btn-white-outline display-4" href="'.site_url("Pemodal").'">Dashboard</a></div>';
                              break;
                            case 2:
                            echo '<div class="mbr-section-btn"><a class="btn btn-md btn-white-outline display-4" href="'.site_url("Peminjam/CariPemodal").'">Cari Pemodal</a></div>';
                              break;
                            case 3:
                            echo '<div class="mbr-section-btn"><a class="btn btn-md btn-white-outline display-4" href="'.site_url("Admin").'">Dashboard</a></div>';
                              break;
                          }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="mbr-arrow hidden-sm-down" aria-hidden="true" style="background:rgba(15, 118, 153, 0.5)">
            <a href="#next">
                <i class="mbri-down mbr-iconfont"></i>
            </a>
        </div>
    </section>

</body>

<footer>
    <?php require_once 'footer.php' ?>

</footer>

</html>