<?php
// Mengatasi Masalah CORS
header("Access-Control-Allow-Origin: *"); // Mengizinkan semua domain, ganti '*' dengan domain spesifik untuk keamanan
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Cek Metode OPTIONS untuk Preflight Request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Konfigurasi Koneksi Database
include '../koneksi.php';
$tglsimpan = date("Y-m-d H:i:s");
// Mendapatkan Data dari Request Body
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data)) {
    $response = [];

    foreach ($data as $item) {
        $kdobat = $conn->real_escape_string($item['kdobat']);
        $notransaksi = $conn->real_escape_string($item['notransaksi']);
        $nomor = $conn->real_escape_string($item['nomor']);
        $frekuensiket = $conn->real_escape_string($item['frekuensiket']);
        $signa = $conn->real_escape_string($item['signa']);
        $keterangan = $conn->real_escape_string($item['keterangan']);
        $jmlpakai= $conn->real_escape_string($item['jmlpakai']);
        $aturan = $frekuensiket . ' ' . $signa;

        // Query Update Data
        $query = "UPDATE ermcpptintruksi 
                  SET aturan='$aturan', signa='$signa', keterangan='$keterangan', frekuensi='$frekuensiket',
                  jmlpakai='$jmlpakai'
                  WHERE kdpruduk='$kdobat' AND notransaksi='$notransaksi'";

        if ($conn->query($query) === TRUE) {
            $response[] = [
                "kdobat" => $kdobat,
                "status" => "success",
                "message" => "Data berhasil diperbarui"
            ];
        //         $kdkostumerd= $conn->real_escape_string($item['kdkostumerd']);
        //         $norm= $conn->real_escape_string($item['norm']);
        //         $kddokter= $conn->real_escape_string($item['kddokter']);
        //         $kdpoli= $conn->real_escape_string($item['kdpoli']);
        //         $nama= $conn->real_escape_string($item['nama']);
        //         $aturan= $conn->real_escape_string($item['aturan']);
        //         $qty= $conn->real_escape_string($item['qty']);
        //         $harga= $conn->real_escape_string($item['harga']);
        //         $keterangan= $conn->real_escape_string($item['keterangan']);
        //          $no= $conn->real_escape_string($item['no']);
                
                
                
        //       $queryl = "INSERT INTO ermcpptintruksi (notransaksi, kdkostumerd, norm, kddokter, 
        //       kdpoli, kdpruduk, nama, aturan, qty, harga, keterangan,
        //       statuso, status, dari, kduser, kdcabang, tgl,
        //       kdcppt, kunci, tglpriksa, kd, no, hargasatuan, 
        //       dari2, kirim, signa, hari, frekuensi, jmlpakai) 
        //           VALUES ('$notransaksi', '$kdkostumerd', '$norm', '$kddokter', 
        //           '$kdpoli', '$kdobat', '$nama', '$aturan', '$qty',
        //           '$harga', '$keterangan', 'Non Racik', '0', 
        //           'Obat', '-', '$kdcabang', '$tglsimpan', '-',
        //           '0', '$tglsimpan', '-', '$no', '$harga',
        //           'Farmasi', 'Ya', '$signa', '0', '$frekuensiket', 
        //           '$jmlpakai')";

        // if ($conn->query($queryl) === TRUE) {
        //     $response[] = [
        //         "notransaksi" => $notransaksi,
        //         "status" => "success",
        //         "message" => "Data berhasil disimpan"
        //     ];
        // } else {
        //     $response[] = [
        //         "notransaksi" => $notransaksi,
        //         "status" => "error",
        //         "message" => "Gagal menyimpan data: " . $conn->error
        //     ];
        // }
        
        
        } else {
            $response[] = [
                "kdobat" => $kdobat,
                "status" => "error",
                "message" => "Gagal memperbarui data: " . $conn->error
            ];
        }
    }

    // Kirim Respons JSON
    echo json_encode(["status" => "success", "results" => $response]);
} else {
    echo json_encode(["status" => "error", "message" => "Data tidak valid"]);
}

// Tutup Koneksi
$conn->close();
?>
