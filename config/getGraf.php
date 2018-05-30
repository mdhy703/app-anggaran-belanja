<?php 
	include('database.php');
	$th=2018;
	$donasi=array();
	$pengeluaran=array();
	for ($i=1; $i <=12 ; $i++) { 
		$q=mysqli_query($con,"SELECT SUM(nominal) AS total FROM donasi WHERE YEAR(tanggal)=$th AND MONTH(tanggal)=$i");
		$res=mysqli_fetch_row($q);
		$donasi[]=($res[0]==null?0:$res[0]);

		$q=mysqli_query($con,"SELECT SUM(nominal) AS total FROM realisasi WHERE YEAR(tanggal)=$th AND MONTH(tanggal)=$i");
		$res=mysqli_fetch_row($q);
		$pengeluaran[]=($res[0]==null?0:$res[0]);
	}
	echo json_encode($donasi);
	echo json_encode($pengeluaran);
?>