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

    }

   
    $sql = "select a.FJOKTGL_OP,a.FJOKJAM_OP,a.FJOKKD_POLY  ,e.FMPKODEBPJS,e.FMPKLINIKN ,a.FJOKNO_KAMAR,  a.FJOKKD_PASIEN,b.NAMAPASIEN,ALAMAT,
            a.FJOKKD_CUSTOMER,c.FMDDOKTERN,d.FMTOKTINDAKAN,a.FJOKDURASI,
            a.FJOKSTATUS,a.FJOKKD_JENIS_OP,a.FJOKKD_SUB_SPC,a.FJOKKD_DOKTERANESTESI,
            a.FJOKNO_TRANSAKSI  
            from OK_JADWAL a 
            LEFT JOIN PASIEN b on a.FJOKKD_PASIEN=b.kd_pasien 
            LEFT JOIN DOKTER c on a.FJOKKD_DOKTER=c.FMDDOKTER_ID 
            LEFT JOIN OK_TINDAKAN_MEDIS D on a.FJOKKD_TINDAKAN=d.FMTOKKD_TINDAKAN 
            LEFT JOIN POLIKLINIK e on a.FJOKKD_POLY=e.FMPKLINIK_ID 
            where FJOKTGL_OP between '$tgl_awal'  and 'tanggalakhir'
          
            order by a.FJOKJAM_OP";

    $query = $db->prepare( $sql, array( PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL ) );
    $query->execute();
    $jml = $query->rowCount();

    $date = new DateTime();
    $timestamp = $date->getTimestamp() * 1000;
    $data = array();
    if ( $jml > 0 ) {
        while( $c = $query->fetch() ) {
            $kd_booking = $c['FJOKNO_TRANSAKSI'];
            $tgl_op = date_format( date_create( $c['FJOKTGL_OP'] ), 'Y-m-d' );
            $tindakan = $c['FMTOKTINDAKAN'];
            if ( $c['FMPKODEBPJS'] == '' ) {
                $kd_poli = 'BED';
                $poli = 'KLINIK BEDAH';
            } else {
                $kd_poli = $c['FMPKODEBPJS'];

                $poli = $c['FMPKLINIKN'];
            }

            $terlaksana = $c['FJOKSTATUS'];

            //--------------cari peserta-----------------------
            // $sql = '';

            // // select kd_pasien as FMPASIEN_ID from Pasien where no_asuransi ='".$kartu."'

            // $sql = "select no_asuransi as FMNO_KARTU from pasien where kd_pasien ='".$c['FJOKKD_PASIEN']."'";
            // // $sql = "select top(1) FMNO_KARTU from bpjs_sep where FMPASIEN_ID='".$c['FJOKKD_PASIEN']."' order by fmtgl_sep desc";
            // $jek = $db->prepare( $sql );
            // $jek->execute();
            // $d = $jek->fetch();
            // if ( $d ) {
            //     $kartu = $d['FMNO_KARTU'];
            // } else {
            //     $kartu = '';
            // }
            // $jek->closeCursor();

            // if ( $kd_booking == '' ) {
            //     $kd_booking = 'BOK-'.date_format( date_create( $c['FJOKTGL_OP'] ), 'y-m' ).'-'.date_format( date_create( $c['FJOKJAM_OP'] ), 'H0i' );
            // }

            $data[] = array(
                'kodebooking'=>'565',
                'tanggaloperasi'=>$tgl_op,
                'jenistindakan'=>$tindakan,
                'kodepoli'=>$kd_poli,
                'namapoli'=>$poli,
                'terlaksana'=>0,
                'nopeserta'=> $kartu,
                'lastupdate'=> $timestamp
            );
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