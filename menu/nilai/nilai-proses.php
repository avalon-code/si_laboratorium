<?php

class crud
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}

	public function getID($id,$prak,$tahun)
	{
		$stmt = $this->db->prepare("SELECT * FROM data_nilai WHERE nim_mahasiswa=:id AND kode_praktikum=:prak AND tahun=:tahun");
		$stmt->execute(array(':id' => $id, ':prak' => $prak, ':tahun' => $tahun));
		if ($stmt->rowCount()>0) {
			$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
			return $editRow;
		}
		else {
			error_reporting(0);
		}
		
	}
	
	public function update($id,$prak_id,$s1,$s2,$s3,$s4,$s5,$s6,$s7,$s8,$s9,$s10,$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10,$tahun)
	{
		try
		{
			$stmt=$this->db->prepare("UPDATE data_nilai SET ns1='$s1', ns2 = '$s2', ns3 = '$s3' , ns4 = '$s4', ns5 = '$s5', ns6 = '$s6', ns7 = '$s7', ns8 = '$s8', ns9 = '$s9', ns10 = '$s10', nt1 = '$t1', nt2 = '$t2', nt3 = '$t3', nt4 = '$t4', nt5 = '$t5', nt6 = '$t6', nt7 = '$t7', nt8 = '$t8', nt9 = '$t9', nt10 = '$t10' WHERE nim_mahasiswa=:id AND tahun=:tahun AND kode_praktikum=:prak_id");
			$stmt->bindparam(":id",$id);
			$stmt->bindparam(":tahun",$tahun);
			$stmt->bindparam(":prak_id",$prak_id);
			$stmt->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
	
	
	/* paging */
	
	public function dataview($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		$no = 1;
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$nim = $row['nim_mahasiswa'];
				$query_x =$this->db->prepare("SELECT * FROM data_praktikum WHERE nim_mahasiswa='$nim'");
				$query_x->execute();
				while ($resu=$query_x->fetch(PDO::FETCH_ASSOC)) {
				?>
                <tr>
                <td><?php print($no)?></td>
                <td><?php print($row['nim_mahasiswa'])?></td>
                <td><?php print($row['nama_mahasiswa']); ?></td>
                <td><?php print($resu['kelompok']); ?></td>
                <td><?php print($resu['tahun']); ?></td>
                <td align="center">
                <a href="index.php?modul=praktikum&file=praktikum-view&view_id=<?php print($row['nim_mahasiswa']); ?>"><i class="glyphicon glyphicon-list-alt"></i> View</a>
                </td>
                <td align="center">
                <a href="index.php?modul=praktikum&file=praktikum-view&view_id=<?php print($row['nim_mahasiswa']); ?>"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                </td>
                </tr>
                <?php
            		$no++;
            		}
		     }
		}
		else
		{
			?>
            <tr>
            <td colspan="5">Nothing here...</td>
            </tr>
            <?php
		}
		
	}
	
	public function paging($query,$records_per_page)
	{
		$starting_position=0;
		if(isset($_GET["page_no"]))
		{
			$starting_position=($_GET["page_no"]-1)*$records_per_page;
		}
		$query2=$query." limit $starting_position,$records_per_page";
		return $query2;
	}
	
	public function paginglink($query,$records_per_page)
	{
		
		$self = "index.php?modul=nilai&file=nilai-home" ;//$_SERVER['PHP_SELF'];
		
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		
		$total_no_of_records = $stmt->rowCount();
		
		if($total_no_of_records > 0)
		{
			?><ul class="pagination"><?php
			$total_no_of_pages=ceil($total_no_of_records/$records_per_page);
			$current_page=1;
			if(isset($_GET["page_no"]))
			{
				$current_page=$_GET["page_no"];
			}
			if($current_page!=1)
			{
				$previous =$current_page-1;
				echo "<li><a href='".$self."&page_no=1'>First</a></li>";
				echo "<li><a href='".$self."&page_no=".$previous."'>Previous</a></li>";
			}
			for($i=1;$i<=$total_no_of_pages;$i++)
			{
				if($i==$current_page)
				{
					echo "<li><a href='".$self."&page_no=".$i."' style='color:red;'>".$i."</a></li>";
				}
				else
				{
					echo "<li><a href='".$self."&page_no=".$i."'>".$i."</a></li>";
				}
			}
			if($current_page!=$total_no_of_pages)
			{
				$next=$current_page+1;
				echo "<li><a href='".$self."&page_no=".$next."'>Next</a></li>";
				echo "<li><a href='".$self."&page_no=".$total_no_of_pages."'>Last</a></li>";
			}
			?></ul><?php
		}
	}
	
	/* paging */
	
}
