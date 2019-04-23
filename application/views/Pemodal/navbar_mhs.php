<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
<!-- Left navbar links -->
<ul class="navbar-nav">
    <li class="nav-item">
    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
    <a href="<?php echo site_url('');?>" class="nav-link"><i class="fa fa-fw fa-home"></i>
                    <span class="nav-link-text">Beranda</span></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
    <a href="index3.html" class="nav-link"><i class="fa fa-fw fa-download"></i>
                    <span class="nav-link-text">Unduh Panduan</span></a>
    </li>
</ul>

<!-- SEARCH FORM -->

<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">
    <!-- Messages Dropdown Menu -->
    <li class="nav-item">
    <a href="<?php echo site_url('Authentication/logout');?>" class="nav-link" style="color:DodgerBlue;"><i class="fa fa-fw fa-sign-out" ></i>
                    <span class="nav-link-text">Sign Out</span></a>
    </li>
</ul>
</nav>

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 450px !important;">
    <!-- Brand Logo -->
    <a href="<?php echo base_url("Petugas"); ?>" class="brand-link">
      <img src="<?php echo base_url("assets/img/logo.png"); ?>" alt="Logo MyModal ITS" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">MyModal ITS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url("assets/img/pic.jpg"); ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $this->session->userdata('nama_user');?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo site_url('Mahasiswa');?>" class="nav-link">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-pie-chart"></i>
              <p>
                Proposal
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('Mahasiswa/PengajuanJudul');; ?>" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Pengajuan Judul</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Mahasiswa/ProposalPending');; ?>" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Proposal Pending</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Petugas/ProposalDiterima');; ?>" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Proposal Disetujui</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('Petugas/ProposalDitolak');; ?>" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Proposal Ditolak</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
