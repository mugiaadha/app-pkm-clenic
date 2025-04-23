<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$nama=$_GET['nama'];




$query="SELECT
a.*
FROM obat a 


WHERE kdcabang ='$kdcabang' and obat like '%$nama%'

order by  kdobat asc limit 20 ";



$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {



$temp = array(


   "kdobat" => $row["kdobat"],  
"obat" => $row["obat"],
"obatx" => $row["obat"],



);
   
    array_push($response, $temp);



}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>