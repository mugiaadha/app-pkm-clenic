<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';


 date_default_timezone_set( 'Asia/Bangkok' );
$kduser=$_GET['kduser'];



 $today=date('dmy');

$query="SELECT max(nourut) AS last FROM ermcppt WHERE kduser='$kduser' and nourut LIKE '$today%'";




$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
      $last=$row['last'];
      $lastnourut = substr($last,6,6);
      $nextno=$lastnourut + 1;

      $nextnot =$today.sprintf('%06s',$nextno);
}


$data = json_encode($nextnot);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>