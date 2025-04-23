<?php
include 'sesi.php';
include 'fungsi.php';
include '../rj/AJG-v3/secret.php';

date_default_timezone_set( 'Asia/Bangkok' );
$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );

$kartu = $_POST['nomorkartu'];
$nik = $_POST['nik'];
$rm = $_POST['norm'];
$hp = $_POST['nohp'];
$kd_poli = $_POST['kodepoli'];
$kd_dokter = $_POST['kodedokter'];
$noref = $_POST['nomorreferensi'];
$jns_kunjungan = $_POST['jeniskunjungan'];
$tgl_periksa = $_POST['tanggalperiksa'];
$kdkloter = 1;
$email = 'BPJS';
$vip = 0;
$tgl_daftar = $tgl_periksa;
$geri = 0;
$jkn  = 1;

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

//----------------------Kartu---------------------------
if ( empty( $kartu ) ) {
    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'No Kartu tidak boleh kosong !'
        ),
        'response'=>null
    );

    echo json_encode( $pesan );
    exit;
}
//---------------------------------------------------------
if ( !preg_match( "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $tgl_daftar ) ) {
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

// if ( strtotime( $tgl_daftar ) != strtotime( date( 'Y-m-d' ) ) ) {
//     $pesan = array(
//         'metadata'=>array(
//             'code'=>303,
//             'message'=>'Tanggal Periksa harus hari H'
//         ),
//         'response'=>null
//     );
//     echo json_encode( $pesan );
//     exit;
// }

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

  

    //--------------cek maping poli-------------------------------
    $sql	 = '';
    $sql	 = "select fmpklinik_id,fmpklinikn as namapoli from poliklinik where fmpkodebpjs='".$kd_poli."'";
    $query 	 = $db->prepare( $sql );
    $query 	-> execute();
    $d 		 = $query->fetch();
    if ( !$d ) {
        $db = null;
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Kode Poli tidak di temukan atau belum di mapping !'
            ),
            'response'=>null
        );
        echo json_encode( $pesan );
        exit();
    }

    $kd_polirs	 = $d['fmpklinik_id'];
    // $nama_polirs = $d['nama_poli'];
    $query->closeCursor();

    // if ( $aktif_rujuk != 0 ) {

    //     $sql = 'select iplocalhost,PPKPELAYANAN from cabang';
    //     $query = $db->prepare( $sql );
    //     $query->execute();
    //     $c = $query->fetch();
    //     if ( !$c ) {
    //         $db = null;
    //         $pesan = 'Maaf, Server BPJS tidak di temukan !';
    //         $pesan = array(
    //             'code'=>201,
    //             'status'=>$pesan,
    //             'response'=>''

    //         );
    //         echo json_encode( $pesan );
    //         exit;
    //     }

    //     $url = 'https://'.$c['iplocalhost'].'';
    //     $ppkksh = $c['PPKPELAYANAN'];
    //     $query->closeCursor();

    //     //-----------------aktif atau tidak------------------
    //     $urlpeserta     = $url.'Peserta/nokartu/'.$kartu.'/tglSEP/'.date( 'Y-m-d' ).'';
    //     $cekpeserta     = getData( $urlpeserta, '', $consid, $tgl_unix, $encodesignature, 'GET' );
    //     // error_log( $urlpeserta );
    //     if ( $cekpeserta === false ) {
    //         $db = null;
    //         $pesan = 'Cek Kepesertaan Tidak dapat menyambung ke server bpjs';
    //         $pesan = array(
    //             'metadata'=>array(
    //                 'code'=>201,
    //                 'message'=>$pesan
    //             ),
    //             'response'=>null

    //         );
    //         echo json_encode( $pesan );
    //         exit;
    //     }
    //     $peserta = json_decode( $cekpeserta, true );
    //     if ( $peserta['metaData']['code'] != 200 ) {
    //         $db = null;
    //         $pesan = array(
    //             'metadata'=>array(
    //                 'code'=>$peserta['metaData']['code'],
    //                 'message'=>$peserta['metaData']['message']
    //             ),
    //             'response'=>null

    //         );
    //         echo json_encode( $pesan );
    //         exit;
    //     }

    //     if ( $peserta['response']['peserta']['statusPeserta']['keterangan'] != 'AKTIF' ) {
    //         $db     = null;
    //         $pesan  = 'Kepesertaan BPJS tidak aktif';
    //         $pesan  = array(
    //             'metadata'=>array(
    //                 'code'=>201,
    //                 'message'=>$pesan
    //             ),
    //             'response'=>null

    //         );
    //         echo json_encode( $pesan );
    //         exit;
    //     }

    //     //---------------------cek tgl Rujukan----------------

    //     if ( $jns_kunjungan == 1 || $jns_kunjungan == 4 ) {
    //         $urlrujukan = $url.'Rujukan/'.$noref.'';
    //         $cekrujukan = getData( $urlrujukan, '', $consid, $tgl_unix, $encodesignature, 'GET' );
    //         if ( $cekrujukan === false ) {
    //             $db = null;
    //             $pesan = 'Tidak dapat menyambung ke server bpjs';

    //             $pesan = array(
    //                 'metadata'=>array(
    //                     'code'=>201,
    //                     'message'=>$pesan
    //                 ),
    //                 'response'=>null

    //             );
    //             echo json_encode( $pesan );
    //             exit;
    //         } else {

    //             $list = json_decode( $cekrujukan, true );
    //             if ( $list['metaData']['code'] != 200 ) {
    //                 $db = null;
    //                 $pesan = array(
    //                     'metadata'=>array(
    //                         'code'=>201,
    //                         'message'=>$list['metaData']['message']
    //                     ),
    //                     'response'=>null
    //                 );
    //                 echo json_encode( $pesan );
    //                 exit;
    //             } else {
    //                 //  $tgl_rujukan = date_create( $list['response']['rujukan']['tglKunjungan'] );
    //                 //  $tgl_rujukan = date_format( $tgl_rujukan, 'Y-m-d' );

    //                 //--------------cek 30 hari-----------------------------------------------------
    //                 $today = new DateTime();
    //                 $tgl_rjk = new DateTime( $list['response']['rujukan']['tglKunjungan'] );
    //                 $jmlhari = $tgl_rjk->diff( $today )->days;
    //                 if ( $jmlhari > 90 ) {
    //                     $db = null;
    //                     $pesan = 'No Rujukan sudah tidak bisa di gunakan, karena lebih dari 90 hari !';
    //                     $pesan = array(
    //                         'metadata'=>array(
    //                             'code'=>201,
    //                             'message'=>$pesan
    //                         ),
    //                         'response'=>null

    //                     );
    //                     echo json_encode( $pesan );
    //                     exit;
    //                 }
    //             }
    //         }
    //     }
    // }

    //-----cari dokter----------
    $sql = '';
    // $sql = "SELECT a.FMKDOKTER_ID,c.FMDDOKTERN as DOKTER FROM DOKTER_KLINIK a INNER JOIN POLIKLINIK b ON a.FMKKLINIK_ID=b.FMPKLINIK_ID
		// 		INNER JOIN DOKTER c ON a.FMKDOKTER_ID=c.FMDDOKTER_ID
		// 		WHERE b.FMPKODEBPJS='".$kd_poli."' ORDER BY NEWID()";

    $sql = "select fmddokter_id,fmddoktern from dokter where fmkd_hafis='".$kd_dokter."'";
    $query = $db->prepare( $sql );
    $query->execute();
    $c = $query->fetch();
    if ( !$c ) {
        $db = null;
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Dokter tidak di temukan  !'
            ),
            'response'=>null
        );
        echo json_encode( $pesan );
        exit();
    }

    $kd_dokterrs = $c['fmddokter_id'];
    $nama_dokterrs = $c['fmddoktern'];
    $query->closeCursor();

    //---cari biodata diri---------------------------------------------------------------------------------------------
    $sql = '';
    // $sql = "SELECT TOP (1) FMPASIEN_ID, FMTGL_LAHIR
		// 	FROM   BPJS_SEP
		// 	WHERE  (FMNO_KARTU = '".$kartu."')  order by fmtgl_sep desc";
    // $sql = "select kd_pasien, tgl_lahir,namapasien,alamat from pasien where kd_pasien='".$rm."'";
    $sql = "select kd_pasien, tgl_lahir,namapasien,alamat from pasien where no_asuransi='".$kartu."'";
    $query = $db->prepare( $sql );
    $query->execute();
    $c = $query->fetch();
    if ( !$c ) {
        $db = null;
        $pesan = array(
            'metadata'=>array(
                'code'=>202,
                'message'=>'Pasien belum memiliki No RM silahkan Datang langsung ke Rumah Sakit !'
            ),
            'response'=>null
        );
        echo json_encode( $pesan );
        exit();
    }
    $rm          = $c['kd_pasien'];
    $tgl		 = date_create( $c['tgl_lahir'] );
    $tgl		 = date_format( $tgl, 'Y-m-d' );
    $nama		 = $c['namapasien'];
    $alamat		 = $c['alamat'];
    $query		-> closeCursor();

    //-------------------------------------------------------------
    $db->beginTransaction();
    $mows = date_create( $tgl_daftar);
    $format = date_format( $mows, 'H:i:s' );
    $timer = date( $format );
    $form_no = date_format( $mows, 'ymd' );
    $mow = date_format( $mows, 'Y-m-d' );

    /*------------------------  Cek hari  ------------------------
    ------------------------------------------------------------*/
    if ( $vip == 1 || $geri == 1 ) {

        //-------- cek 1 Hari ---------------------------------
        $tgl_lebi = date_format( date_add( $mows, date_interval_create_from_date_string( '+1 days' ) ), 'Y-m-d' );
        $tgl_lebih = strtotime( $tgl_lebi );
        //-----------------------------------------------------

        $tgl_daftar = date_create( $tgl_daftar );
        $tgl_ajust = date_format( $tgl_daftar, 'Y-m-d' );

        //---------- lebih dari 1 hari ------------------------------------
        if ( strtotime( $tgl_ajust ) > $tgl_lebih ) {
            $db->rollback();
            $pesan = array(
                'metadata'=>array(
                    'message'=>'Maaf, Pendaftaran maximal 1 Hari sebelum, Pemeriksaan.!',
                    'code'=>201
                ),
                'response'=>null
            );
            echo json_encode( $pesan );
            exit;
        }

        //---------- Kurang dari hari H ------------------------------------
        if ( strtotime( $tgl_ajust ) < strtotime( $mow ) ) {
            $db->rollback();
            $db = null;
            $pesan = array(
                'metadata'=>array(
                    'message'=>'Maaf, Tgl Pendaftaran yang di masukkan sudah berlalu.!',
                    'code'=>201
                ),
                'response'=>null
            );

            echo json_encode( $pesan );
            exit;
        }

        $mow = $tgl_ajust;
        $form_no = date_format( $tgl_daftar, 'ymd' );

    }

    $namahari = date( 'l', strtotime( $mow ) );
    include 'hari.php';

    //----------- Lihat jadwal ----------------------------------
    $sql = "select top (1) $namahari as hari,kuota,kuotajkn,start,durasi from jadwal_poli
					where  FMJKD_DOKTER='".$kd_dokterrs."' and
						   FMJKD_KLINIK='".$kd_polirs."' and kdkloter='".$kdkloter."' order by hari desc";

    // error_log($sql);
    $query = $db->prepare( $sql );
    $query->execute();
    $b = $query->fetch();
    if ( $b ) {
        $jadwal = $b['hari'];
        $kuotaumum = $b['kuota'];
        if ( $b['kuotajkn'] == '' || $b['kuotajkn'] == null ) {
            $kuotajkn = 0;
        } else {
            $kuotajkn = $b['kuotajkn'];
        }
        $kuota = $kuotaumum + $kuotajkn;
        $no_awal = $b['start'];
        $durasi = $b['durasi'];

        //jika kosong
        if ( empty( $jadwal ) ) {
            $query->closeCursor();
            $db->rollback();
            $pesan = array(
                'metadata'=>array(
                    'code'=>201,
                    'message'=>'Maaf, dokter tidak praktek, Pilih Dokter yang lain.!'
                ),
                'response'=>null
            );
            echo json_encode( $pesan );
            exit;
        }
    } else {
        $query->closeCursor();
        $db->rollback();
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Maaf, dokter tidak praktek, Pilih Dokter yang lain 2.!'
            ),
            'response'=>null
        );
        echo json_encode( $pesan );
        exit;
    }

    $query->closeCursor();
    /* -------------- Pecah sesi per sub kembali -----------------------------------
    */
    $sesi1 = substr( $jadwal, 0, 13 );

    $jam_awal = str_replace( ' ', '', substr( $sesi1, 0, 5 ) );
    $akhir = str_replace( ' ', '', substr( $sesi1, 7, 6 ) );

    // error_log( $jam_awal );

    $akhir = $akhir - 1;
    $akhir = $akhir.'.00';
    /* 24-hour time to 12-hour time
    $time_in_12_hour_format  = date( 'g:i a', strtotime( '13:30' ) );

    // 12-hour time to 24-hour time
    $time_in_24_hour_format  = date( 'H:i', strtotime( '1:30 PM' ) );
    */
    //Jam Terahir
    $akhir = date_create( $akhir );
    $akhir = date_format( $akhir, 'H.i' );

    //Jam Awal
    $awal = '06.00';
    $awal = date_create( $awal );
    $awal = date_format( $awal, 'H.i' );

    // Jam Sekarang
    $jam = date_create( $sekarang );
    $jam = date_format( $jam, 'H.i' );

    //-----Jalur Khusus VIP----------------------------------------------
    $hari_ini = date_create( $sekarang );
    $hari_ini = date_format( $hari_ini, 'Y-m-d' );
    $hari_input = $mow;

    // $db->rollback();
    // $pesan[] = 'Hari ini : '.$hari_ini.' | '.'Hari Input :'.$hari_input;
    // echo json_encode( $pesan );
    // exit;

    if ( $hari_ini == $hari_input ) {

        //-------------------batas awal--------------------------------------
        if ( $awal > $jam ) {
            $db->rollback();
            $pesan = array(
                'metadata'=>array(
                    'code'=>201,
                    'message'=>'Maaf, Pendaftaran belum di buka.!'
                ),
                'response'=>null
            );
            echo json_encode( $pesan );
            exit;

        }

        //Batas akhir
        if ( $akhir < $jam ) {
            $db->rollback();
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

    }

    carinomer :
    //---------------------------------------------------------------------
    $sql = "select KD_PASIEN from  ANTRIAN
					where KD_PASIEN='$rm' and
					KD_POLY='$kd_polirs' and convert(date,TGL_PERIKSA)='$mow' and kdkloter='".$kdkloter."'";

    $query = $db->prepare( $sql );
    $query->execute();
    $b = $query->fetch();
    if ( $b ) {
        $query->closeCursor();
        $db->rollback();

        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Maaf, Anda Sudah mendaftar dalam poli yang sama.!'
            ),
            'response'=>null
        );

        echo json_encode( $pesan );
        exit();
    }
    $query->closeCursor();
    /*------------------------------------------------------------------------------------------------
    cari Kode antrian dan kuota
    --------------------------------------------------------------------------------------------------*/
    $sql = "Select  a.RUANGANTRI,d.FMDDOKTERN,a.RUANGPOLI,d.FMDKUOTA
				  from ANTRIMONITOR a,dokter d
				  where a.KDA_DOKTER=d.FMDDOKTER_ID and a.KDA_DOKTER='".$kd_dokterrs."'";
    $query = $db->prepare( $sql );
    $query->execute();
    $b = $query->fetch();
    if ( !$b ) {
        $query->closeCursor();
        $db->rollback();
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Maaf, Kode Antrian tidak di temukan.!'
            ),
            'response'=>null
        );

        echo json_encode( $pesan );
        exit();
    } else {
        $antrian = $b['RUANGANTRI'];
        $nama_dok = $b['FMDDOKTERN'];
        $pol = $b['RUANGPOLI'];

    }
    $query->closeCursor();

    /*
    ---cari data pasien---
    */
    if ( $vip == 0 ) {
        //--------------- reguler---------------------------------------------
        $sql = "select KD_PERUSAHAAN from pasien where kd_pasien='$rm'";
        error_log($sql);
        $query = $db->prepare( $sql );
        $query->execute();
        $b = $query->fetch();
        if ( !$b ) {
            $query->closeCursor();
            $db->rollback();
            $pesan = array(
                'metadata'=>array(
                    'code'=>201,
                    'message'=>'Maaf, Data Pasien tidak valid !.'
                ),
                'response'=>null
            );
            echo json_encode( $pesan );
            exit;
        }
        // Identitas Pasien
        $kd_cus = $b['KD_PERUSAHAAN'];
    } elseif ( $vip == 1 ) {
        //--------------executive / Tarif Umum----------------------------------------------
        $kd_cus = 'XXX846';
    }

    $query->closeCursor();
    /*----------------------------------------------------------------------------------------------------------
    Cari Jenis Tarif
    ----------------------------------------------------------------------------------------------------------*/
    $sql = "select k.FMKJENIS_TARIP from  KELOMPOKCUSTOMER k, CUSTOMER c
				where  k.FMKCUST_ID=c.KELOMPOK_ID and c.CUSID='$kd_cus'";
    $query = $db->prepare( $sql );
    $query->execute();
    $b = $query->fetch();
    if ( !$b ) {
        $query->closeCursor();
        $db->rollback();

        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Maaf, Jenis Kostumer tidak ditemukan !.'
            ),
            'response'=>null
        );

        echo json_encode( $pesan );
        exit;
    }
    $jen_tarif = $b['FMKJENIS_TARIP'];
    $pasien = 2;
    // Pas Lama
    $asal_pas = 4;
    //Online
    $query->closeCursor();
    /*-----------------------------------------------------------------------------------------------------------
    Memberi No transaksi
    -----------------------------------------------------------------------------------------------------------
    -----------------------------------------------------------------------------------------------------------*/
    $umum = 'PK001';
    $fisio = 'PK020';
    $hd = 'PK32';
    $ozone = 'PK037';

    $no_tgl = $form_no;

    if ( $kd_polirs == $fisio ) {
        $nomer = 'BPF'.'-'.$jen_tarif.$no_tgl;
        $jenis = 'PK020';
    } elseif ( $kd_polirs == $hd ) {
        $nomer = 'BHD'.'-'.$jen_tarif.$no_tgl;
        $jenis = 'PK32';
    } elseif ( $kd_polirs == $ozone ) {
        $nomer = 'BOZ'.'-'.$jen_tarif.$no_tgl;
        $jenis = 'PK037';
    } else {
        $nomer = 'BRJ'.'-'.$jen_tarif.$no_tgl;
        $jenis = 'PK001';
    }

    // ---------------Cari Nomer------------------------------------------
    $sql = "Select top(1)FTNO_TRANSAKSI from TRANSAKSIPASIEN where left(FTNO_TRANSAKSI,12)='$nomer' ORDER BY FTNO_TRANSAKSI desc";
    $query = $db->prepare( $sql );
    $query->execute();
    $b = $query->fetch();
    $urut = $b['FTNO_TRANSAKSI'];
    if ( $b ) {
        //ambil data
        $awal = substr( $urut, 13, 3 );
        $awal = $awal + 1;
        //Hitung jumlah karakter
        $urut = strlen( $awal );
        if ( $urut == 1 ) {
            $jum = '00';
        } elseif ( $urut == 2 ) {
            $jum = '0';
        } elseif ( $urut == 3 ) {
            $jum = '';
        }
        $no_trans = $nomer.'-'.$jum.$awal;
    } else {
        $no_trans = $nomer.'-'.'001';
    }

    $query->closeCursor();
    // Masukkan data ke kunjungan pasien   / ( ambil jam )
    try {
        $sql = " insert into KUNJUNGANPASIEN 
						(KPKD_PASIEN,KPKD_POLY,KPTGL_PERIKSA,KPKD_DOKTER,KD_CUSTOMER,KPJAM_MASUK,KPBARU,KPASALPASIEN,
						KPJENISTRANSAKSI,KPNO_TRANSAKSI)
						values
						(:rm,:kd_poli, :tgl_p,:kd_dokter,:kd_cus,:jam_masuk,:pasien,:asal_pas,:jenis,:no_trans)";

        $query = $db->prepare( $sql );

        $data = array(
            ':rm'=>$rm,
            ':kd_poli'=>$kd_polirs,
            ':tgl_p'=>$mow,
            ':kd_dokter'=>$kd_dokterrs,
            ':kd_cus'=>$kd_cus,
            ':jam_masuk'=>$timer,
            ':pasien'=>$pasien,
            ':asal_pas'=>$asal_pas,
            ':jenis'=>$jenis,
            ':no_trans'=>$no_trans
        );
        $query->execute( $data );
    } catch( PDOException $e ) {
        goto carinomer;
    }

    $query->closeCursor();

    //--------------------------------------------------------------------

    /*
    0 = telp
    1 = anjungna
    2 = online
    */
    //Masukkan data ke Transaksi pasien
    $sql = " insert into TRANSAKSIPASIEN 
						(FTKD_PASIEN,FTKD_UNIT,FTTGL_TRANSAKSI,FTNO_TRANSAKSI,USERRS,UPDATERS,STS,VIP) 
						values
						(:rm,:kd_poli,:tgl_p,:no_trans,:user,:update,:sts,:vip)";

    $query = $db->prepare( $sql );

    $data = array(
        ':rm'=>$rm,
        ':kd_poli'=>$kd_polirs,
        ':tgl_p'=>$mow,
        ':no_trans'=>$no_trans,
        ':user'=>'BPJS',
        ':update'=>$sekarang,
        ':sts'=>'2',
        ':vip'=>$vip
    );

    $query->execute( $data );
    $query->closeCursor();

  

    //-------------cek kuota-------------------------------------------------------------------------
    $sql = '';
    $sql = "select count(no_urut) as total from antrian where tgl_periksa='".$mow."' and
               kd_poly='".$kd_polirs."' and
               kd_dokter='".$kd_dokterrs."' and kdkloter='".$kdkloter."'";

    //--------------------------------khusus UMUM ---------------------------------------------------
    // if ( $jkn == 0 ) {
    //     $labeljkn       = 'Umum';
    //     $sql            = $sql . " jkn='0'";
    //     $kuotabanding   = $kuotaumum;
    // } elseif ( $jkn == 1 ) {
    //     //------------------------------Khusus JKN ---------------------------------------------------
    //     $labeljkn     = 'BPJS/JKN';
    //     $sql          = $sql . " jkn='1'";
    //     $kuotabanding = $kuotajkn;

    // }

    //----------Hitung  kloter---------------------
    $cekumum = $db->prepare( $sql );
    $cekumum   -> execute();

    $h = $cekumum->fetch();
    if ( $h ) {
        $pasumum = $h['total'];
    } else {
        $pasumum = 0;
    }

    //-------------------------------verifikasi kuota-----------------------------------
    if ( $pasumum >= $kuota ) {
        $db->rollback();

        //------------Masukkan Log------------------------------------------------------
        $sql = "select kd_pasien from antrian_tolak where 
								kd_poly='".$kd_polirs."' and kd_pasien='".$rm."' and 
								kd_dokter='".$kd_dokterrs."' and convert(date,tgl_periksa)='".$mow."' and
								kdkloter='".$kdkloter."'";

        $query = $db->prepare( $sql );
        $query->execute();
        $c = $query->fetch();
        if ( !$c ) {
            $sql = "insert into antrian_tolak
								(KD_PASIEN, KD_POLY, KD_DOKTER, TGL_PERIKSA, STS, VIP,KDKLOTER) values
								('".$rm."','".$kd_polirs."','".$kd_dokterrs."','".$sekarang."','2','".$vip."','".$kdkloter."')";

            $query = $db->prepare( $sql );
            $query->execute();
        }
        $query->closeCursor();
        //------------------------------------------------------------------------------

        $db = null;
        $pesan    = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>'Kuota Pendaftaran Pasien  untuk sesi '.$kdkloter.' telah habis, Pilih Sesi yg lain '
            ),
            'response'=>null
        );

        echo json_encode( $pesan );
        exit;
    }

    /*------------------------------------------------------------------------------------------------
    cari no urut
    --------------------------------------------------------------------------------------------------*/

    $sql = "select top(1) NO_URUT from ANTRIAN
					where
					KD_ANTRI='$antrian' and
					convert(date,TGL_PERIKSA)='$mow' and
					KD_POLY='$kd_polirs' and
					KD_DOKTER='".$kd_dokterrs."' and kdkloter='".$kdkloter."' order by NO_URUT desc";

    $query = $db->prepare( $sql );
    $query->execute();
    $b = $query->fetch();

    if ( $no_awal == 0 ) {
        $query->closeCursor();
        $db->rollback();
        $pesan = array(
            'metadata'=>array(
                'code'=>201,
                'message'=>"Maaf, Settingan No Start Antrian Dokter $nama_dok Tidak boleh 0, Terima Kasih."
            ),
            'response'=>null
        );

        echo json_encode( $pesan );
        exit();
    }
    //----------------------------------------------------------------

    if ( $b ) {
        $no = $b['NO_URUT'];
        // --------Khusus Online-----------------------------------------
        if ( $no_awal > $no ) {
            $no_urut = $no_awal;
            // NOmer Kurang dari nomer awal
        } else {
            $no_urut = $no + 1 ;
        }
    } else {
        // dimulai dari angka 6
        $no_urut = $no_awal;
    }
    $query->closeCursor();

    //----------------------------------------------------------------------------------------
    //--------------Cek no_antrian------------------------------------------------------------
    $sql = "select NO_URUT from ANTRIAN where 
					KD_ANTRI='$antrian' and
					convert(date,TGL_PERIKSA)='$mow' and
					KD_POLY='$kd_polirs' and
					KD_DOKTER='$kd_dokterrs' and NO_URUT='".$no_urut."' and kdkloter='".$kdkloter."' order by NO_URUT desc";
    $query = $db->prepare( $sql );
    $query->execute();
    $d = $query->fetch();
    if ( $d ) {
        $no_urut = $no_urut+1;
    }
    $query->closeCursor();

    //----------------------------------------------------------------------------------------
    /*------------------  Simpan Antrian telp------------------------------
    ----------------------------------------------------------------------*/
    // lanjut :
    // if ( strlen( $no_trans ) == 1 ) {
    //     $urut = '000'. $no_trans;
    // } elseif ( strlen( $no_trans ) == 2 ) {
    //     $urut = '00' . $no_trans;
    // } elseif ( strlen( $no_trans ) == 3 ) {
    //     $urut = '0' . $no_trans;
    // } elseif ( strlen( $no_trans ) == 4 ) {
    //     $urut = '' . $no_trans;
    // }

    // $nomertrans = date( 'Y-m-d' ).$urut;
    $status = 'ANTRI';

    $sql = "insert into ANTRIAN
					  (NO_URUT,KD_ANTRI,kd_PASIEN,Tgl_periksa,JAM_daftar,TGLLAHIR,NM_DOKTER,NO_transaksi,KD_POLY,KD_DOKTER,PANGGIL_KE,STATUS_ANTRI,NM_PASIEN,STS,TGL_APOITMEN,USR_EMAIL,VIP,GERI,KDKLOTER,NO_TEMP,JKN)
					   Values
					  (:no,:antri,:rm,:tgl_p,:jam_daftar,:tgl_lahir,:nama_dok,:no_trans,:kd_poli,:kd_dokter,:panggil,:status,:nama_pas,:sts,:tgl_appoit,:email,:vip,:geri,:kdkloter,:no_temp,:jkn)";
    $query = $db->prepare( $sql );
    $data = array(
        ':no'=>$no_urut,
        ':antri'=>$antrian,
        ':rm'=>$rm,
        ':tgl_p'=>$mow,
        ':jam_daftar'=>$sekarang,
        ':tgl_lahir'=>$tgl,
        ':nama_dok'=>$nama_dok,
        ':no_trans'=>$no_trans,
        ':kd_poli'=>$kd_polirs,
        ':kd_dokter'=>$kd_dokterrs,
        ':panggil'=>'0',
        ':status'=>$status,
        ':nama_pas'=>$nama,
        ':sts'=>'2',
        ':tgl_appoit'=>null,
        ':email'=>$email,
        ':vip'=>$vip,
        ':geri'=>$geri,
        ':kdkloter' => $kdkloter,
        ':no_temp'  => null,
        ':jkn'      => $jkn
    );

    //----------------------------------------------------------------------
    $query->execute( $data );
    $query->closeCursor();
    //-----------------------------------------------------------------------------------------------------------------

    $db->commit();
    //----------------------------------- cek total antrian ----------------
    $sql = '';
    $sql = "select a.NO_URUT,a.KD_ANTRI, a.NM_DOKTER,b.FMPKLINIKN as POLI,a.JAM_PELAYANAN,a.JAM_DAFTAR,a.JAM_SELESAI, datediff(MILLISECOND, a.JAM_PELAYANAN,a.JAM_SELESAI) as ESTIMASI from antrian a inner join POLIKLINIK b on a.kd_poly=b.FMPKLINIK_ID
  		
        where convert(date,a.tgl_periksa)='".$tgl_periksa."' and a.KD_POLY='".$kd_polirs."' and a.kd_pasien='".$rm."' and a.kdkloter='".$kdkloter."'";
    $query = $db->prepare( $sql );
    $query->execute();
    $c = $query->fetch();
    if ( $c ) {
        $nomor_antrian = ( int ) $c['NO_URUT'];
        $kd_antri = $c['KD_ANTRI'];
        $dokter = $c['NM_DOKTER'];
        $poli = $c['POLI'];
        // $seconds = strtotime( $c['JAM_DAFTAR'] );
        // $estimasi = strtotime( gmdate( 'H:i:s', $seconds ) ) * 1000;

        $second = date_create( $c['JAM_DAFTAR'] );
        // $estimasi = strtotime( date_format( $second, 'H:i:s' ) ) * 1000;

        // $sesi1        = substr( $d['JAM_PRAKTEK'], 0, 13 );
        // $jam_awal     = str_replace( ' ', '', substr( $sesi1, 0, 5 ) );

        if ( empty( $durasi ) ) {
            $durasi = 0;
        } else {
            // $durasi       = ( intval( $no_urut ) * intval( $durasi ) ) - intval( $durasi );
            $durasi       = ( ( int ) $no_urut  * ( int ) $durasi ) - ( int ) $durasi ;
        }

        $jam_awal     = str_replace( ',', ':', $jam_awal );
        $jam_awal     = str_replace( '.', ':', $jam_awal );
        
        $jam_awal     = $jam_awal;

        $time = new DateTime( $jam_awal );
        $time->add( new DateInterval( 'PT' . $durasi . 'M' ) );
        $jam_layani = $time->format( 'H:i' );

        $jamout = date("Y-m-d H:i",strtotime($mow.' '.$jam_layani));
        $estimasi = strtotime( $jamout ) * 1000;

     

    } else {
        // $db->rollback();
        $db = null;
        $query->closeCursor();
        $pesan = array(
            'metadata'=>array(
                'code'=>305,
                'message'=>$sql
            ),
            'response'=>null
        );

        echo json_encode( $pesan );
        exit;

    }

    $query->closeCursor();

 
    $sisakuotaumum = 0;

    //-----------cari sisa antrean---------------------------
    $sql = "select count(no_urut) as total from antrian where tgl_periksa='".$mow."' and
               kd_poly='".$kd_polirs."' and
               kd_dokter='".$kd_dokterrs."' and kdkloter='".$kdkloter."'";
    $query      = $db->prepare( $sql );
    $query      -> execute();
    $h          = $query->fetch();
    if ( $h ) {
        $sisakuotajkn = $kuota - $h['total'] ;
    } else {
        $sisakuotajkn = $kuota;
    }
    $query ->closeCursor();

    $db = null;
    $pesan = array(
        'nomorantrean'      => $kd_antri.'.'.$nomor_antrian,
        'angkaantrean'      => $nomor_antrian,
        'kodebooking'       => $no_trans,
        'norm'		        => $rm,
        'namapoli'          => $poli,
        'namadokter'        => $dokter,
        'estimasidilayani'  => $estimasi,
        'sisakuotajkn'      => $sisakuotajkn,
        'kuotajkn'          => $kuota,
        'sisakuotanonjkn'   => 0,
        'kuotanonjkn'       => 0,
        'keterangan'        => 'Peserta harap 60 menit lebih awal guna pencatatan administrasi.'
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

// print_r( $decoded->password );
?>