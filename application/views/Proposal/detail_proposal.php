<!DOCTYPE html>
<html>
<head>
<?php require_once(dirname(dirname(__FILE__)) . '/Include/header.php'); ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail Proposal</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Kegiatan</a></li>
                <li class="breadcrumb-item active"><a >Detail</a></li>
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
                <h3 class="card-title">Detail Proposal</h3>
                <div clas="row" style="margin-top:2rem;margin-bottom:2rem;">
                    <div class="col" style="margin:auto;">
                    <div class="tab">
                        <button class="tablinks" onclick="openTab(event, 'info')" id="defaultOpen">Informasi</button>
                    </div>
                    </div>
                </div>
                    <div id="info" class="tabcontent">
                    <table class="table" width="100%">
                                <tbody>
                                    <tr>
                                        <th style="width:30%">Nama Pengaju</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                        <?php echo $proposal_data->nama?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Judul</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                        <?php echo $proposal_data->judul?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Jumlah Dana</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                        <?php echo $proposal_data->dana?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Keterangan</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                        <?php echo $proposal_data->ket ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Status Proposal</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                        <?php echo "<i>'$proposal_data->stats.'</i>"?> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">KTP</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                             <a target="_blank" href="<?php echo base_url($proposal_data->fileKtp);?>">File KTP</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Proposal</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                             <a target="_blank" href="<?php echo base_url($proposal_data->fileProp);?>">File Proposal</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Laporan Keuangan</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                             <a target="_blank" href="<?php echo base_url($proposal_data->fileLap);?>">File Laporan Keuangan</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                    </div>
                    <div id="data" class="tabcontent">
                    <table class="table" width="100%">
                                <tbody>
                                    <tr>
                                        <th style="width:30%">Catatan</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                    <div id="seminar" class="tabcontent">
                    <table class="table" width="100%">
                                <tbody>
                                    <tr>
                                        <th style="width:30%">Nama Mahasiswa</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Judul</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Bidang</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Dosen 1</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Dosen 2</th>
                                        <th style="width:5%">:</th>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Status</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Proposal</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                             <a href="" download>Download Proposal</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                    <div id="sidang" class="tabcontent">
                    <table class="table" width="100%">
                                <tbody>
                                    <tr>
                                        <th style="width:30%">Nama Mahasiswa</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Judul</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Bidang</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Dosen 1</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Dosen 2</th>
                                        <th style="width:5%">:</th>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Status</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width:30%">Proposal</th>
                                        <th style="width:5%">:</th>
                                        <td>
                                             <a href="" download>Download Proposal</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
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