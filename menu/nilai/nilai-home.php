<?php
require_once 'nilai-proses.php';
$crud = new crud($DB_con);
?>
<div class="clearfix"></div>

<div class="container">
</div>

<div class="clearfix"></div><br/>

<div class="container">
    
	 <table class='table table-bordered table-responsive'>
     <tr>
     <th width="4%">#</th>
     <th width="20%">NIM Mahasiswa</th>
     <th>Nama Mahasiswa</th>
     <th width="5%">Kelompok</th>
     <th width="5%">Tahun</th>
     <th colspan="2" width="15%"><center>Actions</center></th>
     </tr>
     <?php
		$query = "SELECT * FROM data_mahasiswa";       
		$records_per_page=13;
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