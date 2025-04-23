<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];



$query="SELECT 
a.kdkostumer,b.kdkostumerd
FROM kelompokkostumer a,kelompokkostumerd b
WHERE a.kdkostumer = b.kdkostumer AND a.dash='UMUM' AND a.kdcabang='$kdcabang' ORDER BY kdkostumer DESC LIMIT 1";
$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>