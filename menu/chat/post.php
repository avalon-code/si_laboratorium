<?php
session_start();
if(isset($_SESSION['username'])){
    $text = $_POST['text'];
     
    $cb = fopen("log.html", 'a');
    date_default_timezone_set('Asia/Bangkok');
    fwrite($cb, "<div class='msgln'>(".date("Y-m-d h:i:sa").") <b>".$_SESSION['username']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
    fclose($cb);
}
?>