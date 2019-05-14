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
                <h1>Proposal Masuk</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Proposal Masuk</li>
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
                <h3 class="card-title">Proposal Masuk</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover" style="font-size:10pt; vertical-align:middle; text-align:center;">
                    <thead style="min-width:5rem;" >
                    <tr>
                        <th style="min-width:1rem;max-width:1rem;">NO.</th>
                        <th style="min-width:7.5rem;max-width:7.5rem;">DESKRIPSI</th>
                        <th style="max-width:15rem;">ABSTRAKSI</th>
                        <th style="max-width:5rem;min-width:5rem">AKSI</th>
                    </tr>
                    </thead>
                    <tbody> 
                    
                    <?php $i = 1; foreach($proposal_data as $row){   ?>                       
                    <tr>
                       <td style="vertical-align:middle;"><?php echo $i; ?></td>
                        <td style=" text-align:left; ">
                            <p><b>PERIHAL</b>: <?php echo $row->judul?><br>
                                <b>STATUS</b>: <?php echo $row->statname?><i></i><br>
                                <b>PERMINTAAN DANA</b>: <?php echo $row->dana?><br>
                                <b>Foto KTP</b>: <a target="_blank" href="<?php echo base_url($row->fileKtp);?>">Lihat KTP</a><br>
                                <b>File Proposal</b>: <a target="_blank" href="<?php echo base_url($row->fileProp);?>">Download Proposal</a><br>
                                <b>Laporan Keuangan</b>: <a target="_blank" href="<?php echo base_url($row->fileLap);?>">Download Laporan Keuangan</a><br>
                            </p>
                        </td>
                        <td style="vertical-align:middle;">
                            <?php echo $row->abstrak ?>
                        </td>
                        <td style="vertical-align:middle; ">
                        <form method="post" action="<?php echo site_url('Pemodal/DetailProposal/'.$row->id)?>">
                                <input type="hidden" name="id_proposal" value="<?php echo $row->id?>">
                                <button type="submit" class="btn btn-primary btn-sm" style="border-radius:0px !important;" title="Detail">Detail </button>
                                <a onclick="proposalConfirm('<?php echo site_url('Pemodal/ConfirmProposal/'.$row->id) ?>')"href="#!" style="border-radius:0px !important;" class="btn btn-success btn-sm"></i>Terima</a>
                                <a onclick="deleteConfirm('<?php echo site_url('Pemodal/TolakProposal/'.$row->id) ?>')"href="#!" style="border-radius:0px !important;" class="btn btn-danger btn-sm"></i>Tolak</a>
                            </form>
                                
                        </td>
                    </tr>
                    <?php $i++;} ?>   
                    </tfoot>
                </table>
                </div>
                <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Proposal Masuk</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    <div class="modal-body">Apakah anda yakin untuk mengProposal Masuk ini?</div>
                        <form id="msform" class="form-group" action="" method="post">
            <!-- fieldsets -->
                            <div class="row" style="margin-left:2rem;padding-bottom:1rem;">
                                <div class="col-5">
                                    <input type="number" require id="dana_setuju" placeholder="Dana Disetujui" name="danadisetujui" class="form-control aspect_list" style="border-radius:0px !important;">
                                </div>
                            </div>
                            <div class="row" style="margin-left:2rem;padding-bottom:1rem;">
                                <div class="col-5">
                                    <input type="text" id="Judulcatatan" placeholder="Judul Catatan" name="judulcatatan" class="form-control aspect_list" style="border-radius:0px !important;">
                                </div>
                            </div>
                            <div class="row" style="margin-left:2rem;padding-bottom:1rem;">
                                <div class="col-5">
                                    <textarea type="" id="Catatan" placeholder="Catatan" name="catatan" class="form-control aspect_list" style="border-radius:0px !important;" rows="3"></textarea> 
                                </div>
                            </div>
                            <div class="row" style="margin-left:2rem;padding-bottom:1rem;">
                                <div class="col-5">
                                <input type="submit" name="submit" id="btn-confirm" class="btn btn-primary" value="Terima">
                                        <button style="margin-left:2rem;" class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button> 
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    
                <!-- /.card-body -->
            </div>
            <div class="modal fade" id="tolakModal" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Proposal Masuk</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">Apakah anda yakin untuk menolak proposal ini?</div>
                                <div class="modal-footer">
                                    <a id="btn-tolak" class="btn btn-danger" href="#">Tolak</a>
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                </div>
                                </div>
                            </div>
                         </div>
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
    
    function proposalConfirm(url){
        $('#msform').attr('action', url);
        $('#confirmModal').modal();
    }
    function deleteConfirm(url){
        $('#btn-tolak').attr('href', url);
        $('#tolakModal').modal();
    }
</script>
    <script> 
$(document).ready(function(){
  $("#flip").click(function(){
    $("#panel").slideToggle(350);
  });
});
</script>
