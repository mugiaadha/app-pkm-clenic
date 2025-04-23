<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

date_default_timezone_set('Asia/Jakarta');
 $today=date('dmy');

include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$kduser=$_GET['kduser'];

$sql="SELECT max(kdtamplatem) AS last FROM autonumobat WHERE kdcabang='$kdcabang' and kdtamplatem LIKE '$today%' and kduser='$kduser'";
$result=mysqli_query($conn, $sql);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

 $last=$row['last'];
      $lastnourut = substr($last,6,3);
      $nextno=$lastnourut + 1;
      $nextnot =$today.sprintf('%03s',$nextno);

      echo json_encode($nextnot);




}



?>
