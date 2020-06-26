<!DOCTYPE HTML>
<html>
<head>
<title>Zero Sign Up Page</title>
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

		<?php 

		$query = $DB_con->prepare("SELECT * FROM sistem WHERE nama_sistem = 'Registration'");
		$query->execute();
		$print = $query->fetchAll(PDO::FETCH_ASSOC);
		$printrecord = $print[0];
		$get_kondisi = $printrecord["kondisi_sistem"];

		if ($get_kondisi=="On") {
		?>

		<form action="action.php" method="POST">
			<center>
			    <h1>Make new Account as Laboratorium Assistant</h1>
			    <p>
			    	<input type="text" minlength="7" maxlength="7" name='nim' placeholder="Nomor Induk Mahasiswa" class='form-control' required>
			    </p>
			    <p>
			        <input type="text" minlength="5" maxlength="20" name="user" placeholder="Username" class='form-control' required>
			    </p>
			    <p>
			        <input type="password" minlength="5" maxlength="20" name='sandi' placeholder="Password" class='form-control' required>
			    </p>
			    <p>
			        <input type="text" minlength="10" maxlength="15" name='kontak' placeholder="No. Handphone Aktif" class='form-control' required>
			    </p>
			    <p>
			        <input type="submit" name="regist" value="Continue" class="btn btn-primary btn-block">
			    </p>
		    </center>     
		</form>​​

		<?php
		} else {
			echo '<center><h1>Tidak ada Izin Pembuatan Akun Baru</h1></center>';
		}
		?>
	</div>
	<nav class="navbar navbar-inverse navbar-fixed-bottom">
		<div class="container">
			<a class="navbar-brand" href="#"><strong>&copy Developed By Ghidorah, Lab. RPL 2018 - 2019</strong> </a>
		</div>
	</nav>
</body>
<?php } ?>
<script src="menu/bootstrap/js/jquery.min.js"></script>
<script src="menu/bootstrap/js/bootstrap.min.js"></script>
</html>