<!DOCTYPE html>
<html>
<head>
<?php require_once(dirname(dirname(__FILE__)) . '/Include/header.php'); ?>
<?php require_once(dirname(dirname(__FILE__)) . '/Pemodal/navbar_mhs.php'); ?>
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
                <h1>Tambah Usulan Baru</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Pengajuan Modal</li>
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
                <!-- /.card-header -->
                <div class="card-body">
                <?php if($this->session->has_userdata('error')){ ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>
                        <!-- Grid -->
                <form id="msform" class="form-group" action="<?php echo site_url('Pemodal/InsertProposal')?>" method="post" enctype="multipart/form-data">
            <!-- fieldsets -->
                <fieldset>
                <h2 style="font-size:25pt;">Pengajuan Modal</h2>
                <div class="row" style="margin-top:2rem;padding-bottom:1rem;">
                    <div class="col-3" style="margin-top:5px; text-align:left;">
                        Nama<span style="color:red;">*</span>
                    </div>
                    <div class="col-6" style="text-align:left;">
                       : <?php echo $this->session->userdata('nama_user');?>
                    </div>
                    <div class="col-3">
                        <span class="error_form" id="bidang_error">
                        </span>
                    </div>
                </div>
                <div class="row" style="padding-bottom:1rem;">
                    <div class="col-3" style="padding-top:5px; text-align:left;">
                        Judul<span style="color:red;">*</span>
                    </div>
                    <div class="col-6">
                        <input type="text" id="Judul" placeholder="Judul Proposal" name="judul" class="form-control aspect_list" required style="border-radius:0px !important;">
                    </div>
                    <div class="col-3">
                        <span class="error_form" id="judul_error">
                        </span>
                    </div>
                </div>
                <div class="row" style="padding-bottom:1rem;">
                    <div class="col-3" style="padding-top:5px; text-align:left;">
                        Abstrak<span style="color:red;">*</span>
                    </div>
                    <div class="col-6">
                        <textarea type="" id="Abstrak" placeholder="Abstrak" name="abstrak" class="form-control aspect_list" required style="border-radius:0px !important;" rows="3"></textarea> 
                    </div>
                    <div class="col-3">
                        <span class="error_form" id="abstrak_error">
                        </span>
                    </div>
                </div>
                <div class="row" style="padding-bottom:1rem;">
                    <div class="col-3" style="padding-top:5px; text-align:left;">
                        Jumlah Dana<span style="color:red;">*</span>
                    </div>
                    <div class="col-6">
                        <input type="number" id="jml_dana" placeholder="Jumlah Dana" name="dana" class="form-control aspect_list" required style="border-radius:0px !important;">
                    </div>
                    <div class="col-3">
                        <span class="error_form" id="judul_error">
                        </span>
                    </div>
                </div>
                <div class="row" style="padding-bottom:1rem;">
                    <div class="col-3" style="padding-top:5px; text-align:left;">
                        File Proposal<span style="color:red;">*</span>
                    </div>
                    <div class="col-6">
                    <input type="file" class="form-control-file border" name="hehe">
                    </div>
                    <div class="col-3">
                        <span class="error_form" id="abstrak_error">
                        </span>
                    </div>
                </div>
                <input type="submit" name="submit" class="action-button" value="SUBMIT"/>
            </fieldset>
            </form>
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
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>
