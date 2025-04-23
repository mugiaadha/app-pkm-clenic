<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$namarak = $_GET['namarak'];
$kdcabang = $_GET['kdcabang'];
$query="SELECT  * FROM rakobat where namarak like '%$namarak%' and kdcabang='$kdcabang' order by  namarak asc limit 10 ";
$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>