<?php

require_once __DIR__ . '/vendor/autoload.php';

include '../koneksi.php';

include 'terbilang.php';



$nofaktur = $_GET['nofaktur'];

$kdcabang = $_GET['kdcabang'];



date_default_timezone_set('Asia/Bangkok');

$tgl = date("Y-m-d");



// Buat instance MPDF

$mpdf = new \Mpdf\Mpdf([

    'format' => [80, 200], // Lebar 8 cm, panjang sementara

    'margin_left' => 10,

    'margin_right' => 10,

    'margin_top' => 5,

]);



// Query utama untuk Non-Racik

$sql = "SELECT * FROM ermcpptintruksi 

        WHERE notransaksi='$nofaktur' AND kdcabang='$kdcabang' AND dari='obat' AND dari2='CPPT' AND statuso='Non Racik' 

        ORDER BY tgl ASC";

$result = mysqli_query($conn, $sql);

if (!$result) {

    die("Query gagal: " . mysqli_error($conn));

}



// Query untuk informasi total bayar

$queryx = "SELECT DISTINCT kd, kdpruduk, nama, aturan, qty, keterangan

           FROM ermcpptintruksi 

           WHERE notransaksi='$nofaktur' AND kdcabang='$kdcabang' AND dari='MObat'
           AND statuso='MRacik' AND dari2='CPPT' and nama <> ''

           ORDER BY tgl ASC";

$resultx = mysqli_query($conn, $queryx);

if (!$resultx) {

    die("Query gagal: " . mysqli_error($conn));

}




// Query untuk informasi total bayar

$querynoan = "SELECT no from noanteanfarmasi where notrans='$nofaktur'";

$resultbbno = mysqli_query($conn, $querynoan);

if (!$resultbbno) {

    die("Query gagal: " . mysqli_error($conn));

}

$noan = '';

while ($row = mysqli_fetch_assoc($resultbbno)) {

    $noan = $row['no'];

    

}



// Query untuk informasi total bayar

$querybb = "SELECT bb from ermcppt where notrans='$nofaktur'";

$resultbb = mysqli_query($conn, $querybb);

if (!$resultbb) {

    die("Query gagal: " . mysqli_error($conn));

}

$bb = '';

while ($row = mysqli_fetch_assoc($resultbb)) {

    $bb = $row['bb'];

    

}





// Query untuk informasi total bayar

$querybbx = "SELECT * from cabang where kdcabang='$kdcabang'";

$resultbbx = mysqli_query($conn, $querybbx);

if (!$resultbbx) {

    die("Query gagal: " . mysqli_error($conn));

}

$namaklinik = '';

$alamatklinik = '';

$hp = '';

while ($row = mysqli_fetch_assoc($resultbbx)) {

 



    $namaklinik=$row['nama'];

    $alamatklinik=$row['alamat'];

    $hp=$row['hp'];

    





    

}





// Template query untuk detail Racik

$queryxl_template = "SELECT * FROM ermcpptintruksi 

                     WHERE notransaksi='$nofaktur' AND kdcabang='$kdcabang' AND dari='Obat' AND statuso='Racik' AND dari2='CPPT'
                     AND kd='%s' 
                  
                     ORDER BY tgl ASC";



// Query untuk data pasien dan dokter

$query_pasien = "SELECT 

                 a.norm, a.kdpoli, a.tglpriksa, a.kddokter, a.kdkostumerd, a.notransaksi, b.pasien, b.tgllahir, c.noantrian,

                 d.nampoli, e.namdokter, f.nama, g.costumer, b.alamat, g.kdtarif, a.kelas, b.jeniskelamin, b.alamat

                 FROM kunjunganpasien a

                 LEFT JOIN pasien b ON a.norm = b.norm

                 LEFT JOIN antrian c ON a.notransaksi = c.notransaksi

                 LEFT JOIN poliklinik d ON a.kdpoli = d.kdpoli

                 LEFT JOIN dokter e ON a.kddokter = e.kddokter

                 LEFT JOIN kelompokkostumerd f ON a.kdkostumerd = f.kdkostumerd

                 LEFT JOIN kelompokkostumer g ON f.kdkostumer = g.kdkostumer

                 WHERE a.kdcabang='$kdcabang' AND a.notransaksi='$nofaktur' 

                 ORDER BY a.kddokter, c.noantrian ASC";

$result_pasien = mysqli_query($conn, $query_pasien);

if (!$result_pasien) {

    die("Query gagal: " . mysqli_error($conn));

}



$norm = '';

$pasien = '';

$tgllahir = '';

$kostumer = '';

$Poliklinik = '';

$namdokter = '';

$tglpriksa = '';

$jk = '';

$alamat = '';

$umur = '';



// Ambil data pasien

while ($row = mysqli_fetch_assoc($result_pasien)) {

    $kostumer = $row['costumer'];

    $norm = $row['norm'];

    $Poliklinik = $row['nampoli'];

    $namdokter = $row['namdokter'];

    $tglpriksa = $row['tglpriksa'];

    $tgllahir = $row['tgllahir'];

    $pasien = $row['pasien'];

    $jk = $row['jeniskelamin'] === 'L' ? 'Laki-Laki' : 'Perempuan';

    $alamat = $row['alamat'];



    // Hitung umur

    $tanggal_lahir = new DateTime($tgllahir);

    $sekarang = new DateTime();

    $umur_selisih = $sekarang->diff($tanggal_lahir);

    $umur = $umur_selisih->y . " th " . $umur_selisih->m . " bl " . $umur_selisih->d . " hr";

}



