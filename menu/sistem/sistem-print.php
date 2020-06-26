<?php
require_once 'sistem-proses.php';
$crud = new crud($DB_con);
if(substr($_SESSION['level'],1,1)!=1){
     header("refresh:0;index.php?modul=etc&file=404");
}
else {
if (isset($_POST['print'])) {
	$kode = $_POST['kode'];
	$tahun = $_POST['tahun'];
	$crud->print_nilai($kode,$tahun);
}

$get_tahun = $DB_con->prepare("SELECT * FROM data_nilai GROUP BY tahun");
$get_tahun->execute();
$get_kode = $DB_con->prepare("SELECT * FROM praktikum WHERE laboratorium = '$getRole'");
$get_kode->execute();
?>
<div class="clearfix"></div>

<div class="container">
    <div class="alert alert-info">
        <strong>Print Nilai</strong>
    </div>
</div>

<div class="container">
	<form action="" method="POST">
	<div class="panel panel-primary">
		<div class="panel-heading">Menu Print Nilai</div>
		<div class="panel-body">
			<table class="col-lg-12">
				<tr>
					<td width="70%">
						<label for="sel1">Praktikum</label>
					</td>
					<td width="20%">
						<label for="sel2">Tahun</label>
					</td>
					<td width="10%">
						
					</td>
				</tr>
				<tr>
					<td>
						<select class="form-control" id="sel1" name="kode">
							<?php while ($print = $get_kode->fetch()) { ?>
				                <option value="<?php echo $print["kode_praktikum"] ?>"><?php echo $print["praktikum"] ?></option>
				            <?php } ?>
						</select>
					</td>
					<td>
						<select class="form-control" id="sel2" name="tahun">
						<?php while ($print = $get_tahun->fetch()) { ?>
			                <option value="<?php echo $print["tahun"] ?>"><?php echo $print["tahun"] ?></option>
			            <?php } ?>
						</select>
					</td>
					<td>
						&nbsp <input type="submit" name="print" class="btn btn-primary" value="Print Nilai">
					</td>
				</tr>
			</table>
		</div>
	</div>
	</form>
</div>

<?php } ?>