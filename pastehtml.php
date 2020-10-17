<?php

if (!isset($_SERVER["HTTP_HOST"])) {
	echo "here_setting";
  parse_str($argv[1], $_GET);
  parse_str($argv[1], $_POST);
}

//incluye definiciones
include_once "include/functions.php";
include_once "include/defs.php";

//conect mysql server
$mysql = connectmysql();
$conn = $mysql;


$url=curURL();

if ($view > ""){
	session_start();
}

$view = mysqli_real_escape_string($mysql, $_REQUEST['view']);
$raw_post = mysqli_real_escape_string($mysql, $_POST['raw_post']);
$raw = mysqli_real_escape_string($mysql, $_REQUEST['raw']); // if > 0 then show raw output
$email = mysqli_real_escape_string($mysql, $_POST['email']);
$title = mysqli_real_escape_string($mysql, $_POST['title']);

var_dump($_POST);
var_dump($_REQUEST);
echo $view;
echo "<br>calling open_webpage<br>";


if ($view){
	echo "<br>open_webpage<br>";
	open_webpage($view, $mysql, $raw);
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
echo "here1<br>";

	recapcha_check();
echo "her2<br>";
	//create query

//conect mysql server
$mysql = connectmysql();
echo "here3<br>";

		//$mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$database=MYSQL_DATABASE;
		$database_table=MYSQL_DATABASE_TABLE;
		$mysql->query("ALTER TABLE `pastehtml` DEFAULT CHARSET=utf8 COLLATE utf8_general_ci ROW_FORMAT = COMPACT;
");      // Sets encoding UTF-8
echo "here4<br>";

		$sql = "INSERT INTO `$database`.`$database_table` SET 
		id = '$uniq_key',
		title = '$title',
		raw_post = '$raw_post' ,
		date = '$today' ,
		email = '$email', 
		uniq_string = '$uniq_string';";
		$count = $mysql->query($sql);
		
		echo $sql;
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
















