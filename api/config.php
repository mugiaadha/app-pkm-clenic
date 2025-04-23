<?php
//ob_start("ob_gzhandler");
error_reporting(0);
session_start();

/* DATABASE CONFIGURATION */
// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'clen_clenic');
// define('DB_PASSWORD', 'Clenic2024');
// define('DB_DATABASE', 'clen_litedb');
// define("BASE_URL", "http://localhost/PHP-Slim-Restful/api/");
// define("SITE_KEY", 'yourSecretKey');

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'clen_clenic');
define('DB_PASSWORD', 'Clenic2024');
define('DB_DATABASE', 'clen_kulam');
define("BASE_URL", "http://localhost/PHP-Slim-Restful/api/");
define("SITE_KEY", 'yourSecretKey');





function getDB() 
{
	$dbhost=DB_SERVER;
	$dbuser=DB_USERNAME;
	$dbpass=DB_PASSWORD;
	$dbname=DB_DATABASE;
	$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbConnection->exec("set names utf8");
	$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbConnection;
}
/* DATABASE CONFIGURATION END */

/* API key encryption */
function apiToken($session_uid)
{
$key=md5(SITE_KEY.$session_uid);
return hash('sha256', $key);
}



?>