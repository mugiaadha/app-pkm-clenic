<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$kdobat=$_GET['kdobat'];
$kdgudang=$_GET['kdgudang'];




$query="SELECT
a.*,b.stok
FROM obat a ,obatstock b
WHERE a.kdobat = b.kdobat and a.kdcabang = b.kdcabang and
a.kdcabang ='$kdcabang'  and a.kdobat='$kdobat' and b.kdgudang='$kdgudang'   order by  a.kdobat asc limit 20  ";



$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>