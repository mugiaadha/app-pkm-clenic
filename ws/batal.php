<?php
include 'sesi.php';
include 'fungsi.php';


date_default_timezone_set( 'Asia/Bangkok' );
$rest_json = file_get_contents( 'php://input' );
$_PUT = json_decode( $rest_json, true );

$nomorkartu       = $_PUT['nomorkartu'];

$kodepoli            = $_PUT['kodepoli'];
$tanggalperiksa            = $_PUT['tanggalperiksa'];
$keterangan            = $_PUT['keterangan'];



$head = getallheaders();
//--------cek token---------------s
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





//---------------------------------------------------------
try {
    include 'koneksi.php';
    $coba = cek_token( $token, $key, $username, $db );

    if ( $coba == 0 || $coba == 2 ) {
        $db = null;
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'User dan Token anda tidak cocok atau Token Expired !'
            ),
            // 'response'=>null
        );

        echo json_encode( $pesan );
        exit;
    }



    if ( empty( $nomorkartu ) ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'No Kartu Tidak Boleh Kosong !'
        ),
        // 'response'=>null
    );

    echo json_encode( $pesan );
    exit;
}
if ( empty( $kodepoli ) ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'kodepoli Tidak Boleh Kosong !'
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


     $sql = "SELECT notrans FROM batalpriksa 
WHERE kdpoli='".$kodepoli."' AND tgl='".$tanggalperiksa."'  
 AND norm='".$nomorkartu."'  ";
    $query = $db->prepare( $sql );
    $query->execute();
    $d = $query->fetch();
   

    if ( $d ) {
       $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Antrean Sudah Dibatalkan Sebelumnya'
            ),
            // 'response'=>null
        );
        echo json_encode( $pesan );
        exit;

}

   $query->closeCursor();



     $sql = "SELECT a.noantrian FROM antrian a,poliklinik b,pasien c
WHERE a.kdpoli = b.kdpoli AND b.kdpolibpjs='".$kodepoli."' AND a.tglpriksa='".$tanggalperiksa."'
AND a.norm = c.norm
 AND c.noasuransi='".$nomorkartu."' ";
 

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
            // 'response'=>null
        );
        echo json_encode( $pesan );
        exit;

    }

   $query->closeCursor();




     $sql = "SELECT a.noantrian FROM antrian a,poliklinik b,pasien c
WHERE a.kdpoli = b.kdpoli AND b.kdpolibpjs='".$kodepoli."' AND a.tglpriksa='".$tanggalperiksa."'  AND a.norm = c.norm
 AND c.noasuransi='".$nomorkartu."' and a.status='SELESAI' ";
    $query = $db->prepare( $sql );
    $query->execute();
    $d = $query->fetch();

    if ( $d ) {
        $db = null;
        $query->closeCursor();
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Pasien Sudah Dilayani, Antrean Tidak Dapat Dibatalkan'
            ),
            // 'response'=>null
        );
        echo json_encode( $pesan );
        exit;

    }

   $query->closeCursor();





     $sql = "SELECT a.noantrian,a.notransaksi FROM antrian a,poliklinik b,pasien c
WHERE a.kdpoli = b.kdpoli AND b.kdpolibpjs='".$kodepoli."' AND a.tglpriksa='".$tanggalperiksa."'  AND a.norm = c.norm
 AND c.noasuransi='".$nomorkartu."' and a.status='ANTRI' ";
    $query = $db->prepare( $sql );
    $query->execute();
    $d = $query->fetch();
      $notransaksi = $d['notransaksi'];

    if ( $d ) {


     
        $sqld = "UPDATE  antrian  
        set norm='',notransaksi='$notransaksi$nomorkartu'
        where notransaksi='".$notransaksi."'";
        $queryd = $db->prepare( $sqld );
        $queryd->execute();
        $queryd->closeCursor();


        $sqld = "DELETE from kunjunganpasien  where notransaksi='".$notransaksi."'";
        $queryd = $db->prepare( $sqld );
        $queryd->execute();
        $queryd->closeCursor();



        $sqld = "DELETE from transaksipasien  where notransaksi='".$notransaksi."'";
        $queryd = $db->prepare( $sqld );
        $queryd->execute();
        $queryd->closeCursor();





        $db->beginTransaction();
      
        $sql = "insert into batalpriksa 
        (notrans,norm,kdpoli,kduser,tgl) 
        values('".$notransaksi."','".$nomorkartu."','".$kodepoli."','BPJS','".$tanggalperiksa."')";
        $query = $db->prepare( $sql );
        $query->execute();
        $db->commit();






  
        $pesan = array(
            'metadata'=>array(
                'code'=>200,
                'message'=>'Sukses Batal Priksa'
            ),
            // 'response'=>null
        );
        echo json_encode( $pesan );
        exit;

    }

   $query->closeCursor();










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