// Mulai HTML

$html = <<<HTML

<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">

    <title>Receipt</title>

    <style>

        body {

            font-family: Arial, sans-serif;

            font-size: 12px;

            width: 8cm;

            margin: 0;

            padding: 0;

        }

        .center {

            text-align: center;

        }

        .line {

            border-top: 1px dashed black;

            margin: 5px 0;

        }

        table {

            width: 100%;

            border-collapse: collapse;

        }

        td {

            padding: 2px 0;

        }

        .right {

            text-align: right;

        }

        .left {

            text-align: left;

        }

        .bold {

            font-weight: bold;

        }

    </style>

</head>

<body>


    
<div class="center bold">NO : {$noan} </div>

    <div class="center bold">{$namaklinik}</div>

    <div class="center">{$alamatklinik}</div>

    <div class="center">{$hp}</div>

    <div class="line"></div>

     <div style="font-size:8px" class="right">No Resep : {$nofaktur}<div>

    <table>

        <tr>

            <td class="bold">Nama:</td>

            <td colspan="3">{$pasien}</td>

        </tr>

        <tr>

            <td class="bold">Tgl Lhr:</td>

            <td>{$tgllahir}</td>

            <td class="bold">RM:</td>

            <td>{$norm}</td>

        </tr>

        <tr>

            <td class="bold">JK:</td>

            <td>{$jk}</td>

            <td class="bold">Poli:</td>

            <td>{$Poliklinik}</td>

        </tr>

        <tr>

            <td class="bold">Umur:</td>

            <td>{$umur}</td>

            <td class="bold">Tgl:</td>

            <td>{$tglpriksa}</td>

        </tr>

         <tr>

            <td class="bold">Bb:</td>

            <td>{$bb} Kg</td>

         

        </tr>

        <tr>

            <td class="bold">Alamat:</td>

            <td colspan="3">{$alamat}</td>

        </tr>

    </table>

    <div class="line"></div>

    <table>

HTML;



// Tambahkan data Non-Racik

while ($row = mysqli_fetch_assoc($result)) {

    $name = $row['nama'];

    $qty = $row['qty'];

    $aturanpakai = $row['aturan'];

    $keterangan = $row['keterangan'];

    

    $signa = substr($row['signa'], 0, 25);

$frekuensi = $row['frekuensi'];

$jmlpakai = $row['jmlpakai'];



$hasil = $frekuensi.'x'.$jmlpakai.' '.$signa;





    $html .= <<<HTML

        <tr>

            <td colspan='1'>R/ {$name}</td>

            <td class="right">{$qty}</td>

        </tr>

        <tr>

            <td colspan='2' class="center">{$hasil} {$keterangan}</td>

        </tr>

HTML;

}



// Tambahkan data MRacik dan Detail Racik

while ($rowx = mysqli_fetch_assoc($resultx)) {

    $kd = $rowx['kd'];

    $kdpruduk = $rowx['kdpruduk'];

    

    $nama = $rowx['nama'];

    $aturan = $rowx['aturan'];

    $qty = $rowx['qty'];

    $keterangan = $rowx['keterangan'];



    $html .= <<<HTML

        <tr>

            <td colspan='4'><b> R / {$kdpruduk} {$nama}</b></td>

        </tr>

        <tr>

            <td colspan='4'>{$aturan} @ {$qty}</td>

        

        </tr>

        <tr>

            <td colspan='4' class="center"> {$keterangan}</td>

        </tr>

HTML;



    $queryxl = sprintf($queryxl_template, $kd);

    $resultxl = mysqli_query($conn, $queryxl);

    if (!$resultxl) {

        die("Query gagal: " . mysqli_error($conn));

    }



    while ($rowxl = mysqli_fetch_assoc($resultxl)) {

        $nama_detail = $rowxl['nama'];

        $aturan_detail = $rowxl['aturan'];

        $qty_detail = $rowxl['qty'];

        $keterangan_detail = $rowxl['keterangan'];



        $html .= <<<HTML

            <tr>

                <td colspan='2'> {$nama_detail}</td>

                <td>{$aturan_detail}</td>

                <td>{$qty_detail}</td>

            </tr>

            <tr>

                <td colspan='4' class="center">{$keterangan_detail}</td>

            </tr>

HTML;

    }

}



// Lanjutkan HTML

$html .= <<<HTML

    </table>

    <div class="line">{$tglpriksa}</div>



  

    <div class="right">Dokter</div><br>

    <br>

 <div class="right">{$namdokter}</div>

    <div class="line"></div>

    <div class="center">Terima Kasih Atas Kunjungan Anda</div>

    <div class="center">Semoga Lekas Sembuh</div>

</body>

</html>

HTML;



// Masukkan HTML ke dalam MPDF

$mpdf->WriteHTML($html);



// Output file PDF

$mpdf->Output('receipt.pdf', \Mpdf\Output\Destination::INLINE);

?>

