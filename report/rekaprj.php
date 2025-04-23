<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>KUNJUNGAN</title>

    <!-- Favicon -->
    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />

    <!-- Invoice styling -->
     <style>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400&display=swap');
</style>
    <style>
      body {
          font-family: 'Outfit', sans-serif;
        
        text-align: center;
        color: #000000;

      }

      body h1 {
        font-weight: 300;
        margin-bottom: 0px;
        padding-bottom: 0px;
        color: #000;
      }

      body h3 {
        font-weight: 300;
        margin-top: 10px;
        margin-bottom: 20px;
        font-style: italic;
        color: #555;
      }

      body a {
        color: #06f;
      }

      .invoice-box {
        max-width: 1500px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
     
        font-size: 10px;
        line-height: 24px;
        font-family: 'Outfit', sans-serif;
        color: #555;
      }

      .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
        border-collapse: collapse;
      }

      .invoice-box table td {
        padding: 5px;
        vertical-align: top;
      }

      .invoice-box table tr td:nth-child(2) {
        text-align: right;
      }

      .invoice-box table tr.top table td {
        padding-bottom: 20px;
       

      }

      .invoice-box table tr.top table td.title {
        font-size: 10px;
        line-height: 45px;
        color: #333;

      }

      .invoice-box table tr.information table td {
        padding-bottom: 40px;
      }

      .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
           border: 1px solid black;
      }

      .invoice-box table tr.details td {
        padding-bottom: 0px;
        font-size: 11px;
        border: 1px solid black;


      }

      .invoice-box table tr.item td {
        border-bottom: 1px solid #eee;
         border: 1px solid grey;
      }

      .invoice-box table tr.item.last td {
        border-bottom: none;
      }

      .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
      }

      @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
          width: 100%;
          display: block;
          text-align: center;
        }

        .invoice-box table tr.information table td {
          width: 100%;
          display: block;
          text-align: center;
        }
      }
    </style>
  </head>

  <?php
  include '../koneksi.php';


  $kdcabang = $_GET['kdcabang'];

$tgldari = $_GET['tgldari'];
$tglsampai = $_GET['tglsampai'];

$perbagian = 'ri';



 date_default_timezone_set( 'Asia/Bangkok' );


$tgl = date("Y-m-d");

  ?>

  <body>
  
    <div class="invoice-box">
      <table>
        <tr class="top">
          <td colspan="21">
            <table>
              <tr>
                <td class="title">
                  <?php
                  $query="SELECT * from cabang where kdcabang='$kdcabang'";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                    $namaklinik=$row['nama'];
                    $alamat=$row['alamat'];
                    $hp=$row['hp'];
                    
                    
                  }


                  ?>
                 <b><?php echo $namaklinik ?></b><br>

                   <b>REKAP RAWAT JALAN</b>

                </td>
                


                <td>
                 
                  Tanggal: <br />
                  <?php echo $tgldari ?> -  <?php echo $tglsampai ?><br>

                     <a href="rekapkunjunganrjex.php?kdcabang=<?php  echo $kdcabang ?>&tgldari=<?php echo $tgldari ?>&tglsampai=<?php echo $tglsampai ?>&perbagian=<?php echo $perbagian ?>">Export Excel</a>
                </td>
              </tr>
            </table>
          </td>
        </tr>

       

        <tr class="heading">
        <td>TGL</td>
          <td style="text-align:left;">JML</td>
          <td colspan="2" style="text-align:center;">JK</td>
            
                  <td colspan="2" style="text-align:center;">PASIEN</td>
         <td colspan="7" style="text-align:center;">UMUR</td>
    
     <td colspan="5" style="text-align:center;">ASAL</td>


   
          <td colspan="2" style="text-align:center;">BAYAR</td>

              <td>KUN</td>
    
        </tr>

        <tr class="heading">
        <td>Tgl</td>
          <td style="text-align:left;">Jml</td>
          <td>P</td>
             <td>L</td>
                 <td>BARU</td>
          <td>LAMA</td>
      <td> <01 </td>
      <td>01-04</td>
       <td>05-14</td>
      <td>15-24</td>
      <td>25-44</td>
       <td>45-64</td>
      
      <td> >65</td>
       <td>Sdr</td>
      
      <td>Pus</td>
       <td>Rs.P</td>
      <td>Rs.SW</td>
        <td>Dr.Pr</td>
          <td>Sndr</td>
            <td>JKN</td>
              <td>Umum</td>
    
        </tr>

  <?php 






