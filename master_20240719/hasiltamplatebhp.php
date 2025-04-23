<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];




   $nama=$_GET['nama'];
$query="SELECT distinct
a.kdtamplated,nama,status
FROM tplaning a
WHERE  a.nama LIKE
 '%$nama%'  AND a.kdcabang='$kdcabang' order by a.nama asc LIMIT 20";


$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
// $response[]=$row;





$kd = $row["kdtamplated"];


$queryx="SELECT
a.*,b.standart,b.obat
FROM tplaning a, obat b
WHERE a.kdobat = b.kdobat AND a.kdtamplated='$kd' 
union
SELECT
a.*,0 as standart,a.obat
FROM tplaningr a
WHERE a.kdtamplated='$kd' order by standart";
$responsex=array();
$resultx=mysqli_query($conn, $queryx);

while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {

   $responsex[]=$rowx;




}



    $temp = array(
   "kdtamplated" => $row["kdtamplated"],
   "nama" => $row["nama"],
   "status" => $row["status"],
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