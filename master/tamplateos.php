<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$kduser=$_GET['kduser'];
$status=$_GET['status'];



$nama=$_GET['nama'];
$query="SELECT * from tsubjek where kdcabang='$kdcabang' and kddokter='$kduser'
 and status='$status' and nama like '%$nama%' order by nama";



$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
// $response[]=$row;


   $temp = array(

   "kdtamplate" =>$row['kdtamplate'],
    "nama" =>$row['nama'],
    "detail" =>nl2br($row['detail']),
        "details" =>$row['detail'],
    "status"=>$row['status'],
    "kddokter"=>$row['kddokter'],
    "kdcabang"=>$row['kdcabang']

);

   
    array_push($response, $temp);

}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>