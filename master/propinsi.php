<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';


	$nama=$_GET['nama'];

$query="SELECT  * FROM provinsi  where prov_name like '%$nama%'  order by  prov_name  LIMIT 20";



$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>