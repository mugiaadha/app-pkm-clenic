<?php
include 'sesi.php';
include 'fungsi.php';
$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );

$tgl_periksa = date_format( date_create( $_POST['tanggalperiksa'] ), 'Y-m-d' );
if ( !preg_match( "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $tgl_periksa ) ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Format tanggal tidak sesuai'
        ),
        'response'=>null
    );
    echo json_encode( $pesan );
    exit;
}

$kd_poli = $_POST['kodepoli'];
$kd_dokter = $_POST['kodedokter'];
$jampraktek = $_POST['jampraktek'];

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

$token = str_replace( '"', '', $head['x-token'] );
$token = str_replace( "'", '', $token );
$username = str_replace( '"', '', $head['x-username'] );
$username = str_replace( "'", '', $username );

try {
    include 'koneksi.php';
    $coba = cek_token( $token, $key, $username, $db );

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

    //------------- cek tgl_tdk berlaku----------
    if(strtotime($tgl_periksa) < strtotime(date("Y-m-d"))){
        $db = null;
        $pesan = array(
            'metadata'      => array(
                'code'      => 201,
                'message'   => 'Tgl Periksa tidak berlaku !'
            ),
            'response'      => null
        );

        echo json_encode( $pesan );
        exit;
    }


    //---------cek total antrian-----------------
    $sql = '';
    $sql = "select FMPKLINIK_ID,FMPKLINIKN from poliklinik where FMPKODEBPJS='".$kd_poli."'";
    $query = $db->prepare( $sql );
    $query->execute();
    $d = $query->fetch();
    if ( !$d ) {
        $db = null;
        $query->closeCursor();
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Data Mapping Klinik tidak di temukan !'
            ),
            'response'=>null
        );
        echo json_encode( $pesan );
        exit;

    }

    $kd_polirs = $d['FMPKLINIK_ID'];
    $nama_poli = $d['FMPKLINIKN'];
    $query->closeCursor();

    //------------------  dokter rs--------------------------------------
    $sql    = '';




    $sql    = "select fmddokter_id, fmddoktern,POLIKLINIK.FMPKLINIKN,POLIKLINIK.FMPKODEBPJS from dokter,DOKTER_KLINIK,POLIKLINIK
    where DOKTER.FMDDOKTER_ID = DOKTER_KLINIK.FMKDOKTER_ID  and DOKTER_KLINIK.FMKKLINIK_ID = POLIKLINIK.FMPKLINIK_ID and
    DOKTER.FMKD_HAFIS = '".$kd_dokter."' and POLIKLINIK.FMPKLINIK_ID='".$kd_polirs."'";
    $query  = $db->prepare( $sql );
    $query  -> execute();
    $d      = $query ->fetch();
    if ( !$d ) {
        $db = null;
        $query->closeCursor();
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Data Mapping Dokter tidak di temukan !'
            ),
            'response'=>null
        );
        echo json_encode( $pesan );
        exit;
    }

    $kd_dokterrs = $d['fmddokter_id'];
    $nama_dokter = $d['fmddoktern'];
    $query ->closeCursor();
    //----------------------------------------------------------------------------

    $sql = '';
    $sql = "select count(no_transaksi) as total from 
                antrian 
                where convert(date,tgl_periksa)='".$tgl_periksa."' and kd_poly='".$kd_polirs."' and kd_dokter ='".$kd_dokterrs."'";

    $query = $db->prepare( $sql );
    $query->execute();
    $c = $query->fetch();
    if ( $c ) {
        $total = ( int )$c[0];
    } else {
        $total = 0;
    }
    $query->closeCursor();
    //----------------------------------------------
    //-------------------jml terlayani--------------
    $sql = '';
    // $sql = "select count(b.FTNO_TRANSAKSI) as total_layani,e.FMPKLINIKN from TRANSAKSIPASIEN b 
    //             inner join TRANSAKSIPASIEND c on b.FTNO_TRANSAKSI=c.FDTNO_TRANSAKSI 
    //             inner join TRANSAKSIBAYARD d on c.FDTNO_TRANSAKSI=d.FTBNO_TRANSAKSI and d.FTBNOMER=c.FDTNOMER 
    //             inner join POLIKLINIK e on b.FTKD_UNIT=e.FMPKLINIK_ID          
    //             where convert(date,b.FTTGL_TRANSAKSI)='".$tgl_periksa."' and b.FTKD_UNIT='".$kd_polirs."' group by FMPKLINIKN";

    $sql = "select count(kd_pasien) as total_layani from antrian 
                 where kd_poly='".$kd_polirs."' and convert(date,tgl_periksa)='".$tgl_periksa."' 
                 and kd_dokter='".$kd_dokterrs."' and 
                 status_antri='".'SELESAI'."'";

    $query = $db->prepare( $sql );
    $query->execute();
    $a = $query->fetch();
    if ( $a ) {
        $total_layani = $a[0];
    } else {
        $total_layani = 0;
    }
    $query->closeCursor();
    $sisaantrean  = $total - $total_layani;

    // //------------------- total pasien JKN -----------------------------------
    // $sql = '';
    // $sql = "select count(kd_pasien) as total_layani from antrian 
    // where kd_poly='".$kd_polirs."' and convert(date,tgl_periksa)='".$tgl_periksa."' 
    // and kd_dokter='".$kd_dokterrs."' and 
    // status_antri='".'ANTRI'."' and JKN='1'";

    // $query = $db->prepare( $sql );
    // $query->execute();
    // $a = $query->fetch();
    // if ( $a ) {
    //     $totaljkn = $a[0];
    // } else {
    //     $totaljkn = 0;
    // }
    // $query->closeCursor();

    

    //--------------Kuota dan Jadwal --------------------------------------
    $namahari = date( 'l', strtotime( date( 'Y-m-d' ) ) );
    include 'hari.php';

    //-----------   Lihat jadwal      -------------------------------------
    $sql = "select $namahari as hari,kuota,kuotajkn from jadwal_poli
					where  FMJKD_DOKTER='".$kd_dokterrs."' and
						   FMJKD_KLINIK='".$kd_polirs."'  order by hari desc";
    $query = $db->prepare( $sql );
    $query->execute();
    $kuotaumum = 0;
    $kuotajkn = 0;
    while( $b = $query->fetch() ) {
        $kuotaumum =  $b['kuota'];
        $kuotajkn = $b['kuotajkn'];
    }
    $query ->closeCursor();
    $kuota = $kuotaumum + $kuotajkn;
    $sisakuotajkn = $kuota - $total;
    // $sisakuotajkn = $kuotajkn - $totaljkn;
    // $sisakuotannonjkn = $kuotaumum - ( $total - $totaljkn );

    //----------antrian pemanggilan terahir ----------------

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
    // $date = new DateTime();
    // $timestamp = $date->getTimestamp() * 1000;
    $db = null;

    $pesan = array(
        'namapoli'          => $nama_poli,
        'namadokter'        => $nama_dokter,
        'totalantrean'      => $total,
        'sisaantrean'       => $sisaantrean,
        'antreanpanggil'    => $panggil,
        'sisakuotajkn'      => $sisakuotajkn,
        'kuotajkn'          => $kuota,
        'sisakuotanonjkn'   => 0,
        'kuotanonjkn'       => 0,
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

?>