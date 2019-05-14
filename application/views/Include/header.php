<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>MyModal</title>
<meta name="description" content="Website untuk kewirausahaan mahasiswa">
<meta name="author" content="SIMKWU ITS">
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url("assets/plugins/font-awesome/css/font-awesome.min.css")?>">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url("assets/dist/css/adminlte.min.css")?>">
<!-- iCheck -->
<link rel="stylesheet" href="<?php echo base_url("assets/plugins/iCheck/flat/blue.css")?>">
<!-- Morris chart -->
<link rel="stylesheet" href="<?php echo base_url("assets/plugins/morris/morris.css")?>">
<!-- jvectormap -->
<link rel="stylesheet" href="<?php echo base_url("assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css")?>">
<!-- Date Picker -->
<link rel="stylesheet" href="<?php echo base_url("assets/plugins/datepicker/datepicker3.css")?>">
<!-- Daterange picker -->
<link rel="stylesheet" href="<?php echo base_url("assets/plugins/daterangepicker/daterangepicker-bs3.css")?>">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="<?php echo base_url("assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")?>">
<link rel="stylesheet" href="<?php echo base_url("assets/style.css")?>">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<link rel="shortcut icon" href="<?php echo base_url("assets/images/logo-100x100.png"); ?>" type="image/x-icon">
<link rel="icon" href="<?php echo base_url("assets/images/logo-100x100.png"); ?>" type="image/x-icon">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url("assets/plugins/datatables/dataTables.bootstrap4.min.css");?>">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url("assets/dist/css/adminlte.min.css");?>">

<link rel="stylesheet" href="<?php echo base_url("assets/css/css.css")?>">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js"></script>

<link href="<?php echo base_url("assets/fullcalendar/3.4.0/fullcalendar.min.css")?>" rel="stylesheet">
<link href="<?php echo base_url("assets/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.standalone.min.css")?>" rel="stylesheet">

<script src="<?php echo base_url("assets/fullcalendar/3.4.0/fullcalendar.min.js") ?>"></script>
<script src="<?php echo base_url("assets/fullcalendar/3.4.0/locale/id.js") ?>"></script>
<script src="<?php echo base_url("assets/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js") ?>"></script>
<script src="<?php echo base_url("assets/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.id.min.js") ?>"></script>
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  background-color: #f4f6f9 !important;
  margin:auto;
  width:80%;
  min-width:25rem;
  height:5rem;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
  width:25%;
  height:5rem;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #41b3f9;
  color:white;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #41b3f9;
  color:white;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  -webkit-animation: fadeEffect 1s;
  animation: fadeEffect 1s;
}

/* Fade in tabs */
@-webkit-keyframes fadeEffect {
  from {opacity: 0;}
  to {opacity: 1;}
}

@keyframes fadeEffect {
  from {opacity: 0;}
  to {opacity: 1;}
}
</style>
<?php 
  switch ($this->session->id_role) {
    
    case 1:
      $this->load->view('Include/navbar_pemodal');
      break;
    case 2:
      $this->load->view('Include/navbar_peminjam');
      break;
    case 3:
      $this->load->view('Include/navbar_petugas');
      break;
  }

  
?>
