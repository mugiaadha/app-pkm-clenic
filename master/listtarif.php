<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$sts=$_GET['sts'];
$kdtarif=$_GET['kdtarif'];

$nama=$_GET['nama'];

 date_default_timezone_set( 'Asia/Bangkok' );

$tahun = date("Y");
$bulan = date("m");
$hari = date("d");



// $query="SELECT * from tarifdetail where nama LIKE
//  '%$nama%'  and statust='$sts' and kdtarifm='$kdtarif' and kdcabang='$kdcabang' AND 
// tglberlaku <=  NOW()
// AND tglberakhir >= NOW()
//   order by nama desc limit 20";




$query="SELECT * from tarifdetail where nama LIKE
 '%$nama%'  and statust='$sts' and kdtarifmasli='$kdtarif' and kdcabang='$kdcabang'  and harga <> 0
  order by nama desc limit 20";




$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>