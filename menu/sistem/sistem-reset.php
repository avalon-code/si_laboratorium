<?php 
require_once 'sistem-proses.php';
$crud = new crud($DB_con);
if(substr($_SESSION['level'],1,1)!=1){
     header("refresh:0;index.php?modul=etc&file=404");
}
else {
	$perintah = $_GET['kode'];

	if ($crud->reset_data($perintah)) {
		echo '<center><h1>Data Berhasil Dibersihkan</h1></center>';
		header("refresh:3;index.php?modul=sistem&file=sistem-home");
	}
	else {
		echo '<center><h1>Data Gagal Dibersihkan</h1></center>';
		header("refresh:3;index.php?modul=sistem&file=sistem-home");
	}
}
?>