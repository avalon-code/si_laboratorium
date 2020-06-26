<!DOCTYPE HTML>
<html>
<head>
<title>Zero Login Page</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="menu/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<?php
session_start();
require_once 'menu/dbconfig.php';
if(isset($_SESSION['username'])){
	echo '
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Zero v.1.0.0</a>
			</div>
		</div>
	</nav>
	<br><br><center><h1>Terdapat Akun yang Terdeteksi, Melanjutkan ke Halaman Selanjutnya</h1></center>
	';
	header("refresh: 2;menu/index.php");
	}
else{
?>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">Zero v.1.0.0</a>
			</div>
		</div>
	</nav>
	<div class="container">
		<form action="action.php" method="POST">
			<center>
			    <h1>Laboratorium Information System Website</h1>
			    <h3>Informatics Engineering Laboratorium Assistant </h3>
			    <br/>
			    <p>
			        <input type="text" name="user" placeholder="Username" class='form-control' required>
			    </p>
			    <p>
			        <input type="password" name='sandi' placeholder="Password" class='form-control' required> 
			    </p>

			    <p>
			        <input type="submit" name="login" value="Login" class="btn btn-primary btn-block">
			    </p>
			    <p>
			    	<center><a href="regist.php">Make a new Account ?</a></center>
			    </p>
		    </center>     
		</form>​​
	</div>
	<nav class="navbar navbar-inverse navbar-fixed-bottom">
		<a class="navbar-brand" href="#"><strong>&copy Developed By Ghidorah, Lab. RPL 2018 - 2020</strong> </a>
	</nav>
</body>
<?php } ?>
<script src="menu/bootstrap/js/jquery.min.js"></script>
<script src="menu/bootstrap/js/bootstrap.min.js"></script>
</html>