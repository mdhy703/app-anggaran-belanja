<?php 
session_start();
include('config/database.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>LOGIN - Ponpes AL-Hidayah</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css">
	<link rel="icon" type="image/png" href="assets/images/bootstrap.png">
	<script type="text/javascript" src="assets/jquery/jquery.min.js"></script>
	<!-- <script type="text/javascript" src="asset/tether/js/tether.min.js"></script>
	<script type="text/javascript" src="asset/bootstrap/js/bootstrap.min.js"></script> -->
</head>
<body class="container mt-5">
	<div class="row justify-content-md-center pt-5">
		<div class="col-md-4 jumbotron" style="background-color: yellowgreen;">
			<form method="post">
				<h4 class="text-center">Login</h4>
				<div id="msg"></div>
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control">
				</div>
				<div class="form-group">
					<button type="submit" name="login" class="btn btn-success">LOGIN</button>
				</div>
				<?php  
				if(isset($_POST['login'])){
				$user = bersih($_POST['username']);
				$pass = bersih($_POST['password']);
				$query= "SELECT * FROM user where username='$user' and password='$pass'";
				$q = mysqli_query($con,$query);
				if(mysqli_num_rows($q)>0){ 
					$_SESSION['username']=$user;
					$_SESSION['status']='loggin';
					?>
					<script type="text/javascript">
						$('#msg').attr('class','alert alert-success');
						$('#msg').html('<b>Login Suksess<br> tunggu sesaat..! <i class="fa fa-spinner fa-pulse"></i></b>');
						setTimeout(function(){ window.location="index.php" }, 3500);
					</script>
				<?php }else{ ?>
					<script type="text/javascript">
						$('#msg').attr('class','alert alert-danger');
						$('#msg').html('username tidak ada');
					</script>
				<?php }
			}?>
			</form>
			<hr class="my-4">

			<p class="lead">
    			Ponpes Al-Hidayah Jambi - Pengelolaan Anggaran Belanja 
  			</p>
		</div>
	</div>

</body>
</html>