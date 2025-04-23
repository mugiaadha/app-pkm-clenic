<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$kdcabang=$_GET['kdcabang'];
$notrans=$_GET['notrans'];
$query="SELECT 
a.*
FROM transaksipasiend a,poliklinik b
WHERE a.kdpoli = b.kdpoli   and a.notransaksi='$notrans' 
and a.kdcabang='$kdcabang'  and a.notransaksi <> ''  order by a.tgltransaksi,a.nomor asc ";





$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>