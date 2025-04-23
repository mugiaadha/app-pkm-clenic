<?php
include './sesi.php';
include '../inc/fungsi.php';
include '../inc/secret.php';
include './config.php';
date_default_timezone_set( 'Asia/Bangkok' );
$jenis          = $_GET['jenis'];
$tgl_kontrol    = date_format( date_create( $_GET['tgl_kontrol'] ), 'Y-m-d' );
$kd_poli        = $_GET['kd_poli'];
$data           = null;
$url            = $serverklaim.'RencanaKontrol/JadwalPraktekDokter/JnsKontrol/'.$jenis.'/KdPoli/'.$kd_poli.'/TglRencanaKontrol/'.$tgl_kontrol.'';
$headers        = array(
    'Content-Type: Application/x-www-form-urlencoded',
    'X-Cons-ID: '.$consid.'',
    'X-Timestamp: '.$tgl_unix.'',
    'X-Signature: '.$encodesignature.'',
    'user_key: '.$userkey_sep.''
);
$kirim              = sendDataBpjs( 'GET', $url, $headers, $data );
error_log( $kirim );
$response           = json_decode( $kirim, true );
if ( $response['metaData']['code'] == 200 && isset( $response['response'] ) ) {
    if ( $response['response'] != null ) {
        $key            = $consid.$secret.$tgl_unix;
        $dekrip         = stringDecrypt( $key, $response['response'] );
        $hasil_response = decompress( $dekrip );
        $kirim          = outData( $response['metaData']['code'], $response['metaData']['message'], $hasil_response );
    }
    else{
        $kirim          = noresponse( $response['metaData']['code'], $response['metaData']['message']); 
    }
} else {
    $kirim          = noresponse( $response['metaData']['code'], $response['metaData']['message']);
}

echo $kirim;
?>