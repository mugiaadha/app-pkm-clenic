<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$kdspesial=$_GET['kdspesial'];


$query="SELECT
a.kddokter,a.namdokter,b.nama,b.kdpoli
FROM dokter a , spesialis b
WHERE a.kdspesial = b.kdspesial AND a.kdcabang = b.kdcabang AND a.kdcabang='$kdcabang' and a.kdspesial='$kdspesial'";
$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>