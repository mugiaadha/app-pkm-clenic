<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$kdcabang=$_GET['kdcabang'];
$sts=$_GET['sts'];


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

$tglar = $row["tglpriksa"];

$queryx="SELECT sum(a.ttl) AS total
FROM kunjunganpasien a ,poliklinik b,kelompokkostumerd c,kelompokkostumer d

WHERE 
a.kdpoli = b.kdpoli AND a.kdkostumerd = c.kdkostumerd AND c.kdkostumer = d.kdkostumer and
a.kdcabang='$kdcabang'  AND a.tglpriksa = '$tglar' AND dash='$sts'";
// $responsex=array();
$resultx=mysqli_query($conn, $queryx);
while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {


   $responsex=$rowx['total'];
}



$temp = array(


   "tgl" => $row["tglpriksa"],  
 "jml" => $responsex,  




);
   
    array_push($response, $temp);



}




 $data = json_encode($response);
 
echo ($data);

mysqli_close($conn);


?>