<?php
require_once 'info-proses.php';
$crud = new crud($DB_con);
if(isset($_POST['btn-update']))
{
    $id = $_GET["edit_id"];
    $prak_id = $_GET['prak_id'];
    $get_tahun = $_GET['get_tahun'];
	$nim = $_POST['nim_mahasiswa'];
	$kel = $_POST['kelompok'];
	$praktik = $_POST['kode_praktikum'];
    $tahun = $_POST['tahun'];
	
	if($crud->update($nim,$kel,$praktik,$tahun,$prak_id,$get_tahun))
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
    $prak1='';
    $prak2='';
    $prak3='';
    $prak4='';
    $id = $_POST['nim_mahasiswa'];
    $prak_id = $_POST['kode_praktikum'];
    $get_tahun = $_POST['tahun'];
    extract($crud->getWholeID($id,$prak_id,$get_tahun));
    if ($prak_id=='IF1101') {
        $prak1="selected";
    }
    elseif ($prak_id=='IF2109') {
        $prak2="selected";
    }
    elseif ($prak_id=='IF3117') {
        $prak3="selected";
    }
    elseif ($prak_id=='IF4124') {
        $prak4="selected";
    }
    else {}

}
elseif(isset($_GET['edit_id']))
{
    $prak1='';
    $prak2='';
    $prak3='';
    $prak4='';
    $id = $_GET['edit_id'];
    $prak_id = $_GET['prak_id'];
    $get_tahun = $_GET['get_tahun'];
    extract($crud->getWholeID($id,$prak_id,$get_tahun));
    if ($prak_id=='IF1101') {
        $prak1="selected";
    }
    elseif ($prak_id=='IF2109') {
        $prak2="selected";
    }
    elseif ($prak_id=='IF3117') {
        $prak3="selected";
    }
    elseif ($prak_id=='IF4124') {
        $prak4="selected";
    }
    else {}
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
            <td>NIM Mahasiswa</td>
            <td>
                <input type='text' name='nim' class='form-control' value="<?php echo $nim_mahasiswa; ?>" disabled>
                <input type='hidden' name='nim_mahasiswa' value="<?php echo $nim_mahasiswa; ?>">
            </td>
        </tr>
 
        <tr>
            <td>Kelompok</td>
            <td><input type='text' name='kelompok' class='form-control' value="<?php echo $kelompok; ?>" required></td>
        </tr>
        <tr>
            <td>Praktikum</td>
            <td>
            	<select name="kode_praktikum" class="form-control" id="sel1">
            		<option value="IF1101" <?php echo $prak1 ?>>Algoritma Dan Pemrograman</option>
            		<option value="IF2109" <?php echo $prak2 ?>>Struktur Data</option>
            		<option value="IF3117" <?php echo $prak3 ?>>Object Oriented Programming</option>
            		<option value="IF4124" <?php echo $prak4 ?>>Pemrograman Web</option>
            	</select>
            </td>
        </tr>
        <tr>
            <td>Tahun</td>
            <td><input type='text' name='tahun' class='form-control' value="<?php echo $tahun; ?>" required></td>
        </tr>
 
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary" name="btn-update">
    			<span class="glyphicon glyphicon-edit"></span>  Update
				</button>
                <a href="index.php?modul=praktikum&file=praktikum-view&view_id=<?php echo $_GET['edit_id'] ?>" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>