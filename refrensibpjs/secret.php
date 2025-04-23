<?php
//---------KSH DEV----------
// $consid = '14344';
// $date = date_create();
// $tgl_unix = date_timestamp_get( $date );
// $data = $consid.'&'.$tgl_unix;
// $secret = '4hB936038B';
// $signature = hash_hmac( 'sha256', $data, $secret, true );
// $encodesignature = base64_encode( $signature );
// $ppkksh = '1133R007';



$consid = '23127';
date_default_timezone_set( 'UTC' );
$tgl_unix = strval( time()-strtotime( '1970-01-01 00:00:00' ) );
$data = $consid.'&'.$tgl_unix;
// $secret = 'rs74klg75sht99';
$secret = '6sB3AE440B';
$signature = hash_hmac( 'sha256', $data, $secret, true );
$encodesignature = base64_encode( $signature );
//P
$userkey = '247d5932d20f31228bdaad6c9b9c9a39';




// // bhina
// $consid = '26815';
// date_default_timezone_set( 'UTC' );
// $tgl_unix = strval( time()-strtotime( '1970-01-01 00:00:00' ) );
// $data = $consid.'&'.$tgl_unix;
// // $secret = 'rs74klg75sht99';
// $secret = '5wAA824269';
// $signature = hash_hmac( 'sha256', $data, $secret, true );
// $encodesignature = base64_encode( $signature );
// //DEVELOMPENT

// $userkey =  '0f833100f1adf962c33465a9ed0a802d';




//D
// $userkey     = '9bf31948157af18404b0dc82389c535d';
// $userkey_sep =  'a3301847733a7498d0639d2ed793c724';

//-----------KSH Tayu------------------------
// $consid = '32286';
// date_default_timezone_set( 'UTC' );
// $tgl_unix = strval( time()-strtotime( '1970-01-01 00:00:00' ) );
// $data = $consid.'&'.$tgl_unix;
// $secret = '8bU8274926';
// $signature = hash_hmac( 'sha256', $data, $secret, true );
// $encodesignature = base64_encode( $signature );
// $userkey = 'f28e3b3d678c193a65a77bb8157c97c5';

// $consid = '25247';
// date_default_timezone_set( 'UTC' );
// $tgl_unix = strval( time()-strtotime( '1970-01-01 00:00:00' ) );
// $data = $consid.'&'.$tgl_unix;
// $secret = '8vWE39DC05';
// $signature = hash_hmac( 'sha256', $data, $secret, true );
// $encodesignature = base64_encode( $signature );
// $userkey = '6bc3d4458d8adbc856fb1539c9da78f4';
?>