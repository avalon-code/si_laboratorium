<?php
require_once 'sistem-proses.php';
$crud = new crud($DB_con);
if(substr($_SESSION['level'],1,1)!=1){
     header("refresh:0;index.php?modul=etc&file=404");
}
else {
	$query = $DB_con->prepare("SELECT * FROM sistem WHERE nama_sistem = 'Registration'");
	$query->execute();
	$print = $query->fetchAll(PDO::FETCH_ASSOC);
	$printrecord = $print[0];
	$get_nama = $printrecord["nama_sistem"];
	$get_kondisi = $printrecord["kondisi_sistem"];

	$query = $DB_con->prepare("SELECT COUNT(*) as jumlah FROM admin WHERE status = '0'");
	$query->execute();
	$print = $query->fetchAll(PDO::FETCH_ASSOC);
	$printrecord = $print[0];
	$get_jumlah = $printrecord["jumlah"];
?>

<div class="clearfix"></div>

<div class="container">
    <div class="alert alert-info">
        <strong>Halaman Ini Mengatur Kendali Website Penilaian</strong>
    </div>
</div>

<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">Website Management</div>
		<div class="panel-body">
			<a href="index.php?modul=sistem&file=sistem-register&id=<?php echo $get_nama ?>&kondisi=<?php echo $get_kondisi ?>" class="btn btn-primary">Sign Up Function <span class="badge"><?php echo $get_kondisi ?></span></a>
			<a href="index.php?modul=sistem&file=sistem-user" class="btn btn-primary">New Account Request <span class="badge"><?php echo $get_jumlah ?></span></a>
			<!-- <a href="chat/index.php" class="btn btn-primary">View Log</a> -->
		</div>
	</div>
	<div class="panel panel-info">
		<div class="panel-heading">Data Print</div>
		<div class="panel-body">
			<a href="index.php?modul=sistem&file=sistem-print" class="btn btn-primary">
				<i class="glyphicon glyphicon-file"></i> Print Nilai</a>
		</div>
	</div>
	<div class="panel panel-danger">
		<div class="panel-heading">Database Manager</div>
		<div class="panel-body">
			<a href="#" class="btn btn-danger" onclick="resetData(1)">
				<i class="glyphicon glyphicon-user"></i> Reset Data Mahasiswa</a>
			<a href="#" class="btn btn-danger" onclick="resetData(2)">
				<i class="glyphicon glyphicon-book"></i> Reset Data Praktikum</a>
			<a href="#" class="btn btn-danger" onclick="resetData(3)">
				<i class="glyphicon glyphicon-list-alt"></i> Reset Data Nilai</a>
			<a href="#" class="btn btn-danger" onclick="resetData(4)">
				<i class="glyphicon glyphicon-briefcase"></i> Reset Data Kelompok</a>
		</div>
    </div>
</div>
<script>
	function resetData(a) {
		var r = confirm("Yakin Ingin Men-Reset Seluruh Data ?");
		if (r == true) {
			if (a == 1) {
				window.location = 'index.php?modul=sistem&file=sistem-reset&kode=mhs';
			}
			else if (a == 2) {
				window.location = 'index.php?modul=sistem&file=sistem-reset&kode=prk';
			}
			else if (a == 3) {
				window.location = 'index.php?modul=sistem&file=sistem-reset&kode=nil';
			}
			else if (a == 4) {
				window.location = 'index.php?modul=sistem&file=sistem-reset&kode=kel';
			}
		} else {
			
		}
	}
</script>

<?php } ?>