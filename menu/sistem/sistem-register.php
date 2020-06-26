<?php
require_once 'sistem-proses.php';
$crud = new crud($DB_con);

$nama = $_GET['id'];
$kondisi = $_GET['kondisi'];

if($crud->click_register($nama,$kondisi))
{
	header("Location: index.php?modul=sistem&file=sistem-home");
}
else
{
	header("Location: index.php?modul=sistem&file=sistem-home");
}

?>