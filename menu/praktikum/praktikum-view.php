<?php
require_once 'praktikum-proses.php';
$crud = new crud($DB_con);

if(isset($_GET['view_id']))
{
	$id = $_GET['view_id'];
	extract($crud->getID($id));	
}
$id_next = $id + 1;
$id_prev = $id - 1;
?>
<link rel="stylesheet" type="text/css" href="bootstrap/css/style.css">
<div class="clearfix"></div>

<div class="container">
<a href="index.php?modul=info&file=info-add&id=<?php echo $id ?>" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; TAMBAH DATA PRAKTIKUM</a>
<a href="index.php?modul=praktikum&file=praktikum-view&view_id=<?php echo $id_next ?>" class="btn btn-large btn-info pull-right"><i class="glyphicon glyphicon-menu-right"></i></a>
<a href="index.php?modul=praktikum&file=praktikum-view&view_id=<?php echo $id_prev ?>" class="btn btn-large btn-info pull-right"><i class="glyphicon glyphicon-menu-left"></i></a>
</div>

<div class="clearfix"></div><br/>

<div class="container">
	 <table class='table table-bordered table-responsive'>
	 <tr class="capt">
		<td colspan="3">
			<center>
				Informasi Mahasiswa
				<a href="index.php?modul=praktikum&file=praktikum-edit&edit_id=<?php echo $id ?>" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
				<?php 
                if (substr($_SESSION['level'],1,1)==1) {
                ?>
				<a href="index.php?modul=praktikum&file=praktikum-del&delete_id=<?php echo $id ?>" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
				<?php
                }
                ?>
			</center>
		</td>
	</tr>
	 <tr class="capt">
		<td width="17%">NIM</td>
		<td width="2%">:</td>
		<td><?php echo $nim_mahasiswa ?></td>
	</tr>
	<tr class="capt">
		<td>Nama</td>
		<td>:</td>
		<td><?php echo $nama_mahasiswa ?></td>
	</tr>
	<?php
	$query = $DB_con->prepare("SELECT * FROM data_praktikum WHERE nim_mahasiswa='$id'");
        	$query->execute();
	while ($data = $query->fetch())
	{
		$get_kel = $data["kelompok"];
		$get_prak = $data['kode_praktikum'];
		$get_tahun = $data["tahun"];

		$query2 = $DB_con->prepare("SELECT * FROM praktikum WHERE kode_praktikum='$get_prak' AND laboratorium = '$getRole'");
		$query2->execute();
		$print2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if (isset($print2[0])) {
			$printrecord2 = $print2[0];
			$get_prak_name = $printrecord2["praktikum"];

			$query3 = $DB_con->prepare("SELECT * FROM informasi_kelompok WHERE kode_praktikum = '$get_prak' AND (kel1 = '$get_kel' OR kel2 = '$get_kel' OR kel3 = '$get_kel' OR kel4 = '$get_kel' OR kel5 = '$get_kel' OR kel6 = '$get_kel') AND tahun = '$get_tahun'");
			$query3->execute();
			$print3 = $query3->fetchAll(PDO::FETCH_ASSOC);
			if ($print3) {
				$printrecord3 = $print3[0];
				$get_aslab_nim = $printrecord3["nim_aslab"];
			}
			else {
				$get_aslab_nim = "";
			}
			
			if (!empty($get_aslab_nim)) {
				$query4 = $DB_con->prepare("SELECT * FROM data_aslab WHERE nim_aslab='$get_aslab_nim'");
				$query4->execute();
				$print4 = $query4->fetchAll(PDO::FETCH_ASSOC);
				$printrecord4 = $print4[0];
				$get_aslab_name = $printrecord4["nama_aslab"];
			}
			else {
				$get_aslab_name = "Tidak Ditemukan";
			}
	?>
	<tr class="capt">
		<td colspan="3">
			<center>
				<?php 
					echo $get_prak_name . " (". $get_prak .") ";
				?>
				<a href="index.php?modul=nilai&file=nilai-view&view_id=<?php echo $nim_mahasiswa ?>&tahun=<?php echo $get_tahun ?>&prak_id=<?php echo $get_prak ?>" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-search"></i></a>

				<a href="index.php?modul=info&file=info-edit&edit_id=<?php echo $id ?>&get_tahun=<?php echo $get_tahun ?>&prak_id=<?php echo $get_prak ?>" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
				<?php 
				if (substr($_SESSION['level'],1,1)==1) {
				?>
				<a href="index.php?modul=info&file=info-del&delete_id=<?php echo $id ?>&get_tahun=<?php echo $get_tahun ?>&prak_id=<?php echo $get_prak ?>" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
				<?php } ?>
			</center>
		</td>
	</tr>
	<tr class="capt">
		<td>Kelompok</td>
		<td>:</td>
		<td><?php echo $get_kel ?></td>
	</tr>
	<tr class="capt">
		<td>Aslab Penanggung Jawab</td>
		<td>:</td>
		<td><?php echo $get_aslab_name . " (". $get_aslab_nim .") " ?></td>
	</tr>
	<tr class="capt">
		<td>Tahun Ajaran</td>
		<td>:</td>
		<td><?php echo $get_tahun ?></td>
	</tr>
	<?php 
		}
	}
	?>
</table>

</div>