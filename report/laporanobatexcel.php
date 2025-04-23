<?php

include '../koneksi.php';

$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-01');
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-t');
$jenis_obat = isset($_GET['jenis_obat']) ? $_GET['jenis_obat'] : 'analgesik';

switch ($jenis_obat) {
    case 'analgesik':
        $judul = 'Total Jumlah Seluruh Resep ISPA Non-Pneumonia';
        break;
    case 'antibiotik':
        $judul = 'Jumlah Resep ISPA Non-Pneumonia yang Mengandung Antibiotik';
        break;
    case 'antidiare':
        $judul = 'Total Jumlah Seluruh Resep Diare Non-Spesifik';
        break;
    default:
        $judul = 'Laporan Obat';
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=report.xls");

echo "#\tKode Obat\tNama Obat\tJenis Obat\tJumlah\n";

$sql = "SELECT
    obat.kdobat AS Kode_Obat,
    obat.obat AS Nama_Obat,
    jenis.jenis AS Jenis_Obat,
    SUM(detail.qty) AS Jumlah
FROM
    jualobat jual
    JOIN jualobatd detail ON jual.notransaksi = detail.notransaksi
    JOIN obat ON detail.kdobat = obat.kdobat
    JOIN jenisobat jenis ON obat.jenisobat = jenis.kdjenis
WHERE
    jenis.jenis = '$jenis_obat'
    AND jual.tgl BETWEEN '$start_date' AND '$end_date'
GROUP BY obat.kdobat, obat.obat, jenis.jenis
ORDER BY Nama_Obat ASC";

$result = $conn->query($sql);
$total_jumlah = 0;
$no = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $no++;
        $total_jumlah += $row['Jumlah'];
        echo "$no\t{$row['Kode_Obat']}\t{$row['Nama_Obat']}\t{$row['Jenis_Obat']}\t{$row['Jumlah']}\n";
    }
    echo "\t\t\tTotal\t$total_jumlah\n";
} else {
    echo "Tidak ada data ditemukan\n";
}

$conn->close();
?>
