<?php
session_start();
require_once 'dbconfig.php';
if(!isset($_SESSION['username'])){
     echo '<center><h1>Terjadi Kesalahan ! Tidak ada Akun yang Terdeteksi</h1></center>';
     header("refresh: 2;../index.php");
   }
else {
?>
<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
<?php include_once 'header.php'; ?>

<?php 
  if(!empty($_GET['modul'])) 
  {
    echo "<title>Halaman " .ucfirst($_GET['modul'])."</title>";
    include("$_GET[modul]/$_GET[file].php");
  }
  elseif(empty($_GET['modul']))
  {
    echo "
    <title>Menu Utama</title>
    <br><br><br><br><br><br><br><br><br><br>
    <h1><center>Halaman Awal Web Penilaian Laboratorium Rekayasa Perangkat Lunak</center></h1>
    <br><br><br><br><br><br><br><br><br><br><br><br>";
  }
?>

<?php include_once 'footer.php'; ?>
</body>
</html>
<?php } ?>