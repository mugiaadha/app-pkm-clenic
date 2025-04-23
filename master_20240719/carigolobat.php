<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$nama = $_GET['nama'];
$dari = $_GET['dari'];



if($dari == '1'){


$query="SELECT  * FROM golonganobat where golongan like '%$nama%' order by  golongan asc limit 50";

}else if($dari == '2'){
$query="SELECT  * FROM jenisobat where jenis like '%$nama%' order by  jenis asc limit 50 ";
}else{


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