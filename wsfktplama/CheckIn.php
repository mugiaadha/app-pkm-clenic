<?php
include 'sesi.php';
include 'fungsi.php';

date_default_timezone_set( 'Asia/Bangkok' );
$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );

$no_temp        = $_POST['kodebooking'];
$waktu          = $_POST['waktu'] / 1000;
$waktu= date('Y-m-d H:i:s', $waktu); // output as RFC 2822 date - returns local time
// error_log($waktu);

$head = getallheaders();
//--------cek token---------------s
if ( empty( $head['x-token'] ) && isset( $head['x-token'] ) == '' ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Token kosong atau tidak di kenal !'
        ),
        'response'=>null
    );

    echo json_encode( $pesan );
    exit;
}

if ( empty( $head['x-username'] ) ) {
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

$token = str_replace( '"', '', $head['x-token'] );
$token = str_replace( "'", '', $token );
$username = str_replace( '"', '', $head['x-username'] );
$username = str_replace( "'", '', $username );

//---------------------------------------------------------
try {
    include 'koneksi.php';
    $coba = cek_token( $token, $key, $username, $db );

    if ( $coba == 0 || $coba == 2 ) {
        $db = null;
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'User dan Token anda tidak cocok atau Token Expired !'
            ),
            'response'=>null
        );

        echo json_encode( $pesan );
        exit;
    }

    $sql    = "";
    $sql    = "update antrian set jam_datang='".$waktu."' where no_transaksi ='".$no_temp."'";
    // error_log($sql);
    $query  = $db->prepare($sql);
    $query  -> execute();
    $db = null;
    $pesan = array(
        'metadata'=>array(
            'code'=>200,
            'message'=>"Ok"
        ),
        'response'=>null
    );

    echo json_encode( $pesan );
    exit;

} catch( PDOException $e ) {
    $db = null;
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>$e->getMessage()
        ),
        'response'=>null
    );

    echo json_encode( $pesan );
    exit;
}

?>