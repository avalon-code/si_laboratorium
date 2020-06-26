<?php
require_once 'info-proses.php';
$crud = new crud($DB_con);
if(isset($_POST['btn-save']))
{
    $nim = $_POST['nim'];
	$kel = $_POST['kel'];
    $praktikum = $_POST['kode_praktikum'];
    $tahun = $_POST['tahun'];
	
	if($crud->create($nim,$kel,$praktikum,$tahun))
	{
		header("Location: index.php?modul=info&file=info-add&inserted");
	}
	else
	{
		header("Location: index.php?modul=info&file=info-add&failure");
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
 
        <tr>
            <input type='hidden' name='nim' value="<?php echo $_GET['id'] ?>">
            <td width="25%">Kelompok</td>
            <td><input type='text' name='kel' class='form-control'></td>
        </tr>
 
        <tr>
            <td>Praktikum</td>
            <td>
                <select name="kode_praktikum" class="form-control" id="sel1">
                   <?php
                    $query = $DB_con->prepare("SELECT * FROM praktikum WHERE laboratorium='$getRole'");
                    $query->execute();
                    while ($data = $query->fetch()){
                    ?>
                    <option value="<?php echo $data['kode_praktikum'] ?>"><?php echo $data['praktikum'] ?></option>
                    <?php } ?>
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