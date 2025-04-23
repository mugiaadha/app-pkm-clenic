<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$kdcabang=$_GET['kdcabang'];
$kdgl=$_GET['kdgl'];

$query="SELECT a.*,b.akun

 from glpusatd a,coa b WHERE 
 a.kdcoa = b.kdakun and
 a.kdcabang='$kdcabang' AND a.kdcabang=b.kdcabang   AND a.kdgl='$kdgl'  order BY a.kdcoa asc ";





$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {


// $response[]=$row;



     $temp = array(
  

    "kdgl"=>  $row["kdgl"],
    "kdcoa"=> $row["kdcoa"],
    "tgl"=> $row["tgl"],
    "notrans"=>  $row["notrans"],
    "keterangan"=>  $row["keterangan"],
    "jml"=> $row["jml"],
    "jmlrp"=> number_format($row["jml"],0),
    "kodeunit"=> $row["kodeunit"],
    "kdcabang"=> $row["kdcabang"],
    "kduser"=> $row["kduser"],
    "akun"=> $row["akun"],
    "no"=> $row["no"],
    "stsd"=> $row["statusd"],
    
);
   
    array_push($response, $temp);





}


$data = json_encode($response);

echo $data;
// echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>