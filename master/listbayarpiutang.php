<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];

$notrans=$_GET['notrans'];


$query="SELECT 
a.*,b.pasien,c.nampoli,d.nama
FROM bayarpiutang a , pasien b, poliklinik c,kelompokkostumerd d
WHERE a.norm = b.norm AND a.kdpoli = c.kdpoli AND  a.kdkostumer = d.kdkostumerd and a.kdcabang='$kdcabang' AND a.notrans='$notrans'";
$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>