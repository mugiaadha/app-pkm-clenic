<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
 

 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);














$tgl = date("Y-m-d");


$conn -> autocommit(FALSE);
$idlokas = $data->idlokas;
$kodepos = $data->kodepos;
$hp = $data->hp;
$email = $data->email;
$diskripsipoli = $data->diskripsipoli;
$longtitude = $data->longtitude;
$latitude = $data->latitude;
$kdpoli = $data->kdpoli;
$kdcabang = $data->kdcabang;



$conn -> query("UPDATE poliklinik set

idsatusehat='$idlokas',kodepos='$kodepos',hp='$hp',email='$email',diskripsipoli='$diskripsipoli',
longtitude='$longtitude',latitude='$latitude',kdpolibpjs='$data->kdpolibpjs'
where kdpoli='$kdpoli' and kdcabang='$kdcabang' ");





// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode('Sukses');

}

// Rollback transaction
$conn -> rollback();

$conn -> close();





 




?>