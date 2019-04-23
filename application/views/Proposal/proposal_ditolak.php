<!DOCTYPE html>
<html>
<head>
<?php require_once(dirname(dirname(__FILE__)) . '/Include/header.php'); ?>
<?php require_once(dirname(dirname(__FILE__)) . '/Mahasiswa/navbar_mhs.php'); ?>
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
                <h1>Proposal Ditolak</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Proposal Ditolak</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>

        <!-- Filter -->
        <section class="content">
            <div class="card" style="border-radius:0px !important;">
                <div class="card-header">
                    <div style="cursor:pointer; width:7rem;" id="flip">
                        <i class="fa fa-sliders" style="font-size:25px; color: rgba(0,0,0,.5);"></i>
                        <span class="nav-link-text" style="margin-left:10px;font-size:20px; color: rgba(0,0,0,.5);">FILTER</span>
                    </div>
                </div>
                <div class="card-body" id="panel" style="display:none;">
                    <div class="row">
                        <div class="col-3">
                            <span style="font-size:20px; color:rgba(0,0,0,.7); margin-left:0.5rem;">Tahun</span>
                            <select class="form-control" id="tahun_dana" name="tahun_dana" data-fv-field="id_sumber_dana" style="border-radius:0px !important; margin-top:3px;">
                                <option value="">-- SEMUA TAHUN --</option>
                                <option value="">1</option>
                                <option value="">2</option>
                            </select>
                        </div>
                        <div class="col-4" style="margin-left:2rem;">
                            <span style="font-size:20px; color:rgba(0,0,0,.7); margin-left:0.5rem;">Kode Sumber Dana</span>
                            <select class="form-control" id="tahun_dana" name="tahun_dana" data-fv-field="id_sumber_dana" style="border-radius:0px !important; margin-top:3px;">
                                <option value="">-- SEMUA SUMBER DANA --</option>
                                <option value="">1</option>
                                <option value="">2</option>
                            </select>
                        </div>
                        <div class="col-3" style="margin-left:2rem;">
                            <span style="font-size:20px; color:rgba(0,0,0,.7); margin-left:0.5rem;">SKIM</span>
                            <select class="form-control" id="tahun_dana" name="tahun_dana" data-fv-field="id_sumber_dana" style="border-radius:0px !important; margin-top:3px;">
                                <option value="">-- SKIM --</option>
                                <option value="">1</option>
                                <option value="">2</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-top:1rem;">
                        <div class="col-3">
                        <button type="button" class="btn btn-primary btn-sm" style="border-radius:0px !important; padding-left:1rem;padding-right:1rem;" title="Detail">OK</button>
                        <button type="button" class="btn btn-primary btn-sm" style="border-radius:0px !important; padding-left:1rem;padding-right:1rem;" title="Detail">RESET</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">
            <div class="col">
            <div class="card table-responsive" style="border-radius: 0px !important;">
                <?php if($this->session->has_userdata('success')){ ?>
                    <div class="alert alert-primary" role="alert">
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>
                <div class="card-header">
                <h3 class="card-title">Proposal Ditolak</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover" style="font-size:10pt; vertical-align:middle; text-align:center;">
                    <thead style="min-width:5rem;" >
                    <tr>
                        <th style="min-width:1rem;max-width:1rem;">NO.</th>
                        <th style="min-width:10rem;max-width:10rem;">DESKRIPSI</th>
                        <th style="max-width:15rem;">ABSTRAKSI</th>
                        <th style="max-width:5rem;min-width:5rem">AKSI</th>
                    </tr>
                    </thead>
                    <tbody> 
                    
                    <?php $i = 1; foreach($proposal_data as $row){   ?>                       
                    <tr>
                       <td style="vertical-align:middle;"><?php echo $i; ?></td>
                        <td style=" text-align:left; ">
                            <p><b>JUDUL</b>: <?php echo $row->judul?><br>
                                <b>BIDANG</b>: <?php echo $row->nama?><br>
                                <b>STATUS</b>: <i><?php echo $row->status
                                ?></i><br>
                                <b>Pembimbing 1</b>: <?php echo $row->dosen1.' (<i>'.$row->statusdosen1.'</i>)'?> <br>
                                <b>Pembimbing 2</b>: <?php echo $row->dosen2.' (<i>'.$row->statusdosen2.'</i>)'?> <br>
                            </p>
                        </td>
                        <td style="vertical-align:middle;">
                            <?php echo $row->keterangan ?>
                        </td>
                        <td style="vertical-align:middle; ">
                            <form method="post" action="<?php echo site_url('Mahasiswa/DetailProposal')?>">
                                <input type="hidden" name="id_proposal" value="<?php echo $row->id?>">
                                <button type="submit" class="btn btn-primary btn-sm" style="border-radius:0px !important;" title="Detail">Detail </button>
                            </form>
                        </td>
                    </tr>
                                <?php $i++;} ?>   
                    </tfoot>
                </table>
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
                        
                        <!-- Modal footer -->
                    </div>
                    </div>
                </div>



    <!-- /.content-wrapper -->
    <?php require_once(dirname(dirname(__FILE__)) . '/Include/footer.php'); ?>

    <script> 
$(document).ready(function(){
  $("#flip").click(function(){
    $("#panel").slideToggle(350);
  });
});
</script>
