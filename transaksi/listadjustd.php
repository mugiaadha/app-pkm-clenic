<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$noadjust=$_GET['noadjust'];




$query="SELECT 
a.*,b.obat,b.standart
FROM adjustobatd a,obat b
WHERE a.kdobat = b.kdobat AND a.kdcabang = b.kdcabang
AND a.noadjust='$noadjust' and a.kdcabang='$kdcabang'";







$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>