<?php

    include '../koneksi.php';
    
    
    $query="select * from userpcare";
$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
    
$consid= $row['consid'];

$secret= $row['screetkey'];
$user = $row['username'];
$pass = $row['password'];

$userkeydb = $row['userkey'];
$userkeydbp = $row['userkantrean'];
}
    
        date_default_timezone_set( 'UTC' );
$tgl_unix = strval( time()-strtotime( '1970-01-01 00:00:00' ) );

	$consID 	= $consid; 
	$secretKey 	= $secret; 
	
	$pcareUname =  $user; 
	$pcarePWD 	=$pass; 
	$kdAplikasi	= "095"; 

	$data 		= $consID.'&'.$tgl_unix;
	
	$signature = hash_hmac('sha256', $data, $secretKey, true);
	$encodedSignature = base64_encode($signature);	
	$encodedAuthorization = base64_encode($pcareUname.':'.$pcarePWD.':'.$kdAplikasi);	
	$userkey = $userkeydb; 
	$userkeyan =$userkeydbp;
    
// date_default_timezone_set( 'UTC' );
// $tgl_unix = strval( time()-strtotime( '1970-01-01 00:00:00' ) );

// 	$consID 	= "4753"; //customer ID anda
// 	$secretKey 	= "7tFF380732"; //secretKey anda
	
// 	$pcareUname = "kutabaro.dev"; //username pcare
// 	$pcarePWD 	= "Bpjs2024##"; //password pcare anda
// 	$kdAplikasi	= "095"; //kode aplikasi

// 	$data 		= $consID.'&'.$tgl_unix;
	
// 	$signature = hash_hmac('sha256', $data, $secretKey, true);
// 	$encodedSignature = base64_encode($signature);	
// 	$encodedAuthorization = base64_encode($pcareUname.':'.$pcarePWD.':'.$kdAplikasi);	
// 	$userkey = 'f5fdc865226d595510def3a462738c66';









?>