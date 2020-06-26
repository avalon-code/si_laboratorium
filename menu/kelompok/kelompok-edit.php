<?php
require_once 'kelompok-proses.php';
$crud = new crud($DB_con);
if(substr($_SESSION['level'],1,1)!=1){
     header("refresh:0;index.php?modul=etc&file=404");
}
else {
if(isset($_POST['btn-update']))
{
    $id = $_GET["edit_id"];
    $prak_id = $_GET['prak_id'];
    $get_tahun = $_GET['get_tahun'];
	$kel1 = $_POST['kel1'];
	$kel2 = $_POST['kel2'];
	$kel3 = $_POST['kel3'];
    $kel4 = $_POST['kel4'];
    $kel5 = $_POST['kel5'];
    $kel6 = $_POST['kel6'];
	
	if($crud->update($id,$prak_id,$get_tahun,$kel1,$kel2,$kel3,$kel4,$kel5,$kel6))
	{
		$msg = "<div class='alert alert-info'>
				<strong>Berhasil!</strong> Update Data Berhasil, Jika anda tidak kembali dalam Hitungan Detik silahkan klik <a href='index.php?modul=aslab&file=aslab-view&view_id=$id'>HOME</a> !
			</div>";
                    header("refresh: 2;index.php?modul=aslab&file=aslab-view&view_id=".$id."");
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
    $get_tahun = $_GET['get_tahun'];
    extract($crud->getKel($id,$prak_id,$get_tahun));
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
        <th colspan="20"><center>Kelompok</center></th>
        <tr>
            <td><input type='text' name='kel1' class='form-control' value="<?php echo $kel1 ?>"></td>
            <td><input type='text' name='kel2' class='form-control' value="<?php echo $kel2 ?>"></td>
            <td><input type='text' name='kel3' class='form-control' value="<?php echo $kel3 ?>"></td>
            <td><input type='text' name='kel4' class='form-control' value="<?php echo $kel4 ?>"></td>
            <td><input type='text' name='kel5' class='form-control' value="<?php echo $kel5 ?>"></td>
            <td><input type='text' name='kel6' class='form-control' value="<?php echo $kel6 ?>"></td>
        </tr>
 
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary" name="btn-update">
    			<span class="glyphicon glyphicon-edit"></span>  Update
				</button>
                <a href="index.php?modul=aslab&file=aslab-view&view_id=<?php echo $_GET['edit_id'] ?>" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>
<?php
}
?>