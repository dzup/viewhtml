<?php
$view = mysql_real_escape_string(htmlspecialchars($_REQUEST['view']));
$raw_post = mysql_real_escape_string($_POST['raw_post']);
$raw = htmlspecialchars($_REQUEST['raw']); // if > 0 then show raw output
$email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
$title = mysql_real_escape_string(htmlspecialchars($_POST['title']));
if ($view > ""){
	session_start();
}

//incluye definiciones
include_once "include/functions.php";
include_once "include/defs.php";

//conect mysql server
$mysql = connectmysql();
 
//checa si puedes conectar
//if (!@mysql_select_db(MYSQL_DATABASE)) { exit('<p>Fatal error, can\'t connect database.</p>');}
$url=curURL();
//die;
if ($view > ""){
	open_webpage($view,$mysql,$raw);
} //if $view have some value

if ($raw_post > ""){
	//create uniq data
	$uniq_key=rand_string(10);
	$uniq_string=calculate_uniq_key();
	$today=date("Y-m-d H:i:s");
	//check if exist
	//$existe=get_htmlpost($uniq_key);
	if (! $title){
		//if not title been supply, use $uniq_key
		$title = $uniq_key;
	}
	if ($existe){
		//exist!, quit
		echo "Fatal error, post already exist!<br>";
  		echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
		exit;
	}

	include_once 'securimage/securimage.php';
	$securimage = new Securimage();
	if ($securimage->check($_POST['captcha_code']) == false) {
  		// the code was incorrect
  		// you should handle the error so that the form processor doesn't continue
  		// or you can use the following code if there is no validation or you do not know how
  		echo "The security code entered was incorrect.<br /><br />";
  		echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
  		exit;
	}

	//create query

//conect mysql server
$mysql = connectmysql();

		$mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$database=MYSQL_DATABASE;
		$database_table=MYSQL_DATABASE_TABLE;
		$mysql->exec("SET CHARACTER SET utf8");      // Sets encoding UTF-8

		$sql = "INSERT INTO `$database`.`$database_table` SET 
		id = '$uniq_key',
		title = '$title',
		raw_post = '$raw_post' ,
		date = '$today' ,
		email = '$email', 
		uniq_string = '$uniq_string';";
		$count = $mysql->exec($sql);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>viewHTML - Free View HTML document online <?php echo "$uniq_key"; ?></title>
<meta http-equiv="REFRESH" content="0;url=<?php echo SERVERROOT."/pastehtml.php?view=$uniq_key"; ?>"></HEAD>
<BODY>
</BODY>
</HTML>
<?php

		$mysql = null; // close the database connection
		session_start();
} else { //if ($raw_post > ""){
	echo "There is no data! <br>";
	echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
	exit;
}
















