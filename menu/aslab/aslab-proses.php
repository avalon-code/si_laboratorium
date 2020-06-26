<?php

class crud
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}
	
	public function create($nim,$nama)
	{
		try
		{

			$stmt = $this->db->prepare("INSERT INTO data_aslab(nim_aslab,nama_aslab) VALUES(:nim, :nama)");
			$stmt->bindparam(":nama",$nama);
			$stmt->bindparam(":nim",$nim);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
		
	}
	
	public function getID($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM data_aslab WHERE nim_aslab=:id");
		$stmt->execute(array(":id"=>$id));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function update($id,$nim,$nama)
	{
		try
		{
			$stmt=$this->db->prepare("UPDATE data_aslab SET nim_aslab=:nim, nama_aslab=:nama WHERE nim_aslab=:id ");
			$stmt->bindparam(":nama",$nama);
			$stmt->bindparam(":nim",$nim);
			$stmt->bindparam(":id",$id);
			$stmt->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
	
	public function delete($id)
	{
		$stmt = $this->db->prepare("DELETE FROM data_aslab WHERE nim_aslab=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		return true;
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
				?>
                <tr>
                <td><?php print($row['nim_aslab'])?></td>
                <td><?php print($row['nama_aslab']); ?></td>
                <td align="center">
                 <a href="index.php?modul=aslab&file=aslab-view&view_id=<?php print($row['nim_aslab']); ?>"><i class="glyphicon glyphicon-list-alt"></i> View</a>
                </td>
                <?php 
                if (substr($_SESSION['level'],1,1)==1) {
                ?>
                <td align="center">
                <a href="index.php?modul=aslab&file=aslab-edit&edit_id=<?php print($row['nim_aslab']); ?>"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                </td>
                <td align="center">
                <a href="index.php?modul=aslab&file=aslab-del&delete_id=<?php print($row['nim_aslab']); ?>"><i class="glyphicon glyphicon-remove-circle"></i> Delete</a>
                </td>
                </tr>
                <?php
            	}
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
	
	/* paging */
	
}
