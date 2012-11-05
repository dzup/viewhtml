<?php

/*
 * Funciones varias
 * 27 sep 2012 13:22pm
 * por alex
 *  
 */
function connectmysql(){
	//echo "in MYSQL";exit;
	# MySQL with PDO_MYSQL  
	#print_r(PDO::getAvailableDrivers());
	$host=MYSQL_HOST;
	$dbname=MYSQL_DATABASE;
	$user=MYSQL_USER;
	$pass=MYSQL_PASSWORD;
	try {
    		$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    	}
	catch(PDOException $e)
    	{
    		echo $e->getMessage();
    	}

  	//$deb = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass) or die("fATAL ERROR TRYING TO CONNECT MYSQL");;  
	//http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
   	//$deb=mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or die("FATAL ERROR AL TRATAR DE CONECTAR A  SQL SERVER");
   	//mysql_select_db(MYSQL_DATABASE, $deb);
    	//mysql_query("SET CHARACTER SET utf8", $deb); //cambia para acentos a utf8
	return $dbh;
}
function printheader($title){
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title><?php echo $title; ?></title>
		<script type="text/javascript">
			<!--

			function viewPage() { 
				parent.frames['ifr'].document.getElementById('iframeDiv').innerHTML=document.forms[0].elements[0].value;
			}

			function ClipBoard() 
			{
				holdtext.innerText = copytext.innerText;
				Copied = holdtext.createTextRange();
				Copied.execCommand("Copy");
			}

			function select_all(obj) {
        			var text_val=eval(obj);
        			text_val.focus();
        			text_val.select();
        			if (!document.all) return; // IE only
        			r = text_val.createTextRange();
        			r.execCommand('copy');
    			}
			//-->
		</script>
	</head>
	<body BGCOLOR="#ffffff">
<?php
} //end printheader();

function printfooter(){
?>

	</BODY>
</HTML>
<?php
}

function open_webpage($view,$mysql,$raw){
//	open_webpage($view,$mysql,$raw);
	$existe=get_htmlpost($view,$mysql);
	printheader($existe[title]);
	echo "<center>";	
	echo "<a href=\"".SERVERROOT."/index.php\">
		<button>
			create a NEW viewHTML
		</button>
	      </a>
	      <br>";	
	//add google adsense if is define
	adsense();
	echo WARNING_NOTICE;
	echo "</center>";

	if ($existe){	
			//viewRAW
			show_html($mysql,$view,$raw,curPageURL(),$existe);
	} else {
		echo "<b>" . curPageURL() . "</b><br> Not found, ";
		echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
	}

	disqus();
	printfooter();
	exit;
}



function get_htmlpost($id,$mysql){
//get row
	$mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	$database=MYSQL_DATABASE;
	$database_table=MYSQL_DATABASE_TABLE;
	//$sql = "SELECT *  FROM `a7850950_u3mx`.`pastehtml` ORDER BY `date` DESC LIMIT 20";
	$sql = "SELECT *  FROM `$database`.`$database_table` WHERE `id` = '$id'";
	$result = $mysql->query($sql);
	$row = $result->fetch(PDO::FETCH_ASSOC);
	if ( $row ) {
		return $row;
	} else {
		return 0;
	}
	//$mysql = null; // close the database connection
}

function rand_string( $length ) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	

	$size = strlen( $chars );
	for( $i = 0; $i < $length; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}

	return $str;
}


function calculate_uniq_key(){
	//key to use as unique
	return sha1(rand_string(255).$_SERVER['REMOTE_ADDR']);
}

function curPageURL() {
	$pageURL = 'http';
 	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 		$pageURL .= "://";
 		if ($_SERVER["SERVER_PORT"] != "80") {
  			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 		} else {
  			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 	}
 	return $pageURL;
}

function curPageName() {
 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}

function curURL() {
	$query = $_SERVER['PHP_SELF'];
	$path = pathinfo( $query );
	$url = $path['basename'];
 	return $url;
}

function curWEBDIR(){
	return "http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["REQUEST_URI"]);
}

function adsense(){
//adsense
//
if (GOOGLE_ADSENSE){
	echo "
<!-- begin adsense -->
<script type=\"text/javascript\">
	<!--
	google_ad_client =\"".GOOGLE_AD_CLIENT."\";
	/* u3mx 468x60 */
	google_ad_slot = \"".GOOGLE_AD_SLOT."\";
	google_ad_width = ".GOOGLE_AD_WIDTH.";
	google_ad_height = ".GOOGLE_AD_HEIGHT.";
	//-->
</script>
<script type=\"text/javascript\"
src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\"></script>
<br>
<!--end adsense -->
";
} //if (GOOGLE_ADSENSE){

} //end adsense

function checkEmail($email) {
  if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])
  ↪*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",
               $email)){
    list($username,$domain)=split('@',$email);
    if(!checkdnsrr($domain,'MX')) {
      return false;
    }
    return true;
  }
  return false;
}


function get_last_rows($mysql){
// get last 10 rows addit
     try {
	$mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	$database=MYSQL_DATABASE;
	$database_table=MYSQL_DATABASE_TABLE;
	//$sql = "SELECT *  FROM `a7850950_u3mx`.`pastehtml` ORDER BY `date` DESC LIMIT 20";
	$sql = "SELECT *  FROM `$database`.`$database_table` ORDER BY `date` DESC LIMIT 17";
	$result = $mysql->query($sql);
	echo "<table>";
	echo " <tbody>";
	foreach ($result as $row) {
		echo "<tr>";
		echo " <td>
			<a href=\"$url"."pastehtml.php?view=" . $row["id"] ."\">
				" . $row["id"] ."
			</a>
		       </td>
		       <td>
			<a href=\"$url"."pastehtml.php?view=" . $row["id"] ."&raw=1\">
				viewRAW
			</a>
		       </td>
		      </tr>
	";
	}
	echo "</tbody>";
	echo " </table>";
	echo "<br>";
	$mysql = null; // close the database connection
    }
    catch(PDOException $e) {
    	echo $e->getMessage();
    }
}

