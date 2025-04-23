<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$kdsup=$_GET['kdsup'];
$tgldari=$_GET['tgldari'];
$tglsampai=$_GET['tglsampai'];
$nama=$_GET['nama'];
$verif=$_GET['verif'];


	$query="SELECT a.*,b.nama,c.gudang
 FROM beliobat a , suplier b,gudang c
 WHERE a.KDSUPPLIER = b.kdsup AND a.KDCABANG = b.kdcabang
and a.kdcabang='$kdcabang' and c.kdgudang = a.KDGUDANG and c.kdcabang = a.kdcabang 
and a.SYSTEMBAYAR='2' and a.VERIF='$verif' and a.TGLJATUHTEMPO BETWEEN '$tgldari' and '$tglsampai'
and a.NOFAKTUR like '%$nama%'
order by a.NOFAKTUR asc";


$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>