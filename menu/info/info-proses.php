<?php

class crud
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}
	
	public function create($nim,$kel,$praktikum,$tahun)
	{
		try
		{

			$stmt_1 = $this->db->prepare("INSERT INTO data_praktikum(nim_mahasiswa,kelompok,kode_praktikum,tahun) VALUES(:nim, :kel, :prak, :tahun)");
			$stmt_1->bindparam(":nim",$nim);
			$stmt_1->bindparam(":kel",$kel);
			$stmt_1->bindparam(":prak",$praktikum);
			$stmt_1->bindparam(":tahun",$tahun);
			$stmt_1->execute();

			$stmt_2 = $this->db->prepare("INSERT INTO data_nilai VALUES ('$praktikum','$nim','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','$tahun')");
			$stmt_2->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
		
	}
	
	public function getWholeID($id,$prak,$tahun)
	{
		$stmt = $this->db->prepare("SELECT * FROM data_praktikum WHERE nim_mahasiswa=:id AND kode_praktikum=:prak AND tahun=:tahun");
		$stmt->execute(array(':id' => $id, ':prak' => $prak, ':tahun' => $tahun));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function update($nim,$kel,$kode_praktik,$tahun,$prak_id,$get_tahun)
	{
		try
		{
			$stmt=$this->db->prepare("UPDATE data_praktikum SET kelompok=:kel, kode_praktikum=:prak, tahun=:tahun WHERE nim_mahasiswa=:nim AND kode_praktikum=:prak_id AND tahun=:get_tahun");
			$stmt->bindparam(":nim",$nim);
			$stmt->bindparam(":kel",$kel);
			$stmt->bindparam(":prak",$kode_praktik);
			$stmt->bindparam(":tahun",$tahun);
			$stmt->bindparam(":prak_id",$prak_id);
			$stmt->bindparam(":get_tahun",$get_tahun);
			$stmt->execute();
			
			
			$stmt_2=$this->db->prepare("UPDATE data_nilai SET kode_praktikum=:prak , tahun=:tahun WHERE kode_praktikum=:prak_id AND nim_mahasiswa=:nim AND tahun=:get_tahun");
			$stmt_2->bindparam(":tahun",$tahun);
			$stmt_2->bindparam(":nim",$nim);
			$stmt_2->bindparam(":prak",$kode_praktik);
			$stmt_2->bindparam(":prak_id",$prak_id);
			$stmt_2->bindparam(":get_tahun",$get_tahun);
			$stmt_2->execute();

			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
	
	public function delete($id,$tahun,$prak)
	{
		$stmt_1 = $this->db->prepare("DELETE FROM data_praktikum WHERE nim_mahasiswa=:id AND kode_praktikum=:prak AND tahun=:tahun");
		$stmt_1->bindparam(":id",$id);
		$stmt_1->bindparam(":tahun",$tahun);
		$stmt_1->bindparam(":prak",$prak);
		$stmt_1->execute();

		$stmt_2 = $this->db->prepare("DELETE FROM data_nilai WHERE nim_mahasiswa = '$id' AND kode_praktikum = '$prak' AND tahun = '$tahun'");

		$stmt_2->execute();

		return true;
	}
	
}