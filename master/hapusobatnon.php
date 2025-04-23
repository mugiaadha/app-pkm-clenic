<?php

 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
 

 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);



$kdcabang=$data->kdcabang;
$notransaksi = $data->notransaksi;
$kdpoli = $data->kdpoli;
$kdpruduk = $data->kdpruduk;
$statuso = $data->statuso;
$dari = $data->dari;
$kunci  = $data->kunci;
$no  = $data->no;
$kdcppt  = $data->kdcppt;
$stssimpan = $data->stssimpan;


if($stssimpan === '1'){

// Mulai transaksi
$conn->autocommit(FALSE);

// Ambil kode gudang utama
$sqlv = "SELECT kdgudang FROM gudang WHERE utama='1'";
$resultv = $conn->query($sqlv);
if ($resultv->num_rows === 0) {
    echo json_encode('Gagal');
    $conn->rollback();
    $conn->close();
    exit();
}

$kdgudang = $resultv->fetch_assoc()['kdgudang'];

// Cek apakah data jualobatd sudah terverifikasi
$sql = "SELECT * FROM jualobatd WHERE nofaktur = ? AND nomor = ? 
AND kdcabang = ? AND kdobat = ? ";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssss', $notransaksi, $no, $kdcabang, $kdpruduk);
$stmt->execute();
$result = $stmt->get_result();

// if ($result->num_rows > 0) {
    
//     echo json_encode('Tidak bisa dihapus, obat sudah diverifikasi oleh farmasi.');
    
    
//     // echo json_encode(['status' => 'error', 'message' => 'Tidak bisa dihapus, obat sudah diverifikasi oleh farmasi.']);
//     $conn->rollback();
//     $conn->close();
//     exit();
// }else{
    
      $row = $result->fetch_assoc();
     $qty = $row['qty']; // Ambil nilai qty
     
  
    
// }
//   echo "Debug Query: " . $sql;
//     echo "Debug Data: notransaksi = $notransaksi, nomor = $no, kdcabang = $kdcabang, kdobat = $kdpruduk";
// print_r($row); // Untuk melihat hasil query

// if ($result->num_rows > 0) {
//     $row = $result->fetch_assoc();
//     $qty = $row['qty']; // Ambil nilai qty
// //     echo "Debug Query: " . $sql;
// // echo "Debug Data: notransaksi = $notransaksi, nomor = $no, kdcabang = $kdcabang, kdobat = $kdpruduk";
// // print_r($row); // Untuk melihat hasil query

// } else {
//     echo json_encode('Data tidak ditemukan untuk query jualobatd.');
    
// //     echo "Debug Query: " . $sql;
// // echo "Debug Data: notransaksi = $notransaksi, nomor = $no, kdcabang = $kdcabang, kdobat = $kdpruduk";
// // print_r($row); // Untuk melihat hasil query
//     $conn->rollback();
//     $conn->close();
//     exit();
// }



// Hapus data dari tabel terkait
$conn->query("DELETE FROM ermcpptintruksi WHERE notransaksi = '$notransaksi' AND kdpoli = '$kdpoli' AND kdpruduk = '$kdpruduk' AND statuso = '$statuso' AND dari = '$dari' AND no = '$no' AND kdcppt = '$kdcppt'");
$conn->query("DELETE FROM jualobatd WHERE nofaktur = '$notransaksi' AND nomor = '$no' AND kdcppt = '$kdcppt'");

// Update stok obat
$conn->query("UPDATE obatstock SET stok = stok + $qty WHERE
kdgudang = '$kdgudang' AND kdobat = '$kdpruduk' AND kdcabang = '$kdcabang'");



$conn->query("UPDATE saldoobat SET FSBPENJUALAN = FSBPENJUALAN - $qty WHERE kdbarang = '$kdpruduk' AND KDCABANG = '$kdcabang' AND kdgudang = '$kdgudang'");


// Commit transaksi
if ($conn->commit()) {
    echo json_encode('Berhasil!');
} else {
    echo json_encode('Transaksi gagal.');
    $conn->rollback();
}

$conn->close();



}else if($stssimpan === '2'){

  $conn -> autocommit(FALSE);

  $kd = $data->kd;


  $conn -> query("DELETE FROM ermcpptintruksi where notransaksi='$notransaksi' and kdpoli='$kdpoli' and 
    statuso='$statuso' and dari='$dari'  and kdcppt='$kdcppt' and kd='$kd'");



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

}else if($stssimpan === '3'){










}else if($stssimpan === '4'){



}else if($stssimpan === '5'){

 

}
   

 




?>