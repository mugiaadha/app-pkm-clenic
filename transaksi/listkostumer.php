<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$kdcabang=$_GET['kdcabang'];
$nama=$_GET['nama'];

$query="SELECT * from kelompokkostumerd where  kdcabang='$kdcabang' and nama like '%$nama%' order by nama asc  ";





$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo $data;
// echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>