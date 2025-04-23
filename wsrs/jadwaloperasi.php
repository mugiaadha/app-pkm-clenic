<?php
include 'sesi.php';
include 'fungsi.php';
$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );

$tgl_awal = $_POST['tanggalawal'];
$tgl_akhir = $_POST['tanggalakhir'];

if ( !preg_match( "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $tgl_awal ) ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Format tanggal tidak sesuai, Format yang benar yyyy-mm-dd'
        ),
        'response'=>null
    );
    echo json_encode( $pesan );
    exit;
}

if ( !preg_match( "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $tgl_akhir) ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Format tanggal tidak sesuai, Format yang benar yyyy-mm-dd'
        ),
        'response'=>null
    );
    echo json_encode( $pesan );
    exit;
}



if ( strtotime( $tgl_awal ) > strtotime( $tgl_akhir ) ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Tgl Awal tidak boleh lebih besar dari Tgl Ahir !'
        ),
        'response'=>null
    );

    echo json_encode( $pesan );
    exit;
}

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




          $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Tidak ada jadwal Operasi pada Tanggal Tersebut'
        ),
        'response'=>null
    );
    echo json_encode( $pesan );
    exit;



    }

   

    } else {
        $db = null;
        $query->closeCursor();
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Tidak ada Jadwal OK, Untuk Pasien BPJS !'
            ),
            'response'=>null
        );

        echo json_encode( $pesan );
        exit;

    }
    $query->closeCursor();
    //----------------------------------------------

    $pesan = array(
        'metadata'=>array(
            'code'=>200,
            'message'=>'Ok'
        ),
        'response'=>array( 'list'=>$data )
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