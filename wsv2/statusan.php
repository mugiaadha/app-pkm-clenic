

<?php

 defined('_HOME') OR exit('No direct script access allowed'); 
 date_default_timezone_set( 'Asia/Bangkok' );
include 'sesi.php';
include 'fungsi.php';
$rest_json = file_get_contents( 'php://input' );



$kdpoli = @$URI[2];
$tglpriksa    = @$URI[3];




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


if ( strlen( $tglpriksa ) == 0 ) {
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



//      $sql = "SELECT COUNT(a.notransaksi) AS total FROM antrian a,poliklinik b
// WHERE a.kdpoli = b.kdpoli AND b.kdpolibpjs='".$kdpoli."' AND a.tglpriksa='".$tglpriksa."'";

//     $query = $db->prepare( $sql );
//     $query->execute();
//     $c = $query->fetch();
//     if ( $c ) {
//         $total = ( int )$c[0];
//     } else {
//         $total = 0;
//     }
//     $query->closeCursor();


//      $sql = "SELECT COUNT(a.notransaksi) AS total FROM antrian a,poliklinik b
// WHERE a.kdpoli = b.kdpoli AND b.kdpolibpjs='".$kdpoli."' AND a.tglpriksa='".$tglpriksa."' and a.status='SELESAI'";

//     $query = $db->prepare( $sql );
//     $query->execute();
//     $a = $query->fetch();
//     if ( $a ) {
//         $total_layani = $a[0];
//     } else {
//         $total_layani = 0;
//     }
//     $query->closeCursor();



//    $sisaantrean  = $total - $total_layani;


 
//      $sql = "SELECT
// a.noantrian

// FROM antrian a,poliklinik b
// WHERE a.kdpoli = b.kdpoli AND b.kdpolibpjs='".$kdpoli."' AND a.tglpriksa='".$tglpriksa."'
// and a.kddokter = '".$kddokterinternal."' AND a.status='ANTRI' ORDER BY a.noantrian ASC LIMIT 1 ";

//       $query = $db->prepare( $sql );
//     $query->execute();
//     $d = $query->fetch();
//     $antrianpgl = $d['noantrian'];



//     $query->closeCursor();




 // "namapoli" : "Poli Umum",
 //            "totalantrean" : "25",
 //            "sisaantrean" : 4,
 //            "antreanpanggil" : "A1-21",
 //            "keterangan" : "",
 //            "kodedokter" : 123456,
 //            "namadokter" : "Dr. Ali",
 //            "jampraktek" : "08:00-13:00"
 //        },
 $hari =  date('D');


  if ($hari === 'Sun'){

    $hariku ='minggu';


  }else if($hari === 'Mon'){

$hariku ='senin';
      
  }else if($hari === 'Tue'){
  $hariku ='selasa';
    

  }else if($hari === 'Wed'){
    
$hariku ='rabu';
    

    }else if($hari === 'Thu'){
  $hariku ='kamis';
    

  }else if($hari === 'Fri'){
  $hariku ='jumat';
    

  }else if($hari === 'Sat'){
  
 $hariku ='sabtu';
    
  
  }



     $sql = "SELECT
a.noantrian,c.kddokterbpjs,b.nampoli,c.namdokter,e.$hariku as jadwalpraktek

FROM antrian a,poliklinik b,dokter c,jadwalpraktek e
WHERE a.kdpoli = b.kdpoli AND b.kdpolibpjs='".$kdpoli."' AND a.tglpriksa='".$tglpriksa."' 
AND a.kddokter = c.kddokter  AND a.kddokter = e.kddokter AND a.kdpoli = e.kdpoli
 ORDER BY a.noantrian ASC ";
 $query = $db->prepare( $sql );
 $query->execute();


      while( $d = $query->fetch() ) {

        $kddokter = $d['kddokterbpjs'];

     $sqll = "SELECT COUNT(a.noantrian) AS total 

FROM antrian a,poliklinik b,dokter c,jadwalpraktek e
WHERE a.kdpoli = b.kdpoli AND b.kdpolibpjs='".$kdpoli."' AND a.tglpriksa='".$tglpriksa."' and c.kddokterbpjs='".$kddokter."'
AND a.kddokter = c.kddokter  AND a.kddokter = e.kddokter AND a.kdpoli = e.kdpoli
 ORDER BY a.noantrian ASC ";
  $queryl = $db->prepare( $sqll );
    $queryl->execute();
    $l = $queryl->fetch();

  $total = $l['total'] ;



   $sqlv = "SELECT
a.noantrian,c.kddokterbpjs,b.nampoli,c.namdokter,e.$hariku as jadwalpraktek

FROM antrian a,poliklinik b,dokter c,jadwalpraktek e
WHERE a.kdpoli = b.kdpoli AND b.kdpolibpjs='".$kdpoli."' AND a.tglpriksa='".$tglpriksa."'
and c.kddokterbpjs='".$kddokter."'
 AND a.status='ANTRI'
AND a.kddokter = c.kddokter  AND a.kddokter = e.kddokter AND a.kdpoli = e.kdpoli
 ORDER BY a.noantrian limit 1";
      $queryv = $db->prepare( $sqlv );
    $queryv->execute();
    $k = $queryv->fetch();

  $antrianpgl = $k['noantrian'] ;





   $sqlvl = "SELECT COUNT(a.noantrian) AS total 

FROM antrian a,poliklinik b,dokter c,jadwalpraktek e
WHERE a.kdpoli = b.kdpoli AND b.kdpolibpjs='".$kdpoli."' AND a.tglpriksa='".$tglpriksa."'
and c.kddokterbpjs='".$kddokter."'
 AND a.status='SELESAI'
AND a.kddokter = c.kddokter  AND a.kddokter = e.kddokter AND a.kdpoli = e.kdpoli
 ORDER BY a.noantrian ";
      $queryvl = $db->prepare( $sqlvl );
    $queryvl->execute();
    $kl = $queryvl->fetch();

  $antrianselesai = $kl['total'] ;


 $sisaantrean  = $total - $antrianselesai;



$data[] = array(
                'namapoli' => $d['nampoli'],
            'totalantrean' => $total ,
            'sisaantrean' => $sisaantrean,
            'antreanpanggil' => 'A-'.$antrianpgl,
            'keterangan' => "Ringkasan Sisa Antrian",
             "kodedokter"=>  $d['kddokterbpjs'],
            "namadokter" => $d['namdokter'],
            "jampraktek" =>  $d['jadwalpraktek'],


            );



      }


 


    $query->closeCursor();




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

?>