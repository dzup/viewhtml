<?php 
//incluye definiciones
define('SECURE_PAGE', true);
#include 'includes/page.php';
include 'include/functions.php';
include 'include/defs.php';

//conect mysql server
$mysql = connectmysql();
$conn = $mysql;
//checa si puedes conectar
//if (!@mysql_select_db(MYSQL_DATABASE)) { exit('<p>Fatal error, can\'t connect database.</p>');}
?>
<html>
 <head><title>viewHTML - PasteHTML clone Free HTML Paste website</title></head>

<body>
    <div style="width:1125px;  margin: auto;"> <!-- Main Div -->
		<?php
			//add google adsense if is define
			adsense();
		?>
		<div id='retrieved-data' style="float:left; width:auto; margin:auto;>
			<!-- 
			this is where data will be  shown
			-->
    			<img src="images/ajax-loader.gif" />
		</div>
	<div style="float:right; width:auto; margin:auto;">
		<br>
		Please enter your HTML code
		<br>
		<form name="myForm" method="post" onsubmit="" action="pastehtml.php">
    			<textarea id="raw_post" name="raw_post" rows=22 cols=70 style="background-color:grey"></textarea>
			<br>
			<?php
			 recapcha();
			?>
				viewHTML title: <input type="text" name="title"style="background-color:pink">Email: <input type="text" name="email"style="background-color:pink">
	   			<input type="submit" name="submit" value="Paste HTML!" id="submit" style="background-color:lightblue"/>
			<br>
			*if you provide a valid e-mail address, a delete link will be send to you.
		</form>
	</div>
    </div>
<script type = "text/javascript" src = "js/jquery-1.7.1.min.js"></script>
<!--
<script type = "text/javascript">
$(function() {
	//call the function onload
	getdata( 1 );
});

function getdata( pageno ){                     
	var targetURL = 'search_results.php?page=' + pageno;   

	$('#retrieved-data').html('<p><img src="images/ajax-loader.gif" /></p>');        
	$('#retrieved-data').load( targetURL ).hide().fadeIn('slow');
}      
</script>
-->
</body>
</html>

