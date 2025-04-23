<?php


//  header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");

  include 'sesi.php';
include 'fungsi.php';
include 'secretpcare.php';
include 'configpcare.php';




$data           = null;


$no=$_GET['no'];
$url = $serverklaim.'kunjungan/'.$no.'';
$headers = array(
      'Content-Type: Application/x-www-form-urlencoded',
    'X-cons-id: '.$consID.'',
    'X-timestamp: '.$tgl_unix.'',
    'X-signature: '.$encodedSignature.'',
    'X-authorization: Basic '.$encodedAuthorization.'',
    'user_key: '.$userkey.''
);
$kiriml = sendDataBpjs('DELETE', $url, $headers, $data );

$response           = json_decode( $kiriml, true );
if ( $response['metaData']['code'] == 200 && isset( $response['response'] ) ) {
    $key            = $consID.$secretKey.$tgl_unix;
    $dekrip         = stringDecrypt( $key, $response['response'] );
    $hasil_response = decompress( $dekrip );
    $kirim          = outData( $response['metaData']['code'], $response['metaData']['message'], $hasil_response );
}


echo json_encode($response);

?>