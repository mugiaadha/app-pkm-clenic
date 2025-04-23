<?php
// include 'sesi.php';
//  header("Access-Control-Allow-Origin: *");
//   header('Access-Control-Allow-Headers: Origin,Content-Type');
  
  
// include 'fungsi.php';
// include 'secretpcare.php';
// include 'configpcare.php';



// date_default_timezone_set( 'Asia/Bangkok' );
// $rest_json = file_get_contents( 'php://input' );
// $_POST = json_decode( $rest_json, true );
// $data = json_encode( $_POST['data'] );


// $url = $serverklaim.'pendaftaran';
// $headers = array(
//       'Content-Type: Application/x-www-form-urlencoded',
//     'X-cons-id: '.$consID.'',
//     'X-timestamp: '.$tgl_unix.'',
//     'X-signature: '.$encodedSignature.'',
//     'X-authorization: Basic '.$encodedAuthorization.'',
//     'user_key: '.$userkey.''
// );
// $kirim = sendDataBpjs( 'POST', $url, $headers, $data );

// $response           = json_decode( $kirim, true );
// if ( $response['metaData']['code'] == 201 && isset( $response['response'] ) ) {
//     $key            = $consID.$secretKey.$tgl_unix;
//     $dekrip         = stringDecrypt( $key, $response['response'] );
//     $hasil_response = decompress( $dekrip );
//     $kirim          = outData( $response['metaData']['code'], $response['metaData']['message'], $hasil_response );
// }


// echo $kirim;
header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  
  
include 'fungsi.php';
include 'secretpcare.php';
include 'configpcare.php';



date_default_timezone_set( 'Asia/Bangkok' );
$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST['data'] );
$data = json_decode( $data);

$tglsimpan = date("d-m-Y");



  $value = array(
  
  "kdProviderPeserta" =>  $data->kdProviderPeserta,
  "tglDaftar" =>  $tglsimpan,
  "noKartu" => $data->noKartu,
  "kdPoli" =>   $data->kdPoli,
  "keluhan" =>  $data->keluhan,
  "kunjSakit" =>  $data->kunjSakit,
  "sistole" =>  $data->sistole,
  "diastole" =>   $data->diastole,
  "beratBadan"=>  $data->beratBadan,
  "tinggiBadan"=>  $data->tinggiBadan,
  "respRate"=> $data->respRate,
  "lingkarPerut"=> $data->lingkarPerut,
  "heartRate"=> $data->heartRate,
  "rujukBalik"=> $data->rujukBalik,
  "kdTkp"=>  $data->kdTkp


);


$data = json_encode( $value );



$url = $serverklaim.'pendaftaran';
$headers = array(
      'Content-Type: Application/x-www-form-urlencoded',
    'X-cons-id: '.$consID.'',
    'X-timestamp: '.$tgl_unix.'',
    'X-signature: '.$encodedSignature.'',
    'X-authorization: Basic '.$encodedAuthorization.'',
    'user_key: '.$userkey.''
);
$kirim = sendDataBpjs( 'POST', $url, $headers, $data );

$response           = json_decode( $kirim, true );
// if ( $response['metaData']['code'] == 201 && isset( $response['response'] ) ) {
    $key            = $consID.$secretKey.$tgl_unix;
    $dekrip         = stringDecrypt( $key, $response['response'] );
    $hasil_response = decompress( $dekrip );
    $kirim          = outData( $response['metaData']['code'], $response['metaData']['message'], $hasil_response );
// }


echo $kirim;
?>