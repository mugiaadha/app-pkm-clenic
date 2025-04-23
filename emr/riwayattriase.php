<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$data=$_GET['data'];
$status = $_GET['status'];





if($status === '1'){
$query="SELECT * from emrigdtriase where notransaksi='$data' order by tgl desc ";

}else{
$query="SELECT norm,notransaksi,tgl from emrigdtriase where norm='$data' ";

}
$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>