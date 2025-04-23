<?php




header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$kdcabang=$_GET['kdcabang'];
$notrans=$_GET['notrans'];

$kdcppt='CPPT';







$queryx="SELECT  DISTINCT kd,kdpruduk,nama,aturan,qty,keterangan
FROM ermcpptintruksi WHERE 
notransaksi='$notrans' AND kdcabang='$kdcabang' AND dari='MObat'  and statuso='MRacik' AND dari2='$kdcppt'
order BY  tgl asc";



$resultx=mysqli_query($conn,$queryx);
 $rowcount=mysqli_num_rows($resultx);
  
if($rowcount > 0){

$query="SELECT  DISTINCT kd,kdpruduk,nama,aturan,qty,keterangan,notransaksi,kdpoli
FROM ermcpptintruksi WHERE 
notransaksi='$notrans' AND kdcabang='$kdcabang' AND dari='MObat'  and statuso='MRacik' AND dari2='$kdcppt'
order BY  tgl asc";


$response=array();
$result=mysqli_query($conn, $query);


while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$kd = $row["kd"];


$queryx="SELECT * FROM ermcpptintruksi 
WHERE notransaksi='$notrans' AND kdcabang='$kdcabang' AND dari='Obat'  and statuso='Racik' AND dari2='$kdcppt' and
kd='$kd' order BY  tgl asc ";
$responsex=array();
$resultx=mysqli_query($conn, $queryx);

while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {

   $responsex[]=$rowx;




}



    $temp = array(
   "kdtamplated" => $kd,
   "namaracik" => $row['kdpruduk'],
   "metode" => $row['nama'],
"aturan" => $row['aturan'],
"qty" => $row['qty'],
"keterangan" => $row['keterangan'],
"notransaksi" => $row['notransaksi'],
"kdpoli" => $row['kdpoli'],
   "detail" => $responsex

);
   
    array_push($response, $temp);








}



}else{



   $query="SELECT  DISTINCT kd
FROM ermcpptintruksi WHERE 
notransaksi='$notrans' AND kdcabang='$kdcabang' AND dari='obat'  and statuso='racik' AND dari2='$kdcppt'
order BY  tgl asc";


$response=array();
$result=mysqli_query($conn, $query);


while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$kd = $row["kd"];


$queryx="SELECT * FROM ermcpptintruksi 
WHERE notransaksi='$notrans' AND kdcabang='$kdcabang' AND dari='Obat'  and statuso='Racik' AND dari2='$kdcppt' and
kd='$kd' order BY  tgl asc ";
$responsex=array();
$resultx=mysqli_query($conn, $queryx);

while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {

   $responsex[]=$rowx;




}



    $temp = array(
   "kdtamplated" => $kd,
   "namaracik" => '',
   "metode" => '',
"aturan" => '',
"qty" => '',
"keterangan" => '',
   "detail" => $responsex

);
   
    array_push($response, $temp);








}



}



















$data = json_encode($response);



echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>