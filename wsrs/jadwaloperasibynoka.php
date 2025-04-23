<?php
include 'sesi.php';
include 'fungsi.php';
$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );

$kartu =$_POST['nopeserta'];

$head = getallheaders();
//--------cek token---------------
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



if ( strlen( $kartu ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'No Kartu  belum ada!'
        ),
        'response'=>null
    );

    echo json_encode( $pesan );
    exit;

}





$token = str_replace( '"', '', $head['x-token'] );
$token = str_replace( "'", '', $token );




try {
    include 'koneksi.php';
    $coba = cek_token( $token, $key, 0, $db );

    if ( $coba == 0 ) {
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


         $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Noka Tidak ada jadwal Operasi'
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

// print_r( $decoded->password );
?>