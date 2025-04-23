
<?php
	
	// echo phpinfo();
error_reporting(E_ALL);
ini_set("display_errors", 1);






$service_port = "8000";

$address= '192.168.0.110';













/* Create a TCP/IP socket. */
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
    echo "socket_create() failed: reason: <br>" . 
         socket_strerror(socket_last_error()) . "\n";
}


$result = socket_connect($socket, $address, $service_port);



// $stringsToSend = array("KDDOKTER", "KDANTRI", "KDKLONTER","NOURUT","PASIEN");

$stringsToSend = array('dok', 'an', 'klo','nour','nama');

$in = implode("@", $stringsToSend);
// $out = '';


// echo "Client Sended: PING !<br>";

socket_write($socket, $in, strlen($in));
echo "SENDED!.\n<br>";



socket_close($socket);







?>