<?php
require_once 'praktikum-proses.php';
$crud = new crud($DB_con);

if(isset($_POST['btn-del']))
{
	$id = $_GET['delete_id'];
	$crud->delete($id);
	header("Location: index.php?modul=praktikum&file=praktikum-del&deleted");	
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
          header("refresh: 2;index.php?modul=praktikum&file=praktikum-home");
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
         <th>NIM Mahasiswa</th>
         <th>Nama Mahasiswa</th>
         </tr>
         <?php
         $stmt = $DB_con->prepare("SELECT * FROM data_mahasiswa WHERE nim_mahasiswa=:id");
         $stmt->execute(array(":id"=>$_GET['delete_id']));
         while($row=$stmt->fetch(PDO::FETCH_BOTH))
         {
             ?>
             <tr>
             <td><?php print($row['nim_mahasiswa']); ?></td>
             <td><?php print($row['nama_mahasiswa']); ?></td>
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
    <a href="index.php?modul=praktikum&file=praktikum-home" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
    </form>  
	<?php
}
else
{
	?>
    <a href="index.php?modul=praktikum&file=praktikum-home" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
    <?php
}
?>
</p>
</div>	