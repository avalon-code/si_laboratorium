<?php
session_start();
function loginForm() {
    echo '
	<div class="form-group">
		<div id="loginform">
				<label for="name">Silahkan Login / Sign Up Terlebih Dahulu</label>
		</div>
	</div>
   ';
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
    <div class="container">
<div id="wrapper">
	<div id="menu">
	<h1>History Percakapan!</h1>
	<hr/>
		<p class="welcome"><b>History Percakapan Dengan - <a>Tester</a></b></p>
	<div style="clear: both"></div>
	</div>
	<div id="chatbox">
	<?php
		if (file_exists ( "log.html" ) && filesize ( "log.html" ) > 0) {
		$handle = fopen ( "log.html", "r" );
		$contents = fread ( $handle, filesize ( "log.html" ) );
		fclose ( $handle );

		echo $contents;
		}
	?>
	</div>
	<a href="../index.php"><i class="btn btn-primary">Back</i></a>
</div>
<script type="text/javascript">
$(document).ready(function(){
});
$("#submitmsg").click(function(){
        var clientmsg = $("#usermsg").val();
        $.post("post.php", {text: clientmsg});             
        $("#usermsg").attr("value", "");
        loadLog;
    return false;
});
function loadLog(){    
    var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
    $.ajax({
        url: "log.html",
        cache: false,
        success: function(html){       
            $("#chatbox").html(html);       
            var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
            if(newscrollHeight > oldscrollHeight){
                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal');
            }              
        },
    });
}
setInterval (loadLog, 2500);
</script>
</div>
</body>
</html>