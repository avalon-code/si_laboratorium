<?php
require_once 'menu/dbconfig.php';
if(isset($_POST['login']))
{
	$user = $_POST['user']; 
	$sandi = md5($_POST['sandi']);
	$stmt = $DB_con->prepare("SELECT * FROM admin WHERE username='$user' and  password='$sandi'");
	$stmt->execute();
	$data = $stmt->fetch();
	$nama=$data['username'];
	$pass=$data['password'];
	$nim=$data['nim'];
	$level=$data['level'];
	if($nama==$user && $pass==$sandi)
	{
		// jika login benar //
		session_start();
		$_SESSION['username']=$nama;
		$_SESSION['level']=$level;

		echo "
			<script>
				alert('Login Berhasil...');
				window.location = 'menu/index.php';
			</script>
		";
	}
	else
	{
		echo "
			<script>
				alert('Login Gagal...');
				window.location = 'index.php';
			</script>
		";
	}
}
elseif (isset($_POST['regist'])){
	$nim = $_POST['nim'];
	$user = $_POST['user']; 
	$sandi = $_POST['sandi'];
	$kontak = $_POST['kontak'];
	$stmt = $DB_con->prepare("INSERT INTO admin VALUES ('$nim','$user', MD5('$sandi'), '$kontak', '0','0')");
	$res = $stmt->execute();
	if($res)
	{
		echo "
			<script>
				alert('Registrasi berhasil, harap tunggu Persetujuan dari Administrator sebelum melanjutkan.');
				window.location = 'index.php';
			</script>
		";
	}
	else
	{
		echo "
			<script>
				alert('Registrasi Gagal!');
				window.location = 'regist.php';
			</script>
		";
	}
}
else {
	echo '<br><h1>What ?</h1>';
}
?>