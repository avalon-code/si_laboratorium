<title>Nilai Mahasiswa <?php echo $_GET['view_id'] ?></title>
<?php
require_once 'nilai-proses.php';
$crud = new crud($DB_con);

if(isset($_GET['view_id']))
{
	$id = $_GET['view_id'];
	$tahun = $_GET['tahun'];
	$prak_id = $_GET['prak_id'];
	extract($crud->getID($id,$prak_id,$tahun));
	$query = $DB_con->prepare("SELECT * FROM data_mahasiswa WHERE nim_mahasiswa='$id'");
	$query->execute();
	$print = $query->fetchAll(PDO::FETCH_ASSOC);
	$printrecord = $print[0];
	$get_name = $printrecord["nama_mahasiswa"];

	$query1 = $DB_con->prepare("SELECT * FROM data_praktikum WHERE nim_mahasiswa='$id' AND kode_praktikum='$prak_id'");
	$query1->execute();
	$print = $query1->fetchAll(PDO::FETCH_ASSOC);
	$printrecord = $print[0];
	$get_kel = $printrecord["kelompok"];
	$get_tahun = $printrecord["tahun"];
}
$id_next = $id + 1;
$id_prev = $id - 1;
?>
<link rel="stylesheet" type="text/css" href="bootstrap/css/style.css">
<div class="clearfix"></div>

<div class="container">
<a href="index.php?modul=praktikum&file=praktikum-view&view_id=<?php echo $id ?>" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; BACK</a>
<a href="index.php?modul=nilai&file=nilai-edit&edit_id=<?php echo $id ?>&prak_id=<?php echo $prak_id ?>&tahun=<?php echo $get_tahun ?>" class="btn btn-large btn-warning"><i class="glyphicon glyphicon-edit"></i> &nbsp; UBAH DATA</a>
<a href="index.php?modul=nilai&file=nilai-view&view_id=<?php echo $id_next ?>&tahun=<?php echo $tahun ?>&prak_id=<?php echo $prak_id ?>" class="btn btn-large btn-info pull-right"><i class="glyphicon glyphicon-menu-right"></i></a>
<a href="index.php?modul=nilai&file=nilai-view&view_id=<?php echo $id_prev ?>&tahun=<?php echo $tahun ?>&prak_id=<?php echo $prak_id ?>" class="btn btn-large btn-info pull-right"><i class="glyphicon glyphicon-menu-left"></i></a>
</div>

<div class="clearfix"></div><br/>

<div class="container">
	 <table class='table table-bordered table-responsive'>
	<tr class="capt">
		<td width="10%">Nama</td>
		<td width="2%">:</td>
		<td><?php echo $get_name ?></td>
	</tr>
	<tr class="capt">
		<td>NIM</td>
		<td>:</td>
		<td><?php echo $id ?></td>
	</tr>
	<tr class="capt">
		<td>Kelompok</td>
		<td>:</td>
		<td><?php echo $get_kel ?></td>
	</tr>
	<tr class="capt">
		<td>Tahun</td>
		<td>:</td>
		<td><?php echo $tahun ?></td>
	</tr>
</table>
<table class='table table-bordered table-responsive'>
	<th colspan="12"><center>Nilai</center></th>
	<tr>
		<th width="8%">Sikap 1</th>
		<th width="8%">Sikap 2</th>
		<th width="8%">Sikap 3</th>
		<th width="8%">Sikap 4</th>
		<th width="8%">Sikap 5</th>
		<th width="8%">Sikap 6</th>
		<th width="8%">Sikap 7</th>
		<th width="8%">Sikap 8</th>
		<th width="8%">Sikap 9</th>
		<th width="8%">Sikap 10</th>
		<th width="8%">Sub Total</th>
		<th width="8%">Total</th>
	</tr>
	<tr>
		<td><?php echo $ns1 ?></td>
		<td><?php echo $ns2 ?></td>
		<td><?php echo $ns3 ?></td>
		<td><?php echo $ns4 ?></td>
		<td><?php echo $ns5 ?></td>
		<td><?php echo $ns6 ?></td>
		<td><?php echo $ns7 ?></td>
		<td><?php echo $ns8 ?></td>
		<td><?php echo $ns9 ?></td>
		<td><?php echo $ns10 ?></td>
		<td><?php echo ($ns1+$ns2+$ns3+$ns4+$ns5+$ns6+$ns7+$ns8+$ns9+$ns10)/10 ?></td>
		<td rowspan="3"><?php echo (($ns1+$ns2+$ns3+$ns4+$ns5+$ns6+$ns7+$ns8+$ns9+$ns10)/10 + ($nt1+$nt2+$nt3+$nt4+$nt5+$nt6+$nt7+$nt8+$nt9+$nt10)/10) / 2 ?></td>
	</tr>
	<tr>
		<th>Tugas 1</th>
		<th>Tugas 2</th>
		<th>Tugas 3</th>
		<th>Tugas 4</th>
		<th>Tugas 5</th>
		<th>Tugas 6</th>
		<th>Tugas 7</th>
		<th>Tugas 8</th>
		<th>Tugas 9</th>
		<th>Tugas 10</th>
		<th>Sub Total</th>
	</tr>
	<tr>
		<td><?php echo $nt1 ?></td>
		<td><?php echo $nt2 ?></td>
		<td><?php echo $nt3 ?></td>
		<td><?php echo $nt4 ?></td>
		<td><?php echo $nt5 ?></td>
		<td><?php echo $nt6 ?></td>
		<td><?php echo $nt7 ?></td>
		<td><?php echo $nt8 ?></td>
		<td><?php echo $nt9 ?></td>
		<td><?php echo $nt10 ?></td>
		<td><?php echo ($nt1+$nt2+$nt3+$nt4+$nt5+$nt6+$nt7+$nt8+$nt9+$nt10)/10 ?></td>
	</tr>
	</table>
</div>