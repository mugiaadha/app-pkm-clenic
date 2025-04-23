<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
 date_default_timezone_set( 'Asia/Bangkok' );

$tgl = date("Y-m-d");
$query="SELECT 
sum(a.totalcash) as tunai,sum(a.totalpiutang) AS piutang,sum(a.tagihan) AS total
FROM transaksiakhir a ,pasienrawatinap b
WHERE a.notrans = b.notransaksi AND b.tglpulang='$tgl' AND a.kdcabang='$kdcabang'";
$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>