<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];


  $sql="SELECT norm from pasien where  kdcabang='$kdcabang'";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);







     echo json_encode($rowcount);




mysqli_close($conn);

?>