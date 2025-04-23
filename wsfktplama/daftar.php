<?php
include 'sesi.php';
include 'fungsi.php';
// $logfile = './error.log';
// ini_set( 'log_errors', TRUE );
// ini_set( 'error_log', $logfile );

// ini_set( 'display_errors', '1' );
// ini_set( 'display_startup_errors', '1' );
// error_reporting( E_ALL );
 date_default_timezone_set( 'Asia/Bangkok' );
$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );




$kartu      = preg_replace( '/\D/', '', $_POST['nomorkartu'] );
$nik        = preg_replace( '/\D/', '', $_POST['nik'] );
$kodepoli   = $_POST['kodepoli'];
$tanggalperiksa   = $_POST['tanggalperiksa'];
$keluhan         = $_POST['keluhan'];
$updater = date("Y-m-d H:i:s");




    
    
if ( strlen( $kartu ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'No Kartu Belum di isi !'
        ),
        'response'=>null
    );

    echo json_encode( $pesan );
    exit;

} elseif ( strlen( $kartu ) != 13 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Format No Kartu tidak sesuai !'
        ),
        'response'=>null
    );

    echo json_encode( $pesan );
    exit;
}


if ( is_numeric($kartu) ) {
   
}else{
   


  $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Format Harus number/numeric!'
        ),
        'response'=>null
    );

    echo json_encode( $pesan );
   exit;

}



if ( strlen( $nik ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'NIK Belum di isi !'
        ),
        'response'=>null
    );

    echo json_encode( $pesan );
    exit;

} elseif ( strlen( $nik ) != 16 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Format Nik tidak sesuai !'
        ),
        'response'=>null
    );

    echo json_encode( $pesan );
    exit;
}



if ( strlen( $kodepoli ) == 0 ) {
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


if ( strlen( $tanggalperiksa ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Tgl Belum di isi !'
        ),
        'response'=>null
    );

    echo json_encode( $pesan );
    exit;

}


