<?php
ini_set('display_errors', 1	); // 0 No show errors, 1
// Config application

/* Path local and remote */

if($_SERVER['SERVER_ADDR']=="localhost"){	
	define('SITE_URL','http://10.6.2.243/'); /* Production path */
}else{
	define('SITE_URL', '/BeeProject/'); /* Local path */
}

/* PATHS PROYECTO */
define('URL_VIEWS'      , SITE_URL  .'views/'); //View Layer Folder
define('URL_JS'         , URL_VIEWS .'js'); //JS's folder
define('BOOTSTRAP'         , URL_VIEWS . 'bootstrap'); //bootstrap Folder