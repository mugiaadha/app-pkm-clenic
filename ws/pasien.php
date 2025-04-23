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
$kk         = preg_replace( '/\D/', '', $_POST['nomorkk'] );
$nama       = strtoupper( $_POST['nama'] );
$jk         = $_POST['jeniskelamin'];
$tgl_lahir  = $_POST['tanggallahir'];
$alamat     = strtoupper( $_POST['alamat'] );
$kd_prop    = $_POST['kodeprop'];
$prop       = $_POST['namaprop'];
$kd_kab     = $_POST['kodedati2'];
$kab        = $_POST['namadati2'];

$kd_kec     = $_POST['kodekec'];
$kec        = $_POST['namakec'];
$kd_desa    = $_POST['kodekel'];
$desa       = $_POST['namakel'];
$rw         = $_POST['rw'];
$rt         = $_POST['rt'];
$tglk = date("y");
$tgldaftar = date("Y-m-d");
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



if ( strlen( $kk ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'KK Belum di isi !'
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


if ( strlen( $nama ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Nama Belum di isi !'
        ),
        // 'response'=>null
    );

    echo json_encode( $pesan );
    exit;

}

if ( strlen( $jk ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Jenis Kelamin Belum di pilih !'
        ),
        // 'response'=>null
    );

    echo json_encode( $pesan );
    exit;

}

if ( strlen( $tgl_lahir ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Tgl Lahir  Belum di isi !'
        ),
        // 'response'=>null
    );

    echo json_encode( $pesan );
    exit;

}


//------------tgl_lahir---------------------------------
if ( !preg_match( "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $tgl_lahir ) ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Format tanggal tidak sesuai, Format yang benar yyyy-mm-dd'
        ),
        // 'response'=>null
    );
    echo json_encode( $pesan );
    exit;
}








if ( strlen( $alamat ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Alamat Masih Kosong !'
        ),
        // 'response'=>null
    );

    echo json_encode( $pesan );
    exit;

}

if ( strlen( $kd_prop ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Kode Propinsi Masih Kosong !'
        ),
        // 'response'=>null
    );

    echo json_encode( $pesan );
    exit;

}

if ( strlen( $prop ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Nama Propinsi Masih Kosong !'
        ),
        // 'response'=>null
    );

    echo json_encode( $pesan );
    exit;

}

if ( strlen( $kd_kab ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Kode Kab/Kota Masih Kosong !'
        ),
        // 'response'=>null
    );

    echo json_encode( $pesan );
    exit;

}

if ( strlen( $kab ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Nama Kab/Kota Masih Kosong !'
        ),
        // 'response'=>null
    );

    echo json_encode( $pesan );
    exit;

}

if ( strlen( $kd_kec ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Kode Kecamatan Masih Kosong !'
        ),
        // 'response'=>null
    );

    echo json_encode( $pesan );
    exit;

}

if ( strlen( $kec ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Nama Kecamatan Masih Kosong !'
        ),
        // 'response'=>null
    );

    echo json_encode( $pesan );
    exit;

}

if ( strlen( $kd_desa ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Kode Kelurahan/Desa Masih Kosong !'
        ),
        // 'response'=>null
    );

    echo json_encode( $pesan );
    exit;

}


if ( strlen( $desa ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Nama Kelurahan/Desa Masih Kosong !'
        ),
        // 'response'=>null
    );

    echo json_encode( $pesan );
    exit;

}

// if ( strlen( $rw ) == 0 ) {
//     $pesan = array(
//         'metadata'=>array(
//             'code'=>201,
//             'message'=>'RW Masih Kosong !'
//         ),
//         'response'=>null
//     );

//     echo json_encode( $pesan );
//     exit;

// }

// if ( strlen( $rt ) == 0 ) {
//     $pesan = array(
//         'metadata'=>array(
//             'code'=>201,
//             'message'=>'RT Masih Kosong !'
//         ),
//         'response'=>null
//     );

//     echo json_encode( $pesan );
//     exit;

// }


  
  

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














       $sql = "select pasien from pasien where noasuransi='".$kartu."'";
    $query = $db->prepare( $sql );
    $query->execute();
    $d = $query->fetch();
    if ($d ) {
        $db = null;
        $query->closeCursor();
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Anda Sudah Terdaftar Sebagai Pasien di Klinik ini'
            ),
            // 'response'=>null
        );
        echo json_encode( $pesan );
        exit;

    }

    
   $query->closeCursor();


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
  


    $sql = "SELECT angka from autonum where kdnomor='15'";
    $query = $db->prepare( $sql );
    $query->execute();
    $c = $query->fetch();
    if ( !$c ) {
        $db = null;
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Konfigurasi NO RM tidak di temukan !'
            ),
            // 'response'=>null
        );

        echo json_encode( $pesan );
        $query->closeCursor();
        exit;
    }
    $urutrm = $c['angka'] + 1;
    $query->closeCursor();


    //----------------------------------------------------------------------------------------------
    $dataCabang = "select kdcabang,kdklinik from cabang limit 0,1";
    $dataCabang = $db->prepare($dataCabang);
    $dataCabang->execute();
    $dataCabang = $dataCabang->fetch();
    $kdcabang = $dataCabang['kdcabang'] ?? null;
    $kdklinik = $dataCabang['kdklinik'] ?? null;

    if ( $urutrm >= 999999 ) {
        $uruttm = 1;
    }
    if ( strlen( $urutrm ) == 6 ) {
        $nomer = $urutrm;
    } elseif ( strlen( $urutrm ) == 5 ) {
        $nomer = '0'.$urutrm;
    } elseif ( strlen( $urutrm ) == 4 ) {
        $nomer = '00'.$urutrm;
    } elseif ( strlen( $urutrm ) == 3 ) {
        $nomer = '000'.$urutrm;
    } elseif ( strlen( $urutrm ) == 2 ) {
        $nomer = '0000'.$urutrm;
    } elseif ( strlen( $urutrm ) == 1 ) {
        $nomer = '00000'.$urutrm;
    }
   $no = $kdcabang.'-'.$tglk.$nomer;


    try {
        $db->beginTransaction();
        //---------------------------------- Update autonum ---------------------------------------------------
        $sql = "update autonum set  angka='$urutrm' where kdnomor='15'";
        $exe = $db->prepare( $sql );
        $exe->execute();
        $exe->closeCursor();


        //---------------------------------------------------------------------------------------------
        $sql = "INSERT into pasien 
        (norm,kdkelurahan,pasien,tgllahir,jeniskelamin,statusmarital,agama,
alamat,alamatsekarang,hp,tandapengenal,nopengenal,tempatlahir,golda,kdcabang,kdklinik,tgl,pendidikan,perkerjaan,noasuransi,kdasuransi) 
        values('".$no."','".$kd_desa."','".$nama."','".$tgl_lahir."','".$jk."','TIDAK TAHU','TIDAK TAHU','".$alamat."','".$alamat."','00','KTP','".$nik."','TIDAK TAHU','Tidak Tahu','".$kdcabang."','".$kdklinik."','".$tgldaftar."','TIDAK TAHU','TIDAK TAHU','".$kartu."','".$kdkostumer."')";
       
 
       
        $query = $db->prepare( $sql );
        $query->execute();
        $db->commit();

        $pesan = array(
            'metadata'=>array(
                'code'=>200,
                'message'=>'OK'
            )
        );

        $db = null;
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

