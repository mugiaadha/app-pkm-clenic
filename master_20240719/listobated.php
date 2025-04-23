<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];

 date_default_timezone_set( 'Asia/Bangkok' );


$tgl = date("Y-m-d");

$query="SELECT a.TGLEX,a.KDOBAT,a.OBAT,a.QTY ,b.gudang FROM beliobatd a,gudang b,beliobat c WHERE 
c.NOFAKTUR = a.NOFAKTUR AND c.KDGUDANG = b.kdgudang and
a.kdcabang='$kdcabang' AND a.tglex='$tgl'";

// echo $query;
$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>