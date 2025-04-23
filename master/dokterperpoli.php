<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$kddokter=$_GET['kddokter'];



$query="
SELECT 
a.kddokter,a.namdokter,b.kdpoli,c.nampoli
FROM dokter a ,dokterklinik b ,poliklinik c
WHERE a.kddokter = b.kddokter AND a.kdcabang=b.kdcabang 
AND b.kdpoli = c.kdpoli AND b.kdcabang = c.kdcabang

AND b.kdcabang='$kdcabang'  and a.kddokter='$kddokter' order by nampoli asc";
$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>