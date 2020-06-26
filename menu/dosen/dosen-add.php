<?php
require_once 'dosen-proses.php';
$crud = new crud($DB_con);
if(isset($_POST['btn-save']))
{
	$nip = $_POST['nip_dosen'];
	$dname = $_POST['nama_dosen'];
	
	if($crud->create($nip,$dname))
	{
		header("Location: index.php?modul=dosen&file=dosen-add&inserted");
	}
	else
	{
		header("Location: index.php?modul=dosen&file=dosen-add&failure");
	}
}
?>

<div class="clearfix"></div>

<?php
if(isset($_GET['inserted']))
{
	?>
    <div class="container">
	<div class="alert alert-info">
    <strong>Berhasil!</strong> Menambahkan Data Baru, Kembali ke <a href="index.php?modul=dosen&file=dosen-home">HOME</a>!
	</div>
	</div>
    <?php
    header("refresh: 2;index.php?modul=dosen&file=dosen-home");
}
else if(isset($_GET['failure']))
{
	?>
    <div class="container">
	<div class="alert alert-warning">
    <strong>Gagal!</strong> Terjadi Kesalahan saat menambahkan Data !
	</div>
	</div>
    <?php
}
?>

<div class="clearfix"></div><br />

<div class="container">

 	
	 <form method='post'>
 
    <table class='table table-bordered'>
 
        <tr>
            <td>NIP Dosen</td>
            <td><input type='text' name='nip_dosen' class='form-control' required></td>
        </tr>
 
        <tr>
            <td>Nama Dosen</td>
            <td><input type='text' name='nama_dosen' class='form-control' required></td>
        </tr> 
 
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
    		<span class="glyphicon glyphicon-plus"></span> Proses
			</button>  
            <a href="index.php?modul=dosen&file=dosen-home" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>