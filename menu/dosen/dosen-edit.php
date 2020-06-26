<?php
require_once 'dosen-proses.php';
$crud = new crud($DB_con);
if(substr($_SESSION['level'],1,1)!=1){
     header("refresh:0;index.php?modul=etc&file=404");
}
else{
if(isset($_POST['btn-update']))
{
    $id = $_GET["edit_id"];
	$nip = $_POST['nip_dosen'];
	$dname = $_POST['nama_dosen'];
	
	if($crud->update($id,$nip,$dname))
	{
		$msg = "<div class='alert alert-info'>
				<strong>Berhasil!</strong> Update Data Berhasil, Jika anda tidak kembali dalam Hitungan Detik silahkan klik <a href='index.php?modul=dosen&file=dosen-home'>HOME</a> !
			</div>";
                    header("refresh: 2;index.php?modul=dosen&file=dosen-home");
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
	extract($crud->getID($id));	
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
 
        <tr>
            <td>NIP Dosen</td>
            <td><input type='text' name='nip_dosen' class='form-control' value="<?php echo $nip_dosen; ?>" required></td>
        </tr>
 
        <tr>
            <td>Nama Dosen</td>
            <td><input type='text' name='nama_dosen' class='form-control' value="<?php echo $nama_dosen; ?>" required></td>
        </tr>
 
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary" name="btn-update">
    			<span class="glyphicon glyphicon-edit"></span>  Update
				</button>
                <a href="index.php?modul=dosen&file=dosen-home" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
            </td>
        </tr>
 
    </table>
</form>
</div>
<?php } ?>