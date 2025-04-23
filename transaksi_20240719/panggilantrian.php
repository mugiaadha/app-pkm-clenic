
<?php
		header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

	// echo phpinfo();
error_reporting(E_ALL);
ini_set("display_errors", 1);



$no=$_GET['no'];
$dokter=$_GET['dokter'];


$service_port = "8001";


$address= '192.168.43.51';













/* Create a TCP/IP socket. */
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
    echo "socket_create() failed: reason: <br>" . 
         socket_strerror(socket_last_error()) . "\n";
}


$result = socket_connect($socket, $address, $service_port);


// $stringsToSend = array("noantri", "KDANTRI", "poli","namadokter");

$stringsToSend = array($no,'A','A',$dokter);

$in = implode("@", $stringsToSend);
// $out = '';


// echo "Client Sended: PING !<br>";

socket_write($socket, $in, strlen($in));
echo "SENDED!.\n<br>";



socket_close($socket);







?>