function disqus(){
if (DISQUS_ACTIVE){
?>
    <div id="disqus_thread"></div>
         <script type="text/javascript">
            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
            var disqus_shortname = '<?php echo DISQUS_SHORTNAME; ?>';
            // required: replace example with your forum shortname

            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function() {
               var dsq = document.createElement('script');
               dsq.type = 'text/javascript';
               dsq.async = true;
               dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
               (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
         </script>
<?php } //if (DISQUS_ACTIVE)

} //disqus();


function getFIRSTrow($mysql){
	$mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	$database=MYSQL_DATABASE;
	$database_table=MYSQL_DATABASE_TABLE;
	$sql = "SELECT *  FROM `$database`.`$database_table` ORDER BY `date` DESC LIMIT 1";
	$result = $mysql->query($sql);
	$row = $result->fetch(PDO::FETCH_ASSOC);
	if ( $row ) {
		return $row;
	} else {
		//no nexts, get first
		return null;
	}	
}//getFIRSTrow($mysql, $current_date){

function getLASTrow($mysql){
	$mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	$database=MYSQL_DATABASE;
	$database_table=MYSQL_DATABASE_TABLE;
	$count=$mysql->prepare("SELECT *  FROM `$database`.`$database_table` ORDER BY `date` ASC LIMIT 1");
	$count->execute();
	$no=$count->rowCount();
	$row = $count->fetch(PDO::FETCH_ASSOC);
	if ( $row ) {
		return $row;
	} else {
		//nothing
		return null;
	}
} //getLASTrow($mysql, $current_date){

function showNextRow($mysql, $thisdate){
	$mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	$database=MYSQL_DATABASE;
	$database_table=MYSQL_DATABASE_TABLE;
	$sql = "SELECT *  FROM `$database`.`$database_table` WHERE date < '$thisdate' ORDER BY `date` DESC LIMIT 1";
	$result = $mysql->query($sql);
	$row = $result->fetch(PDO::FETCH_ASSOC);
	if ( $row ) {
		return $row;
	} else {
		//no nexts, get first
		return getFIRSTrow($mysql);
	}
} //showNextRow($mysql, $currentid){

function showPrevRow($mysql, $thisdate){
	$mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	$database=MYSQL_DATABASE;
	$database_table=MYSQL_DATABASE_TABLE;
	$sql = "SELECT *  FROM `$database`.`$database_table` WHERE date > '$thisdate' ORDER BY `date` ASC LIMIT 1";
	$result = $mysql->query($sql);
	$row = $result->fetch(PDO::FETCH_ASSOC);
	if ( $row ) {
		return $row;
	} else {
		//get last
		return getLASTrow($mysql);
	}
} //showPrevRow($mysql, $currentid){

function showNextPrevButtom($mysql, $row, $viewmode){
//show the next previous row buttoms
//<a href=\"".SERVERROOT."/pastehtml.php?view=$view
	$current_date = $row['date'];
	$current_id = $row['id'];
	$prev=showPrevRow($mysql, $current_date);
	$next=showNextRow($mysql, $current_date);
	echo "<a href=\"".SERVERROOT."/pastehtml.php?view=".$prev["id"]."&raw=".$viewmode."\"><button>Prev</button></a><a href=\"".SERVERROOT."/pastehtml.php?view=".$next["id"]."&raw=".$viewmode."\"><button>Next</button></a> ";
//.getROWcount($mysql);
}

function getROWcount($mysql){
	$mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	$database=MYSQL_DATABASE;
	$database_table=MYSQL_DATABASE_TABLE;
	$sql="SELECT * FROM `$database`.`$database_table` WHERE `id` > ''";
	$result = $mysql->query($sql);
	$row = $result->fetch(PDO::FETCH_NUM);
	return $result->rowCount();;
}

function show_html($mysql,$view,$viewmode,$currentPage,$row){
// show_html($view, $existe, '1');
// $mode = 1 raw
// $mode = 0 html
	echo "<center>";
	if ($viewmode){
		$rawtxt="viewHTML";
		$viewmode=1;
		echo "<a href=\"".SERVERROOT."/pastehtml.php?view=$view&raw=0\">";
	} else {
		$rawtxt="viewRAW";
		$viewmode=0;
		echo "<a href=\"".SERVERROOT."/pastehtml.php?view=$view&raw=1\">";
	}
	//$viewmode = (! $viewmode);

	echo "<button>$rawtxt</button>				
	</center></a>";

	showNextPrevButtom($mysql, $row, $viewmode);
	echo "<br>Title: <b>".htmlspecialchars($row['title'])."</b><br>
	 Date: <b>".htmlspecialchars($row['date'])."</b><br>
	 viewHTML id; <b>".$row['id']."<b> <input value=\"$currentPage\"
 	onclick=\"select_all(this)\" name=\"url\" type=\"text\" STYLE=\"width:100%;background-color:pink\"/>
<br>
";
	echo "<hr noshade size=7>";

	if ($viewmode){
		echo "<div style=\"float:auto; width:auto; margin:auto;\">";
		echo "<pre>";
		echo htmlspecialchars($row['raw_post']);
		echo "</pre>";
		echo "</div>";
	} else {
		echo "<div style=\"float:auto; width:auto; margin:auto;\">";
		echo $row['raw_post'];
		echo "</div>";
	}
	echo "<hr noshade size=7>";
}




























