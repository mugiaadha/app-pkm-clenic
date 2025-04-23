<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$notrans=$_GET['notrans'];
$sts=$_GET['sts'];
$kdcppt=$_GET['kdcppt'];


$query="SELECT DISTINCT kdcppt,keterangan FROM ermcpptintruksi 
WHERE notransaksi='$notrans'  AND dari='$sts' AND kdcabang='$kdcabang' and kunci='0'";




$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>