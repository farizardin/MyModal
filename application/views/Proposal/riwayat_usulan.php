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
                <h1>Riwayat Usulan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Kegiatan</a></li>
                <li class="breadcrumb-item active">Riwayat Usulan</li>

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
                <h3 class="card-title">Riwayat Usulan</h3>    <?php 
                 if(!empty($this->session->flashdata('message'))){
                 echo $this->session->flashdata('message');
            }?>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover" style="font-size:10pt; vertical-align:middle; text-align:center;">
                    <thead>
                    <tr>
                        <th style="">No.</th>
                        <th style="">DATA SKIM</th>
                        <th style="">KEGIATAN</th>
                        <th style="">KANGGOTAAN</th>
                        <th style="">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                   
                    <?php $i = 1; foreach ($proposal as $row) { ?>                            
                    <tr>
                       <td style="vertical-align:middle;"><?php echo $i ?></td>
                        <td style="text-align:left; ">
                            <p><b>TAHUN</b>: <?php echo $row->tahun ?><br>
                                <b>PROGRAM</b>: <?php echo $row->nama_sumber ?><br>
                                <b>SKIM</b>: <?php echo $row->SKIM?>
                            </p>
                        </td>
                        <td style=" text-align:left; ">
                            <p><b>JUDUL</b>: <?php echo $row->judul ?><br>
                                <b>BIDANG</b>: <?php echo $row->nama_bidang ?><br>
                                  
                                <b>STATUS</b>: <?php echo $row->stat ?> 
                            </p>
                        </td>
                        <td style=" text-align:center; ">
                            <?php 
                                if($row->ketua == $_SESSION['user_id'])
                                {
                                    echo 'Ketua';
                                }
                                else if ($row->anggota1 || $row->anggota2 == $_SESSION['user_id'])
                                { 
                                    echo 'Anggota';
                                   
                                       
                                         echo '<br><a href="#" data-toggle="modal" data-target="#confirmModal" data-id='.$row->id_proposal.'>(Konfirmasi)</a>';
                                    
                                }   
                             
                                else echo 'Pembimbing';

                            ?>
                            
                        </td>

                        
                        <td style="vertical-align:middle; ">
                            <form method="post" action="<?php echo site_url('kegiatan/detail')?>">
                                <input type="hidden" name="id_proposal" value="<?php echo $row->id_proposal ?>">
                                <button type="submit" class="btn btn-primary btn-sm" style="border-radius:0px !important;" title="Detail">Detail </button>
                            </form>

                            <?php require_once 'proposal_modals.php' ?>
                        </td>
                    </tr>    
                    <?php $i++; } ?>
                    
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

<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Apakah anda bersedia untuk menjadi anggota dalam Usulan ini?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Tekan <b>Setuju</b> Untuk Setuju<br>
                Tekan <b>Tolak</b> Untuk Menolak.
                Jika Menolak Usulan akan hilang dari riwayat usulan anda!
                <input type="text" id="coba">
            </div>
            <div class="modal-footer">
                <form action="<?php echo site_url('Mahasiswa/tolakKeanggotaan') ?>" method="POST" >
                    <input type="hidden" id="id_proposal" name="id_proposal">
                    <button class="btn btn-danger" type="submit" >Tolak</button>
                </form>

                <form action="<?php echo site_url('Mahasiswa/terimaKeanggotaan') ?>" method="POST" >
                    <input type="hidden" id="id_proposal" name="id_proposal">
                    <button class="btn btn-primary" type="submit">Setuju</button>
                </form>

              
              
            </div>
          </div>
        </div>
     </div>  
    <!-- /.content-wrapper -->
    <?php require_once(dirname(dirname(__FILE__)) . '/Include/footer.php'); ?>




<script type="text/javascript">
    $('#confirmModal').on('show.bs.modal', function (event) {
  var myVal = $(event.relatedTarget).data('id');
  $(this).find("input#id_proposal").val(myVal);
});
</script>