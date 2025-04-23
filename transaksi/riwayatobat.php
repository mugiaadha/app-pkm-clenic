<?php




header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$kdcabang=$_GET['kdcabang'];
$norm=$_GET['norm'];







   $query="SELECT DISTINCT tglpriksa ,dari,norm,notransaksi FROM ermcpptintruksi WHERE norm='$norm' 
AND  dari ='obat' and kdcabang='$kdcabang'  order by tglpriksa desc";


$response=array();
$result=mysqli_query($conn, $query);


while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$tglpriksa = $row["tglpriksa"];
$dari = $row["dari"];
$norm = $row["norm"];
$notransaksi = $row["notransaksi"];


$queryx="SELECT dari,statuso,kdpruduk,nama,norm,notransaksi,aturan,qty FROM ermcpptintruksi WHERE norm='$norm' 
AND  dari ='$dari' and notransaksi='$notransaksi' order by tglpriksa ";
$responsex=array();
$resultx=mysqli_query($conn, $queryx);

while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {

   $responsex[]=$rowx;




}



    $temp = array(
   "dari" => $dari,
     "tglpriksa" => $tglpriksa,
"notransaksi" =>$notransaksi,
   "detail" => $responsex

);
   
    array_push($response, $temp);








}























$data = json_encode($response);



echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>