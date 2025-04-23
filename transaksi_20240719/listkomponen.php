<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';


$kdtarif=$_GET['kdtarif'];
$kdcabang=$_GET['kdcabang'];


$query="SELECT * from tarifkomponen where kdtarif='$kdtarif' and kdcabang='$kdcabang' and kdkomponen='6'";
$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>