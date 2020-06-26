<?php
require_once 'aslab-proses.php';
$crud = new crud($DB_con);
if(substr($_SESSION['level'],1,1)!=1){
     header("refresh:0;index.php?modul=etc&file=404");
}
else {

if(isset($_POST['btn-update']))
{
    $id = $_GET["edit_id"];
	$nim = $_POST['nim_aslab'];
	$nama = $_POST['nama_aslab'];
	
	if($crud->update($id,$nim,$nama))
	{
		$msg = "<div class='alert alert-info'>
    				<strong>Berhasil!</strong> Update Data Berhasil, Jika anda tidak kembali dalam Hitungan Detik silahkan klik <a href='index.php?modul=aslab&file=aslab-home'>HOME</a> !
    			</div>";
                header("refresh: 2;index.php?modul=aslab&file=aslab-home");
	}
	else
	{
		$msg = "<div class='alert alert-warning'>
    				<strong>Gagal!</strong>Terjadi Kesalahan saat melakukan Update !
    			</div>";
	}
}

if (isset($_POST['nim_aslab']))
{
	$id = $_POST['nim_aslab'];
}
elseif(isset($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
}
extract($crud->getID($id));	
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
 
        <tr>
            <td>NIM Aslab</td>
            <td><input type='text' name='nim_aslab' class='form-control' value="<?php echo $nim_aslab; ?>" required></td>
        </tr>
 
        <tr>
            <td>Nama Aslab</td>
            <td><input type='text' name='nama_aslab' class='form-control' value="<?php echo $nama_aslab; ?>" required></td>
        </tr>
 
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary" name="btn-update">
    			<span class="glyphicon glyphicon-edit"></span>  Update
				</button>
                <a href="index.php?modul=aslab&file=aslab-home" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>
<?php 
}
?>