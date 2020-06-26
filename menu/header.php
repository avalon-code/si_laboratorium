<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>

<body>

<?php 
$cek1 = ''; $cek2 = ''; $cek3 = ''; $cek4 = ''; $cek5 = '';
if (isset($_GET['modul'])) {
  if ($_GET['modul']=="praktikum") {
    $cek2 = 'active';
  }
  elseif ($_GET['modul']=="aslab") {
    $cek3 = 'active';
  }
  elseif ($_GET['modul']=="dosen") {
    $cek4 = 'active';
  }
  elseif ($_GET['modul']=="sistem") {
    $cek5 = 'active';
  }
}
else {
  $cek1 = 'active';
}


if (substr($_SESSION['level'],0,1)=='1') {
  $getRole = 'RPL';
}
elseif (substr($_SESSION['level'],0,1)=='2') {
  $getRole = 'Jarkom';  
}
elseif(substr($_SESSION['level'],0,1)=='3'){
  $getRole = 'DB';
}
elseif (substr($_SESSION['level'],0,1)=='4') {
  $getRole = 'MM';
}
else{
  $getRole = 'Mobile';
}
?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Zero v.1.0.0</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="<?php echo $cek1?>"><a href="index.php">Home</a></li>
        <li class="<?php echo $cek2?>"><a href="index.php?modul=praktikum&file=praktikum-home">Praktikum</a></li>
        <li class="<?php echo $cek3?>"><a href="index.php?modul=aslab&file=aslab-home">Aslab</a></li>
        <?php 
        if (substr($_SESSION['level'],1,1)==1) {
        ?>
        <li class="<?php echo $cek4?>"><a href="index.php?modul=dosen&file=dosen-home">Dosen</a></li>
        <li class="<?php echo $cek5?>"><a href="index.php?modul=sistem&file=sistem-home">Sistem</a></li>
        <?php 
        }
        ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> <?php echo $_SESSION['username'] ?></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>