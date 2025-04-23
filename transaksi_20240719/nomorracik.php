<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';



$kdcabang=$_GET['kdcabang'];
$notrans=$_GET['notrans'];

$norm=$_GET['norm'];
 $today=date('dmy');

$sql = "SELECT MAX(nomor) as last FROM nomorracik  WHERE nomor LIKE '$today%' and kdcabang='$kdcabang' and notransaksi='$notrans' and norm='$norm' and status='0'";
$stmt = mysqli_query( $conn, $sql );

while( $row =mysqli_fetch_array( $stmt, MYSQLI_ASSOC) ) {
      $last=$row['last'];
	  $lastnourut = substr($last,6,3);
	  $nextno=$lastnourut + 1;

	  $nextnot =$today.sprintf('%03s',$nextno);

	 

	  $data = json_encode($nextnot);
 echo $data;
	  
}


mysqli_close($conn);


?>