<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';


$kdproduk = $_GET['kdproduk'];
$kdcabang = $_GET['kdcabang'];





$query="SELECT a.*,b.nama
FROM mapinglaborat a,teslab b
WHERE a.kdtes = b.kdlab AND a.kdcabang='$kdcabang' AND a.kdproduk='$kdproduk'";



$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>