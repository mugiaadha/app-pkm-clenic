<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];



date_default_timezone_set( 'Asia/Bangkok' );


$tgl = $_GET['tgl'];

$query="SELECT * FROM
 poliklinik WHERE kdcabang='$kdcabang' ";


$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
// $response[]=$row;





$kd = $row["kdpoli"];


$queryx="SELECT SUM(tagihan) AS total FROM
 transaksiakhir WHERE kdcabang='$kdcabang' AND kdpoli='$kd' and tglfaktur='$tgl' and notrans <> '' ";


$responsex=array();
$resultx=mysqli_query($conn, $queryx);

while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {

   $responsex[]=$rowx;




}



	 $temp = array(
 	"kdtamplated" => $row["kdpoli"],
 	"nama" => $row["nampoli"],
 	
 	"detail" => $responsex

);
   
    array_push($response, $temp);








}


 // $pesan = array(
 //        'datax'=>$response,
      
 //    );




$data = json_encode($response);



echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>