<?php
require_once 'praktikum-proses.php';
$crud = new crud($DB_con);
if(isset($_POST['btn-update']))
{
    $id = $_GET["edit_id"];
    $nim = $_POST['nim_mahasiswa'];
	$mname = $_POST['nama_mahasiswa'];
	
	if($crud->update($id,$nim,$mname))
	{
		$msg = "<div class='alert alert-info'>
				<strong>Berhasil!</strong> Update Data Berhasil, Jika anda tidak kembali dalam Hitungan Detik silahkan klik <a href='index.php?modul=praktikum&file=praktikum-view&view_id=$nim'>HOME</a> !
			</div>";

                    header("refresh: 2;index.php?modul=praktikum&file=praktikum-view&view_id=".$nim."");
	}
	else
	{
		$msg = "<div class='alert alert-warning'>
				<strong>Gagal!</strong>Terjadi Kesalahan saat melakukan Update !
			</div>";
	}
}

if (isset($_POST['nim_mahasiswa'])) 
{
    $id = $_POST['nim_mahasiswa'];
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
            <td>NIM Mahasiswa</td>
            <td><input type='text' name='nim_mahasiswa' class='form-control' value="<?php echo $nim_mahasiswa; ?>" required></td>
        </tr>
 
        <tr>
            <td>Nama Mahasiswa</td>
            <td><input type='text' name='nama_mahasiswa' class='form-control' value="<?php echo $nama_mahasiswa; ?>" required></td>
        </tr>
 
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary" name="btn-update">
    			<span class="glyphicon glyphicon-edit"></span>  Update
				</button>
                <a href="index.php?modul=praktikum&file=praktikum-home" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>