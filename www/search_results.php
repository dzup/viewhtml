<!-- include style -->
<link rel="stylesheet" type="text/css" href="styles/style.css" />
<?php
//open database
//include 'db_connect.php';
//include our awesome pagination
//class (library)
//incluye definiciones
include_once "include/functions.php";
include_once "include/defs.php";

//conect mysql server
$mysql = connectmysql();
$conn = $mysql;
$mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$database=MYSQL_DATABASE;
$database_table=MYSQL_DATABASE_TABLE;

include 'libs/ps_pagination.php';

//query all data anyway you want

$sql = "SELECT *  FROM `$database`.`$database_table` ORDER by date DESC";
//$sql = "select * from  ORDER BY firstname DESC";

//now, where gonna use our pagination class
//this is a significant part of our pagination
//i will explain the PS_Pagination parameters
//$conn is a variable from our config_open_db.php
//$sql is our sql statement above
//3 is the number of records retrieved per page
//4 is the number of page numbers rendered below
//null - i used null since in dont have any other
//parameters to pass (i.e. param1=valu1&param2=value2)
//you can use this if you're gonna use this class for search
//results since you will have to pass search keywords
$pager = new PS_Pagination( $mysql, $sql, 11, 4, null );

//our pagination class will render new
//recordset (search results now are limited
//for pagination)
$rs = $pager->paginate(); 

//get retrieved rows to check if
//there are retrieved data
$num = $rs->rowCount();

if($num >= 1 ){     
	//creating our table header
	echo "<table id='my-tbl'>";
	echo "<tr>";
		echo "<th>Title</th>";
		echo "<th>Id key</th>";
		echo "<th>Date</th>";
	echo "</tr>";
	
	//looping through the records retrieved
	while ($row = $rs->fetch(PDO::FETCH_ASSOC)){
		echo "<tr class='data-tr' align='center' onclick=\"document.location = '".SERVERROOT."/pastehtml.php?view="."{$row['id']}';\">";
		echo "";
		echo "<td>{$row['title']}</td>";
		echo "<td>{$row['id']}</td>";
		echo "<td>{$row['date']}</td>";
		echo "";
		echo "</tr>";
	}       
	
	echo "</table>";
}else{
	//if no records found
	echo "No records found!";
}
//page-nav class to control
//the appearance of our page 
//number navigation
echo "<div class='page-nav'>";
	//display our page number navigation
	echo $pager->renderFullNav();
echo "</div>";

?>