$query="SELECT 
a.tglpriksa ,COUNT(a.tglpriksa) AS total,
(SELECT 
COUNT(f.jeniskelamin) 
FROM kunjunganpasien e
LEFT JOIN pasien f ON e.norm = f.norm
LEFT JOIN kelompokkostumerd g ON g.kdkostumerd = e.kdkostumerd
LEFT JOIN poliklinik h ON h.kdpoli = e.kdpoli 
INNER JOIN antrian an on an.notransaksi = e.notransaksi
WHERE e.tglpriksa = a.tglpriksa AND h.sts='$perbagian' AND f.jeniskelamin='P') AS p,
(SELECT 
COUNT(f.jeniskelamin) 
FROM kunjunganpasien e
LEFT JOIN pasien f ON e.norm = f.norm
LEFT JOIN kelompokkostumerd g ON g.kdkostumerd = e.kdkostumerd
LEFT JOIN poliklinik h ON h.kdpoli = e.kdpoli 
INNER JOIN antrian an on an.notransaksi = e.notransaksi
WHERE e.tglpriksa = a.tglpriksa AND h.sts='$perbagian' AND f.jeniskelamin='L') AS L
,
(SELECT 
COUNT(e.norm) 
FROM kunjunganpasien e
LEFT JOIN pasien f ON e.norm = f.norm
LEFT JOIN kelompokkostumerd g ON g.kdkostumerd = e.kdkostumerd
LEFT JOIN poliklinik h ON h.kdpoli = e.kdpoli 
INNER JOIN antrian an on an.notransaksi = e.notransaksi
WHERE e.tglpriksa = a.tglpriksa AND h.sts='$perbagian' AND f.tgl < a.tglpriksa) AS lama
,
(SELECT 
COUNT(e.norm) 
FROM kunjunganpasien e
LEFT JOIN pasien f ON e.norm = f.norm
LEFT JOIN kelompokkostumerd g ON g.kdkostumerd = e.kdkostumerd
LEFT JOIN poliklinik h ON h.kdpoli = e.kdpoli 
INNER JOIN antrian an on an.notransaksi = e.notransaksi
WHERE e.tglpriksa = a.tglpriksa AND h.sts='$perbagian' AND f.tgl >= a.tglpriksa) AS baru,

(SELECT 
COUNT(e.norm) 
FROM kunjunganpasien e
LEFT JOIN pasien f ON e.norm = f.norm
LEFT JOIN kelompokkostumerd g ON g.kdkostumerd = e.kdkostumerd
LEFT JOIN poliklinik h ON h.kdpoli = e.kdpoli 
INNER JOIN antrian an on an.notransaksi = e.notransaksi
WHERE e.tglpriksa = a.tglpriksa AND h.sts='$perbagian' AND  (YEAR(CURDATE()) - YEAR(f.tgllahir)) < 1  ) AS satu,

(SELECT 
COUNT(e.norm) 
FROM kunjunganpasien e
LEFT JOIN pasien f ON e.norm = f.norm
LEFT JOIN kelompokkostumerd g ON g.kdkostumerd = e.kdkostumerd
LEFT JOIN poliklinik h ON h.kdpoli = e.kdpoli 
INNER JOIN antrian an on an.notransaksi = e.notransaksi
WHERE e.tglpriksa = a.tglpriksa AND h.sts='$perbagian' AND  (YEAR(CURDATE()) - YEAR(f.tgllahir)) >= 1  and
(YEAR(CURDATE()) - YEAR(f.tgllahir)) <= 4
  ) AS satuempat

