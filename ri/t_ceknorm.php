<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$norm=$_GET['norm'];


$query="SELECT
a.notransaksi,b.nama,a.kdkamar
 FROM pasienrawatinap a,kamar b 
 
 WHERE 
 a.kdkamar = b.kdkamar and
 a.norm='$norm' and a.kdcabang='$kdcabang'  and a.tglpulang IS null";


$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>