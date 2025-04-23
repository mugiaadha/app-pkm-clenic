<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$kdcabang=$_GET['kdcabang'];
$nama=$_GET['nama'];

$query="SELECT * from coa where kdcabang='$kdcabang'  and akun like '%$nama%' order by kdakun asc ";





$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {


     $temp = array(
  

    "kdakun"=>  $row["kdakun"],
    "parent"=> $row["parent"],
    "akun"=> $row["akun"],
   "akund"=> $row['kdakun'].'|'.$row["akun"],
  
    "kdcabang"=> $row["kdcabang"],
    "kdklinik"=> $row["kdklinik"],
  
    
);
   
    array_push($response, $temp);

}


$data = json_encode($response);

echo $data;
// echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>