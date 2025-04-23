<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>HASIL LABORATORIUM</title>

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
        color: #000;
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
        max-width: 100%;
        margin: auto;
        padding: 10px;
        border: 1px solid #eee;
        /*box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);*/
        font-size: 12px;
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
        font-size: 14px;
        line-height: 45px;
        color: #333;
      }

      .invoice-box table tr.information table td {
        padding-bottom: 40px;
      }

      .invoice-box table tr.heading td {
        /*background: #eee;*/
        
        border: 1px solid grey;
        font-weight: bold;
      }

      .invoice-box table tr.details td {
        /*padding-bottom: 20px;*/

      }

      .invoice-box table tr.item td {
        border-bottom: 1px solid #eee;
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


        span{
          color: black;
        }
      }
    </style>
  </head>

  <?php
  include '../koneksi.php';
    include 'terbilang.php';
  $notransaksi = $_GET['notransaksi'];
  $kdcabang = $_GET['kdcabang'];


 date_default_timezone_set( 'Asia/Bangkok' );





$tgl = date("Y-m-d");

  ?>

  <body>
  
    <div class="invoice-box">
      <table>
       <!--  <tr class="top">
          <td colspan="4">
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
                  <p><?php echo $namaklinik ?></p>


                   <p>KWITANSI</p>

                </td>
                


                <td>
                  Kwitansi #: <?php echo $notransaksi ?><br />
                  Tanggal: <?php  echo $tgl?><br />
                  
                </td>
              </tr>
            </table>
          </td>
        </tr> -->

        <tr class="information">
          <td colspan="6">
            <table>
              <tr>
                <td>

 <!--<img src="../gmb/logo.png" width="8%">-->
                    <br>
                   <?php
                  $query="SELECT * from cabang where kdcabang='$kdcabang'";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                    $namaklinik=$row['nama'];
                    $alamat=$row['alamat'];
                    $hp=$row['hp'];
                    
                    
                  }


                  ?>
                      <b style="font-size: 16px"><?php echo $namaklinik ?></b><br>
                     <span  style="font-size: 14px"><?php echo $alamat ?></span> <br>
                     <span  style="font-size: 14px"><?php echo $hp ?></span> 
             
                </td>

                <td style="color:black;">
                     <br>
                  <br>
                  <div style="border: 1px solid #000; border-radius: 10px;padding: 7px; margin-bottom: 10px">
                  HASIL PEMERIKSAAN LABORATORIUM<br>
                  LABORATORY RESULT EXAMINATION 
                </div>

            <!--       <div style="border: 1px solid #000; border-radius: 10px;padding: 7px; margin-bottom: 10px">
          <p style="margin-bottom: 5px"><b>Nama </b>: </p>
          <p style="margin-bottom: 5px"><b>No. RM </b>: </p>
          <p style="margin-bottom: 5px"><b>Tgl.Lahir </b>: </p>
        </div> -->


                </td>
              </tr>
              <?php
$query="SELECT 
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,a.notransaksi,b.pasien,b.tgllahir,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas,a.nofaktur,a.kddokterpengirim,x.namdokter as dokterkirim,b.jeniskelamin
FROM kunjunganpasien a 
LEFT join pasien b on a.norm = b.norm 
left join poliklinik d ON  a.kdpoli = d.kdpoli
LEFT JOIN  dokter e ON  a.kddokter = e.kddokter
left join kelompokkostumerd f on a.kdkostumerd = f.kdkostumerd
left join kelompokkostumer g ON f.kdkostumer = g.kdkostumer
LEFT  JOIN dokter x ON x.kddokter = a.kddokterpengirim
WHERE d.filter='2'   and  a.kdcabang='$kdcabang' and a.notransaksi='$notransaksi'  order BY a.tglpriksa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                  $pasien = $row['pasien'];
                 $rm = $row['norm'];
                 $notransaksi = $row['notransaksi'];
                  $tglpriksa = $row['tglpriksa'];
                   $tgllahir = $row['tgllahir'];
                 if($row['jeniskelamin'] === 'L'){
                  $jk = 'LAKI-LAKI';

                 }else{
                  $jk = 'PEREMPUAN';
                  
                 }


                  $alamat = $row['alamat'];
                 $nampoli = $row['nampoli'];
                $namdokter = $row['namdokter'];
                 $dokterkirim = $row['dokterkirim'];
                 }


          ?> 
                 <tr style="border: 1px solid #000; border-radius: 10px;padding: 7px;">
                  <td>
                  <span>  Nama Pasien&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<?php echo  $pasien ?> </span><br>
                  <span>  No Rekam Medik&nbsp;:<?php echo  $rm ?> </span><br>
                  <span>  Tgl Lahir&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo  $tgllahir ?></span><br>
                  <span>  Jenis Kelamin&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo  $jk ?></span><br>
                  
                  <span>  Tgl Periksa Lab &nbsp;&nbsp;&nbsp;&nbsp;:<?php echo  $tglpriksa ?> </span><br>
              <span>  Alamat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo  $alamat ?></span><br>
                  

                  </td>
                                <?php
