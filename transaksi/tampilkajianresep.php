<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$noresep=$_GET['noresep'];

$query="SELECT a.*,b.*,c.*
FROM kajianresep a ,kajianresepb b ,kajianresepc c
WHERE a.noresep = b.noresep AND a.noresep = c.noresep AND a.noresep ='$noresep'";


$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>