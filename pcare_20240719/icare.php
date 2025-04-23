<?php
// include 'sesi.php';
 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  
  
include 'fungsi.php';
// include 'secretpcare.php';
include 'scicare.php';



date_default_timezone_set( 'Asia/Bangkok' );
$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST['data'] );


// $url = $serverklaim.'pendaftaran';
// $url = 'https://apijkn.bpjs-kesehatan.go.id/wsihs/api/pcare/validate';
$url='https://apijkn-dev.bpjs-kesehatan.go.id/ihs_dev/api/pcare/validate';


$headers = array(
      'Content-Type: Application/json',
    'X-cons-id: '.$consID.'',
    'X-timestamp: '.$tgl_unix.'',
    'X-signature: '.$encodedSignature.'',
    'X-authorization: Basic '.$encodedAuthorization.'',
    'user_key: '.$userkey.''
);




$kiriml = sendDataBpjs( 'POST', $url, $headers, $data );

$response           = json_decode( $kiriml, true );

    $key            = $consID.$secretKey.$tgl_unix;
    $dekrip         = stringDecrypt( $key, $response['response'] );
    $hasil_response = decompress( $dekrip );
    $kirim          = outData( $response['metaData']['code'], $response['metaData']['message'], $hasil_response );



echo $kirim;

?>