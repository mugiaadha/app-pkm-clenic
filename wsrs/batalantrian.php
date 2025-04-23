<?php
include 'sesi.php';
include 'fungsi.php';


date_default_timezone_set( 'Asia/Bangkok' );
$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );

$no_trans       = $_POST['kodebooking'];
$email          = 'BPJS';
$ket            = $_POST['keterangan'];

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

if ( strlen( $no_trans ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'kode booking belum ada!'
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

  

    //-------------------- detail pemeriksaan ---------------------------------------------------
    $sql = "select notransaksi  from transaksipasiend where notransaksi='".$no_trans."'";
    $query = $db->prepare( $sql );
    $query->execute();
    $c = $query->fetch();
    if ( $c ) {
        $query->closeCursor();
        $db = null;
        $data = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Anda Sudah melakukan pemeriksaan'
            ),
            'response'=>null
        );

        echo json_encode( $data );
        exit;
    }
    $query->closeCursor();


       $sql = "select notrans  from batalpriksa where notrans='".$no_trans."'";
    $query = $db->prepare( $sql );
    $query->execute();
    $c = $query->fetch();
    if ( $c ) {
        $query->closeCursor();
        $db = null;
        $data = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Anda Sudah melakukan Pembatalan'
            ),
            'response'=>null
        );

        echo json_encode( $data );
        exit;
    }
    $query->closeCursor();




    // //------------------------------------ Cek SEP ------------------------------------------------


    try {
        $db->beginTransaction();
        $sql = "select * from antrian where notransaksi='".$no_trans."'";
        $query = $db->prepare( $sql );
        $query->execute();
        $b = $query->fetch();
        if ( !$b ) {
            $db->rollback();
            $db = null;
            $data = array(
                'metadata'=>array(
                    'code'=>201,
                    'message'=>'Nomer Transasi tidak di temukan !'
                ),
                'response'=>null
            );
            echo json_encode( $data );
            exit;
        }




     $sql = "INSERT INTO batalpriksa(notrans,keterangan,kduser) values
                ('".$no_trans."','".$ket."','".$email."')";
            $query = $db->prepare( $sql );
            $query->execute();
            $query->closeCursor();




       

        $sql = '';
        $sql = "delete from antrian where notransaksi='".$no_trans."'";
        $query = $db->prepare( $sql );
        $query->execute();
        $query->closeCursor();
        //----------------------------------------------------------------------
        $sql = '';
        $sql = "delete from kunjunganpasien where notransaksi='".$no_trans."'";
        $query = $db->prepare( $sql );
        $query->execute();
        $query->closeCursor();

        $sql = '';
        $sql = "delete from transaksipasien where notransaksi='".$no_trans."'";
        $query = $db->prepare( $sql );
        $query->execute();
        $query->closeCursor();
        $db->commit();

        $db = null;
        $data = array(
            'metadata'=>array(
                'code'=>200,
                'message'=>'Pembatalan antrean Sukses !'
            ),
            'response'=>null
        );
        echo json_encode( $data );
        exit;

    } catch( PDOException $e ) {
        $db->rollback();
        $db = null;
        $data = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Gagal melakukan Pembatalan antrean !'
            ),
            'response'=>null
        );
        echo json_encode( $data );
        exit;
    }

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