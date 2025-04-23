<?php
include 'sesi.php';
include 'fungsi.php';

date_default_timezone_set( 'Asia/Bangkok' );
$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );

$kd_booking = $_POST['kodebooking'];
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

if ( empty( $kd_booking ) ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Kode Booking tidak boleh kosong'

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

    //-------------------------------------------------
    $sql = '';
    $sql = "select a.NO_URUT,a.tgl_periksa,a.kd_dokter,a.kd_poly,a.NM_DOKTER,b.FMPKLINIKN as KLINIK,a.JAM_DATANG,a.JAM_PELAYANAN,a.JAM_SELESAI,a.KDKLOTER 
        from ANTRIAN a left JOIN POLIKLINIK b ON a.KD_POLY=b.FMPKLINIK_ID
        WHERE a.NO_TRANSAKSI='".$kd_booking."'";

    $query      = $db->prepare( $sql );
    $query      -> execute();
    $d          = $query ->fetch();
    if ( !$d ) {
        $db = null;
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Kode Booking tidak di temukan '
            ),
            'response'=>null
        );

        echo json_encode( $pesan );
        exit;
    }

    $nomer          = ( int )$d['NO_URUT'];
    $kd_dokterrs    = $d['kd_dokter'];
    $dokter         = $d['NM_DOKTER'];
    $kd_polirs      = $d['kd_poly'];
    $poli           = $d['KLINIK'];
    $jam_datang     = $d['JAM_DATANG'];
    $jam_pelayanan  = $d['JAM_PELAYANAN'];
    $jam_selesai    = $d['JAM_SELESAI'];
    $tgl_periksa    = date_format( date_create( $d['tgl_periksa'] ), 'Y-m-d' );
    $kdkloter       = $d['KDKLOTER'];
    //------------cek masa aktif No transaksi--------------
    if ( strtotime( date( 'Y-m-d' ) )> strtotime( $tgl_periksa ) ) {
        $db = null;
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Kode Booking sudah tidak aktif'
            ),
            'response'=>null
        );

        echo json_encode( $pesan );
        exit;
    }

    $query      -> closeCursor();
    //--------------Sisa  antrean------------------
    $sql = '';
    $sql = "select count(kd_pasien) as total_layani from antrian 
    where kd_poly='".$kd_polirs."' and convert(date,tgl_periksa)='".$tgl_periksa."' 
    and kd_dokter='".$kd_dokterrs."' and 
    status_antri='".'ANTRI'."'";

    $query = $db->prepare( $sql );
    $query->execute();
    $a = $query->fetch();
    if ( $a ) {
        $totalblm = ( int )$a[0];
    } else {
        $totalblm = 0;
    }
    $query->closeCursor();

    //---------cek SPM--------------------------------------
    $sql        = '';
    $sql        = "select durasi from jadwal_poli where fmjkd_dokter='".$kd_dokterrs."' and 
                  fmjkd_klinik='".$kd_polirs."' and
                  kdkloter='".$kdkloter."'";
    $query      = $db ->prepare( $sql );
    $query      -> execute();
    $dr         = $query ->fetch();
    if ( !$dr ) {
        $db = null;
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'SPM dokter tidak di temukan !'
            ),
            'response'=>null
        );

        echo json_encode( $pesan );
        exit;
    }
    $durasi     = $dr['durasi'];
    $query      -> closeCursor();


    //----------antrian pemanggilan terahir ----------------
    // $sql = "SELECT top(1) antidantri,antcounter FROM [dbo].[ANTRIANDOKTER] 
    //     where convert(date,anttanggal)='".$tgl_periksa."' and antidpoli='".$kd_polirs."' and
    //     antiddokter='".$kd_dokterrs."' ORDER BY ANTTANGGAL desc";



 $sql = "SELECT top(1) NO_URUT FROM ANTRIAN 
        where convert(date,TGL_PERIKSA)='".$tgl_periksa."' and KD_POLY='".$kd_polirs."' and
        KD_DOKTER='".$kd_dokterrs."' and STATUS_ANTRI='ANTRI' order by TGL_PERIKSA,NO_URUT desc";





    $query   = $db->prepare( $sql );
    $query   -> execute();
    $c       = $query->fetch();
    if ( $c ) {
        $panggil = $c[0];
    } else {
        $panggil = null;
    }

    $query -> closeCursor();
    $waktutunggu = ( $durasi * ( $totalblm - 1 ) ) * 60;

    error_log("durasi : ".$durasi);

    $db = null;
    $pesan = array(
        'nomorantrean'      => $nomer,
        'namapoli'          => $poli,
        'namadokter'        => $dokter,
        'sisaantrean'       => $totalblm,
        'antreanpanggil'    => $panggil,
        'waktutunggu'       => $waktutunggu,
        'keterangan'        => ''
    );

    $pesan = array(
        'metadata'=>array(
            'code'=>200,
            'message'=>'Ok'
        ),
        'response'=>$pesan
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