<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$kdcabang=$_GET['kdcabang'];
$norm=$_GET['norm'];
$kddokter=$_GET['kddokter'];
$kdpoli=$_GET['kdpoli'];
$query="SELECT a.*,b.namdokter,c.nampoli
 FROM ermcppt a,dokter b,poliklinik c
WHERE a.kddokter = b.kddokter AND a.kdcabang = b.kdcabang AND a.kdpoli = c.kdpoli AND a.kdcabang = c.kdcabang and a.norm='$norm' and a.kdcabang='$kdcabang'  and a.kdpoli='$kdpoli' order by tgl desc";
$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);



?>