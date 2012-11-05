<?php 
//incluye definiciones
include_once "include/functions.php";
include_once "include/defs.php";

//conect mysql server
$mysql = connectmysql();
$conn = $mysql;
//checa si puedes conectar
//if (!@mysql_select_db(MYSQL_DATABASE)) { exit('<p>Fatal error, can\'t connect database.</p>');}
?>
<html>
 <head><title>viewHTML - PasteHTML clone Free HTML Paste website</title></head>
<script type="text/javascript">
<!--	function validateForm()
	{
		var x=document.forms["myForm"]["email"].value;
		if (x="")
		{
			return true;
		}
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  		{
  			alert("Not a valid e-mail address");
  			return false;
  		}
	}
-->
</script>
<body>
    <div style="width:1125px;  margin: auto;"> <!-- Main Div -->
		<center>
		<?php
			//add google adsense if is define
			adsense();
		?>

		</center>
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
			<center>
				<img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />
				<input type="text" name="captcha_code" size="10" maxlength="6" style="background-color:pink"/>
				<a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false"><button alt="Click to get another image" style="background-color:yellow">Sorry, can't read that<br>Let me try<br>another captcha</button></a>
			</center>
			<br>
				viewHTML title: <input type="text" name="title"style="background-color:pink">Email: <input type="text" name="email"style="background-color:pink">
	   			<input type="submit" name="submit" value="Paste HTML!" id="submit" style="background-color:lightblue"/>
			<br>
			*if you provide a valid e-mail address, a delete link will be send to you.
		</form>
	</div>
    </div>
<script type = "text/javascript" src = "js/jquery-1.7.1.min.js"></script>
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

</body>
</html>

