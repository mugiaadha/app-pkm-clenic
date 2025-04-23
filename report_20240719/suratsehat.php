<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>SURAT</title>

    <!-- Favicon -->
    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />
    <link href="Bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Invoice styling -->
     <style>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400&display=swap');
</style>

<style type="text/css">
.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th{
  padding: 2px 5px;
  font-size: 11px;
}  
@media print
{    
  .noprint{
    display: none !important;
  }
  .marg_2_onprint{
    margin: 2px;
  }
}
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
        max-width: 100%;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
     
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
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
      }

      .invoice-box table tr.details td {
        padding-bottom: 0px;
        font-size: 11px;
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
      }
    </style>
  </head>

  <?php
  include '../koneksi.php';
    include 'terbilang.php';

  $kdcabang = $_GET['kdcabang'];

$nosurat = $_GET['nosurat'];
$norm = $_GET['norm'];
$kddokter = $_GET['kddokter'];





 date_default_timezone_set( 'Asia/Bangkok' );





$tgl = date("Y-m-d");
$tgla = date("Y-m-d");

  ?>

  <body>
  
    <div class="invoice-box">
      <table>
        <tr class="top">
          <td colspan="5">
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
                    <img src="../gmb/logo.png" width="15%"><br>
                 <b><?php echo $namaklinik ?></b><br>

                   <b>SURAT KETERANGAN DOKTER</b>

                </td>
                


                <td>
                 
                  No Surat: <br />
                    <input  style="border-top:hidden ;border-left:hidden ;border-right:hidden;border-bottom: 0.5px dashed grey;" type="text" placeholder="No Surat"><br>
                  <?php echo $alamat ?>
                </td>
              </tr>
            </table>
          </td>
        </tr>

       


      
      
      </table>
      <hr>

<div style="text-align:left;">
 
  <?php

   $query="SELECT * from dokter where kdcabang='$kdcabang' and kddokter='$kddokter'";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
   
                    $dokter = $row['namdokter'];

                  }


 ?>



 <b>Yang bertanda tangan di bawah ini Dokter Pemeriksa <?php echo $namaklinik ?>  Menerangkan:</b><br>

 <?php

   $query="SELECT * from pasien where kdcabang='$kdcabang' and norm='$norm'";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                 $nama = $row['pasien'];
$perkerjaan = $row['perkerjaan'];
$alamat = $row['alamat'];
$golda = $row['golda'];
                    
               
                    $tanggal_lahir = new DateTime($row['tgllahir']);
    $sekarang = new DateTime("today");

    if ($tanggal_lahir > $sekarang) { 

    }
    $thn = $sekarang->diff($tanggal_lahir)->y;
    $bln = $sekarang->diff($tanggal_lahir)->m;
    $tgl = $sekarang->diff($tanggal_lahir)->d;


                  }


 ?>
 <span>Nama: <?php echo $nama ?></span>
<br>
<span>Umur: <?php echo $thn." tahun ".$bln." bulan ".$tgl." hari" ?></span>
<br>
<span>Perkerjaan: <?php echo $perkerjaan ?></span>
<br>
<span>Alamat: <?php echo $alamat ?></span>
<br>
 <b>Hasil Pemeriksaan fisik kami pada tanggal di <?php echo $namaklinik ?> adalah sebegai berikut : </b><br>

 <?php

   $queryx="SELECT * from ermcppt where kdcabang='$kdcabang' and notrans='$nosurat'";
   $resultx=mysqli_query($conn, $queryx);
   $rowcount=mysqli_num_rows($resultx);
   if($rowcount > 0){
   
                  while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {
  
                    $td = $rowx['td'];
                    $bb = $rowx['bb'];
                   $nadi = $rowx['nadi'];
                   $suhu = $rowx['suhu'];
                   $rr = $rowx['rr'];
                   $spo = $rowx['spo'];
                   $pf = $rowx['pf'];
                   $tglpriksa = $rowx['tgl'];
 
                  }

   }else{


     $td = "-";
                    $bb = "-";
                   $nadi = "-";
                   $suhu = "-";
                   $rr = "-";
                   $spo ="-";
                   $pf = "-";
                   $tglpriksa = "-";
   }
                


 ?>


<span>Tekanan Darah: <?php echo $td ?></span>
<br>
<span>Berat Badan:  <?php echo $bb ?> </span>
<br>
<span>Golongan Darah:   <?php echo $golda ?></span><br>

<span>Nadi: <?php echo $nadi ?></span>
<br>
<span>Suhu: <?php echo $suhu ?></span><br>
<span>RR: <?php echo $rr ?></span>
<br>
<span>Spo: <?php echo $spo ?></span>
<br>
<span>Fisik: <?php echo $pf ?></span>
<br>

<b>Surat keterangan Sehat ini di pergunakan sebagai <input  style="border-top:hidden ;border-left:hidden ;border-right:hidden;border-bottom: 0.5px dashed grey;" type="text" name=""></b><br>
<b>Demikian Surat keterangan ini di buat untuk dapat di pergunakan sebagaimana mestinya</b><br>

</div>
     

        <div style="text-align:right;">
      
 <b><?php  echo $tglpriksa ?></b><br>
 <b>Dokter Pemeriksa</b><br>
<br>
<br>
 <b><?php echo $dokter ?></b>
</div>
    </div>


  </body>
  
    <button class="btn btn-primary noprint" onclick="window.print()" style="position: fixed;top: 0; margin: 10px;right: 50px">PRINT</button>
    
    
    <!--<b  onclick="window.print()" >Cetak</b>-->
  
<script type="text/javascript" src="Bootstrap/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="Bootstrap/bootstrap.min.js"></script>
<!-- <script type="text/javascript">window.print()</script> -->
</html>
