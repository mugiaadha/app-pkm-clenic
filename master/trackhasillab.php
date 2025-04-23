<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$norm=$_GET['norm'];
$kdlab=$_GET['kdlab'];



$query="SELECT a.hasil,b.tgl 

FROM hasillab a,hasilabm b
WHERE a.notrans = b.notrans AND a.kdlab='$kdlab' and a.norm='$norm' AND a.kdcabang='$kdcabang'  ORDER BY tgl asc";



$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {



$temp = array(


   "hasil" => $row["hasil"],  

"tgl" => $row["tgl"],



);
   
    array_push($response, $temp);



}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>