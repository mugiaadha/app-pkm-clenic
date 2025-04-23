

<?php


include 'sesi.php';
include 'fungsi.php';
$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );







$tglpriksa = date_format( date_create( $_POST['tanggalperiksa'] ), 'Y-m-d' );
$tg = $_POST['tanggalperiksa'];

if ( !preg_match( "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $tglpriksa ) ) {
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

$kdpoli = $_POST['kodepoli'];
$kddokter = $_POST['kodedokter'];
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

if ( strlen( $kdpoli ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Poli Belum di isi !'
        ),
        'response'=>null
    );

    echo json_encode( $pesan );
    exit;

}

if ( strlen( $kddokter ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Kode Dokter Belum di isi !'
        ),
        'response'=>null
    );

    echo json_encode( $pesan );
    exit;

}

if ( strlen( $tg ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'tgl Belum di isi !'
        ),
        'response'=>null
    );

    echo json_encode( $pesan );
    exit;

}


if ( strlen( $jampraktek ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Jam Prakter Belum di isi !'
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
try{
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
    if(strtotime($tglpriksa) < strtotime(date("Y-m-d"))){
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


    if(strtotime($tglpriksa) > strtotime(date("Y-m-d"))){
        $db = null;
        $pesan = array(
            'metadata'      => array(
                'code'      => 201,
                'message'   => 'Tgl Periksa tidak lebih dari hari ini !'
            ),
            'response'      => null
        );

        echo json_encode( $pesan );
        exit;
    }



    $sql = "select kdpolibpjs,nampoli from poliklinik where kdpolibpjs='".$kdpoli."'";
    $query = $db->prepare( $sql );
    $query->execute();
    $d = $query->fetch();
    if ( !$d ) {
        $db = null;
        $query->closeCursor();
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Poli Tidak di temukan !'
            ),
            'response'=>null
        );
        echo json_encode( $pesan );
        exit;

    }

      $nampoli = $d['nampoli'];
   $query->closeCursor();


      $sql = "select kddokter,namdokter from dokter where kddokterbpjs='".$kddokter."'";
    $query = $db->prepare( $sql );
    $query->execute();
    $d = $query->fetch();
    if ( !$d ) {
        $db = null;
        $query->closeCursor();
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Dokter Tidak di temukan !'
            ),
            'response'=>null
        );
        echo json_encode( $pesan );
        exit;

    }

   $query->closeCursor();




// kuota jkn
        $sql = "SELECT 
a.kuota,a.kuotajkn,c.namdokter
FROM jadwalpraktek a , poliklinik b,dokter c
WHERE a.kdpoli = b.kdpoli AND a.kddokter = c.kddokter AND c.kddokterbpjs='".$kddokter."' AND b.kdpolibpjs='".$kdpoli."'";

    $query = $db->prepare( $sql );
    $query->execute();
    $c = $query->fetch();
    if ( $c ) {
        $kuotajkn = (int)$c['kuotajkn'];
 $kuotajknnon = (int)$c['kuota'];
 $namdokter = $c['namdokter'];
         
    } else {
        $kuotajkn = 0;
         $kuotajknnon = 0;
         $namdokter = $c['namdokter'];

    }
    $query->closeCursor();







     $sql = "SELECT COUNT(a.notransaksi) AS total FROM antrian a,poliklinik b
WHERE a.kdpoli = b.kdpoli AND b.kdpolibpjs='".$kdpoli."' AND a.tglpriksa='".$tglpriksa."'";

    $query = $db->prepare( $sql );
    $query->execute();
    $c = $query->fetch();
    if ( $c ) {
        $total = ( int )$c[0];
    } else {
        $total = 0;
    }
    $query->closeCursor();


     $sql = "SELECT COUNT(a.notransaksi) AS total FROM antrian a,poliklinik b
WHERE a.kdpoli = b.kdpoli AND b.kdpolibpjs='".$kdpoli."' AND a.tglpriksa='".$tglpriksa."' and a.status='SELESAI'";

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


$sisakuotajkn  = $kuotajkn - $total;
$sisakuotajknnon  = $kuotajknnon - $total;


     $sql = "SELECT
a.noantrian

FROM antrian a,poliklinik b
WHERE a.kdpoli = b.kdpoli AND b.kdpolibpjs='".$kdpoli."' AND a.tglpriksa='".$tglpriksa."' AND a.status='ANTRI' ORDER BY a.noantrian ASC LIMIT 1 ";

      $query = $db->prepare( $sql );
    $query->execute();
    $d = $query->fetch();
 	$antrianpgl = $d['noantrian'];


    $query->closeCursor();


	$db = null;

    $pesan = array(
        	'namapoli' => $nampoli,
            'namadokter' => $namdokter,
            'totalantrean' => $total,
            'sisaantrean' => $total_layani,
            'antreanpanggil' => 'A'.$antrianpgl,
            
             'sisakuotajkn' =>$sisakuotajkn,
             'kuotajkn' => $kuotajkn,
             'sisakuotanonjkn' => $sisakuotajknnon,
             'kuotanonjkn'=> $kuotajknnon,
            
            'keterangan' => "Ringkasan Sisa Antrian"


            
   


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