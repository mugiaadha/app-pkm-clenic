<?php
include 'sesi.php';
// include 'fungsi.php';



date_default_timezone_set( 'Asia/Bangkok' );
$rest_json = file_get_contents( 'php://input' );
// $_GET = json_decode( $rest_json, true );

 

$tglOrder = $_GET['tglOrder'];
$NoOrder = $_GET['NoOrder'];
$Nama = $_GET['Nama'];
$NoRM = $_GET['NoRM'];


if ( empty( $NoOrder ) ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>303,
            'message'=>'Kode Order  kosong '
        ),
        'response'=>null
    );

    echo json_encode( $pesan );
    exit;
}try {
   


    //----------antrian pemanggilan terahir ----------------
 include 'koneksi.php';
    $sql = "select distinct notransaksi,norm, nama, jeniskelamin, tgllahir, alamat, tglorder, notransaksi,
 kdruangan, namaruangan, kddokterpengirim, namadokterpengirim,userid,Status from ORDERLABLIS where tglorder='$tglOrder' and notransaksi='$NoOrder' and nama='$Nama' and norm='$NoRM' and Status='1'";



    $query   = $db->prepare( $sql );
    $query   -> execute();
    $c       = $query->fetch();

   

    $db = null;
    $pesan = array(
      

         'NoOrder' =>  $c['notransaksi'], 
      'NoLab' =>   $c['notransaksi'],
      'TglOrder' => date_format( date_create( $c['tglorder'] ), 'Y-m-d' ),
      'NoRM' => $c['norm'],
      'NIK' => '',
      'Nama' => $c['nama'],
      'JenisKelamin' =>  $c['jeniskelamin'],
      'TglLahir' => date_format( date_create( $c['tgllahir'] ), 'Y-m-d' ),
      'Pekerjaan' => '',
      'Telepon' => '',
      'Alamat' => $c['alamat'],
      'KelasPerawatan' => $c['namaruangan'],
      'DokterID' => $c['kddokterpengirim'],
      'NamaDokter' => $c['namadokterpengirim'],
      'PetugasID' => $c['userid'],
      'NamaPetugas' => $c['userid'],
      'Status' => $c['Status'],
      'JenisBayarID' => '',
      'NamaJenisBayar' =>''


    );

 $query -> closeCursor();
    $pesan = array(
        'metadata'=>array(
            'code'=>200,
            'message'=>'Data has been listed'
        ),
        'data'=>$pesan
    );

    echo json_encode( $pesan );

    exit;

} catch( PDOException $c ) {

    $db = null;
    $pesan = array(
        'metadata'=>array(
            'code'=>305,
            'message'=>$e
        ),
        'response'=>null
    );
    echo json_encode( $pesan );
    exit;
}

// print_r( $decoded->password );
?>