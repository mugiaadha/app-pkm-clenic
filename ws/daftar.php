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



$kddokter         = $_POST['kodedokter'];

$jampraktek         = $_POST['jampraktek'];

$norm         = $_POST['norm'];

$nohp         = $_POST['nohp'];



if ( strlen( $kartu ) == 0 ) {

    $pesan = array(

        'metadata'=>array(

            'code'=>201,

            'message'=>'No Kartu Belum di isi !'

        ),

        // 'response'=>null

    );



    echo json_encode( $pesan );

    exit;



} elseif ( strlen( $kartu ) != 13 ) {

    $pesan = array(

        'metadata'=>array(

            'code'=>201,

            'message'=>'Format No Kartu tidak sesuai !'

        ),

        // 'response'=>null

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

        // 'response'=>null

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

        // 'response'=>null

    );



    echo json_encode( $pesan );

    exit;



} elseif ( strlen( $nik ) != 16 ) {

    $pesan = array(

        'metadata'=>array(

            'code'=>201,

            'message'=>'Format Nik tidak sesuai !'

        ),

        // 'response'=>null

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

        // 'response'=>null

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

        // 'response'=>null

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

        // 'response'=>null

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

            // 'response'      => null

        );



        echo json_encode( $pesan );

        exit;

    }







                

                    $hari =  date('D', strtotime($tanggalperiksa));

$jam = date("H:i");



$jampraktekakhir =substr($jampraktek,6,11);





     //------------- cek tutup jam poli----------

    if(strtotime($tanggalperiksa) === strtotime(date("Y-m-d"))){

    

        if($jam >  $jampraktekakhir){

 $pesan = array(

        'metadata'=>array(

            'code'=>201,

            'message'=>'Pendaftaran Poli Sudah Tutup Jam '.$jampraktekakhir

        ),

        // 'response'=>null

    );



    echo json_encode( $pesan );

    exit;



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

        // 'response'=>null

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

        // 'response'=>null

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

    

    $dataCabang = "select kdcabang,kdklinik from cabang limit 0,1";

    $dataCabang = $db->prepare($dataCabang);

    $dataCabang->execute();

    $dataCabang = $dataCabang->fetch();

    $kdcabang = $dataCabang['kdcabang'] ?? null;

    $kdklinik = $dataCabang['kdklinik'] ?? null;







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



      $sql = "select noasuransi,norm,nopengenal from pasien where nopengenal='".$nik."'";

    $query = $db->prepare( $sql );

    $query->execute();

    $d = $query->fetch();

    if ( !$d ) {

        $db = null;

        $query->closeCursor();

        $pesan = array(

            'metadata'=>array(

                'code'=>202,

                'message'=>'Data pasien ini tidak ditemukan, silahkan Melakukan Registrasi Pasien Baru'

            ),

            // 'response'=>null

        );

        echo json_encode( $pesan );

        exit;



    }

    $norm = $d['norm'];

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

                'message'=>'dokter Tidak di temukan Silahakan Klinik Melakukan Maping !'

            ),

            // 'response'=>null

        );

        echo json_encode( $pesan );

        exit;



    }



    $kddokterinternal = $d['kddokter'] ;

  

    $namadokterinfo = $d['namdokter'];

  



  $query->closeCursor();









  

  

    





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

            // 'response'=>null

        );

        echo json_encode( $pesan );

        exit;



    }



    $nampoli = $d['nampoli'] ;

    $kodepoliasli = $d['kdpoli'] ;



  $query->closeCursor();


    $sql = "
        SELECT 
            dokterklinik.id,
            dokter.kddokter,
            poliklinik.kdklinik,
            dokter.kddokterbpjs,
            poliklinik.kdpolibpjs
        FROM dokterklinik
        JOIN dokter ON dokterklinik.kddokter = dokter.kddokter
        JOIN poliklinik ON dokterklinik.kdpoli = poliklinik.kdpoli
        WHERE dokter.kddokterbpjs = :kddokter
        AND poliklinik.kdpolibpjs = :kodepoli
    ";
    $query = $db->prepare( $sql );
    $query->execute([
        ':kddokter'  => $kddokter,
        ':kodepoli'  => $kodepoli
    ]);
    $d = $query->fetch();
    $query->closeCursor();

    if ( !$d ) {
        $db = null;
        $query->closeCursor();
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'dokter belum di maping di poli tersebut'
            )
        );
        echo json_encode( $pesan );
        exit;
    }
    $query->closeCursor();



