<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$norm=$_GET['norm'];

$query="SELECT tgl,
notransaksi,nofaktur,norm,totalbayar
FROM jualobat 
WHERE norm='$norm' AND statuslunas='1' and kdcabang='$kdcabang'  order by tgl";


$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>