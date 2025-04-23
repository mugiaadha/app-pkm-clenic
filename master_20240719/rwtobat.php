<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$kdcabang=$_GET['kdcabang'];
$norm=$_GET['norm'];

$query="SELECT DISTINCT a.tglpriksa ,dari,norm,notransaksi,a.kdpoli,b.nampoli FROM ermcpptintruksi a,poliklinik b 
WHERE a.kdpoli = b.kdpoli
and a.norm='$norm' AND  a.dari ='obat' AND a.kdcabang='$kdcabang'  order BY a.tglpriksa asc";



$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>