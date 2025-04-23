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

echo "<h2 style='text-align: center;'>$judul<br>Periode " . date('d F Y', strtotime($start_date)) . " s/d " . date('d F Y', strtotime($end_date)) . "</h2>";

echo "<form method='GET' style='text-align: center; margin-bottom: 20px;'>
        <label>Start Date: </label>
        <input type='date' name='start_date' value='$start_date'>
        <label>End Date: </label>
        <input type='date' name='end_date' value='$end_date'>
        <label>Jenis Obat: </label>
        <select name='jenis_obat'>
            <option value='analgesik' " . ($jenis_obat == 'analgesik' ? 'selected' : '') . ">Analgesik</option>
            <option value='antibiotik' " . ($jenis_obat == 'antibiotik' ? 'selected' : '') . ">Antibiotik</option>
            <option value='antidiare' " . ($jenis_obat == 'antidiare' ? 'selected' : '') . ">Antidiare</option>
        </select>
        <button type='submit'>Filter</button>
    </form>";

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='5' cellspacing='0' style='width: 100%; border-collapse: collapse; text-align: center; font-size: 9px;'>
            <thead>
                <tr style='background-color: #f2f2f2;'>
                    <th>#</th>
                    <th>Kode Obat</th>
                    <th>Nama Obat</th>
                    <th>Jenis Obat</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>";
    $no = 0;
    while ($row = $result->fetch_assoc()) {
        $no++;
        $total_jumlah += $row['Jumlah'];

        echo "<tr>
                <td>$no</td>
                <td>{$row['Kode_Obat']}</td>
                <td align='left'>{$row['Nama_Obat']}</td>
                <td>{$row['Jenis_Obat']}</td>
                <td>{$row['Jumlah']}</td>
            </tr>";
    }
    echo "<tr style='background-color: #f2f2f2; font-weight: bold;'>
            <td colspan='4' style='text-align: right;'>Total</td>
            <td>$total_jumlah</td>
          </tr>";
    echo "</tbody></table>";
} else {
    echo "<p style='text-align: center; color: red;'>Tidak ada data ditemukan</p>";
}
$conn->close();
?>
