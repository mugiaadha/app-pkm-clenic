<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$kdcabang=$_GET['kdcabang'];
$norm=$_GET['norm'];

$query="SELECT a.notransaksi,a.norm,a.tgl,b.nama,a.kdcabang,a.kdproduk,a.status,a.nmfile from hasilrad a
left join tarifdetail b ON   a.kdproduk = b.kdtarif
WHERE norm='$norm' and a.kdcabang='$kdcabang' order by tgl desc ";





$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo $data;
// echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>