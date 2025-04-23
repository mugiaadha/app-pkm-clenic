<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$nama=$_GET['nama'];

$query="SELECT
a.*,b.kdindukkamar,b.indukkamar,c.kdkelas,c.namakelas
FROM kamar a ,kamarinduk b,kamarkelas c
WHERE a.kdinduk = b.kdindukkamar AND a.kdkelas = c.kdkelas AND a.kdcabang = '$kdcabang'  AND a.nama LIKE '%$nama%'";
$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>