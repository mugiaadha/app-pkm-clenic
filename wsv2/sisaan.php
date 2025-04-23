

<?php

 defined('_HOME') OR exit('No direct script access allowed'); 

include 'sesi.php';
include 'fungsi.php';
$rest_json = file_get_contents( 'php://input' );



$kdpoli = @$URI[3];
$nokartu    = @$URI[2];
$tglpriksa    = @$URI[4];




$date =   $tglpriksa;

if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
   $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Format Tanggal Tidak Sesuai, format yang benar adalah yyyy-mm-dd'
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


if ( strlen( $nokartu ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'nokartu Belum di isi !'
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





    $sql = "select kdpolibpjs,kdpoli,nampoli from poliklinik where kdpolibpjs='".$kdpoli."'";
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
        $kdpoliinternal = $d['kdpoli'];
   $query->closeCursor();




$sql = "select noasuransi from pasien where noasuransi='".$nokartu."'";
    $query = $db->prepare( $sql );
    $query->execute();
    $d = $query->fetch();
    if ( !$d ) {
        $db = null;
        $query->closeCursor();
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'No Kartu Tidak di Temukan !'
            ),
            'response'=>null
        );
        echo json_encode( $pesan );
        exit;

    }

      $noasuransi = $d['noasuransi'];
   $query->closeCursor();


   $sql = "SELECT 
b.noasuransi
FROM antrian a,pasien b
WHERE a.norm = b.norm AND b.noasuransi='".$nokartu."' AND a.tglpriksa='".$tglpriksa."'";
    $query = $db->prepare( $sql );
    $query->execute();
    $d = $query->fetch();
    if ( !$d ) {
        $db = null;
        $query->closeCursor();
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Antrean Tidak Ditemukan'
            ),
            'response'=>null
        );
        echo json_encode( $pesan );
        exit;

    }

     $query->closeCursor();




     $sql = "SELECT
a.noantrian

FROM antrian a,poliklinik b
WHERE a.kdpoli = b.kdpoli AND b.kdpolibpjs='".$kdpoli."' AND a.tglpriksa='".$tglpriksa."' AND a.status='SELESAI' ORDER BY a.noantrian DESC LIMIT 1 ";

      $query = $db->prepare( $sql );
    $query->execute();
    $d = $query->fetch();
      if ( !$d ) {
          
            $antrianpgl = 0;

      }else{
          
          $antrianpgl = $d['noantrian'];
  
      }
  

    $query->closeCursor();

// antrian di panggil



     $sql = "SELECT a.noantrian FROM antrian a,poliklinik b,pasien c
WHERE a.kdpoli = b.kdpoli AND b.kdpolibpjs='".$kdpoli."' AND a.tglpriksa='".$tglpriksa."'  AND a.norm = c.norm
 AND c.noasuransi='".$nokartu."' ";



      $query = $db->prepare( $sql );
    $query->execute();
    $d = $query->fetch();
    $antriankm = $d['noantrian'];


    $query->closeCursor();



    $sisaantrean=$antriankm - $antrianpgl;




    if($sisaantrean < 0){

        $sisaantrean = 0;

    }else{

$sisaantrean = $sisaantrean;
        
    }


      if($antrianpgl <= 0){

$no = 0;

            

      }else{
            $no = 'A'.$antrianpgl;


      }



        $db = null;

    $pesan = array(
            'nomorantrean' => $antriankm,
            'namapoli' => $nampoli,
            'sisaantrean' => $sisaantrean,
            'antreanpanggil' => $no,
            'keterangan' => "Ringkasan Sisa Antrian Kamu"
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






    // antrian kamu


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