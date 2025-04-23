<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';


$sts=$_GET['sts'];

if($sts === '1'){
$query="SELECT * from jenisbayar where tampil2='1'  order by kd ";



}else{
$kd=$_GET['kd'];
$query="SELECT * from jenisbayar where kd='$kd'  order by kd ";

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