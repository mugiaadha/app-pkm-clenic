<?php


include 'sesi.php';
include 'fungsi.php';
include 'secretpcare.php';
include 'configpcare.php';



$data           = null;


$kdtindakan=$_GET['kdtindakan'];
$nokunjungan = $_GET['nokunjungan'];
$url = $serverklaim.'tindakan/'.$kdtindakan.'/kunjungan/'.$nokunjungan.'';
$headers = array(
      'Content-Type: Application/x-www-form-urlencoded',
    'X-cons-id: '.$consID.'',
    'X-timestamp: '.$tgl_unix.'',
    'X-signature: '.$encodedSignature.'',
    'X-authorization: Basic '.$encodedAuthorization.'',
    'user_key: '.$userkey.''
);
$kirim = sendDataBpjs('DELETE', $url, $headers, $data );

$response           = json_decode( $kirim, true );
if ( $response['metaData']['code'] == 200 && isset( $response['response'] ) ) {
    $key            = $consID.$secretKey.$tgl_unix;
    $dekrip         = stringDecrypt( $key, $response['response'] );
    $hasil_response = decompress( $dekrip );
    $kirim          = outData( $response['metaData']['code'], $response['metaData']['message'], $hasil_response );
}


echo $kirim;

?>