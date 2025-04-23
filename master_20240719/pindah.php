<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';


$query="SELECT 
a.kdobat,b.hargabeli,a.notransaksi,a.hargabeli AS jl
 FROM jualobatd a ,obat b WHERE a.kdobat = b.kdobat AND a.kdcabang = b.kdcabang AND a.kdcabang='003'";


$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {


$kdobat = $row['kdobat'];
$hargabeli = $row['hargabeli'];
$notrans = $row['notransaksi'];


 $conn -> query("UPDATE jualobatd set hargabeli='$hargabeli'
         where notransaksi='$notrans' and kdobat='$kdobat'");









}


mysqli_close($conn);


?>