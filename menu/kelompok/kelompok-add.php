<?php
require_once 'kelompok-proses.php';
$crud = new crud($DB_con);
if(substr($_SESSION['level'],1,1)!=1){
     header("refresh:0;index.php?modul=etc&file=404");
}
else {

if(isset($_POST['btn-save']))
{
    $nim = $_POST['nim'];
    $praktikum = $_POST['kode_praktikum'];
    $tahun = $_POST['tahun'];
	
	if($crud->create($nim,$praktikum,$tahun))
	{
		header("Location: index.php?modul=kelompok&file=kelompok-add&inserted");
	}
	else
	{
		header("Location: index.php?modul=kelompok&file=kelompok-add&failure");
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
	<div class="alert alert-danger">
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
        <input type='hidden' name='nim' value="<?php echo $_GET['id'] ?>">
        <tr>
            <td>Praktikum</td>
            <td>
                <select name="kode_praktikum" class="form-control" id="sel1">
                    <option value="IF1101">Algoritma Dan Pemrograman</option>
                    <option value="IF2109">Struktur Data</option>
                    <option value="IF3117">Object Oriented Programming</option>
                    <option value="IF4124">Pemrograman Web</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>Tahun</td>
            <td><input type='year' name='tahun' class='form-control' required></td>
        </tr>
 
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
    		<span class="glyphicon glyphicon-plus"></span> Proses
			</button>  
            <a href="index.php?modul=praktikum&file=praktikum-view&view_id=<?php echo $_GET['id'] ?>" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>
<?php 
}
?>