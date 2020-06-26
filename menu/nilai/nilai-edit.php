<title>Ubah Nilai</title>
<?php
require_once 'nilai-proses.php';
$crud = new crud($DB_con);
if(isset($_POST['btn-update']))
{
    $id = $_GET['edit_id'];
	$prak_id = $_GET['prak_id'];
	$s1 = $_POST['ns1'];
	$s2 = $_POST['ns2'];
	$s3 = $_POST['ns3'];
	$s4 = $_POST['ns4'];
	$s5 = $_POST['ns5'];
	$s6 = $_POST['ns6'];
	$s7 = $_POST['ns7'];
	$s8 = $_POST['ns8'];
	$s9 = $_POST['ns9'];
	$s10 = $_POST['ns10'];
	$t1 = $_POST['nt1'];
	$t2 = $_POST['nt2'];
	$t3 = $_POST['nt3'];
	$t4 = $_POST['nt4'];
	$t5 = $_POST['nt5'];
	$t6 = $_POST['nt6'];
	$t7 = $_POST['nt7'];
	$t8 = $_POST['nt8'];
	$t9 = $_POST['nt9'];
	$t10 = $_POST['nt10'];
	$tahun = $_GET['tahun'];

	
	if($crud->update($id,$prak_id,$s1,$s2,$s3,$s4,$s5,$s6,$s7,$s8,$s9,$s10,$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10,$tahun))
	{
		$msg = "<div class='alert alert-info'>
				<strong>Berhasil!</strong> Update Data Berhasil, Jika anda tidak kembali dalam Hitungan Detik silahkan klik <a href='index.php?modul=nilai&file=nilai-view&view_id=$id&tahun=$tahun&prak_id=$prak_id'>HOME</a> !
			</div>";
                    header("refresh: 2;index.php?modul=nilai&file=nilai-view&view_id=".$id."&tahun=".$tahun."&prak_id=".$prak_id."");
	}
	else
	{
		$msg = "<div class='alert alert-warning'>
				<strong>Gagal!</strong>Terjadi Kesalahan saat melakukan Update !
			</div>";
	}
}

if(isset($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
	$prak_id = $_GET['prak_id'];
	$tahun = $_GET['tahun'];
	extract($crud->getID($id,$prak_id,$tahun));
}

?>


<div class="clearfix"></div>

<div class="container">
<?php
if(isset($msg))
{
	echo $msg;
}
?>
</div>

<div class="clearfix"></div><br />

<div class="container">
	 
    <form method='post'>
    <table class='table table-bordered'>
    	<table class='table table-bordered table-responsive'>
	<th colspan="20"><center>Nilai</center></th>
	<tr>
		<th width="6%">Sikap 1</th>
		<th width="6%">Sikap 2</th>
		<th width="6%">Sikap 3</th>
		<th width="6%">Sikap 4</th>
		<th width="6%">Sikap 5</th>
		<th width="6%">Sikap 6</th>
		<th width="6%">Sikap 7</th>
		<th width="6%">Sikap 8</th>
		<th width="6%">Sikap 9</th>
		<th width="6%">Sikap 10</th>
	</tr>
	<tr>
		<td><input type='text' name='ns1' class='form-control' value="<?php echo $ns1 ?>" required></td>
		<td><input type='text' name='ns2' class='form-control' value="<?php echo $ns2 ?>" required></td>
		<td><input type='text' name='ns3' class='form-control' value="<?php echo $ns3 ?>" required></td>
		<td><input type='text' name='ns4' class='form-control' value="<?php echo $ns4 ?>" required></td>
		<td><input type='text' name='ns5' class='form-control' value="<?php echo $ns5 ?>" required></td>
		<td><input type='text' name='ns6' class='form-control' value="<?php echo $ns6 ?>" required></td>
		<td><input type='text' name='ns7' class='form-control' value="<?php echo $ns7 ?>" required></td>
		<td><input type='text' name='ns8' class='form-control' value="<?php echo $ns8 ?>" required></td>
		<td><input type='text' name='ns9' class='form-control' value="<?php echo $ns9 ?>" required></td>
		<td><input type='text' name='ns10' class='form-control' value="<?php echo $ns10?>" required></td>
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
	</tr>
	<tr>
		<td><input type='text' name='nt1' class='form-control' value="<?php echo $nt1 ?>" required></td>
		<td><input type='text' name='nt2' class='form-control' value="<?php echo $nt2 ?>" required></td>
		<td><input type='text' name='nt3' class='form-control' value="<?php echo $nt3 ?>" required></td>
		<td><input type='text' name='nt4' class='form-control' value="<?php echo $nt4 ?>" required></td>
		<td><input type='text' name='nt5' class='form-control' value="<?php echo $nt5 ?>" required></td>
		<td><input type='text' name='nt6' class='form-control' value="<?php echo $nt6 ?>" required></td>
		<td><input type='text' name='nt7' class='form-control' value="<?php echo $nt7 ?>" required></td>
		<td><input type='text' name='nt8' class='form-control' value="<?php echo $nt8 ?>" required></td>
		<td><input type='text' name='nt9' class='form-control' value="<?php echo $nt9 ?>" required></td>
		<td><input type='text' name='nt10' class='form-control' value="<?php echo $nt10?>" required></td>
	</tr>
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary" name="btn-update">
    			<span class="glyphicon glyphicon-edit"></span>  Update
				</button>
                <a href="index.php?modul=nilai&file=nilai-view&view_id=<?php echo $id ?>&prak_id=<?php echo $prak_id ?>&tahun=<?php echo $tahun ?>" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>