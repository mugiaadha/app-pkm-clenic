<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$notrans=$_GET['notrans'];




$query="SELECT * FROM ermcpptintruksi 
WHERE notransaksi='$notrans' AND kdcabang='$kdcabang' AND dari='obat' and dari2='CPPT'  and statuso='Non Racik' order BY  tgl asc";


$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$response[]=$row;



}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>