<?php
include 'sesi.php';
include 'fungsi.php';
include 'secretpcare.php';
// include 'configpcare.php';
date_default_timezone_set( 'Asia/Bangkok' );

$data           = null;

$kdpoli=$_GET['kdpoli'];
$tgl=$_GET['tgl'];

$url="https://apijkn.bpjs-kesehatan.go.id/antreanfktp/ref/dokter/kodepoli/".$kdpoli."/tanggal/".$tgl."";





$headers        = array(
    'Content-Type: Application/x-www-form-urlencoded',
    'x-cons-id: '.$consID.'',
    'x-timestamp: '.$tgl_unix.'',
    'x-signature: '.$encodedSignature.'',
    'x-authorization: Basic '.$encodedAuthorization.'',
    'user_key: '.$userkeyan.''
);



$kiriml              = sendDataBpjs( 'GET', $url, $headers, $data );
$response           = json_decode( $kiriml, true );
// if ( $response['metaData']['code'] == 200 && isset( $response['response'] ) ) {
    $key            = $consID.$secretKey.$tgl_unix;
    $dekrip         = stringDecrypt( $key, $response['response'] );
    $hasil_response = decompress( $dekrip );
    $kirim          = outData( $response['metaData']['code'], $response['metaData']['message'], $hasil_response );
// }

echo $kirim;

?>