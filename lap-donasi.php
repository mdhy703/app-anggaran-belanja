<?php include('config/database.php'); 
if(!empty($_GET['tanggal'])){
	$tgl=$_GET['tanggal'];
	$query="SELECT donasi.*,donatur.nama_donatur FROM donasi inner join donatur on donasi.id_donatur = donatur.id_donatur
	 where donasi.tanggal='$tgl'
	 order by donasi.tanggal ASC";
}
else if(!empty($_GET['bulan'])&&!empty($_GET['tahun'])){
	$bulan=$_GET['bulan'];
	$th=$_GET['tahun'];
	$query="SELECT donasi.*,donatur.nama_donatur FROM donasi inner join donatur on donasi.id_donatur = donatur.id_donatur
	 where MONTH(donasi.tanggal)=$bulan AND YEAR(donasi.tanggal)=$th
	 order by donasi.tanggal ASC";
}else if(!empty($_GET['tahun'])){
	$th=$_GET['tahun'];
	$query="SELECT donasi.*,donatur.nama_donatur FROM donasi inner join donatur on donasi.id_donatur = donatur.id_donatur
	 where YEAR(donasi.tanggal)=$th
	 order by donasi.tanggal ASC";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>LAPORAN DONASI | PONPES AL-HIDAYAH</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css" media="print">
</head>
<body class="container">
	<div class="row mt-4">
		<div class="col-md-2 pl-5">
			<img src="assets/images/bootstrap.png">
		</div>
		<div class="col-md-10">
			<h3 class="text-center">PONDOK PESANTREN MODER AL HIDAYAH</h3>
			<p class="text-center mb-0">
				Jl. Marsda Surya Dharma Kel. Kenali Asam Bawah Kec. Kota Baru - Kota Jambi Kode Pos:<i>36129</i> 
			</p>
			<p class="text-center mb-0">Telepon: (0741) 40954</p>
		</div>
	</div>
	<hr class="my-4">
	<div class="row">
		<div class="col-12">
			<?php 
			if(!empty($_GET['tanggal'])){
			$tgl=$_GET['tanggal']; ?>
				<h4 class="text-center">LAPORAN DONASI <?php echo date('d-m-Y',strtotime($tgl)); ?></h4>
			<?php }
			else if(!empty($_GET['bulan'])&&!empty($_GET['tahun'])){
			$bulan=($_GET['bulan']==1?'Januari':($_GET['bulan']==2?'Februari':($_GET['bulan']==3?'Maret':($_GET['bulan']==4?'April':($_GET['bulan']==5?'Mei':($_GET['bulan']==6?'Juni':($_GET['bulan']==7?'Juli':($_GET['bulan']==8?'Agustus':($_GET['bulan']==9?'September':($_GET['bulan']==10?'Oktober':($_GET['bulan']==11?'November':'Desember')))))))))));
			$th=$_GET['tahun'];?>
				<h4 class="text-center">LAPORAN DONASI BULAN <?php echo $bulan.' '.$th; ?></h4>
			<?php }else if(!empty($_GET['tahun'])){
				$tahun=$_GET['tahun'];?>
				<h4 class="text-center">LAPORAN DONASI TAHUN <?php echo $th; ?></h4>
			<?php } ?> 
			<table class="table table-bordered" id="example">
			<thead>
				<tr>
					<th>No</th><th>Nama Donatur</th><th>Tanggal</th><th>Jumlah</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$q= mysqli_query($con,$query);
				$total=0;
				$i=1;
				while($r=mysqli_fetch_array($q)){ ?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $r[4]; ?></td>
					<td><?php echo date('d-m-Y',strtotime($r[2])); ?></td>
					<td  class="text-right"><?php echo 'Rp.'.number_format($r[3]); ?></td>
					
				</tr>
				<?php $i++;
				$total += $r[3];
			} ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3"><b>TOTAL</b></td>
					<th class="text-right"><?php echo 'Rp.'.number_format($total); ?></th>
				</tr>
			</tfoot>	
		</table>	
		</div>
	</div>
<script type="text/javascript">
	window.print();
</script>
</body>
</html>