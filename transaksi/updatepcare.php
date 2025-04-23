<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
 

 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);





$stssimpan =$data->stssimpan;

$notransaksi =  $data->notransaksi;

$tgl = date("Y-m-d H:i:s");






if($stssimpan === '1'){
$conn -> autocommit(FALSE);

$noantrian =$data->noantrian;

$conn -> query("UPDATE kunjunganpasien set spcare='TERDAFTAR DI PCARE',
kdtkp='$data->kdtkp',jeniskun='$data->jeniskun'
 where notransaksi='$notransaksi'");


$conn -> query("UPDATE antrian set noantrianbpjs='$noantrian'
 where notransaksi='$notransaksi'");




// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode('Sukses');

}

// Rollback transaction
$conn -> rollback();

$conn -> close();



}else if($stssimpan === '2'){


// $conn -> autocommit(FALSE);


// $nokunjungan=$data->nokunjungan;
// $kdpoli=$data->kdpoli;
// $kddokter=$data->kddokter;
// $jeniskunjungan=$data->jeniskunjungan;
// $username=$data->$username;


// $conn -> query("UPDATE kunjunganpasien set spcare='SUDAH KIRIM KUNJUNGAN',
// nokunjungan='$nokunjungan',skunjungan=1,jeniskunjungan='$jeniskunjungan'
//  where notransaksi='$notransaksi'");




//   $conn -> query("INSERT INTO riwayatpulang(skunjungan,jeniskunjungan,nokunjungan,
//   notransaksi,username) 
//  values('1','$jeniskunjungan','$nokunjungan','$notransaksi','$username')");





// // Commit transaction
// if (!$conn -> commit()) {
//   // echo "Commit transaction failed";
//     echo json_encode('Gagal');
 

//   exit();
// }else{
// echo json_encode('Sukses');

// }

// // Rollback transaction
// $conn -> rollback();

// $conn -> close();

$conn->autocommit(FALSE);

// Ambil data dari input
$nokunjungan = isset($data->nokunjungan) ? $data->nokunjungan : null;
$kdpoli = isset($data->kdpoli) ? $data->kdpoli : null;
$kddokter = isset($data->kddokter) ? $data->kddokter : null;
$jeniskunjungan = isset($data->jeniskunjungan) ? $data->jeniskunjungan : null;
$username = isset($data->username) && !empty($data->username) ? $data->username : '-';

// Periksa parameter wajib
if (empty($nokunjungan) || empty($notransaksi)) {
    echo json_encode('Gagal');
    exit();
}

// Query 1: Update tabel kunjunganpasien
$updateQuery = "
    UPDATE kunjunganpasien 
    SET spcare = 'SUDAH KIRIM KUNJUNGAN',
        nokunjungan = '$nokunjungan',
        skunjungan = 1,
        jeniskunjungan = '$jeniskunjungan'
    WHERE notransaksi = '$notransaksi'
";

if (!$conn->query($updateQuery)) {
    $conn->rollback(); // Batalkan transaksi jika gagal
    echo json_encode('Gagal');
    exit();
}

// Query 2: Insert ke tabel riwayatpulang
$insertQuery = "
    INSERT INTO riwayatpulang (skunjungan, jeniskunjungan, nokunjungan, notransaksi, username,tgl) 
    VALUES ('1', '$jeniskunjungan', '$nokunjungan', '$notransaksi', '$username','$tgl')
";

if (!$conn->query($insertQuery)) {
    $conn->rollback(); // Batalkan transaksi jika gagal
    echo json_encode('Gagal');
    exit();
}

// Commit transaksi jika semua query berhasil
if ($conn->commit()) {
   echo json_encode('Sukses');
} else {
  echo json_encode('Gagal');
}

// Tutup koneksi
$conn->close();



}else if($stssimpan === '3'){




$conn -> autocommit(FALSE);

$kdpoli=$data->kdpoli;
$noRujukan=$data->noRujukan;
$nokaPst=$data->nokaPst;
// $conn -> query("UPDATE kunjunganpasien set nokunjungan='0',skunjungan=0,jeniskunjungan='0'
//  where notransaksi='$notransaksi' and kdpoli='$kdpoli'");

// $conn -> query("DELETE from riwayatkunjungan  where noRujukan='$noRujukan' and nokaPst='$nokaPst' ");





// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode('Sukses');

}

// Rollback transaction
$conn -> rollback();

$conn -> close();






}else if($stssimpan === '4'){
$conn -> autocommit(FALSE);







// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode('Sukses');

}

// Rollback transaction
$conn -> rollback();

$conn -> close();

}else if($stssimpan === '5'){




}
   

 




?>