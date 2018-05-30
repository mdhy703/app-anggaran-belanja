<?php 
include('database.php');
$id=$_POST['id'];
$m=mysqli_query($con,"SELECT * FROM detail_realisasi where id='$id'");
$res = mysqli_fetch_assoc($m);
echo json_encode($res);
 ?>