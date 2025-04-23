<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$data=$_GET['data'];
$status = $_GET['status'];





if($status === '1'){
$query="SELECT 
*
FROM emrasesmenkep 
WHERE notransaksi='$data'";
}else{
$query="SELECT 
*
FROM emrasesmenkep 
WHERE norm='$data' order by tgl asc";

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