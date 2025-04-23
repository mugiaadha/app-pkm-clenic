<?php
$key = 'bhina';
$aktif_rujuk = 0;
require 'vendor/autoload.php';
use \Firebase\JWT\JWT;

function cek_token( $token, $key, $user_name, $db ) {
    $token = base64_decode( $token );
    try{
        $decoded = JWT::decode( $token, $key, array( 'HS256' ) );
        $username = $decoded->user;
        $password = $decoded->password;

        if ( $username != 0 ) {
            if ( $username != $user_name ) {
                $hasil = 2;
                return $hasil ;

            }
        }

        //-----------cek user----------------
        $sql = "select * from wsuser where username='".$username."' and password='".$password."'";
        $query = $db->prepare( $sql );
        $query->execute();
        $c = $query->fetch();
        if ( !$c ) {
            $hasil = 0;
        } else {
            $hasil = 1;
        }
        $query->closeCursor();
    }
    catch(Exception $e){
        $hasil =0;
    }
    
    return $hasil;
}

function logData( $r_data = array() )
 {
    file_put_contents( 'log.txt', print_r( $arr, true ) );
}

function getData( $url, $data, $consid, $timestamp, $signature, $method ) {
    $headers = array(
        'Content-Type   : application/x-www-form-urlencoded',
        'X-cons-id      : '.$consid.'',
        'X-timestamp    : '.$timestamp.'',
        'X-signature    : '.$signature.''
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

?>