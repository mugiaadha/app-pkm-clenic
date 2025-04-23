<?php

require_once __DIR__ . '/vendor/autoload.php';


// Define a default page size/format by array - page will be 190mm wide x 236mm height
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [70, 40]]);

  
  include '../koneksi.php';

$kdcabang=$_GET['kdcabang'];
$notransaksi=$_GET['notransaksi'];




    
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->AddPage("P","","","","","6","0","2","2","","","","","","","","","","","",[70,40]);
    // $mpdf->WriteHTML($content);


    $query="SELECT a.*,b.nama,c.pasien,c.tgllahir,c.norm,b.nama AS klinik ,d.obat
FROM ermcpptintruksi a , cabang b,pasien c,obat d WHERE a.kdcabang = b.kdcabang 
AND a.norm =c.norm AND a.kdcabang = c.kdcabang AND a.kdcabang='$kdcabang'
 AND a.notransaksi='$notransaksi' AND a.kdpruduk = d.kdobat 
 ORDER BY a.nama ASC";




$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) { 


$pasienx = $row['pasien'];

$pasien = substr($pasienx, 0, 25);


$nama = $row['nama'];
$obat = substr($row['obat'], 0, 25);
$qty = $row['qty'];



$signa = substr($row['signa'], 0, 25);
$tgllahir = $row['tgllahir'];

$norm = $row['norm'];
$keterangan =  substr($row['keterangan'], 0, 25);



$frekuensi = $row['frekuensi'];
$jmlpakai = $row['jmlpakai'];

$hasil = $frekuensi.'x'.$jmlpakai.' '.$signa;


$mpdf->WriteHTML("

<span style='font-size:10px'><b>DINAS KESEHATAN ACEH BESAR</b><span><br>
<span style='font-size:10px'><b>$nama</b><span>
<br>
-------------------------------------------------------------
<br>
<b style='font-size:10px'>$pasien</b><br>
Tgl.Lahir : $tgllahir Norm : $norm<br>

 <b  style='font-size:10px'>$obat</b><br>
$hasil<br>
$keterangan
<br>
<br>
<br>
<br>


    ");
       
}
    
$mpdf->Output();
exit;


?>