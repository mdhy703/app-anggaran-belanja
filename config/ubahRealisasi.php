<?php 
include('database.php');
$anggaran=$_POST['anggaran'];
$tanggal=$_POST['tanggal'];
$petugas=$_POST['petugas'];
$id=$_POST['id'];
echo json_encode($_POST);
$qs = "UPDATE realisasi set tanggal,id_petugas,nominal) values(,'$tanggal','$petugas',$total) WHERE id_anggaran='$id'";
if(mysqli_query($con,$qs)){
	$res = array('sukses' => TRUE);
		echo json_encode($res);
}else{
	$res = array('sukses' => FALSE,
					 'msg'=>'realisasi gagal di buat',
					 'err'=>mysqli_error($con) );
		echo json_encode($res);
} ?>