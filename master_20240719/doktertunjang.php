<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$sts=$_GET['sts'];

$query="SELECT 
a.*
FROM dokter a,dokterklinik b,poliklinik c
WHERE a.kddokter = b.kddokter AND b.kdpoli = c.kdpoli  and a.kdcabang='$kdcabang' AND c.sts='$sts' order by a.namdokter asc";
$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>