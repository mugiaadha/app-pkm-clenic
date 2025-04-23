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

    // //------------Ambil No Booking-------------------------------------------------------------
    // $sql = '';
    // $sql = "select no_transaksi from antrian where no_temp='".$no_temp."'";
    // $query  = $db->prepare( $sql );
    // $query  -> execute();
    // $d      = $query->fetch();
    // if ( !$d ) {
    //     $db = null;
    //     $query      -> closeCursor();
    //     $pesan = array(
    //         'metadata'=>array(
    //             'code'=>300,
    //             'message'=>'Kode Booking Tidak di temukan !'
    //         ),
    //         'response'=>null
    //     );

    //     echo json_encode( $pesan );
    //     exit;
    // }

    // $no_trans  = $d['no_transaksi'];
    // $query      -> closeCursor();

    //-------------------- detail pemeriksaan ---------------------------------------------------
    $sql = "select FDTNO_TRANSAKSI  from TRANSAKSIPASIEND where FDTNO_TRANSAKSI='".$no_trans."'";
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

    // //------------------------------------ Cek SEP ------------------------------------------------
    // $sql = "select FMNOTRANSAKSI  from BPJS_SEP where FMNOTRANSAKSI='".$no_trans."'";
    // $query = $db->prepare( $sql );
    // $query->execute();
    // $c = $query->fetch();
    // if ( $c ) {
    //     $query->closeCursor();
    //     $db = null;
    //     $data = array(
    //         'metadata'=>array(
    //             'code'=>300,
    //             'message'=>'Anda Sudah Membuat SEP BPJS, Hubungi Admin untuk membatalkan pemeriksaan !'
    //         ),
    //         'response'=>null
    //     );
    //     echo json_encode( $data );
    //     exit;
    // }
    // $query->closeCursor();

    try {
        $db->beginTransaction();
        $sql = "select convert(date,tgl_periksa) as tgl,no_urut,kd_poly,kd_dokter,kdkloter from antrian where no_transaksi='".$no_trans."'";
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

        $tgl_periksa    = $b['tgl'];
        $no_urut        = $b['no_urut'];
        $kd_poli        = $b['kd_poly'];
        $kd_dokter      = $b['kd_dokter'];
        $kdkloter       = $b['kdkloter'];
        $query          ->closeCursor();

        $sql = '';
        $sql = "select no_urut from antrian_batal where tgl_periksa='".$tgl_periksa."' and 
            no_urut='".$no_urut."' and kd_poly='".$kd_poli."' and kd_dokter='".$kd_dokter."'
            and sts=0 and kdkloter='".$kdkloter."'";
        $query = $db->prepare( $sql );
        $query->execute();
        $dk = $query->fetch();
        if ( !$dk ) {

            $sql = '';
            $sql = "insert into antrian_batal(NO_URUT, STS, TGL_PERIKSA,KD_POLY,KD_DOKTER,EMAIL,KDKLOTER) values
                ('".$no_urut."','0','".$tgl_periksa."','".$kd_poli."','".$kd_dokter."','".$email."','".$kdkloter."')";
            $query = $db->prepare( $sql );
            $query->execute();
            $query->closeCursor();
        }

        $sql = '';
        $sql = "delete from kunjunganpasien where kpno_transaksi='".$no_trans."'";
        $query = $db->prepare( $sql );
        $query->execute();
        $query->closeCursor();
        //----------------------------------------------------------------------
        $sql = '';
        $sql = "delete from antrian where no_transaksi='".$no_trans."'";
        $query = $db->prepare( $sql );
        $query->execute();
        $query->closeCursor();

        $sql = '';
        $sql = "delete from screningrj where notrans='".$no_trans."'";
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