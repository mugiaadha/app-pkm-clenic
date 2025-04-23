<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];


 date_default_timezone_set( 'Asia/Bangkok' );

// $tgl = date("Y-m-d");

$tgl=$_GET['tgl'];


$query="SELECT SUM(totalbayar) AS total FROM jualobat WHERE kdcabang='$kdcabang' AND tgl='$tgl' ";



$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {



$temp = array(


   "total" => number_format($row["total"],0),  




);
   
    array_push($response, $temp);



}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>