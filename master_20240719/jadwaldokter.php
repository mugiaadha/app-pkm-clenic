<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];

$query="SELECT
a.*,b.nampoli,c.namdokter
FROM jadwalpraktek a , poliklinik b, dokter c
WHERE a.kddokter = c.kddokter AND a.kdpoli = b.kdpoli AND a.kdcabang='$kdcabang' order by c.namdokter asc ";
$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>