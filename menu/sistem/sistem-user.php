<?php
require_once 'sistem-proses.php';
$crud = new crud($DB_con);
if(substr($_SESSION['level'],1,1)!=1){
     header("refresh:0;index.php?modul=etc&file=404");
}
else {
if(isset($_GET['approve']))
{
    $id = $_GET["approve"];
    $nim = $_GET["nim"];
    
    if($crud->approve($id,$nim))
    {
        $msg = "<div class='alert alert-info'>
                    <strong>Berhasil!</strong> User dengan nama ".$id." telah mendapat Hak Akses sebagai Aslab!
                </div>";
    }
    else
    {
        $msg = "<div class='alert alert-warning'>
                    <strong>Gagal!</strong> Terjadi Kesalahan saat memberikan hak akses !
                </div>";
    }
}
if(isset($_GET['denied']))
{
    $id = $_GET["denied"];
    
    if($crud->denied($id))
    {
        $msg = "<div class='alert alert-info'>
                    <strong>Berhasil!</strong> Permintaan Hak Akses sebagai Aslab atas nama ".$id." telah di tolak!
                </div>";
    }
    else
    {
        $msg = "<div class='alert alert-warning'>
                    <strong>Gagal!</strong> Terjadi Kesalahan saat melakukan penolakan hak akses!
                </div>";
    }
}
?>

<div class="clearfix"></div>

<div class="container">
    <?php
    if(isset($msg))
    {
        echo $msg;
    }
    else{
        echo "
            <div class='alert alert-info'>
                <strong>Daftar Permintaan Hak Akses</strong>
            </div>
        ";
    }
    ?>
</div>

<div class="clearfix"></div><br/>
<form action="" method="POST">
<div class="container">
	 <table class='table table-bordered table-responsive'>
     <tr>
     <th width="30%">NIM</th>
     <th>Username</th>
     <th colspan="2" width="20%"><center>Actions</center></th>
     </tr>
     <?php
		$query = "SELECT * FROM admin WHERE status = '0'";
		$records_per_page=8;
		$newquery = $crud->paging($query,$records_per_page);
		$crud->userview($newquery);
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
<?php 
}
?>