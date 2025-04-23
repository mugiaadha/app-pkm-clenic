<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];

$notrans=$_GET['notrans'];

$kdproduk=$_GET['kdproduk'];
$nomor=$_GET['nomor'];
$query="SELECT 
a.*,b.tarif
FROM transaksijasa a,komponentarif b
 where a.kdkomponen = b.kdkomponen
 AND a.notrans='$notrans' AND a.kdproduk='$kdproduk'  and nomor='$nomor' and a.kdcabang='$kdcabang'";





$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>