,
(SELECT 
COUNT(e.norm) 
FROM kunjunganpasien e
LEFT JOIN pasien f ON e.norm = f.norm
LEFT JOIN kelompokkostumerd g ON g.kdkostumerd = e.kdkostumerd
LEFT JOIN poliklinik h ON h.kdpoli = e.kdpoli 
INNER JOIN antrian an on an.notransaksi = e.notransaksi
WHERE e.tglpriksa = a.tglpriksa AND h.sts='$perbagian' AND  (YEAR(CURDATE()) - YEAR(f.tgllahir)) >= 5  and
(YEAR(CURDATE()) - YEAR(f.tgllahir)) <= 14
  ) AS limaempatbelas
  
  ,
(SELECT 
COUNT(e.norm) 
FROM kunjunganpasien e
LEFT JOIN pasien f ON e.norm = f.norm
LEFT JOIN kelompokkostumerd g ON g.kdkostumerd = e.kdkostumerd
LEFT JOIN poliklinik h ON h.kdpoli = e.kdpoli 
INNER JOIN antrian an on an.notransaksi = e.notransaksi
WHERE e.tglpriksa = a.tglpriksa AND h.sts='$perbagian' AND  (YEAR(CURDATE()) - YEAR(f.tgllahir)) >= 15  and
(YEAR(CURDATE()) - YEAR(f.tgllahir)) <= 24
  ) AS limaduaempat
    ,
(SELECT 
COUNT(e.norm) 
FROM kunjunganpasien e
LEFT JOIN pasien f ON e.norm = f.norm
LEFT JOIN kelompokkostumerd g ON g.kdkostumerd = e.kdkostumerd
LEFT JOIN poliklinik h ON h.kdpoli = e.kdpoli 
INNER JOIN antrian an on an.notransaksi = e.notransaksi
WHERE e.tglpriksa = a.tglpriksa AND h.sts='$perbagian' AND  (YEAR(CURDATE()) - YEAR(f.tgllahir)) >= 25  and
(YEAR(CURDATE()) - YEAR(f.tgllahir)) <= 44
  ) AS dualimaempat
      ,
(SELECT 
COUNT(e.norm) 
FROM kunjunganpasien e
LEFT JOIN pasien f ON e.norm = f.norm
LEFT JOIN kelompokkostumerd g ON g.kdkostumerd = e.kdkostumerd
LEFT JOIN poliklinik h ON h.kdpoli = e.kdpoli 
INNER JOIN antrian an on an.notransaksi = e.notransaksi
WHERE e.tglpriksa = a.tglpriksa AND h.sts='$perbagian' AND  (YEAR(CURDATE()) - YEAR(f.tgllahir)) >= 45  and
(YEAR(CURDATE()) - YEAR(f.tgllahir)) <= 64
  ) AS empatlimaenmaempat
      ,
(SELECT 
COUNT(e.norm) 
FROM kunjunganpasien e
LEFT JOIN pasien f ON e.norm = f.norm
LEFT JOIN kelompokkostumerd g ON g.kdkostumerd = e.kdkostumerd
LEFT JOIN poliklinik h ON h.kdpoli = e.kdpoli 
INNER JOIN antrian an on an.notransaksi = e.notransaksi
WHERE e.tglpriksa = a.tglpriksa AND h.sts='$perbagian' AND  (YEAR(CURDATE()) - YEAR(f.tgllahir)) >= 65 ) AS enamlima
  ,
  
  (SELECT 
COUNT(f.jeniskelamin) 
FROM kunjunganpasien e
LEFT JOIN pasien f ON e.norm = f.norm
LEFT JOIN kelompokkostumerd g ON g.kdkostumerd = e.kdkostumerd
LEFT JOIN poliklinik h ON h.kdpoli = e.kdpoli 
INNER JOIN antrian an on an.notransaksi = e.notransaksi
WHERE e.tglpriksa = a.tglpriksa AND h.sts='$perbagian' AND g.statusbpjs='1') AS jkn 
,
  (SELECT 
COUNT(f.jeniskelamin) 
FROM kunjunganpasien e
LEFT JOIN pasien f ON e.norm = f.norm
LEFT JOIN kelompokkostumerd g ON g.kdkostumerd = e.kdkostumerd
LEFT JOIN poliklinik h ON h.kdpoli = e.kdpoli 
INNER JOIN antrian an on an.notransaksi = e.notransaksi
WHERE e.tglpriksa = a.tglpriksa AND h.sts='$perbagian' AND g.statusbpjs='0') AS nonjkn

  
FROM kunjunganpasien a
LEFT JOIN pasien b ON a.norm = b.norm
LEFT JOIN kelompokkostumerd c ON a.kdkostumerd = c.kdkostumerd
LEFT JOIN poliklinik d ON d.kdpoli = a.kdpoli 
INNER JOIN antrian an on an.notransaksi = a.notransaksi
WHERE a.tglpriksa BETWEEN '$tgldari' AND '$tglsampai' AND d.sts='$perbagian'
and a.norm <> '' AND b.pasien IS NOT null
and
(SELECT COUNT(r.tglpriksa) AS total
FROM kunjunganpasien r
LEFT JOIN pasien s ON r.norm = s.norm
LEFT JOIN kelompokkostumerd cx ON r.kdkostumerd = cx.kdkostumerd
LEFT JOIN poliklinik dx ON dx.kdpoli = r.kdpoli 
INNER JOIN antrian dxc ON dxc.notransaksi = r.notransaksi 
WHERE r.tglpriksa =a.tglpriksa  and dx.sts='$perbagian'
and r.norm <> '' AND s.pasien IS NOT null
 
GROUP BY r.tglpriksa
ORDER BY r.tglpriksa ASC) 


