<?php
include 'sesi.php';
// include 'fungsi.php';
 include 'koneksi.php';


date_default_timezone_set( 'Asia/Bangkok' );
$rest_json = file_get_contents( 'php://input' );




// $_GET = json_decode( $rest_json, true );

$noorder=$_GET['NoOrder'];
 



$sql = "select a.id,notransaksi,kodepemeriksaan,namapemeriksaan ,b.MTLSATUAN,a.status
from ORDERLABLIS a , LAB_TEST b where Status='1' and a.kodepemeriksaan = b.MTLKD_LAB and notransaksi='$noorder' and Status='1' ";

$query = $db->prepare( $sql );
$query->execute();
$data = array();
while( $c = $query->fetch() ) {
   
    $data[] = array(
        'DetailID'=>$c['id'],
        'NoOrder'=>$c['notransaksi'],
        "ParameterID" =>$c['kodepemeriksaan'],
"Parameter"=>$c['namapemeriksaan'],
"Satuan" =>$c['MTLSATUAN'],
 "NilaiNormal" => "",
"Metode" => null,
"Hasil" => null,
"Flag" => "",
"KodeACC" => null,
"Status"=> null
    );





 


}

$pesan = array(
    'status'=>200,
    'message'=>"Data has been listed.",
    'data'=>$data



);

echo json_encode( $pesan );


  
?>