$query="SELECT * from hasilabm where kdcabang='$kdcabang' and notrans='$notransaksi'";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                    $hasilkeluar = $row['waktu'];
                    $ket = $row['keterangan'];
                  }

                  ?>
                   <td style=" text-align: justify;">
                   
                  <span>No Transaksi :  <?php echo  $notransaksi ?> </span><br>
                  <span>Poliklinik :  <?php echo  $nampoli ?>  </span><br>
                  <span>Dokter Pengirim :   <?php echo  $dokterkirim ?>  </span><br>
                  <span>Dokter Laboratorium :  <?php echo  $namdokter ?>   </span><br>
                  <span>Hasil Keluar : <?php echo  $tglpriksa ?></span><br>
                

                  </td>

                 </tr>

            </table>
          </td>
        </tr>

        <tr class="heading">
          <td>PEMERIKSAAN
           
          </td>

          <td style="text-align: center;">HASIL</td>
        
          <td>SATUAN</td>
             <td>NILAI NORMAL</td>
        
          <td>KETERANGAN</td>
           <td>STATUS</td>
        </tr>


           


           <?php 


$q="SELECT distinct a.kdgolongan,a.golongan ,d.notransaksi
FROM teslab a 
LEFT join mapinglaborat b
on a.kdlab = b.kdtes 
AND a.kdcabang = b.kdcabang
LEFT JOIN transaksipasiend d
ON b.kdproduk = d.kdproduk 
AND a.kdcabang = d.kdcabang
LEFT JOIN hasillab f
on f.notrans=d.notransaksi
AND a.kdlab = f.kdlab
AND f.kdcabang = d.kdcabang
where d.notransaksi ='$notransaksi' AND d.kdcabang='$kdcabang' order by golongan,nourut asc";

$resultq=mysqli_query($conn, $q);
while($rowq=mysqli_fetch_array($resultq,MYSQLI_ASSOC)) {
$kdgolongan = $rowq['kdgolongan'];
$golongan = $rowq['golongan'];


?>

<tr class='details' style='border-bottom: 0.5px solid grey;'>
  <td><b><?php echo $golongan ?></b></td>







   <?php
$query="SELECT distinct a.* ,b.kdproduk,d.notransaksi,f.hasil,f.keterangan,f.warna
FROM teslab a 
LEFT join mapinglaborat b
on a.kdlab = b.kdtes 
AND a.kdcabang = b.kdcabang
LEFT JOIN transaksipasiend d
ON b.kdproduk = d.kdproduk 
AND a.kdcabang = d.kdcabang
LEFT JOIN hasillab f
on f.notrans=d.notransaksi
AND a.kdlab = f.kdlab
AND f.kdcabang = d.kdcabang
where d.notransaksi ='$notransaksi' AND d.kdcabang='$kdcabang' and a.kdgolongan='$kdgolongan' order by golongan,nourut asc
";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

if($jk === 'LAKI-LAKI'){
$jkx = $row['reflaki'];
}else{
$jkx = $row['refperempuan'];
}


$warna = $row['warna'];
   if($warna == 'Merah'){
                   $warnac='red';
                   $sts = 'OVER(High)';
                   
              }else if($warna == 'Hitam'){
                    //  <td style='color:black'>NORMAL</td>
                     $warnac='black';
                   $sts = 'NORMAL';
              }else if($warna == 'Kuning'){
                     $warnac='yellow';
                   $sts = 'HATI-HATI';
             }else if($warna == 'Merahl'){
                   $warnac='red';
                   $sts = 'OVER(Low)';
                   
              }else{
                     $warnac='black';
                   $sts = 'NORMAL';
                  
                  
              }
              
              

                    echo "<tr class='details' style='border-bottom: 0.5px solid grey;'>
          <td>".$row['nama']."</td>

         
        <td  style='text-align: center;'>".$row['hasil']."</td>

          <td >".$row['satuan']."</td>
             <td>".$jkx."</td>

          <td>".$row['keterangan']."</td>
          <td style='color:".$warnac."'>".$sts."</td>
          
          
        </tr>";
                  
                  }

                  ?>


</tr>



<?php

}
           ?>



  

          <tr class="details" style="border-bottom: 0.5px solid grey;">
          <td style="width:80px" colspan="5"> <b>KETERANGAN :</b> 
 <?php echo $ket ?>

      </td>

          
       
        </tr>


         



  
         

     

       
      
       

          <tr class="item last">
          <td colspan="3">DPJP Laboratorium
            <br>
            <br>
            <span><?php  echo $namdokter ?></span>
          </td>

          <td colspan="2">Penerima Hasil
            <br>
            <br>
             <span>Nama Lengkap dan TTD</span>
          </td>

        </tr>



      </table>
    </div>
  </body>

</html>
