<?php
header("Content-Type: application/json");

// Sertakan koneksi ke database
include '../koneksi.php';

// Ambil input JSON dari body POST
$inputJSON = file_get_contents('php://input');
$inputData = json_decode($inputJSON, true);

// Cek apakah parameter kddokter tersedia
// if (!isset($inputData['data']['kddokter'])) {
//    echo json_encode([
//        'code'    => '400',
//        'message' => 'Kode Dokter tidak ditemukan',
//        'result'  => null
//    ]);
//    exit;
// }

$kddokter = $inputData['data']['kddokter'];

// Siapkan query dengan prepared statement
$stmt = $conn->prepare("SELECT usericare, passicare FROM dokter WHERE kddokter = ? LIMIT 1");
if (!$stmt) {
    echo json_encode([
        'code'    => '500',
        'message' => 'Gagal menyiapkan query',
        'result'  => null
    ]);
    exit;
}

$stmt->bind_param("s", $kddokter);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $usericaredokter = $row['usericare'];
    $passicaredokter = $row['passicare'];
}

$stmt->close();
$conn->close();
?>
