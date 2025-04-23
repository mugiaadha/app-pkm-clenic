<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$sts=$_GET['sts'];




if($sts === '1'){
$query="SELECT  * FROM tarif  where kdcabang='$kdcabang' and status='1'  order by  nama  LIMIT 20";
}else{
	$nama=$_GET['nama'];
$query="SELECT  * FROM tarif  where kdcabang='$kdcabang' and   status='1' and  nama like '%$nama%'  order by  nama  LIMIT 20";

}

$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>