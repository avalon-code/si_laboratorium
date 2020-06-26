<?php
require_once 'aslab-proses.php';
$crud = new crud($DB_con);

if(isset($_GET['view_id']))
{
	$id = $_GET['view_id'];
	extract($crud->getID($id));	
}
?>
<link rel="stylesheet" type="text/css" href="bootstrap/css/style.css">
<div class="clearfix"></div>

<div class="container">
<?php if(substr($_SESSION['level'],1,1)==1){ ?>
<a href="index.php?modul=kelompok&file=kelompok-add&id=<?php echo $id ?>" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; TAMBAH INFORMASI KELOMPOK</a>
<?php } ?>
</div>

<div class="clearfix"></div><br/>

<div class="container">
	 <table class='table table-bordered table-responsive'>
	 <tr class="capt">
		<td colspan="3">
			<center>
				Informasi Aslab
				<?php 
                if (substr($_SESSION['level'],1,1)==1) {
                ?>
				<a href="index.php?modul=aslab&file=aslab-edit&edit_id=<?php echo $id ?>" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
				<a href="index.php?modul=aslab&file=aslab-del&delete_id=<?php echo $id ?>" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
				<?php 
				}
				?>
			</center>
		</td>
	</tr>
	 <tr class="capt">
		<td width="17%">NIM</td>
		<td width="2%">:</td>
		<td><?php echo $nim_aslab ?></td>
	</tr>
	<tr class="capt">
		<td>Nama</td>
		<td>:</td>
		<td><?php echo $nama_aslab ?></td>
	</tr>
	</table>
	<?php
	$query = $DB_con->prepare("SELECT * FROM informasi_kelompok WHERE nim_aslab='$id'");
	$query->execute();
	while ($data = $query->fetch())
	{
		$get_prak = $data['kode_praktikum'];
		$get_tahun = $data["tahun"];
		$get_kel1 = $data["kel1"];
		$get_kel2 = $data["kel2"];
		$get_kel3 = $data["kel3"];
		$get_kel4 = $data["kel4"];
		$get_kel5 = $data["kel5"];
		$get_kel6 = $data["kel6"];

		$query2 = $DB_con->prepare("SELECT * FROM praktikum WHERE kode_praktikum='$get_prak'");
		$query2->execute();
		$print2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$printrecord2 = $print2[0];
		$get_prak_name = $printrecord2["praktikum"];

	?>
	<table class='table table-bordered table-responsive'>
	<tr class="capt">
		<td colspan="6">
			<center>
				<?php 
					echo $get_prak_name . " (". $get_prak .") Tahun " . $get_tahun;
					if (substr($_SESSION['level'],1,1)==1) {
				?>
				<a href="index.php?modul=kelompok&file=kelompok-edit&edit_id=<?php echo $id ?>&prak_id=<?php echo $get_prak ?>&get_tahun=<?php echo $get_tahun ?>" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
				<a href="index.php?modul=kelompok&file=kelompok-del&delete_id=<?php echo $id ?>&prak_id=<?php echo $get_prak ?>&get_tahun=<?php echo $get_tahun ?>" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
				<?php } ?>
			</center>
		</td>
	</tr>
	<tr class="capt">
		<td width="16%">
			<div class="panel panel-primary">
				<div class="panel-heading"><?php echo $get_kel1 ?></div>
		    </div>
		</td>
		<td width="16%">
			<div class="panel panel-primary">
				<div class="panel-heading"><?php echo $get_kel2 ?></div>
		    </div>
		</td>
		<td width="16%">
			<div class="panel panel-primary">
				<div class="panel-heading"><?php echo $get_kel3 ?></div>
		    </div>
		</td>
		<td width="16%">
			<div class="panel panel-primary">
				<div class="panel-heading"><?php echo $get_kel4 ?></div>
		    </div>
		</td>
		<td width="16%">
			<div class="panel panel-primary">
				<div class="panel-heading"><?php echo $get_kel5 ?></div>
		    </div>
		</td>
		<td width="16%">
			<div class="panel panel-primary">
				<div class="panel-heading"><?php echo $get_kel6 ?></div>
		    </div>
		</td>
	</tr>
	<?php 
	}
	?>
</table>

</div>