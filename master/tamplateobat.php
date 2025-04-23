<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$kddokter=$_GET['kduser'];
$kdtamplate=$_GET['kdtamplate'];

$sts=$_GET['status'];





$query="SELECT
a.*,b.standart,b.obat
FROM tplaning a, obat b
WHERE a.kdobat = b.kdobat AND a.kdtamplated='$kdtamplate' AND a.kddokter='$kddokter' AND a.kdcabang='$kdcabang' order BY a.nama DESC LIMIT 10";


$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>