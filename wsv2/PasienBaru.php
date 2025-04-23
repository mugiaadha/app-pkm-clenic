<?php
include 'sesi.php';
include 'fungsi.php';
// $logfile = './error.log';
// ini_set( 'log_errors', TRUE );
// ini_set( 'error_log', $logfile );

// ini_set( 'display_errors', '1' );
// ini_set( 'display_startup_errors', '1' );
// error_reporting( E_ALL );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$kartu      = preg_replace( '/\D/', '', $_POST['nomorkartu'] );
$nik        = preg_replace( '/\D/', '', $_POST['nik'] );
$kk         = preg_replace( '/\D/', '', $_POST['nomorkk'] );
$nama       = strtoupper( $_POST['nama'] );
$jk         = $_POST['jeniskelamin'];
$tgl_lahir  = $_POST['tanggallahir'];
$nohp       = $_POST['nohp'];
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
$alamat     = strtoupper( $_POST['alamat'] );

//------------Validasi----------------

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



if ( strlen( $kk ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'KK Belum di isi !'
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


if ( strlen( $nama ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Nama Belum di isi !'
        ),
        'response'=>null
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
        'response'=>null
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
        'response'=>null
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
        'response'=>null
    );
    echo json_encode( $pesan );
    exit;
}


$tgl_lahir=date_format(date_create($tgl_lahir),"Y-m-d");
if(strtotime($tgl_lahir) > strtotime(date('Y-m-d'))){
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Tanggal Lahir tidak boleh lebih dari tanggal hari ini !'
        ),
        'response'=>null
    );
    echo json_encode( $pesan );
    exit;
}



if ( strlen( $nohp ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'No Hp Masih Kosong !'
        ),
        'response'=>null
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
        'response'=>null
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
        'response'=>null
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
        'response'=>null
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
        'response'=>null
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
        'response'=>null
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
        'response'=>null
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
        'response'=>null
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
        'response'=>null
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
        'response'=>null
    );

    echo json_encode( $pesan );
    exit;

}

if ( strlen( $rw ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'RW Masih Kosong !'
        ),
        'response'=>null
    );

    echo json_encode( $pesan );
    exit;

}

if ( strlen( $rt ) == 0 ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'RT Masih Kosong !'
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
            'response'=>null
        );
        echo json_encode( $pesan );
        exit;

    }

    //-----------------------Kelamin---------------------
    if ( $jk == 'L' ) {
        $jk = 1;
    } elseif ( $jk == 'P' ) {
        $jk = 2;
    }
    //---------------------------------------------------

    //--------------  cari peserta -----------------------
    $sql = '';
    $sql = "select top(1) FMPASIEN_ID from bpjs_sep where FMNO_KARTU ='".$kartu."' order by fmtgl_sep desc";
    $jek = $db->prepare( $sql );
    $jek->execute();
    $d = $jek->fetch();
    if ( $d ) {
        //-------------Update No Asuransi-------------------------------'
        $sql = "";
        $sql ="update pasien set NO_ASURANSI='".$kartu."' where kd_pasien='".$d['FMPASIEN_ID']."'";
        // error_log($sql);
        $exe = $db->prepare($sql);
        $exe -> execute();
        
        //--------------------------------------------------------------
        $db = null;
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Pasien atas Nama '.$nama.' Sudah memiliki No RM : '.$d['FMPASIEN_ID'].''
            ),
            'response'=>null
        );

        echo json_encode( $pesan );
        $jek->closeCursor();
        exit;
    }
    $jek->closeCursor();

    //----------------Cek NIK-----------------------------------------
    $sql = '';
    $sql = "select top(1) kd_pasien from pasien where no_pengenal ='".$nik."'";
    $jek = $db->prepare( $sql );
    $jek->execute();
    $d = $jek->fetch();
    if ( $d ) {

         //-------------Update No Asuransi-------------------------------'
        $sql = "";
        $sql ="update pasien set NO_ASURANSI='".$kartu."' where kd_pasien='".$d['kd_pasien']."'";
        // error_log($sql);
        $exe = $db->prepare($sql);
        $exe -> execute();
        
        
        $db = null;
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Pasien atas Nama '.$nama.' Sudah memiliki No RM : '.$d['kd_pasien'].''
            ),
            'response'=>null
        );

        echo json_encode( $pesan );
        $jek->closeCursor();
        exit;
    }
    $jek->closeCursor();

    //--------------------------------------------------------------
    //-------------ambil no urut--------------------------------------------------------------------
    $sql = "select * from autonum where formc='01'";
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
            'response'=>null
        );

        echo json_encode( $pesan );
        $query->closeCursor();
        exit;
    }
    $urutrm = $c['SEQNO'] + 1;
    $query->closeCursor();
    //----------------------------------------------------------------------------------------------
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
    $no = date( 'y' ).$nomer;
    // $no = date( 'y' ).' '.$nomer;
    //---------------------------------------------------------------------------------------------

    try {
        $db->beginTransaction();
        //---------------------------------- Update autonum ---------------------------------------------------
        $sql = "update autonum set seqno='".$nomer."' where formc='01'";
        $exe = $db->prepare( $sql );
        $exe->execute();
        $exe->closeCursor();

        $kelompok = 'XXX790';
        //---------------------------------------------------------------------------------------------
        $sql = "insert into PASIEN 
        (KD_PASIEN,KD_KELURAHAN,KD_PENDIDIKAN,KD_PEKERJAAN,KD_PERUSAHAAN,NAMAPASIEN,TGL_LAHIR,GOL_DARAH,
        JENIS_KELAMIN,STATUS_MARITA,AGAMA,ALAMAT,TELEPON,KD_POS,KD_ASURANSI,NO_ASURANSI, 
        TANDA_PENGENAL,NO_PENGENAL,WNI,NAMA_KELUARGA,TEMPAT_LAHIR,PEMEGANG_ASURANSI,PANGKAT_POLRI,KESAT_POLRI,JENISPASIEN,STATUS) 
        values('".$no."','".$kd_desa."','9','15',
        '".$kelompok."','".$nama."','".$tgl_lahir."','5','".$jk."',
        '3','1','".$alamat."','','','00006',
        '".$kartu."','1','".$nik."','1','','',
        '','','','P01','5')";
        $query = $db->prepare( $sql );
        $query->execute();
        $db->commit();

        $pesan = array(
            'metadata'=>array(
                'code'=>200,
                'message'=>'Harap datang ke RS BHINA untuk melengkapi data rekam medis !'
            ),
            'response'=>array( 'norm'=>$no )
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