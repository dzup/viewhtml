<?php
	//carga archivo .ini
    	$ini_array = parse_ini_file("include/pastehtml.ini", true);
    	//print_r($ini_array);
    	define('LOCAL', $ini_array["coneccion"]); 
    	define('OLD_SQL', $ini_array["old_sql"]);

	if ($ini_array["url"]){
    		define('URL', $ini_array["url"]);
	} else {
   		//try to get where we are
		define('URL', curURL());
	}
	if ($ini_array["servername"]){
    		define('SERVERROOT', $ini_array["servername"]);
	} else {
   		//try to get where we are
		define('SERVERROOT', curWEBDIR());
	}

	define('WARNING_NOTICE', $ini_array["warning_notice"]);

	define('DISQUS_ACTIVE', $ini_array["disqus_active"]);
	define('RECAPCHA_ACTIVE', $ini_array["recapcha_active"]);

	define('DISQUS_SHORTNAME',$ini_array["disqus_shortname"]);

    	define('GOOGLE_ADSENSE', $ini_array["google_adsense"]);
    	define('GOOGLE_AD_CLIENT', $ini_array["google_ad_client"]);
    	define('GOOGLE_AD_SLOT', $ini_array["google_ad_slot"]);
    	define('GOOGLE_AD_WIDTH', $ini_array["google_ad_width"]);
    	define('GOOGLE_AD_HEIGHT', $ini_array["google_ad_height"]);

    	define('MYSQL_DATABASE_TABLE',$ini_array["mysql_database_table"]);
    	define('CHARSET', $ini_array["charset"]);
    	define('MYSQL_HOST', $ini_array[LOCAL]["mysql_host"]);
    	define('MYSQL_DATABASE', $ini_array[LOCAL]["mysql_database"]);
    	define('MYSQL_USER', $ini_array[LOCAL]["mysql_user"]);
    	define('MYSQL_PASSWORD', $ini_array[LOCAL]["mysql_password"]);

