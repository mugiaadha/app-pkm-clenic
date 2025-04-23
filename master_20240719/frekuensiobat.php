<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$kdcp=$_GET['kdcp'];
$kdbs=$_GET['kdbs'];
$query="SELECT distinct APJML from CPOAPD WHERE     kdcp = '$kdcp' AND kdbs = '$kdbs' order by APJML";


$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>