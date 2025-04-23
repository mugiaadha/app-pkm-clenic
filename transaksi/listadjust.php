<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$tgl=$_GET['tgl'];

$nama=$_GET['nama'];




$query="SELECT 
a.*,b.gudang
FROM adjustobat a , gudang b
WHERE a.kdgudang = b.kdgudang AND a.kdcabang = b.kdcabang and a.keterangan like '%$nama%' and a.tgl='$tgl' and a.kdcabang='$kdcabang'";







$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>