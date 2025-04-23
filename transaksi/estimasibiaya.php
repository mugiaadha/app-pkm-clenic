<?php




header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$kdcabang=$_GET['kdcabang'];
$notrans=$_GET['notrans'];







   $query="SELECT DISTINCT dari,notransaksi 
FROM ermcpptintruksi WHERE notransaksi='$notrans' AND dari <> 'mobat' and kdcabang='$kdcabang'";


$response=array();
$result=mysqli_query($conn, $query);


while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$dari = $row["dari"];
$notransaksi = $row["notransaksi"];


$queryx="SELECT * FROM ermcpptintruksi 
WHERE notransaksi='$notrans' AND kdcabang='$kdcabang' AND dari='$dari' order BY  tgl asc ";
$responsex=array();
$resultx=mysqli_query($conn, $queryx);

while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {

   $responsex[]=$rowx;




}



    $temp = array(
   "dari" => $dari,
   
"notransaksi" =>$notransaksi,
   "detail" => $responsex

);
   
    array_push($response, $temp);








}























$data = json_encode($response);



echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>