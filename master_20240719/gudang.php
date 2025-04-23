<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdklinik=$_GET['kdklinik'];

$query="SELECT
c.kdgudang,c.gudang,a.nama AS cabang,b.nama,c.kdklinik,c.kdcabang,c.utama
FROM cabang a,masterklinik b,gudang c 
WHERE a.kdklinik = b.kdklinik AND c.kdklinik = b.kdklinik AND a.kdcabang = c.kdcabang and c.kdcabang='$kdklinik' order by c.gudang asc";
$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>