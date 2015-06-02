<?php
/**
 * This file contains all of the important definitions for this application
 *
 * @author Tong Liu
 */
//============================================================================================
// Database definitions
//============================================================================================

define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'postgres');
define('DB_PASSWORD', 'postgres');
define('DB_NAME', 'Restaurant');
define('DB_PORT', 5432); // Enter an integer

//============================================================================================
// File system definitions
//============================================================================================

$FS_INTRANET_RESTAURANT_HTTP = $_SERVER['HTTP_REFERER'];
$FS_INTRANET_RESTAURANT_HTTP_POS = strrpos($FS_INTRANET_RESTAURANT_HTTP, "/Restaurant/");
if (!$FS_INTRANET_RESTAURANT_HTTP_POS) {
	$FS_INTRANET_RESTAURANT_HTTP .= "Restaurant/";
	$FS_INTRANET_RESTAURANT_HTTP_POS = strrpos($FS_INTRANET_RESTAURANT_HTTP, "/Restaurant/");
}
$FS_INTRANET_RESTAURANT_PREFIX = substr($FS_INTRANET_RESTAURANT_HTTP, 0, $FS_INTRANET_RESTAURANT_HTTP_POS);

// The path that Ventus resides on within the "intranet" folder
$GLOBALS['FS_INTRANET_RESTAURANT'] = $FS_INTRANET_RESTAURANT_PREFIX."/Restaurant/"; 

// If you have connection issues, comment out the above File system definitions and uncomment the following
// and add your local host path to the string
// $GLOBALS['FS_INTRANET_RESTAURANT'] = "http://localhost/~tongliu/Restaurant/"; 