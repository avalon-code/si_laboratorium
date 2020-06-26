<?php
require_once 'praktikum-proses.php';
$crud = new crud($DB_con);
if(isset($_POST['btn-save']))
{
	$nim = $_POST['nim_mahasiswa'];
	$mname = $_POST['nama_mahasiswa'];
	
	if($crud->create($nim,$mname))
	{
		header("Location: index.php?modul=praktikum&file=praktikum-add&inserted");
	}
	else
	{
		header("Location: index.php?modul=praktikum&file=praktikum-add&failure");
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
    <strong>Berhasil!</strong> Menambahkan Data Baru, Kembali ke <a href="index.php?modul=praktikum&file=praktikum-home">HOME</a>!
	</div>
	</div>
    <?php
    header("refresh: 2;index.php?modul=praktikum&file=praktikum-home");
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
            <td>NIM Mahasiswa</td>
            <td><input type='text' name='nim_mahasiswa' class='form-control' required></td>
        </tr>
 
        <tr>
            <td>Nama Mahasiswa</td>
            <td><input type='text' name='nama_mahasiswa' class='form-control' required></td>
        </tr>
 
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
    		<span class="glyphicon glyphicon-plus"></span> Proses
			</button>  
            <a href="index.php?modul=praktikum&file=praktikum-home" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>