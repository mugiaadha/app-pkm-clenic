<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$notrans=$_GET['notrans'];
$sts=$_GET['sts'];
$kdcppt=$_GET['kdcppt'];

$query="SELECT a.*,b.nomor ,b.notransaksi,a.notransaksi as nofaktur
FROM ermcpptintruksi a 
 LEFT JOIN transaksipasiend b
ON a.kdcppt = b.kdcppt AND 
a.kdpruduk = b.kdproduk AND
a.kdpoli = b.kdpoli AND a.notransaksi = b.nofaktur AND a.kdcabang = b.kdcabang and a.no = b.nomor
WHERE a.notransaksi='$notrans' AND a.kdcabang='$kdcabang' AND a.dari='$sts'  
AND a.kdcppt='$kdcppt'
order BY  a.tgl asc";



$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>