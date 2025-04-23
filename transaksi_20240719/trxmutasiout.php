<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];

$nomutasi=$_GET['nomutasi'];



$query="SELECT 
a.*,b.obat,b.standart
FROM mutasioutd a , obat b
WHERE a.kdobat = b.kdobat AND a.kdcabang = b.kdcabang AND a.nomutasi='$nomutasi' and a.kdcabang='$kdcabang' order by a.nomor asc";




$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>