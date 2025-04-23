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

    //--------------cari peserta-----------------------
    $sql = '';
    $sql = "select kd_pasien as FMPASIEN_ID from Pasien where no_asuransi ='".$kartu."' ";
    $jek = $db->prepare( $sql );
    $jek->execute();
    $d = $jek->fetch();
    if ( $d ) {
        $rm = $d['FMPASIEN_ID'];
    } else {
        $rm = '';
    }
    $jek->closeCursor();

    $sql = '';

    // $sql = "select a.FJOKTGL_OP,a.FJOKJAM_OP,e.FMPKODEBPJS,e.FMPKLINIKN ,a.FJOKNO_KAMAR,  a.FJOKKD_PASIEN,b.NAMAPASIEN,ALAMAT,
        //     a.FJOKKD_CUSTOMER,c.FMDDOKTERN,d.FMTOKTINDAKAN,a.FJOKDURASI,
        //     a.FJOKSTATUS,a.FJOKKD_JENIS_OP,a.FJOKKD_SUB_SPC,a.FJOKKD_DOKTERANESTESI,
        //     a.FJOKRJNO_TRANSAKSI  
        //     from OK_JADWAL a,PASIEN b,DOKTER c,OK_TINDAKAN_MEDIS D , POLIKLINIK e
        //     where  a.FJOKKD_PASIEN=b.kd_pasien and  a.FJOKKD_DOKTER=c.FMDDOKTER_ID 
        //     and  a.FJOKKD_TINDAKAN=d.FMTOKKD_TINDAKAN 
        //     and a.FJOKKD_UNIT=e.FMPKLINIK_ID 
        //     and a.FJOKKD_CUSTOMER='XXX790' and FJOKKD_PASIEN='".$rm."'
        //     and FJOKSTATUS='0'
        //      union 

        //      select a.FJOKTGL_OP,a.FJOKJAM_OP,e.FMPKODEBPJS,e.FMPKLINIKN ,a.FJOKNO_KAMAR,  a.FJOKKD_PASIEN,b.NAMAPASIEN,ALAMAT,
        //     a.FJOKKD_CUSTOMER,c.FMDDOKTERN,d.FMTOKTINDAKAN,a.FJOKDURASI,
        //     a.FJOKSTATUS,a.FJOKKD_JENIS_OP,a.FJOKKD_SUB_SPC,a.FJOKKD_DOKTERANESTESI,
        //     a.FJOKRJNO_TRANSAKSI  
        //     from OK_JADWAL a,PASIEN b,DOKTER c,OK_TINDAKAN_MEDIS D , POLIKLINIK e
        //     where  a.FJOKKD_PASIEN=b.kd_pasien and  a.FJOKKD_DOKTER=c.FMDDOKTER_ID 
        //     and  a.FJOKKD_TINDAKAN=d.FMTOKKD_TINDAKAN 
        //     and a.FJOKKD_UNIT=e.FMPKLINIK_ID 
        //     and a.FJOKKD_CUSTOMER='XXX980' and FJOKKD_PASIEN='".$rm."'
        //     and FJOKSTATUS='0'

        //     union
        //     select a.FJOKTGL_OP,a.FJOKJAM_OP,e.FMPKODEBPJS,e.FMPKLINIKN ,a.FJOKNO_KAMAR,  a.FJOKKD_PASIEN,b.NAMAPASIEN,ALAMAT,
        //     a.FJOKKD_CUSTOMER,c.FMDDOKTERN,d.FMTOKTINDAKAN,a.FJOKDURASI,
        //     a.FJOKSTATUS,a.FJOKKD_JENIS_OP,a.FJOKKD_SUB_SPC,a.FJOKKD_DOKTERANESTESI,
        //     a.FJOKRJNO_TRANSAKSI  
        //     from OK_JADWAL a,PASIEN b,DOKTER c,OK_TINDAKAN_MEDIS D , POLIKLINIK e
        //     where  a.FJOKKD_PASIEN=b.kd_pasien and  a.FJOKKD_DOKTER=c.FMDDOKTER_ID 
        //     and  a.FJOKKD_TINDAKAN=d.FMTOKKD_TINDAKAN 
        //     and a.FJOKKD_UNIT=e.FMPKLINIK_ID 
        //     and a.FJOKKD_CUSTOMER='XXX856' and FJOKKD_PASIEN='".$rm."'
        //     and FJOKSTATUS='0'
        //     order by a.FJOKJAM_OP ";

    // $sql = "select a.FJOKTGL_OP,a.FJOKJAM_OP,e.FMPKODEBPJS,e.FMPKLINIKN ,a.FJOKNO_KAMAR,  a.FJOKKD_PASIEN,b.NAMAPASIEN,ALAMAT,
    //         a.FJOKKD_CUSTOMER,c.FMDDOKTERN,d.FMTOKTINDAKAN,a.FJOKDURASI,
    //         a.FJOKSTATUS,a.FJOKKD_JENIS_OP,a.FJOKKD_SUB_SPC,a.FJOKKD_DOKTERANESTESI,
    //         a.FJOKRJNO_TRANSAKSI  
    //         from OK_JADWAL a,PASIEN b,DOKTER c,OK_TINDAKAN_MEDIS D , POLIKLINIK e
    //         where  a.FJOKKD_PASIEN=b.kd_pasien and  a.FJOKKD_DOKTER=c.FMDDOKTER_ID 
    //         and  a.FJOKKD_TINDAKAN=d.FMTOKKD_TINDAKAN 
    //         and a.FJOKKD_UNIT=e.FMPKLINIK_ID 
    //         and FJOKKD_PASIEN='".$rm."'
    //         and FJOKSTATUS='0' and convert(date,FJOKTGL_OP) >='".date( 'Y-m-d' )."'";


            $sql = "select a.FJOKTGL_OP,a.FJOKJAM_OP,e.FMPKODEBPJS,e.FMPKLINIKN ,a.FJOKNO_KAMAR,  a.FJOKKD_PASIEN,b.NAMAPASIEN,ALAMAT,
            a.FJOKKD_CUSTOMER,c.FMDDOKTERN,d.FMTOKTINDAKAN,a.FJOKDURASI,
            a.FJOKSTATUS,a.FJOKKD_JENIS_OP,a.FJOKKD_SUB_SPC,a.FJOKKD_DOKTERANESTESI,
            a.FJOKNO_TRANSAKSI  
            from OK_JADWAL a,PASIEN b,DOKTER c,OK_TINDAKAN_MEDIS D , POLIKLINIK e
            where  a.FJOKKD_PASIEN=b.kd_pasien and  a.FJOKKD_DOKTER=c.FMDDOKTER_ID 
            and  a.FJOKKD_TINDAKAN=d.FMTOKKD_TINDAKAN 
            and a.FJOKKD_UNIT=e.FMPKLINIK_ID 
            and FJOKKD_PASIEN='".$rm."'
            and FJOKSTATUS='0' ";

    $query = $db->prepare( $sql, array( PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL ) );
    $query->execute();
    $jml = $query->rowCount();

    $date = new DateTime();
    $timestamp = $date->getTimestamp();
    $data = array();
    if ( $jml > 0 ) {
        while( $c = $query->fetch() ) {
            $kd_booking = $c['FJOKNO_TRANSAKSI'];
            $tgl_op = date_format( date_create( $c['FJOKTGL_OP'] ), 'Y-m-d' );
            $tindakan = $c['FMTOKTINDAKAN'];
            $kd_poli = $c['FMPKODEBPJS'];
            $poli = $c['FMPKLINIKN'];
            $terlaksana = 0;

            $data[] = array(
                'kodebooking'=>$kd_booking,
                'tanggaloperasi'=>$tgl_op,
                'jenistindakan'=>$tindakan,
                'kodepoli'=>$kd_poli,
                'namapoli'=>$poli,
                'terlaksana'=>$terlaksana,
            );

        }

    } else {
        $db = null;
        $query->closeCursor();
        $pesan = array(
            'metadata'=>array(
                'code'=>305,
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

        'response'=>array( 'list'=>$data ),
        'metadata'=>array(
            'code'=>200,
            'message'=>'Ok'
        ),
        
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