if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$tanggalperiksa)) {
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


       //------------- cek tgl_tdk berlaku----------
    if(strtotime($tanggalperiksa) < strtotime(date("Y-m-d"))){
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


    // if(strtotime($tanggalperiksa) > strtotime(date("Y-m-d"))){
    //     $db = null;
    //     $pesan = array(
    //         'metadata'      => array(
    //             'code'      => 201,
    //             'message'   => 'Tgl Periksa tidak lebih dari hari ini !'
    //         ),
    //         'response'      => null
    //     );

    //     echo json_encode( $pesan );
    //     exit;
    // }










// $akhir='19.00';
// $awal='06.00';

//  if ( $awal > $jam ) {
          
//             $pesan = array(
//                 'metadata'=>array(
//                     'code'=>201,
//                     'message'=>'Maaf, Pendaftaran belum di buka'
//                 ),
//                 'response'=>null
//             );
//             echo json_encode( $pesan );
//             exit;
//         }


//     if ( $akhir < $jam ) {
          
//             $pesan = array(
//                 'metadata'=>array(
//                     'code'=>201,
//                     'message'=>'Maaf, Pendaftaran sudah di tutup!'
//                 ),
//                 'response'=>null
//             );
//             echo json_encode( $pesan );
//             exit;
//         }
        
        
//         $akhirr='06.00';
//                 $awall='08.30';
                
//                 $akhirrc='07.00';
//                 $awallc='14.00';
                
                
                
//                   $akhirrcc='14.00';
//                 $awallcc='21.00';
                
                    $hari =  date('D', strtotime($tanggalperiksa));
$jam = date("H:i");




    
    
if($kdpoli === '003'){
    $pesan = array(
                'metadata'=>array(
                    'code'=>201,
                    'message'=>'Maaf, Poli Kia Pendaftaran OnSite!'
                ),
                'response'=>null
            );
            echo json_encode( $pesan );
            exit; 
    
}
    
    
   

        
        
        if($kodepoli === '001'){
            
            
  if ($hari === 'Sun'){
  
      $kddokter ='DOK0039';
    }else if($hari === 'Mon'){
        
        $awal =  '15:00';
    
        
        if($jam < $awal){
            $kddokter ='DOK0033';
            
        }else if($jam > $awal){
             $kddokter ='DOK0038';
            
        }else{
               $kddokter ='DOK0033';
        }

        
    }else if($hari === 'Tue'){
      $kddokter ='DOK0039';
      
     
      
      
      
        
    }else if($hari === 'Wed'){
    
 $kddokter ='DOK0039';
        
    }else if($hari === 'Thu'){
  $kddokter ='DOK0038';
        
    }else if($hari === 'Fri'){
 
 
 $awal =  '15:00';
    
        
        if($jam < $awal){
            $kddokter ='DOK0033';
            
        }else if($jam > $awal){
             $kddokter ='DOK0039';
            
        }else{
               $kddokter ='DOK0039';
        }
        
        
         
     }else if($hari === 'Sat'){
  $kddokter ='DOK0039';
     }else{
    
      $kddokter ='DOK0039';
     }
            
    }else if($kodepoli === '002'){
          
             
             
               if ($hari === 'Sun'){
  
  
    }else if($hari === 'Mon'){
        
  
    
       $kddokter ='DOK0032';

        
    }else if($hari === 'Tue'){
 
            $pesan = array(
                'metadata'=>array(
                    'code'=>201,
                    'message'=>'Maaf, Pendaftaran tidak ada jadwal dr gigi'
                ),
                'response'=>null
            );
            echo json_encode( $pesan );
            exit;
        
    }else if($hari === 'Wed'){
    
 $awal =  '12:00';
    
        
        if($jam < $awal){
            $kddokter ='DOK0032';
            
        }else if($jam > $awal){
             $kddokter ='DOK0034';
            
        }else{
              $kddokter ='DOK0034';
        }
        
        
    }else if($hari === 'Thu'){
   $kddokter ='DOK0034';
        
    }else if($hari === 'Fri'){
 
 
  $kddokter ='DOK0032';
    
        
 
        
         
     }else if($hari === 'Sat'){

     }else{
    
  
     }
      
            
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

try {
    include 'koneksi.php';
    $coba = cek_token( $token, $key, $username, $db );





  $sql = "select kdpolibpjs,nampoli,kdpoli from poliklinik where kdpolibpjs='".$kodepoli."'";
    $query = $db->prepare( $sql );
    $query->execute();
    $d = $query->fetch();
    if ( !$d ) {
        $db = null;
        $query->closeCursor();
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Poli Tidak di temukan Silahakan Klinik Melakukan Maping !'
            ),
            'response'=>null
        );
        echo json_encode( $pesan );
        exit;

    }

    $nampoli = $d['nampoli'] ;
    $kodepoliasli = $d['kdpoli'] ;

  $query->closeCursor();




  $sql = "select noasuransi,norm from pasien where noasuransi='".$kartu."'";
    $query = $db->prepare( $sql );
    $query->execute();
    $d = $query->fetch();
    if ( !$d ) {
        $db = null;
        $query->closeCursor();
        $pesan = array(
            'metadata'=>array(
                'code'=>202,
                'message'=>'Pasien Belum Terdaftar Pada Klinik'
            ),
            'response'=>null
        );
        echo json_encode( $pesan );
        exit;

    }

$norm = $d['norm'];
      
  $query->closeCursor();




  $sql = "SELECT 
b.pasien,b.norm
FROM kunjunganpasien a,pasien b,poliklinik v
where
a.norm = b.norm AND a.kdpoli = v.kdpoli AND a.tglpriksa='".$tanggalperiksa."' AND v.kdpolibpjs='".$kodepoli."' and b.nopengenal ='".$nik."' ";
$query = $db->prepare( $sql );
    $query->execute();
    $d = $query->fetch();
    if ( $d ) {
        $db = null;
        $query->closeCursor();
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Anda Terdaftar di Poli dan Tanggal yang sama'
            ),
            'response'=>null
        );
        echo json_encode( $pesan );
        exit;

    }



 $query->closeCursor();


  $sql = "SELECT kdtarif from kelompokkostumer where dash='BPJS'";
    $query = $db->prepare( $sql );
    $query->execute();
    $d = $query->fetch();
    if ( !$d ) {
        $db = null;
        $query->closeCursor();
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Kode Tarif tidak di temukan'
            ),
            'response'=>null
        );
        echo json_encode( $pesan );
        exit;

    }
   
  $kdtarif = $d['kdtarif'];
      

      

  $query->closeCursor();






  $mows = date_create( $tanggalperiksa);
  
    $form_no = date_format( $mows, 'ymd' );


 $nomer = 'RJ'.'-'.$kdtarif.$form_no;



   
    $sql = "SELECT notransaksi from transaksipasien where left(notransaksi,15)='$nomer' and kdcabang='003' ORDER BY notransaksi desc limit 1";

    
    $query = $db->prepare( $sql );
    $query->execute();
    $c = $query->fetch();
    if ( !$c ) {

        
 $no_trans = $nomer.'-'.'001';
}else{

 $urut = $c['notransaksi'];
  $awal = substr( $urut, 16, 3 );
        $awal = $awal + 1;

 $urut = strlen( $awal );


        if ( $urut == 1 ) {
            $jum = '00';
        } elseif ( $urut == 2 ) {
            $jum = '0';
        } elseif ( $urut == 3 ) {
            $jum = '';
        }
        $no_trans = $nomer.'-'.$jum.$awal;





    }
   

 $query->closeCursor();










  $sql = "SELECT noantrian from antrian where kdpoli='".$kodepoliasli."' and tglpriksa='".$tanggalperiksa."' and kddokter='$kddokter' 
