<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$kdcabang=$_GET['kdcabang'];
$nama=$_GET['nama'];


$tgl=strtotime($_GET['tgl']);


// $time = strtotime('2022-08-10');

$tahun = date('Y',$tgl);
$bulan = date('m',$tgl);



$query="SELECT * from glpusat
 where kdcabang='$kdcabang' and  YEAR(tgl)='$tahun'  AND MONTH(tgl)='$bulan'   AND keterangan like '%$nama%'  order BY tgl asc ";





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