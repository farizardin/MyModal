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
              <a class="dashboard-panel" href="<?php echo site_url('Petugas/ProposalMasuk'); ?>" style="background-color:DodgerBlue; margin: auto; margin-top:1rem; margin-bottom:1rem; height: 14rem;">
                <div class="col-md-1 content-da" style="width:14rem; height: 14rem; padding-top:25%; padding-left:2rem;">
                  <div>
                    <h2 style="margin-top:auto; color:white; font-weight: bold;">Proposal</h2>
                    <h2 style="margin-top:auto; color:white; font-weight: bold;">Mahasiswa</h2>
                  </div>
                  <div class="bar1" style="; height:0.2rem; width:3rem; background-color:orange;">
                  </div>
                  <div class="bar2" style="height:0.1rem; width:10rem; background-color:orange;">
                  </div>
                </div>
              </a>
              <a class="dashboard-panel" href="<?php echo site_url('Proposal/Disetujui'); ?>" style="background-color:DodgerBlue; margin: auto; margin-top:1rem; margin-bottom:1rem; height: 14rem;">
                <div class="col-md-1" style="width:14rem; height: 14rem; padding-top:25%; padding-left:2rem;">
                  <div>
                    <h2 style="margin-top:auto; color:white; font-weight: bold;">Proposal</h2>
                    <h2 style="margin-top:auto; color:white; font-weight: bold;">Disetujui</h2>
                  </div>
                  <div class="bar1" style="; height:0.2rem; width:3rem; background-color:orange;">
                  </div>
                  <div class="bar2" style="height:0.1rem; width:10rem; background-color:orange;">
                  </div>
              </div>
              </a>
              <a class="dashboard-panel" href="<?php echo site_url('Petugas/PencairanDana'); ?>" style="background-color:DodgerBlue; margin: auto; margin-top:1rem; margin-bottom:1rem; height: 14rem;">
                <div class="col-md-1" style="width:14rem; height: 14rem; padding-top:25%; padding-left:2rem;">
                  <div>
                    <h2 style="margin-top:auto; color:white; font-weight: bold;">Proposal</h2>
                    <h2 style="margin-top:auto; color:white; font-weight: bold;">Ditolak</h2>
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