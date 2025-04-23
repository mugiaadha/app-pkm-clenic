<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$status=$_GET['status'];
$query="SELECT  ket from tamplatesigna where status='$status' order by ket asc";
$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {


if($status === '1'){

$nama ='APJML';

}else if($status === '2'){

$nama = 'APWAKTU';

}else if($status === '3'){
$nama = 'APUSE';

}
	$temp = array(
$nama => $row["ket"],  
$status => 1,  
  );
   
    array_push($response, $temp);




}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>