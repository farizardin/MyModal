<!DOCTYPE html>
<html>
<head>
<?php require_once(dirname(dirname(__FILE__)) . '/Include/header.php'); ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <?php require_once 'navbar_petugas.php' ?>
  <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Proposal Disetujui</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Proposal Disetujui</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">
            <div class="col">
            <div class="card table-responsive" style="border-radius: 0px !important;">
                <div class="card-header">
                <h3 class="card-title">Proposal Disetujui</h3>
                <div clas="row" style="margin-top:2rem;margin-bottom:2rem;">
                    <div class="col" style="margin:auto;">
                    <div class="tab">
                        <button class="tablinks" onclick="openTab(event, 'data')" id="defaultOpen">Data Kegiatan</button>
                        <button class="tablinks" onclick="openTab(event, 'dana')">Dana Kegiatan</button>
                        <button class="tablinks" onclick="openTab(event, 'unggah')">Unggah File</button>
                    </div>
                    </div>
                </div>
                    <div id="data" class="tabcontent">
                    <table class="table" width="100%">
                                <tbody>
                                    <tr>
                                        <th style="width:30%">Judul</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                            2018
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Bidang</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                            HEHEHE
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Abstrak</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                            jaskkkkkkkkkdhjaksbdshdbasd asdahsdabshasbd asdhasdabjshdvasjd asdhasvdahsdvajsd asdavsdasvdasdbas dasdgabsgydbasudaysd asdyasdvauysdvas dasduyildnfoj;ajnasid asduiasdbasdabsda
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Ketua</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                            HEHEHE
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Anggota</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                            HEHEHE
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Anggota</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                            HEHEHE
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Pembimbing</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                            HEHEHE
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Tahun Aktif</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                            HEHEHE
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Status</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                            HEHEHE
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Proposal</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>

                    <div id="dana" class="tabcontent">
                    <table class="table" width="100%">
                                <tbody>
                                    <tr>
                                        <th style="width:30%">Tahun Sumber Dana</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                            2018
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Sumber Dana</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                            HEHEHE
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">SKIM</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                            aaaaaaaaaaaaaaaaaaa   
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Pengajuan Dana</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                            10.000.000
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Dana Disetujui</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                            7.000.000
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Dana Diterima</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                            5.000.000
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Dana Telah Diangsur</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                            1.500.000
                                        </td>
                                    </tr>
                                </tbody>
                            </table> 
                    </div>

                    <div id="unggah" class="tabcontent">
                    <table id="example1" class="table table-bordered table-striped table-hover" style="font-size:10pt; text-align:center; vertical-align:middle;">
                    <thead>
                    <tr>
                    <th>Jenis Kemajuan</th>
                    <th>Status Kemajuan</th>
                    <th>Tanggal Unggah</th>
                    <th style="max-width:8rem;min-width:8rem;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                    <td style="vertical-align:middle;">Test</td>
                    <td style="vertical-align:middle;">test</td>
                    <td style="vertical-align:middle;">Test</td>
                    <td>
                    <button type="button" class="btn btn-primary btn-sm" style="border-radius:0px !important;" title="Unggah">Unggah</button>
                    <button type="button" class="btn btn-success btn-sm" style="border-radius:0px !important; color:white;" title="Edit">Unduh</button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusUnggah" style="border-radius:0px !important;" title="Tolak">Hapus</button>
                    <?php require_once 'proposal_modals.php' ?>
                    </td>
                    </tr>
                    <tr>
                    <td style="vertical-align:middle;">Test</td>
                    <td style="vertical-align:middle;">test</td>
                    <td style="vertical-align:middle;">Test</td>
                    <td>
                    <button type="button" class="btn btn-primary btn-sm" style="border-radius:0px !important;" title="Unggah">Unggah</button>
                    <button type="button" class="btn btn-success btn-sm" style="border-radius:0px !important; color:white;" title="Edit">Unduh</button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusUnggah" style="border-radius:0px !important;" title="Tolak">Hapus</button>
                    <?php require_once 'proposal_modals.php' ?>
                    </td>
                    </tr>
                    <tr>
                    <td style="vertical-align:middle;">Test</td>
                    <td style="vertical-align:middle;">test</td>
                    <td style="vertical-align:middle;">Test</td>
                    <td>
                    <button type="button" class="btn btn-primary btn-sm" style="border-radius:0px !important;" title="Unggah">Unggah</button>
                    <button type="button" class="btn btn-success btn-sm" style="border-radius:0px !important; color:white;" title="Edit">Unduh</button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusUnggah" style="border-radius:0px !important;" title="Tolak">Hapus</button>
                    <?php require_once 'proposal_modals.php' ?>
                    </td>
                    </tr>
                    <tr>
                    <td style="vertical-align:middle;">Test</td>
                    <td style="vertical-align:middle;">test</td>
                    <td style="vertical-align:middle;">Test</td>
                    <td>
                    <button type="button" class="btn btn-primary btn-sm" style="border-radius:0px !important;" title="Unggah">Unggah</button>
                    <button type="button" class="btn btn-success btn-sm" style="border-radius:0px !important; color:white;" title="Edit">Unduh</button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusUnggah" style="border-radius:0px !important;" title="Tolak">Hapus</button>
                    <?php require_once 'proposal_modals.php' ?>
                    </td>
                    </tr>
                    <tr>
                    <td style="vertical-align:middle;">Test</td>
                    <td style="vertical-align:middle;">test</td>
                    <td style="vertical-align:middle;">Test</td>
                    <td>
                    <button type="button" class="btn btn-primary btn-sm" style="border-radius:0px !important;" title="Unggah">Unggah</button>
                    <button type="button" class="btn btn-success btn-sm" style="border-radius:0px !important; color:white;" title="Edit">Unduh</button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusUnggah" style="border-radius:0px !important;" title="Tolak">Hapus</button>
                    <?php require_once 'proposal_modals.php' ?>
                    </td>
                    </tr>
                    <tr>
                    <td style="vertical-align:middle;">Test</td>
                    <td style="vertical-align:middle;">test</td>
                    <td style="vertical-align:middle;">Test</td>
                    <td>
                    <button type="button" class="btn btn-primary btn-sm" style="border-radius:0px !important;" title="Unggah">Unggah</button>
                    <button type="button" class="btn btn-success btn-sm" style="border-radius:0px !important; color:white;" title="Edit">Unduh</button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusUnggah" style="border-radius:0px !important;" title="Tolak">Hapus</button>
                    <?php require_once 'proposal_modals.php' ?>
                    </td>
                    </tr>
                    </tfoot>
                </table>
                    </div>
                </div>
                <!-- /.card-header -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php require_once(dirname(dirname(__FILE__)) . '/Include/footer.php'); ?>

    <script>
function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>