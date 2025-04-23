<?php
require_once '../vendor/autoload.php';
// $base_wsantri   = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/rjt/ws_antrianbpjs/';
$base_wsantri   = 'http://'.$_SERVER['SERVER_NAME'].'/rj/ws_antrianbpjs/';
$base_wskontrol   = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/rjt/ws_kontrol/';


// error_log($base_wsantri);
$bpjs_aktif     = 1;
// ---------------------------- Aktif | dead --------------------------------------------------------------

function stringDecrypt( $key, $string ) {
    $encrypt_method = 'AES-256-CBC';
    // hash
    $key_hash = hex2bin( hash( 'sha256', $key ) );

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr( hex2bin( hash( 'sha256', $key ) ), 0, 16 );
    $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv );
    // error_log( 'Output : '.$output );
    return $output;
}

// function lzstring decompress https://github.com/nullpunkt/lz-string-php
function decompress( $string ) {
    return \LZCompressor\LZString::decompressFromEncodedURIComponent( $string );
}

function sendDataBpjs( $method, $url, $headers, $data ) {
    $ch = curl_init();

    if ( $method == 'POST' ) {
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
        
    } elseif ( $method == 'PUT' || $method == 'DELETE' ) {
        // error_log( 'method : '.$method );
        curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, $method );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
    }

    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
    // curl_setopt( $ch, CURLOPT_SSLVERSION, 5 );

    $result = curl_exec( $ch );
    // error_log( curl_getInfo( $ch, CURLINFO_HTTP_CODE ) );
    curl_close( $ch );
    unset( $data );
    return $result;
}

function sendData( $method, $url, $data ) {
    $headers = array(
        'content-type:application/x-www-form-urlencoded'
    );
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );

    if ( $method == 'POST' ) {
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
    }
    $result = curl_exec( $ch );
    curl_close( $ch );

    unset( $data );
    return $result;
}

function outData( $code, $message, $response ) {
    return '{
        "metaData": {
            "code": "'.$code.'",
            "message": "'.$message.'"
        },
        "response" : '.$response.'
    }';
}
function outDatax($code, $message, $response) {
    return json_encode([
        'metaData' => [
            'code' => $code,
            'message' => $message
        ],
        'response' => $response ?? new stdClass()
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
function noresponse( $code, $message) {
    return '{
        "metaData": {
            "code": "'.$code.'",
            "message": "'.$message.'"
        }
    }';
}

?>