<?php
require_once __DIR__ . '/vendor/autoload.php'; // Autoload MPDF
include '../koneksi.php'; // Koneksi ke database

// Tanggal filter (bisa juga didapat dari input form)
$notrans = $_GET['notrans'];
$tanggalSelesai = $_GET['tglsampai'];



// Query untuk mengambil data penggunaan obat
$query = "SELECT 
a.*,b.spcare
FROM riwayatpulang a,kunjunganpasien b where  a.notransaksi = b.notransaksi AND a.notransaksi='$notrans'";

$result = $conn->query($query);

// Menyusun HTML untuk laporan
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penggunaan Obat</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { text-align: center; padding: 8px; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h6>Riwayat Editing Status Pulang</h6>
   
    <table>
        <thead>
            <tr>
                <th>Waktu</th>
                <th>Status Pulang</th>
                <th>No Kunjungan</th>
                   <th>Username</th>
            </tr>
        </thead>
        <tbody>';

// Menambahkan data ke tabel
while ($row = $result->fetch_assoc()) {
        
        if($row['jeniskunjungan'] === '3'){
               $stspulang ='Rawat Jalan';
        }else if($row['jeniskunjungan'] === '4'){      
        
              $stspulang ='Rujuk';
               
            
        }else{
            
            $stspulang ='';
        }
        
    
    
    $html .= '
            <tr>
                <td>' . htmlspecialchars($row['tgl']) . '</td>
                <td>' . htmlspecialchars($stspulang) . '</td>
                <td>' . htmlspecialchars($row['nokunjungan']) . '</td>
                  <td>' . htmlspecialchars($row['username']) . '</td>
            </tr>';
}

$html .= '
        </tbody>
    </table>
</body>
</html>';

// Inisialisasi MPDF dan Generate PDF
try {
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    $mpdf->Output('Laporan_Penggunaan_Obat.pdf', 'I'); // Download file PDF
} catch (\Mpdf\MpdfException $e) {
    echo 'Error saat membuat PDF: ' . $e->getMessage();
}

// Tutup koneksi
$conn->close();
?>
