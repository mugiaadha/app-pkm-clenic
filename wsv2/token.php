<?php
include 'sesi.php';
require 'vendor/autoload.php';
use \Firebase\JWT\JWT;


include 'fungsi.php';
$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$head = getallheaders();
$username =$head['x-username'];
$password = $head['x-password'];

//--------cek token---------------
if ( empty( $username ) && isset( $username ) == '' ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Username kosong atau tidak di kenal !'
        ),
        'response'=>null
    );

    echo json_encode( $pesan );
    exit;
}


if ( empty( $password ) && isset( $password ) == '' ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Password kosong atau tidak di kenal !'
        ),
        'response'=>null
    );

    echo json_encode( $pesan );
    exit;
}




try {

    include 'koneksi.php';
    $sql = "select * from wsuser where username='".$username."' and password='".$password."'";
    $query = $db->prepare( $sql );
    $query->execute();
    $c = $query->fetch();
    if ( !$c ) {
        $db = null;
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'User dan Password atau Token anda tidak cocok !'
            ),
            'response'=>null
        );

        echo json_encode( $pesan );
        exit;

    }
    $query->closeCursor();
	$db = null;
    $payload = array(
        'user' => $username,
        'password' => $password,
        'exp'      => time() + (5 * 60)
    );

    /**
    * IMPORTANT:
    * You must specify supported algorithms for your application. See
    * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
    * for a list of spec-compliant algorithms.
    */

    $jwt = JWT::encode( $payload, $key, 'HS256' );
    $token = base64_encode( $jwt );
    // $decoded = JWT::decode( $jwt, $key, array( 'HS256' ) );

    // $head = getallheaders();
    // $paijo = $head['Paijo'];

    $pesan = array(
        'metadata'=>array(
            'code'=>200,
            'message'=>'Ok'
        ),
        'response'=>array(
            'token'=>$token,
            // 'decrt'=>$decoded
        )
    );

    echo json_encode( $pesan );

} catch( PDOException $e ) {
    $db = null;
    $pesan = array(
        'metadata'=>array(
            'code'=>305,
            'message'=>$e->getMessage()
        ),
        'response'=>null
    );
    echo json_encde( $pesan );
    exit;
}

// print_r( $decoded->password );
?>