and kdcabang='003' order by noantrian desc  limit 1";

    
    $query = $db->prepare( $sql );
    $query->execute();
    $c = $query->fetch();
    if ( !$c ) {

        
$noantrian=1;
}else{



$noantrian=$c['noantrian'] + 1;



    }
   

 $query->closeCursor();






    try {

  $db->beginTransaction();

  //---------------------------------------------------------------------------------------------
        $sql = "INSERT into transaksipasien 
        (notransaksi,norm,tgltransaksi,user,updaters,kdpoli,kunci,kdklinik,kdcabang) 
        values('".$no_trans."','".$norm."','".$tanggalperiksa."','BPJS','".$updater."','".$kodepoliasli."','0','3','003')";
        $queryx = $db->prepare( $sql );
        $queryx->execute();
        $queryx->closeCursor();

   
            $sql = "INSERT into kunjunganpasien 
        (norm,kdpoli,tglpriksa,kddokter,kdkostumerd,jammasuk,notransaksi,koreksierm,kelas,kdklinik,kdcabang,nofaktur) 
        values('".$norm."','".$kodepoliasli."','".$tanggalperiksa."','$kddokter','CUSD0032','".$updater."','".$no_trans."','BELUM','1','3','003','".$no_trans."')";
        $query = $db->prepare( $sql );
        $query->execute();
        


            $sql = "INSERT into antrian 
        (noantrian,norm,kdpoli,tglpriksa,notransaksi,kddokter,status,dari,kdklinik,kdcabang) 
        values('".$noantrian."','".$norm."','".$kodepoliasli."','".$tanggalperiksa."','".$no_trans."','$kddokter','ANTRI','OUT','3','003')";

     

        $query = $db->prepare( $sql );
        $query->execute();

     $db->commit();











          $sql = "SELECT
a.noantrian

FROM antrian a,poliklinik b
WHERE a.kdpoli = b.kdpoli AND b.kdpolibpjs='".$kodepoli."' AND a.tglpriksa='".$tanggalperiksa."' AND a.status='ANTRI' ORDER BY a.noantrian ASC LIMIT 1 ";

      $query = $db->prepare( $sql );
    $query->execute();
    $d = $query->fetch();
    $antrianpgl = $d['noantrian'];


    $query->closeCursor();





        $sql = "SELECT a.noantrian FROM antrian a,poliklinik b,pasien c
WHERE a.kdpoli = b.kdpoli AND b.kdpolibpjs='".$kodepoli."' AND a.tglpriksa='".$tanggalperiksa."'  AND a.norm = c.norm
 AND c.noasuransi='".$kartu."' ";



      $query = $db->prepare( $sql );
    $query->execute();
    $d = $query->fetch();
    $antriankm = $d['noantrian'];



     $sisaantrean=$antriankm - $antrianpgl;




    if($sisaantrean < 0){

        $sisaantrean = 0;

    }else{

$sisaantrean = $sisaantrean;
        
    }




    $query->closeCursor();



   



  $pesan = array(


            'nomorantrean' => 'A'.$noantrian,
             'angkaantrean'  => $noantrian,
            'namapoli' => $nampoli,
            'sisaantrean' => $sisaantrean,
            'antreanpanggil' => 'A'.$antrianpgl,
            'keterangan' => "Apabila antrean terlewat harap mengambil antrean kembali."
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
        $db->rollback();
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