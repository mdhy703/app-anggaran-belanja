<?php session_start();
if(!$_SESSION['username']){
    header('location:login.php');
}else{
if (! isset($_GET['p']))
{
            header('location:index.php?p=home');
} else {
include('config/database.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Home - Ponpes AL-Hidayah</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/DataTables/css/dataTables.bootstrap4.min.css">
	<link rel="icon" type="image/png" href="assets/images/bootstrap.png">

	<script type="text/javascript" src="assets/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="assets/tether/js/tether.min.js"></script>
	<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/DataTables/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="assets/DataTables/js/dataTables.bootstrap4.min.js"></script>
	<style type="text/css">
	#example_wrapper{
		padding: 0;
	}
	#rsT {
    	padding: 0 15px;
	}
	</style>
</head>
<body class="">
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: yellowgreen;">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbar">
    <a class="navbar-brand" href="index.php?p=home">Al-Hidayah</a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="index.php?p=home">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="master" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Master
        </a>
        <div class="dropdown-menu" aria-labelledby="master">
          <a class="dropdown-item" href="index.php?p=supplayer">Data Supplayer</a>
          <a class="dropdown-item" href="index.php?p=petugas">Data Petugas</a>
          <a class="dropdown-item" href="index.php?p=anggaran">Data Anggaran</a>
          <a class="dropdown-item" href="index.php?p=donatur">Data Donatur</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="proses" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Proses
        </a>
        <div class="dropdown-menu" aria-labelledby="proses">
          <a class="dropdown-item" href="index.php?p=realisasi">Realisasi Anggaran</a>
          <a class="dropdown-item" href="index.php?p=donasi">Donasi</a>
          <!-- <a class="dropdown-item" href="#">Data Lain</a> -->
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="laporan" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Laporan
        </a>
        <div class="dropdown-menu" aria-labelledby="laporan">
          <a class="dropdown-item" href="index.php?p=grafik">Grafik</a>
          <a class="dropdown-item" href="index.php?p=lap-belanja">Laporan Belanja</a>
          <a class="dropdown-item" href="index.php?p=lap-donasi">Laporan Donasi</a>
          <!-- <a class="dropdown-item" href="#">Data Lain</a> -->
        </div>
      </li>
    </ul>
    <ul class="navbar-nav my-2 my-lg-0">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="profil" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-gear"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profil">
          <a class="dropdown-item" href="logout.php">Log Out</a>
          <!-- <a class="dropdown-item" href="#">Data Petugas</a>
          <a class="dropdown-item" href="#">Data Lain</a> -->
        </div>
      </li>
    </ul>
  </div>
</nav>
<div>
<?php  
$page = $_GET['p'];  
switch($page) {
    case 'home':
        include('home.php');
    break;
    case 'petugas':
        include('petugas.php');
    break;
    case 'supplayer':
        include('supplayer.php');
    break;
    case 'anggaran':
        include('anggaran.php');
    break;
    case 'donatur':
        include('donatur.php');
    break;
    case 'realisasi':
        include('realisasi.php');
    break;
    case 'donasi':
        include('donasi.php');
    break;
    case 'grafik':
        include('grafik.php');
    break;
    case 'lap-belanja':
        include('lbelanja.php');
    break;
    case 'lap-donasi':
        include('ldonasi.php');
    break;
}
?>	
</div>	

</body>
</html>
<?php } //end page selection
} //end session?>