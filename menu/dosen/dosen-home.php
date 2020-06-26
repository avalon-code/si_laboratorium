<?php
require_once 'dosen-proses.php';
$crud = new crud($DB_con);
if(substr($_SESSION['level'],1,1)!=1){
     header("refresh:0;index.php?modul=etc&file=404");
}
else{
?>

<div class="clearfix"></div>

<div class="container">
    <div class="alert alert-info">
        <strong>Halaman Ini Menyediakan Informasi Dosen Informatika </strong>
    </div>
    <a href="index.php?modul=dosen&file=dosen-add" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; TAMBAH DATA</a>
</div>

<div class="clearfix"></div><br/>
<form action="" method="POST">
<div class="container">
	 <table class='table table-bordered table-responsive'>
     <tr>
     <th width="30%">NIP Dosen</th>
     <th>Nama Dosen</th>
     <th colspan="2" width="15%"><center>Actions</center></th>
     </tr>
     <?php
		$query = "SELECT * FROM data_dosen";       
		$records_per_page=8;
		$newquery = $crud->paging($query,$records_per_page);
		$crud->dataview($newquery);
	 ?>
    <tr>
        <td colspan="7" align="center">
 	<div class="pagination-wrap">
            <?php $crud->paginglink($query,$records_per_page); ?>
        	</div>
        </td>
    </tr>
 
</table>
</div>
</form>
<?php } ?>