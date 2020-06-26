<?php
require_once 'aslab-proses.php';
$crud = new crud($DB_con);
if(substr($_SESSION['level'],1,1)!=1){
     header("refresh:0;index.php?modul=etc&file=404");
}
else {
    
if(isset($_POST['btn-save']))
{
	$nim = $_POST['nim_aslab'];
	$nama = $_POST['nama_aslab'];
	
	if($crud->create($nim,$nama))
	{
		header("Location: index.php?modul=aslab&file=aslab-add&inserted");
	}
	else
	{
		header("Location: index.php?modul=aslab&file=aslab-add&failure");
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
    <strong>Berhasil!</strong> Menambahkan Data Baru, Kembali ke <a href="index.php?modul=aslab&file=aslab-home">HOME</a>!
	</div>
	</div>
    <?php
    header("refresh: 2;index.php?modul=aslab&file=aslab-home");
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
            <td>NIM Aslab</td>
            <td><input type='text' name='nim_aslab' class='form-control' required></td>
        </tr>
 
        <tr>
            <td>Nama Aslab</td>
            <td><input type='text' name='nama_aslab' class='form-control' required></td>
        </tr> 
 
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
    		<span class="glyphicon glyphicon-plus"></span> Proses
			</button>  
            <a href="index.php?modul=aslab&file=aslab-home" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
            </td>
        </tr>
 
    </table>
</form>
</div>
<?php 
}
?>