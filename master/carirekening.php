<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$akun=$_GET['akun'];

$query="SELECT a.* ,b.akun from rekening a , coa b
WHERE a.kdcoa = b.kdakun AND a.kdcabang = b.kdcabang and b.kdcabang='$kdcabang' and a.namarekening like '%$akun%'";
$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>