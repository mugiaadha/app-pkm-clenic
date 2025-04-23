

<?php


include 'sesi.php';
include 'fungsi.php';
$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );








$kodebooking = $_POST['kodebooking'];


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


if ( strlen( $kodebooking ) == 0 ) {
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



  

      $sql = "SELECT 
a.noantrian,a.status,a.notransaksi,b.nampoli,c.namdokter,b.kdpolibpjs,a.tglpriksa,c.kddokter
 FROM antrian a,poliklinik b,dokter c
WHERE a.kdpoli = b.kdpoli AND      
a.kddokter = c.kddokter and 
a.notransaksi='".$kodebooking."'";
    $query = $db->prepare( $sql );
    $query->execute();
    $d = $query->fetch();
    if ( !$d ) {
        $db = null;
        $query->closeCursor();
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Data Tidak di temukan !'
            ),
            'response'=>null
        );
        echo json_encode( $pesan );
        exit;

    }
     $noantrian = $d['noantrian'];
          $nampoli = $d['nampoli'];
          $namdokter = $d['namdokter'];

          $kdpoli = $d['kdpolibpjs'];
       $tglpriksa = $d['tglpriksa'];
       $kddokter = $d['kddokter'];
       
          
          
   $query->closeCursor();






     $sql = "SELECT COUNT(a.notransaksi) AS total FROM antrian a,poliklinik b
WHERE a.kdpoli = b.kdpoli AND b.kdpolibpjs='".$kdpoli."' AND a.tglpriksa='".$tglpriksa."' and a.kddokter='".$kddokter."'";

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
WHERE a.kdpoli = b.kdpoli AND b.kdpolibpjs='".$kdpoli."' AND a.tglpriksa='".$tglpriksa."' and a.status='SELESAI'  and a.kddokter='".$kddokter."'";




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





     $sql = "SELECT
a.noantrian

FROM antrian a,poliklinik b
WHERE a.kdpoli = b.kdpoli AND b.kdpolibpjs='".$kdpoli."' AND a.tglpriksa='".$tglpriksa."'  and a.kddokter='".$kddokter."' AND a.status='ANTRI' ORDER BY a.noantrian ASC LIMIT 1 ";

      $query = $db->prepare( $sql );
    $query->execute();
    $d = $query->fetch();
 	$antrianpgl = $d['noantrian'];


    $query->closeCursor();



    $waktutunggu = (5 * ( $sisaantrean - 1 ) ) * 60;



	$db = null;

    $pesan = array(


             "nomorantrean" => $noantrian,
      "namapoli" => $nampoli,
      "namadokter" => $namdokter,
      "sisaantrean" => $sisaantrean,
      "antreanpanggil" => 'A'.$antrianpgl,
      "waktutunggu" => $waktutunggu,
      "keterangan" => ""
   


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