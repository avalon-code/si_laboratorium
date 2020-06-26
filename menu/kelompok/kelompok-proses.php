<?php

class crud
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}
	
	public function create($nim,$praktikum,$tahun)
	{
		try
		{
			$stmt = $this->db->prepare("INSERT INTO informasi_kelompok VALUES('$praktikum','$tahun','-','-','-','-','-','-',$nim)");
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
		
	}
	
	public function getKel($id,$prak_id,$get_tahun)
	{
		$stmt = $this->db->prepare("SELECT * FROM informasi_kelompok WHERE kode_praktikum = :praktikum AND tahun = :tahun AND nim_aslab=:id");
		$stmt->execute(array(':id' => $id, ':praktikum' => $prak_id, ':tahun' => $get_tahun));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function update($id,$prak_id,$get_tahun,$kel1,$kel2,$kel3,$kel4,$kel5,$kel6)
	{
		try
		{
			$stmt=$this->db->prepare("UPDATE informasi_kelompok SET kel1=:kel1, kel2=:kel2, kel3=:kel3, kel4=:kel4, kel5=:kel5, kel6=:kel6 WHERE kode_praktikum=:kode AND tahun=:tahun AND nim_aslab=:id ");
			$stmt->bindparam(":id",$id);
			$stmt->bindparam(":tahun",$get_tahun);
			$stmt->bindparam(":kode",$prak_id);
			$stmt->bindparam(":kel1",$kel1);
			$stmt->bindparam(":kel2",$kel2);
			$stmt->bindparam(":kel3",$kel3);
			$stmt->bindparam(":kel4",$kel4);
			$stmt->bindparam(":kel5",$kel5);
			$stmt->bindparam(":kel6",$kel6);
			$stmt->execute();
			
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
		$stmt = $this->db->prepare("DELETE FROM informasi_kelompok WHERE kode_praktikum=:praktikum AND tahun=:tahun AND nim_aslab=:id");
		$stmt->bindparam(":id",$id);
		$stmt->bindparam(":tahun",$tahun);
		$stmt->bindparam(":praktikum",$prak);
		$stmt->execute();
		return true;
	}
	
}