<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
 
 date_default_timezone_set( 'Asia/Bangkok' );

// $tgl = date("Y-m-d");

$kdcabang=$_GET['kdcabang'];
$norm=$_GET['norm'];
$kdpoli=$_GET['kdpoli'];
$tgl = $_GET['tgl'];

$query="SELECT  a.* 
FROM kunjunganpasien a,poliklinik b  where 
a.kdpoli = b.kdpoli and 
a.kdcabang='$kdcabang' and a.norm='$norm' and a.kdpoli='$kdpoli' and a.tglpriksa='$tgl' and b.filter='1' and a.ri='No'";



$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>