<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$nama=$_GET['nama'];
date_default_timezone_set( 'Asia/Bangkok' );
$tgl = date("Y-m-d");

$kdpoli=$_GET['kdpoli'];


$query="SELECT distinct a.notransaksi,a.tglpriksa,
b.pasien,a.norm,c.nampoli,a.layan
FROM kunjunganpasien a 
LEFT JOIN pasien b ON a.norm = b.norm
LEFT JOIN poliklinik c ON a.kdpoli = c.kdpoli
WHERE a.kdcabang='$kdcabang' and c.kdpoli like '%$kdpoli%' AND a.tglpriksa='$tgl' and b.pasien like '%$nama%'
ORDER BY b.pasien ,a.layan asc";




$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>