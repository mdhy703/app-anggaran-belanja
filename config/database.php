<?php 
	error_reporting(E_ALL ^ E_DEPRECATED);
    $host="localhost";
    $user="root";
    $pass="";
	$db="anggaran";
    $con=mysqli_connect($host,$user,$pass);
	mysqli_select_db($con,$db);
	

	function bersih($text){
		$host="localhost";
	    $user="root";
	    $pass="";
		$db="anggaran";
	    $con=mysqli_connect($host,$user,$pass);
		return mysqli_real_escape_string($con,$text);
	}
 ?>