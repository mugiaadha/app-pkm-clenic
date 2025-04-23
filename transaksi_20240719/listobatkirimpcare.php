<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$notrans=$_GET['notrans'];




$query="SELECT 
b.obat,b.standart,b.kdobatbpjs,a.qty,c.frekuensi,c.jmlpakai,b.kdobat
FROM jualobatd a , obat b ,ermcpptintruksi c
WHERE a.kdobat = b.kdobat AND a.nofaktur = c.notransaksi AND a.kdcppt = c.kdcppt  AND a.kdobat = c.kdpruduk
and a.nofaktur='$notrans' AND a.kdcabang='$kdcabang'";






$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>