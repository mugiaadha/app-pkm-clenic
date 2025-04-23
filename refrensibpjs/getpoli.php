<?php
include 'sesi.php';
include 'fungsi.php';
include 'secret.php';
include 'config.php';
date_default_timezone_set( 'Asia/Bangkok' );


$data           = null;
$url            = $serverklaim.'ref/poli';
$headers = array(
    'x-cons-id: '.$consid.'',
    'x-timestamp: '.$tgl_unix.'',
    'x-signature: '.$encodesignature.'',
    'user_key: '.$userkey.''
);
$kirim          = sendDataBpjs( 'GET', $url, $headers, $data );

$response       = json_decode( $kirim, true );

    $key            = $consid.$secret.$tgl_unix;
    $dekrip         = stringDecrypt( $key, $response['response'] );
    $hasil_response = decompress( $dekrip );
    $kirim          = outData( $response['metadata']['code'], $response['metadata']['message'], $hasil_response );
 

echo $kirim;

?>