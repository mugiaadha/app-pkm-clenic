<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';


$kdcabang=$_GET['kdcabang'];

date_default_timezone_set( 'Asia/Bangkok' );


$tgl = date("Y-m-d");


$tgl2 = date('Y-m-d', strtotime('-7 days', strtotime($tgl))); //operasi penjumlahan tanggal sebanyak 6 hari





$query="SELECT distinct a.tglpriksa
FROM kunjunganpasien a ,poliklinik b

WHERE 
a.kdpoli = b.kdpoli and
a.kdcabang='$kdcabang'  AND a.tglpriksa BETWEEN '$tgl2' AND '$tgl' ORDER BY a.tglpriksa asc";



$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {


$temp = array(


   "tgl" => $row["tglpriksa"],  




);
   
    array_push($response, $temp);



}




 $data = json_encode($response);
 
echo ($data);

mysqli_close($conn);


?>