//   $sql = "SELECT a.kddokter ,b.kddokter,b.namdokter,a.$hariku as jam

//   FROM jadwalpraktek a,dokter b,poliklinik c

//   WHERE a.kddokter = b.kddokter AND

//   a.kdpoli = c.kdpoli and c.kdpolibpjs ='".$kodepoli."'  

//   and b.kddokterbpjs='".$kddokter."' and a.$hariku <>''";



//   $query = $db->prepare( $sql );

//   $query->execute();

//   $d = $query->fetch();

//   if (!$d ) {

//       $db = null;

//       $query->closeCursor();

//       $pesan = array(

//           'metadata'=>array(

//               'code'=>201,

//               'message'=>'Jadwal Dokter '.$namadokterinfo.' tersebut Belum tersedia, Silahkan Reschedule Tanggal dan Jam Praktek Lainnya'

//           ),

//           // 'response'=>null

//       );

//       echo json_encode( $pesan );

//       exit;



//   }



//   $sudahtutupjam = $d['jam'];















//   $sql = "SELECT a.kddokter ,b.kddokter,b.namdokter,a.$hariku as jam

//   FROM jadwalpraktek a,dokter b,poliklinik c

//   WHERE a.kddokter = b.kddokter AND

//   a.kdpoli = c.kdpoli and c.kdpolibpjs ='".$kodepoli."'  

//   and a.$hariku='".$jampraktek."'";

  

  

  

  

//       $query = $db->prepare( $sql );

//       $query->execute();

//       $d = $query->fetch();

//       if (!$d ) {

//           $db = null;

//           $query->closeCursor();

//           $pesan = array(

//               'metadata'=>array(

//                   'code'=>201,

//                   'message'=>'Pendaftaran Ke Poli '.$nampoli.' Sudah Tutup Jam  '.$sudahtutupjam

//               ),

//               // 'response'=>null

//           );

//           echo json_encode( $pesan );

//           exit;

  

//       }























    $sql = "SELECT

a.dash,d.kdkostumerd

FROM kelompokkostumer a , kelompokkostumerd d

WHERE a.kdkostumer = d.kdkostumer AND a.dash ='BPJS'";

    $query = $db->prepare( $sql );

    $query->execute();

    $d = $query->fetch();

    if ( !$d ) {

        $db = null;

        $query->closeCursor();

        $pesan = array(

            'metadata'=>array(

                'code'=>201,

                'message'=>'Kostumer belum di maping'

            ),

            // 'response'=>null

        );

        echo json_encode( $pesan );

        exit;



    }



    $kdkostumer = $d['kdkostumerd'] ;

  



  $query->closeCursor();













//   $sql = "select noasuransi,norm from pasien where noasuransi='".$kartu."'";

//     $query = $db->prepare( $sql );

//     $query->execute();

//     $d = $query->fetch();

//     if ( !$d ) {

//         $db = null;

//         $query->closeCursor();

//         $pesan = array(

//             'metadata'=>array(

//                 'code'=>202,

//                 'message'=>'No kartu Pasien Belum Terdaftar Pada Klinik'

//             ),

//             // 'response'=>null

//         );

//         echo json_encode( $pesan );

//         exit;



//     }

    

    

//       $sql = "select noasuransi,norm from pasien where norm='".$norm."'";

//     $query = $db->prepare( $sql );

//     $query->execute();

//     $d = $query->fetch();

//     if ( !$d ) {

//         $db = null;

//         $query->closeCursor();

//         $pesan = array(

//             'metadata'=>array(

//                 'code'=>202,

//                 'message'=>'Pasien Belum punya NORM  Pada Klinik'

//             ),

//             // 'response'=>null

//         );

//         echo json_encode( $pesan );

//         exit;



//     }

    





      

