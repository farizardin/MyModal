<!DOCTYPE html>
<html>
<head>
<?php require_once 'Include/header.php' ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 450px !important;">
    <!-- Content Header (Page header) -->
    <div class="content-header" style="padding-top:1rem !important; padding-bottom:0px !important;">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark" style="margin-left:0.5rem !important;">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
            <div class="row dashboard-petugas" style="margin-top:3%;">
              <a class="dashboard-panel" href="<?php echo site_url('Admin/ProposalMasuk'); ?>" style="background-color:DodgerBlue; margin: auto; margin-top:1rem; margin-bottom:1rem; height: 14rem;">
                <div class="col-md-1 content-da" style="width:14rem; height: 14rem; padding-top:25%; padding-left:2rem;">
                  <div>
                    <h3 style="margin-top:auto; color:white; font-weight: bold;">Pemodal</h3>
                    <h3 style="margin-top:auto; color:white; font-weight: bold;">Masuk</h3>
                  </div>
                  <div class="bar1" style="; height:0.2rem; width:3rem; background-color:orange;">
                  </div>
                  <div class="bar2" style="height:0.1rem; width:10rem; background-color:orange;">
                  </div>
                </div>
              </a>
              <a class="dashboard-panel" href="<?php echo site_url('Admin/ProposalDisetujui'); ?>" style="background-color:DodgerBlue; margin: auto; margin-top:1rem; margin-bottom:1rem; height: 14rem;">
                <div class="col-md-1" style="width:14rem; height: 14rem; padding-top:25%; padding-left:2rem;">
                  <div>
                    <h3 style="margin-top:auto; color:white; font-weight: bold;">Pemodal</h3>
                    <h3 style="margin-top:auto; color:white; font-weight: bold;">Disetujui</h3>
                  </div>
                  <div class="bar1" style="; height:0.2rem; width:3rem; background-color:orange;">
                  </div>
                  <div class="bar2" style="height:0.1rem; width:10rem; background-color:orange;">
                  </div>
              </div>
              </a>
              <a class="dashboard-panel" href="<?php echo site_url('Admin/ProposalDitolak'); ?>" style="background-color:DodgerBlue; margin: auto; margin-top:1rem; margin-bottom:1rem; height: 14rem;">
                <div class="col-md-1" style="width:14rem; height: 14rem; padding-top:25%; padding-left:2rem;">
                  <div>
                    <h3 style="margin-top:auto; color:white; font-weight: bold;">Pemodal</h3>
                    <h3 style="margin-top:auto; color:white; font-weight: bold;">Ditolak</h3>
                  </div>
                  <div class="bar1" style="; height:0.2rem; width:3rem; background-color:orange;">
                  </div>
                  <div class="bar2" style="height:0.1rem; width:10rem; background-color:orange;">
                  </div>
                </div>
              </a>
              <a class="dashboard-panel" href="<?php echo site_url('Admin/PencairanPending'); ?>" style="background-color:DodgerBlue; margin: auto; margin-top:1rem; margin-bottom:1rem; height: 14rem;">
                <div class="col-md-1" style="width:14rem; height: 14rem; padding-top:25%; padding-left:2rem;">
                  <div>
                    <h3 style="margin-top:auto; color:white; font-weight: bold;">Pencairan</h3>
                    <h3 style="margin-top:auto; color:white; font-weight: bold;">Pending</h3>
                  </div>
                  <div class="bar1" style="; height:0.2rem; width:3rem; background-color:orange;">
                  </div>
                  <div class="bar2" style="height:0.1rem; width:10rem; background-color:orange;">
                  </div>
                </div>
              </a>
              <a class="dashboard-panel" href="<?php echo site_url('Admin/PencairanVerified'); ?>" style="background-color:DodgerBlue; margin: auto; margin-top:1rem; margin-bottom:1rem; height: 14rem;">
                <div class="col-md-1" style="width:14rem; height: 14rem; padding-top:25%; padding-left:2rem;">
                  <div>
                    <h3 style="margin-top:auto; color:white; font-weight: bold;">Pencairan</h3>
                    <h3 style="margin-top:auto; color:white; font-weight: bold;">Verified</h3>
                  </div>
                  <div class="bar1" style="; height:0.2rem; width:3rem; background-color:orange;">
                  </div>
                  <div class="bar2" style="height:0.1rem; width:10rem; background-color:orange;">
                  </div>
                </div>
              </a>
              <a class="dashboard-panel" href="<?php echo site_url('Admin/PengembalianPending'); ?>" style="background-color:DodgerBlue; margin: auto; margin-top:1rem; margin-bottom:1rem; height: 14rem;">
                <div class="col-md-1" style="width:14rem; height: 14rem; padding-top:25%; padding-left:2rem;">
                  <div>
                    <h3 style="margin-top:auto; color:white; font-weight: bold;">Pengembalian</h3>
                    <h3 style="margin-top:auto; color:white; font-weight: bold;">Pending</h3>
                  </div>
                  <div class="bar1" style="; height:0.2rem; width:3rem; background-color:orange;">
                  </div>
                  <div class="bar2" style="height:0.1rem; width:10rem; background-color:orange;">
                  </div>
                </div>
              </a>
              <a class="dashboard-panel" href="<?php echo site_url('Admin/PengembalianVerified'); ?>" style="background-color:DodgerBlue; margin: auto; margin-top:1rem; margin-bottom:1rem; height: 14rem;">
                <div class="col-md-1" style="width:14rem; height: 14rem; padding-top:25%; padding-left:2rem;">
                  <div>
                    <h3 style="margin-top:auto; color:white; font-weight: bold;">Pengembalian</h3>
                    <h3 style="margin-top:auto; color:white; font-weight: bold;">Verified</h3>
                  </div>
                  <div class="bar1" style="; height:0.2rem; width:3rem; background-color:orange;">
                  </div>
                  <div class="bar2" style="height:0.1rem; width:10rem; background-color:orange;">
                  </div>
                </div>
              </a>
              <a class="dashboard-panel" href="<?php echo site_url('Admin/Pemasukan'); ?>" style="background-color:DodgerBlue; margin: auto; margin-top:1rem; margin-bottom:1rem; height: 14rem;">
                <div class="col-md-1" style="width:14rem; height: 14rem; padding-top:25%; padding-left:2rem;">
                  <div>
                    <h3 style="margin-top:auto; color:white; font-weight: bold;">Pemasukan</h3>
                    <h3 style="margin-top:auto; color:white; font-weight: bold;">Perusahaan</h3>
                  </div>
                  <div class="bar1" style="; height:0.2rem; width:3rem; background-color:orange;">
                  </div>
                  <div class="bar2" style="height:0.1rem; width:10rem; background-color:orange;">
                  </div>
                </div>
              </a>
              <a class="dashboard-panel" href="<?php echo site_url('Admin/ManajemenUser'); ?>" style="background-color:DodgerBlue; margin: auto; margin-top:1rem; margin-bottom:1rem; height: 14rem;">
                <div class="col-md-1" style="width:14rem; height: 14rem; padding-top:25%; padding-left:2rem;">
                  <div>
                    <h3 style="margin-top:auto; color:white; font-weight: bold;">Manajemen</h3>
                    <h3 style="margin-top:auto; color:white; font-weight: bold;">User</h3>
                  </div>
                  <div class="bar1" style="; height:0.2rem; width:3rem; background-color:orange;">
                  </div>
                  <div class="bar2" style="height:0.1rem; width:10rem; background-color:orange;">
                  </div>
                </div>
              </a>
            </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php require_once 'Include/footer.php' ?>