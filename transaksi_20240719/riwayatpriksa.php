<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$kdcabang=$_GET['kdcabang'];
$norm=$_GET['norm'];

$query="SELECT 
a.norm,b.pasien,a.tglpriksa,a.kdpoli,c.nampoli
FROM kunjunganpasien a,pasien b,poliklinik c
WHERE a.norm = b.norm AND a.kdpoli = c.kdpoli AND
a.norm='$norm' AND a.kdcabang='$kdcabang' order by a.tglpriksa asc";
$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);



?>