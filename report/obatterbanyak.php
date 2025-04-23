<?php
require_once __DIR__ . '/vendor/autoload.php'; // Autoload MPDF
include '../koneksi.php'; // Koneksi ke database

// Tanggal filter (bisa juga didapat dari input form)
$tanggalMulai = $_GET['tgldari'];
$tanggalSelesai = $_GET['tglsampai'];



// Query untuk mengambil data penggunaan obat
$query = "
SELECT 
    a.kdobat, b.obat, SUM(a.qty) AS qty
FROM 
    jualobatd a, obat b
WHERE 
    a.kdobat = b.kdobat 
    AND a.tgl BETWEEN '$tanggalMulai' AND '$tanggalSelesai'
GROUP BY 
    a.kdobat
ORDER BY 
    SUM(a.qty) DESC
";

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
    <h1>Laporan Penggunaan Obat</h1>
    <p><strong>Periode:</strong> ' . $tanggalMulai . ' s/d ' . $tanggalSelesai . '</p>
    <table>
        <thead>
            <tr>
                <th>Kode Obat</th>
                <th>Nama Obat</th>
                <th>Jumlah Penggunaan</th>
            </tr>
        </thead>
        <tbody>';

// Menambahkan data ke tabel
while ($row = $result->fetch_assoc()) {
    $html .= '
            <tr>
                <td>' . htmlspecialchars($row['kdobat']) . '</td>
                <td>' . htmlspecialchars($row['obat']) . '</td>
                <td>' . htmlspecialchars($row['qty']) . '</td>
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
