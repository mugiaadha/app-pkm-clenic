<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$kdobat=$_GET['kdobat'];



$query="SELECT
a.kdgudang,b.gudang,a.stok
FROM obatstock a , gudang b
WHERE a.kdgudang = b.kdgudang AND a.kdcabang='$kdcabang' AND a.kdobat='$kdobat' ORDER BY gudang asc";


$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>