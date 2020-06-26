<?php
require_once 'praktikum-proses.php';
$crud = new crud($DB_con);
if (isset($_POST['search_keyword'])) {
    $search_keyword = $_POST['search_keyword'];
}
elseif (isset($_POST['keyword'])) {
    $search_keyword = $_POST['keyword'];
}
else {
    $search_keyword = '';
}
?>
<div class="clearfix"></div>
<div class="container">
    <div class="alert alert-info">
        <strong>Halaman Ini Menyediakan Informasi Berupa 
            Daftar Mahasiswa, 
            Kelompok, 
            Praktikum & 
            <a href="index.php?modul=nilai&file=nilai-home">Nilai</a></strong>
    </div>
</div>
<form action="" method="POST">
    <div class="container">
        <a href="index.php?modul=praktikum&file=praktikum-add" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; TAMBAH DATA</a>

        <!-- Trigger the modal with a button -->
        <?php 
        echo '<button type="button" class="btn btn-large btn-info" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-search"></i> &nbsp; PENCARIAN</button>';
        ?>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Search</h4>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td>NIM / Nama Mahasiswa </td><td>&nbsp; : &nbsp;</td><td width="70%"><input type="text" name="search_keyword" class='form-control' value="<?php echo $search_keyword ?>" autofocus></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <input type="submit" name="search" value="Search" class="btn btn-large btn-info">
            </div>
          </div>
          
        </div>
        </div>  
    </div>


<div class="clearfix"></div><br/>
<?php 
if (isset($_POST['search_keyword'])) {
    $query = "SELECT * FROM data_mahasiswa WHERE nim_mahasiswa LIKE '%$search_keyword%' OR nama_mahasiswa LIKE '%$search_keyword%' ORDER BY nim_mahasiswa ASC";
}
else{
    $query = "SELECT * FROM data_mahasiswa ORDER BY nim_mahasiswa ASC";
}
$records_per_page=8;
$newquery = $crud->paging($query,$records_per_page);
?>
<div class="container">
    <table class='table table-bordered table-responsive'>
    <tr>
        <th width="15%">NIM Mahasiswa</th>
        <th>Nama Mahasiswa</th>
        <th colspan="3" width="20%"><center>Actions</center></th>
    </tr>
    <?php
        $crud->dataview($newquery);
    ?>
    <tr>
        <td colspan="7" align="center">
            <div class="pagination-wrap">
            <input type='hidden' name='keyword' value='<?php echo $search_keyword ?>'>
            <?php 
                $crud->paginglink($query,$records_per_page);
            ?>
            </div>
        </td>
    </tr>
</table>
</div>
</form>