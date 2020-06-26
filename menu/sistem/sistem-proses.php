<?php

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class crud
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}

	public function click_register($nama,$kondisi)
	{
		try
		{
			if ($kondisi=="On") {
				$kondisi = "Off";
			}
			elseif($kondisi=="Off") {
				$kondisi = "On";
			}
			$stmt=$this->db->prepare("UPDATE sistem SET kondisi_sistem=:kondisi WHERE nama_sistem=:nama ");
			$stmt->bindparam(":kondisi",$kondisi);
			$stmt->bindparam(":nama",$nama);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
		
	}

	public function reset_data($perintah)
	{
		if ($perintah == "mhs") {
			$stmt=$this->db->prepare("TRUNCATE TABLE data_mahasiswa");
		}
		elseif ($perintah == "prk") {
			$stmt=$this->db->prepare("TRUNCATE TABLE data_praktikum");
		}
		elseif ($perintah == "nil") {
			$stmt=$this->db->prepare("TRUNCATE TABLE data_nilai");
		}
		elseif ($perintah == "kel") {
			$stmt=$this->db->prepare("TRUNCATE TABLE informasi_kelompok");
		}
		
		$stmt->execute();
		return true;

	}

	public function print_nilai($kode,$tahun)
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->setTitle('Sheet 1');
		$sheet->setCellValue('A1', 'NIM');
		$sheet->setCellValue('B1', 'NAMA');
		$sheet->setCellValue('C1', 'KELOMPOK');
		$sheet->setCellValue('D1', 'NILAI SIKAP');
		$sheet->setCellValue('E1', 'NILAI TUGAS');
		$sheet->setCellValue('F1', 'TOTAL');

		$stmt = $this->db->prepare("SELECT * FROM data_nilai WHERE kode_praktikum = :kode AND tahun = :tahun");
		$stmt->bindparam(":kode",$kode);
		$stmt->bindparam(":tahun",$tahun);
		$stmt->execute();
		$row = 2;
		while($record = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$get_name = $this->db->prepare("SELECT * FROM data_mahasiswa WHERE nim_mahasiswa = :nim");
			$get_name->bindparam(":nim",$record['nim_mahasiswa']);
			$get_name->execute();
			$print_name = $get_name->fetchAll(PDO::FETCH_ASSOC);
			$print_n = $print_name[0];

			$get_kel = $this->db->prepare("SELECT * FROM data_praktikum WHERE nim_mahasiswa = :nim AND kode_praktikum = :kode AND tahun = :tahun");
			$get_kel->bindparam(":nim",$record['nim_mahasiswa']);
			$get_kel->bindparam(":kode",$kode);
			$get_kel->bindparam(":tahun",$tahun);
			$get_kel->execute();
			$print_kel = $get_kel->fetchAll(PDO::FETCH_ASSOC);
			$print_k = $print_kel[0];
			
			$sikap = ($record['ns1']+$record['ns2']+$record['ns3']+$record['ns4']+$record['ns5']+$record['ns6']+$record['ns7']+$record['ns7']+$record['ns8']+$record['ns9']+$record['ns10'])/10;
			$tugas = ($record['nt1']+$record['nt2']+$record['nt3']+$record['nt4']+$record['nt5']+$record['nt6']+$record['nt7']+$record['nt7']+$record['nt8']+$record['nt9']+$record['nt10'])/10;
			$total = ($sikap + $tugas)/2;
		    $sheet->setCellValue('A'.$row, $record['nim_mahasiswa']);
		    $sheet->setCellValue('B'.$row, $print_n["nama_mahasiswa"]);
		    $sheet->setCellValue('C'.$row, $print_k["kelompok"]);
		    $sheet->setCellValue('D'.$row, $sikap);
		    $sheet->setCellValue('E'.$row, $tugas);
		    $sheet->setCellValue('F'.$row, $total);
		    $row++;
		}

		$writer = new Xlsx($spreadsheet);
		$path = "C:\Users\'".get_current_user()."'\Documents";
		$writer->save("../../../../Users/".get_current_user()."/Documents/Rekapitulasi_".$kode."_".$tahun.".xlsx");
		exec("explorer '" . $path . "'");
	}

	/* paging */
	
	public function userview($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		$no = 1;
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
                <td><?php print($row['nim'])?></td>
                <td><?php print($row['username']); ?></td>
                <td align="center">
                	<a href="index.php?modul=sistem&file=sistem-user&approve=<?php print($row['username']) ?>&nim=<?php print($row['nim']) ?>"><i class="glyphicon glyphicon-list-alt"></i> Approve</a>
                </td>
                <td align="center">
                	<a href="index.php?modul=sistem&file=sistem-user&denied=<?php print($row['username']) ?>"><i class="glyphicon glyphicon-remove-circle"></i> Denied</a>
                </td>
                </tr>
                <?php
            }
		}
		else
		{
			?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
		}
		
	}

	public function approve($id,$nim)
	{
		try
		{
			$get_lab = "";
			$query = $this->db->prepare("SELECT * FROM data_aslab WHERE nim_aslab=:nim");
			$query->bindparam(":nim",$nim);
			$query->execute();
			$print = $query->fetchAll(PDO::FETCH_ASSOC);
			if (isset($print[0])) {
				$printrecord = $print[0];
				$get_lab = $printrecord["laboratorium"];
			}

			if ($get_lab == "RPL") {
				$get_lab = '12';
			}
			elseif ($get_lab == "Jarkom") {
				$get_lab = '22';	
			}
			elseif ($get_lab == "DB") {
				$get_lab = '32';
			}
			elseif ($get_lab == "MM") {
				$get_lab = '42';
			}
			elseif ($get_lab == "Mobile") {
				$get_lab = '52';
			}
			else{
				return false;
			}

			$stmt=$this->db->prepare("UPDATE admin SET status='1', level=:lab WHERE username=:id ");
			$stmt->bindparam(":id",$id);
			$stmt->bindparam(":lab",$get_lab);
			$stmt->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
	
	public function denied($id)
	{
		$stmt = $this->db->prepare("DELETE FROM admin WHERE username=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		return true;
	}
	
	public function paging($query,$records_per_page) //Mengatur Halaman
	{
		$starting_position=0;
		if(isset($_POST["page"]))
		{
			$starting_position=($_POST["page"]-1)*$records_per_page;
		}
		$query2=$query." limit $starting_position,$records_per_page";
		return $query2;
	}

	public function paginglink($query,$records_per_page) //Mengatur Button Page per Page
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		
		$total_no_of_records = $stmt->rowCount();
		
		if($total_no_of_records > 0)
		{
			?>
			<ul class="pagination justify-content-center">

			<?php
			$total_no_of_pages=ceil($total_no_of_records/$records_per_page);
			$current_page=1;
			if(isset($_POST["page"]))
			{
				$current_page=$_POST["page"];
			}
			if($current_page!=1)
			{
				$previous = $current_page-2;
				echo "
				<li class='page-item'>
					<button type='submit' class='btn btn-info' value='1' name='page'>First</button>
				</li>
				";
				if ($previous > 0) {
					echo "
					<li class='page-item'>
						<button type='submit' class='btn btn-info' value='".$previous."' name='page' aria-label='Previous'>
						<span aria-hidden='true'>&laquo;</span>
	            		<span class='sr-only'>Previous</span>
						</button>
					</li>
					";
				}
			}
			if($current_page>1)
			{
				$prev=$current_page-1;
				echo "
				<li class='page-item'>
					<button type='submit' class='btn btn-info' value='".$prev."' name='page'>".$prev."</button>
				</li>
				";
			}
			for($i=$current_page;$i<=$current_page;$i++)
			{
				if($i==$current_page)
				{
					echo "
					<li class='page-item'>
						<button type='submit' class='btn btn-warning' value='".$i."' name='page'>".$i."</button>
						
					</li>
					";
				}
				else
				{
					echo "
					<li class='page-item'>
						<button type='submit' class='btn btn-info' value='".$i."' name='page'>".$i."</button>
					</li>
					";
				}
			}
			if($current_page<$total_no_of_pages)
			{
				$next=$current_page+1;
				echo "
				<li class='page-item'>
					<button type='submit' class='btn btn-info' value='".$next."' name='page'>".$next."</button>
				</li>
				";
			}
			if($current_page!=$total_no_of_pages)
			{
				$next=$current_page+2;
				if ($next<$total_no_of_pages) {
					echo "
					<li class='page-item'>
						<button type='submit' class='btn btn-info' value='".$next."' name='page' aria-label='Next'>
						<span aria-hidden='true'>&raquo;</span>
	            		<span class='sr-only'>Next</span>
	            		</button>
					</li>
					";
				}
				echo "
				<li class='page-item'>
					<button type='submit' class='btn btn-info' value='".$total_no_of_pages."' name='page'>Last</button>
				</li>
				";
			}
			?></ul><?php
		}
	}
	
}