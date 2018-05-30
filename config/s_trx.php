<?php 
include('database.php');
$anggaran=$_POST['anggaran'];
$tanggal=$_POST['tanggal'];
$petugas=$_POST['petugas'];
$total=$_POST['total'];
$qs = "INSERT INTO realisasi(id_anggaran,tanggal,id_petugas,nominal) values('$anggaran','$tanggal','$petugas',$total)";
if(mysqli_query($con,$qs)){
	$idTrx= mysqli_insert_id($con);
	mysqli_autocommit($con,FALSE);
	$i = 0;
	$len = count($_POST['item']);
	foreach ($_POST['item'] as $item) {
		$sup =$item['supplayer'];
		$barang = $item['barang'];
		$harga = $item['harga'];
		$jumlah = $item['jumlah'];
		$subtotal = $item['subtotal'];
		mysqli_query($con,"INSERT INTO detail_realisasi(id_realisasi,id_suplayer,nama_pembelian,harga,jumlah,subtotal) VALUES('$idTrx','$sup','$barang','$harga','$jumlah','$subtotal')");
	}

	if(mysqli_commit($con)){
		$res = array('sukses' => TRUE,
					 'msg'=>'berhasil di insert' );
		echo json_encode($res);
	}else{
		$res = array('sukses' => FALSE,
					 'msg'=>'gagal di insert' );
		echo json_encode($res);
	}

}else{
	$res = array('sukses' => FALSE,
					 'msg'=>'realisasi gagla di buat',
					 'err'=>mysqli_error($con) );
		echo json_encode($res);
}
// echo $qs;
?>