//   $query->closeCursor();

  

  

  

  

  









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

            // 'response'=>null

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

            // 'response'=>null

        );

        echo json_encode( $pesan );

        exit;



    }

   

  $kdtarif = $d['kdtarif'];

      



      



  $query->closeCursor();













  $mows = date_create( $tanggalperiksa);

  

    $form_no = date_format( $mows, 'ymd' );





 $nomer = 'RJ'.'-'.$kdtarif.$form_no;

   

    $sql = "SELECT notransaksi from transaksipasien where left(notransaksi,15)='$nomer' and kdcabang='$kdcabang' ORDER BY notransaksi desc limit 1";



    

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





















  $sql = "SELECT noantrian from antrian where kdpoli='".$kodepoliasli."'

   and tglpriksa='".$tanggalperiksa."' and kddokter='$kddokterinternal' 

and kdcabang='$kdcabang'  and rirj is null  order by noantrian desc  limit 1";



    

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

        values('".$no_trans."','".$norm."','".$tanggalperiksa."','BPJS','".$updater."','".$kodepoliasli."','0','$kdklinik','$kdcabang')";

        $queryx = $db->prepare( $sql );

        $queryx->execute();

        $queryx->closeCursor();



   

            $sql = "INSERT into kunjunganpasien 

        (norm,kdpoli,tglpriksa,kddokter,kdkostumerd,jammasuk,notransaksi,koreksierm,kelas,kdklinik,kdcabang,nofaktur) 

        values('".$norm."','".$kodepoliasli."','".$tanggalperiksa."','$kddokterinternal','".$kdkostumer."','".$updater."','".$no_trans."','BELUM','1','$kdklinik','$kdcabang','".$no_trans."')";

        $query = $db->prepare( $sql );

        $query->execute();

        





            $sql = "INSERT into antrian 

        (noantrian,norm,kdpoli,tglpriksa,notransaksi,kddokter,status,dari,kdklinik,kdcabang,tgldatang) 

        values('".$noantrian."','".$norm."','".$kodepoliasli."','".$tanggalperiksa."','".$no_trans."','$kddokterinternal','ANTRI','OUT','$kdklinik','$kdcabang','$updater')";

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











        $sql = "SELECT a.noantrian,d.kodeantrian FROM antrian a,poliklinik b,pasien c,dokterklinik d

WHERE a.kdpoli = b.kdpoli AND b.kdpolibpjs='".$kodepoli."' AND a.tglpriksa='".$tanggalperiksa."'  AND a.norm = c.norm

 AND a.kdpoli = d.kdpoli AND a.kddokter = d.kddokter

 AND c.noasuransi='".$kartu."' and a.norm <> '' ";







      $query = $db->prepare( $sql );

    $query->execute();

    $d = $query->fetch();

    $antriankm = $d['noantrian'];

    $kodeantrian = $d['kodeantrian'];







     $sisaantrean=$antriankm - $antrianpgl;









    if($sisaantrean < 0){



        $sisaantrean = 0;



    }else{



$sisaantrean = $sisaantrean;

        

    }







    $antrianpglv= $kodeantrian.$antrianpgl;

    

    









    $query->closeCursor();







   



    

    $sql = "SELECT COUNT(a.noantrian) AS total FROM antrian a,poliklinik b,pasien c,dokterklinik d

    WHERE a.kdpoli = b.kdpoli AND b.kdpolibpjs='".$kodepoli."' AND a.tglpriksa='".$tanggalperiksa."'  AND a.norm = c.norm

      and a.rirj is null   and a.status <> 'SELESAI' AND a.noantrian < $antriankm and a.kdpoli = d.kdpoli AND a.kddokter = d.kddokter";

    //   echo $sql;

      

      $query = $db->prepare( $sql );

        $query->execute();

        $d = $query->fetch();

        if ( !$d ) {

            $db = null;

            $query->closeCursor();

            $pesan = array(

                'metadata'=>array(

                    'code'=>201,

                    'message'=>'total antrian tidak di temukan'

                ),

                // 'response'=>null

            );

            echo json_encode( $pesan );

            exit;

    

        }

 

        $totalantreansisa = $d['total'];

 

    

         $query->closeCursor();











  $pesan = array(





            'nomorantrean' => $kodeantrian.$antriankm,

             'angkaantrean'  => $antriankm,

            'namapoli' => $nampoli,

            'sisaantrean' => $totalantreansisa,

            'antreanpanggil' => $antrianpglv,

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

            // 'response'=>null

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