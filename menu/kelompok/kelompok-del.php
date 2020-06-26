<?php
require_once 'kelompok-proses.php';
$crud = new crud($DB_con);
if(substr($_SESSION['level'],1,1)!=1){
     header("refresh:0;index.php?modul=etc&file=404");
}
else {
if(isset($_POST['btn-del']))
{
	$id = $_POST['id'];
    $tahun = $_POST['tahun'];
    $prak = $_POST['prak'];
	$crud->delete($id,$tahun,$prak);
	header("Location: index.php?modul=kelompok&file=kelompok-del&deleted");	
}

?>


<div class="clearfix"></div>

<div class="container">

	<?php
	if(isset($_GET['deleted']))
	{
		?>
        <div class="alert alert-success">
    	<strong>Berhasil!</strong> Data berhasil di hapus . . .
		</div>
        <?php
          header("refresh: 2;index.php?modul=aslab&file=aslab-home");
	}
	else
	{
		?>
        <div class="alert alert-danger">
    	<strong>Yakin ?</strong> Ingin menghapus Data ? 
		</div>
        <?php
	}
	?>	
</div>

<div class="clearfix"></div>

<div class="container">
 	
	 <?php
	 if(isset($_GET['delete_id']))
	 {
        $id = $_GET['delete_id'];
        $prak_id = $_GET['prak_id'];
        $get_tahun = $_GET['get_tahun'];
        extract($crud->getKel($id,$prak_id,$get_tahun));
		 ?>
         <table class='table table-bordered'>
         <th colspan="2"><center>Daftar Kelompok</center></th>
         <tr>
         <th width="50%">Tahun Ajar</th>
         <th width="50%">Kode Praktikum</th>
         </tr>
         <tr>
         <td><?php echo $tahun ?></td>
         <td><?php echo $kode_praktikum ?></td>
         </tr>
         </table>
         <?php
     }
     ?>
</div>

<div class="container">
<p>
<?php
if(isset($_GET['delete_id']))
{
	?>
  	<form method="post">
    <input type="hidden" name="id" value="<?php echo $nim_aslab ?>" />
    <input type="hidden" name="tahun" value="<?php echo $tahun ?>" />
    <input type="hidden" name="prak" value="<?php echo $kode_praktikum ?>" />
    <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; YES</button>
    <a href="index.php?modul=aslab&file=aslab-view&view_id=<?php echo $nim_aslab ?>" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
    </form>  
	<?php
}
else
{
	?>
    <a href="index.php?modul=aslab&file=aslab-home" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
    <?php
}
?>
</p>
</div>	
<?php 
}
?>