<?php

include '../koneksi.php';


$query="SELECT * FROM tarifdetail WHERE statust='LAB' AND harga > 0";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$kdtarif=$row['kdtarif'];


  $conn -> query("DELETE FROM tarifkomponen where kdtarif='$kdtarif'");



}


?>