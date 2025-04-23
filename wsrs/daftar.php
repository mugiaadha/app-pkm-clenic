<?php
include 'sesi.php';
include 'fungsi.php';

 date_default_timezone_set( 'Asia/Bangkok' );
$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );




$kartu      = preg_replace( '/\D/', '', $_POST['nomorkartu'] );
$nik        = preg_replace( '/\D/', '', $_POST['nik'] );
$kodepoli   = $_POST['kodepoli'];
$nohp   = $_POST['nohp'];
$norm   = $_POST['norm'];
$tanggalperiksa   = $_POST['tanggalperiksa'];
$kodedokter         = $_POST['kodedokter'];
$jampraktek         = $_POST['jampraktek'];
$jeniskunjungan         = $_POST['jeniskunjungan'];
$nomorreferensi         = $_POST['nomorreferensi'];
$tgl_daftar = $tanggalperiksa ;

                                                



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

    $todayDate = date("Y-m-d");// current date

  $datex = strtotime(date("Y-m-d", strtotime($todayDate)) . " +1 day");

  $datexx = date('Y-m-d', $datex);




  if(strtotime($tanggalperiksa) > strtotime($datexx)){
        $db = null;
        $pesan = array(
            'metadata'      => array(
                'code'      => 201,
                'message'   => 'Maaf, Pendaftaran maximal 1 Hari sebelum, Pemeriksaan.!'
            ),
            'response'      => null
        );

        echo json_encode( $pesan );
        exit;
    }




 $awaljam = substr( $jampraktek, 0, 2 );
  $awalmenit = substr( $jampraktek, 3, 2 );


 $akhirjam = substr( $jampraktek, 6, 2 );
  $akhirmenit = substr( $jampraktek, 9, 2 );





$awal = $awaljam.'.'.$awalmenit;
$akhir = $akhirjam.'.'.$akhirmenit;





$jam = date("H.i");




 if ( $awal > $jam ) {
          
            $pesan = array(
                'metadata'=>array(
                    'code'=>201,
                    'message'=>'Maaf, Pendaftaran belum di buka'
                ),
                'response'=>null
            );
            echo json_encode( $pesan );
            exit;
        }


    if ( $akhir < $jam ) {
          
            $pesan = array(
                'metadata'=>array(
                    'code'=>201,
                    'message'=>'Maaf, Pendaftaran sudah di tutup!'
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
                'message'=>'Poli Tidak di temukan Silahakan Faskes Melakukan Maping !'
            ),
            'response'=>null
        );
        echo json_encode( $pesan );
        exit;

    }

    $nampoli = $d['nampoli'] ;
    $kodepoliasli = $d['kdpoli'] ;

   $query->closeCursor();




  $sql = "select *  from dokter where kddokterbpjs='".$kodedokter."'";
    $query = $db->prepare( $sql );
    $query->execute();
    $d = $query->fetch();
    if ( !$d ) {
        $db = null;
        $query->closeCursor();
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Kd dokter Belum di maping'
            ),
            'response'=>null
        );
        echo json_encode( $pesan );
        exit;

    }

$namadokter = $d['namdokter'];
 $kddokterasli = $d['kddokter'];
           
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
                'message'=>'Pasien Belum Terdaftar Pada Faskes'
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










   $sql = "SELECT noantrian from antrian where kdpoli='".$kodepoliasli."' and tglpriksa='".$tanggalperiksa."' and kddokter='".$kddokterasli."' 
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
        values('".$norm."','".$kodepoliasli."','".$tanggalperiksa."','".$kddokterasli."','CUSD0032','".$updater."','".$no_trans."','BELUM','1','3','003','".$no_trans."')";
        $query = $db->prepare( $sql );
        $query->execute();
        


            $sql = "INSERT into antrian 
        (noantrian,norm,kdpoli,tglpriksa,notransaksi,kddokter,status,dari,kdklinik,kdcabang) 
        values('".$noantrian."','".$norm."','".$kodepoliasli."','".$tanggalperiksa."','".$no_trans."','".$kddokterasli."','ANTRI','OUT','3','003')";

     

        $query = $db->prepare( $sql );
        $query->execute();

     $db->commit();




        $sql = "SELECT 
a.kuota,a.kuotajkn,c.namdokter
FROM jadwalpraktek a , poliklinik b,dokter c
WHERE a.kdpoli = b.kdpoli AND a.kddokter = c.kddokter AND c.kddokterbpjs='".$kodedokter."' AND b.kdpolibpjs='".$kodepoli."'";

    $query = $db->prepare( $sql );
    $query->execute();
    $c = $query->fetch();
    if ( $c ) {
        $kuotajkn = (int)$c['kuotajkn'];
 $kuotajknnon = (int)$c['kuota'];
        
    } else {
        $kuotajkn = 0;
         $kuotajknnon = 0;
        
    }
    $query->closeCursor();




  $sql = "SELECT COUNT(a.notransaksi) AS total FROM antrian a,poliklinik b
WHERE a.kdpoli = b.kdpoli AND b.kdpolibpjs='".$kodepoli."' AND a.tglpriksa='".$tanggalperiksa."'";

    $query = $db->prepare( $sql );
    $query->execute();
    $c = $query->fetch();
    if ( $c ) {
        $total = ( int )$c[0];
    } else {
        $total = 0;
    }
    $query->closeCursor();


  

$sisakuotajkn  = $kuotajkn - $total;
$sisakuotajknnon  = $kuotajknnon - $total;


$yourdate = date("Y-m-d H:s");



$stamp = strtotime($yourdate); // get unix timestamp
$time_in_ms = $stamp*1000;



  $pesan = array(


            'nomorantrean' => 'A'.$noantrian,
             'angkaantrean'  => $noantrian,
              'kodebooking'  => $no_trans,
               'norm'  => $norm,

            'namapoli' => $nampoli,
             'namadokter' => $namadokter,
            'estimasidilayani' => $time_in_ms,

        'sisakuotajkn' =>$sisakuotajkn,
             'kuotajkn' => $kuotajkn,
             'sisakuotanonjkn' => $sisakuotajknnon,
             'kuotanonjkn'=> $kuotajknnon,
            


            'keterangan' => "Peserta harap 30 menit lebih awal guna pencatatan administrasi."




            
    
  

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