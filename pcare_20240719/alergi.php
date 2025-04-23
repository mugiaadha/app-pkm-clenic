<?php
include 'sesi.php';
include 'fungsi.php';
include 'secretpcare.php';
include 'configpcare.php';
date_default_timezone_set( 'Asia/Bangkok' );

$data           = null;


$no=$_GET['no'];

$url=$serverklaim.'alergi/jenis/'.$no.'';





$headers        = array(
    'Content-Type: Application/x-www-form-urlencoded',
    'X-cons-id: '.$consID.'',
    'X-timestamp: '.$tgl_unix.'',
    'X-signature: '.$encodedSignature.'',
    'X-authorization: Basic '.$encodedAuthorization.'',
    'user_key: '.$userkey.''
);

// error_log($url);

$kirim              = sendDataBpjs( 'GET', $url, $headers, $data );
$response           = json_decode( $kirim, true );
if ( $response['metaData']['code'] == 200 && isset( $response['response'] ) ) {
    $key            = $consID.$secretKey.$tgl_unix;
    $dekrip         = stringDecrypt( $key, $response['response'] );
    $hasil_response = decompress( $dekrip );
    $kirim          = outData( $response['metaData']['code'], $response['metaData']['message'], $hasil_response );
}

echo $kirim;




// $data = ' {
//   "response": {
//       "list": [
//           {
//               "kdAlergi": "00",
//               "nmAlergi": "Tidak Ada"
//           },
//           {
//               "kdAlergi": "01",
//               "nmAlergi": "Seafood"
//           },
//           {
//               "kdAlergi": "02",
//               "nmAlergi": "Gandum"
//           },
//           {
//               "kdAlergi": "03",
//               "nmAlergi": "Susu Sapi"
//           },
//           {
//               "kdAlergi": "04",
//               "nmAlergi": "Kacang-Kacangan"
//           },
//           {
//               "kdAlergi": "05",
//               "nmAlergi": "Makanan Lain"
//           }
//       ]
//   },
//   "metaData": {
//       "message": "OK",
//       "code": 200
//   }
// }';


//         echo $data;

?>