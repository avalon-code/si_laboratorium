<?php
require_once 'aslab-proses.php';
$crud = new crud($DB_con);
    
?>

<div class="clearfix"></div>

<div class="container">
    <div class="alert alert-info">
        <strong>Halaman Ini Menyediakan Informasi Berupa Daftar Alsab & Konfigurasi Kelompok</strong>
    </div>
    <?php if(substr($_SESSION['level'],1,1)==1){ ?>
        <a href="index.php?modul=aslab&file=aslab-add" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; TAMBAH DATA</a>
    <?php } ?>
</div>

<div class="clearfix"></div><br/>
<form action="" method="POST">
<div class="container">
	 <table class='table table-bordered table-responsive'>
     <tr>
     <th width="30%">NIM Aslab</th>
     <th>Nama Aslab</th>
     <th colspan="3" width="20%"><center>Actions</center></th>
     </tr>
     <?php
		$query = "SELECT * FROM data_aslab WHERE laboratorium = '$getRole' ORDER BY nim_aslab ASC";       
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