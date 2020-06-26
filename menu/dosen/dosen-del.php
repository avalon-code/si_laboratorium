<?php
require_once 'dosen-proses.php';
$crud = new crud($DB_con);
if(substr($_SESSION['level'],1,1)!=1){
     header("refresh:0;index.php?modul=etc&file=404");
}
else{
if(isset($_POST['btn-del']))
{
	$id = $_GET['delete_id'];
	$crud->delete($id);
	header("Location: index.php?modul=dosen&file=dosen-del&deleted");	
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
          header("refresh: 2;index.php?modul=dosen&file=dosen-home");
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
		 ?>
         <table class='table table-bordered'>
         <tr>
         <th>NIP Dosen</th>
         <th>Nama Dosen</th>
         </tr>
         <?php
         $stmt = $DB_con->prepare("SELECT * FROM data_dosen WHERE id=:id");
         $stmt->execute(array(":id"=>$_GET['delete_id']));
         while($row=$stmt->fetch(PDO::FETCH_BOTH))
         {
             ?>
             <tr>
             <td><?php print($row['nip_dosen']); ?></td>
             <td><?php print($row['nama_dosen']); ?></td>
             </tr>
             <?php
         }
         ?>
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
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
    <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; YES</button>
    <a href="index.php?modul=dosen&file=dosen-home" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
    </form>  
	<?php
}
else
{
	?>
    <a href="index.php?modul=dosen&file=dosen-home" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
    <?php
}
?>
</p>
</div>
<?php } ?>