GROUP BY a.tglpriksa
ORDER BY a.tglpriksa ASC";



          $result=mysqli_query($conn, $query);
                    
                        $total = 0;
                        $totalp = 0;
                         $totall = 0;

 $totalb = 0;
  $totallama = 0;


  $total1 = 0;
  $total2 = 0;
  $total3 = 0;
  $total4 = 0;
  $total5 = 0;
  $total6 = 0;
  $total7 = 0;
    $tnonjkn = 0;
      $tjkn = 0;
      
 
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
              $total  += $row['total'];
               
           $totalp += $row['p'];
                         $totall += $row['L'];

 $totalb += $row['baru'];
  $totallama += $row['lama'];


  $total1 += $row['satu'];
  $total2 += $row['satuempat'];
  $total3  += $row['limaempatbelas'];
  $total4 += $row['limaduaempat'];
  $total5  += $row['empatlimaenmaempat'];
  $total6 += $row['enamlima'];

  $tnonjkn += $row['nonjkn'];
    $tjkn += $row['jkn'];
    
 
                echo   "<tr class='details'>
                   <td>".$row['tglpriksa']."</td>
                       <td  style='text-align:left;'>".$row['total']."</td>
          <td >".$row['p']."</td>
    <td>".$row['L']."</td>
    <td>".$row['lama']."</td>
         
 <td>".$row['baru']."</td>
    <td>".$row['satu']."</td>
     <td>".$row['satuempat']."</td>
    <td>".$row['limaempatbelas']."</td>
   
    <td>".$row['limaduaempat']."</td>
     <td>".$row['dualimaempat']."</td>
    <td>".$row['empatlimaenmaempat']."</td>
     <td>".$row['enamlima']."</td>
 <td></td>
        <td></td>
         <td></td>
          <td></td>
           <td></td>
    <td>".$row['nonjkn']."</td>
    <td>".$row['jkn']."</td>
     <td>".$row['total']."</td>
        </tr>";



                  }

                  ?> 
                    
          



<tr class="heading">
        <td></td>
          <td style="text-align:left;"><?php echo $total ?></td>
          <td><?php echo $totalp ?></td>
             <td><?php echo $totall ?></td>
                 <td><?php echo $totalb ?></td>
          <td><?php echo $totallama ?></td>
      <td><?php echo $total1 ?></td>
      <td><?php echo $total2 ?></td>
         <td><?php echo $total3 ?></td>
      <td><?php echo $total4 ?></td>
       <td><?php echo $total5 ?></td>
       <td><?php echo $total6 ?></td>
      
      <td> 0</td>
       <td>0</td>
      
      <td>0</td>
       <td>0</td>
      <td>0</td>
        <td>0</td>
          <td><?php echo $tnonjkn ?></td>
            <td><?php echo $tjkn ?></td>
              <td><?php echo $total ?></td>
    
        </tr>

      
      
      </table>
    </div>
  </body>

</html>
