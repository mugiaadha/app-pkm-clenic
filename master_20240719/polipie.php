<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];

date_default_timezone_set( 'Asia/Bangkok' );


// $tgl = date("Y-m-d");
$tgl=$_GET['tgl'];

$query="SELECT DISTINCT
b.nampoli,a.kdpoli
FROM kunjunganpasien a ,poliklinik b

WHERE 
a.kdpoli = b.kdpoli and
a.kdcabang='$kdcabang' and a.tglpriksa='$tgl'  order by a.kdpoli asc ";



$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$kdpoli=$row['kdpoli'];

$queryx="SELECT SUM(ttl) AS ttl
FROM kunjunganpasien a ,poliklinik b

WHERE 
a.kdpoli = b.kdpoli and
a.kdcabang='$kdcabang'  AND a.kdpoli='$kdpoli' and a.tglpriksa='$tgl'  ORDER BY a.kdpoli asc ";
$resultx=mysqli_query($conn, $queryx);
while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {

$ttl = $rowx['ttl'];
}

$temp = array(


   "nampoli" => $row["nampoli"],  
"kdpoli" => $row["kdpoli"],
"ttl" => $ttl ,



);
   
    array_push($response, $temp);



}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>