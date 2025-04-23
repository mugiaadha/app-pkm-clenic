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
$query="SELECT * from cabang where kdcabang='$kdcabang'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
  $namaklinik=$row['nama'];
  $alamat=$row['alamat'];
  $email=$row['email'];
  $hp=$row['hp'];
}
  ?>

  <body>

    <table border="0" width="100%" style="border:none; border-collapse:collapse; cellspacing:0; cellpadding:0;" >
      <tr align="center">
        <td style="border: none !important;">
          <img src="../gmb/1724037610_kop-surat-1.png" width="80" alt=""/>
        </td>
        <td style="text-align: center; font-family: century; border: none !important;">
          <h3 style="margin:0px; font-size:15pt;">PEMERINTAH KABUPATEN ACEH BESAR</h3>
          <h2 style="margin:0px; font-size:18pt;">DINAS KESEHATAN</h2>
          <h3 style="margin:0px; font-size:15pt;"><?php echo strtoupper($namaklinik); ?></h3>
          <p style="font-size: 10pt;">
            <?php echo $alamat; ?><br>
            Email: <?php echo $email; ?>
          </p>
        </td>
        <td style="border: none !important; width:10%;"></td>
      </tr>
    </table>

    <hr style="border: 1px solid black; margin:0px;">

    <div class="invoice-box">
      <h5 align="center">
	<u><b>SURAT KETERANGAN SEHAT</b></u><br>
	<b>Nomor : <span contenteditable="true" onclick="if(this.textContent == '..............................') this.textContent = ' '" onblur="if(this.textContent == ' ' || this.textContent == '') this.textContent = '..............................'">..............................</span></br><br>
     </h5>

<div style="text-align:left;">
 
  <?php

   $query="SELECT * from dokter where kdcabang='$kdcabang' and kddokter='$kddokter'";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
   
                    $dokter = $row['namdokter'];

                  }


 ?>


 <b>Dokter Puskesmas :</b><br>
 <span style="font-weight: normal;">Nama : <?php echo $dokter ?? '' ?></span><br>
 <span style="font-weight: normal;">Nip : <span contenteditable="true" onclick="if(this.textContent == '..............................') this.textContent = ' '" onblur="if(this.textContent == ' ' || this.textContent == '') this.textContent = '..............................'">..............................</span><br>
 <span style="font-weight: normal;">Jabatan : Dokter <?php echo $namaklinik ?? '' ?></span><br>
<br>

 <b>Dengan ini menerangkan bahwa :</b><br>


 <?php

   $query="SELECT * from pasien where kdcabang='$kdcabang' and norm='$norm'";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                 $nama = $row['pasien'];
$perkerjaan = $row['perkerjaan'];
$alamat = $row['alamat'];
$golda = $row['golda'];
$tempatlahir = $row['tempatlahir'];
                    
               
                    $tanggal_lahir = new DateTime($row['tgllahir']);
    $sekarang = new DateTime("today");

    if ($tanggal_lahir > $sekarang) { 

    }
    $thn = $sekarang->diff($tanggal_lahir)->y;
    $bln = $sekarang->diff($tanggal_lahir)->m;
    $tgl = $sekarang->diff($tanggal_lahir)->d;


                  }


 ?>
<span style="font-weight: normal;">Nama : <?php echo $nama ?></span>
<br>
<span style="font-weight: normal;">Tempat/Tanggal Lahir : <?php echo $tempatlahir ?> / <?php echo $tanggal_lahir->format('d M Y') ?></span>
<br>
<span style="font-weight: normal;">Perkerjaan : <?php echo $perkerjaan ?></span>
<br>
<span style="font-weight: normal;">Alamat : <?php echo $alamat ?></span>
<br>
<br>
<b>Hasil Pemeriksaan : </b><br>


 <?php

   $queryx="SELECT * from ermcppt where kdcabang='$kdcabang' and notrans='$nosurat'";
   $resultx=mysqli_query($conn, $queryx);
   $rowcount=mysqli_num_rows($resultx);
   if($rowcount > 0){
   
                  while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {
  
                    $td = $rowx['td'];
		    $tb = $rowx['tb'];
                    $bb = $rowx['bb'];
                   $nadi = $rowx['hr'];
                   $suhu = $rowx['suhu'];
                   $rr = $rowx['rr'];
                   $spo = $rowx['spo'];
                   $pf = $rowx['pf'];
                   $lp = $rowx['lp'];
                   $tglpriksa = $rowx['tgl'];
 
                  }

   }else{

		   $td = "-";
		   $tb = "-";
                   $bb = "-";
                   $nadi = "-";
                   $suhu = "-";
                   $rr = "-";
                   $spo ="-";
                   $pf = "-";
                   $lp = "-";
                   $tglpriksa = "-";
   }
                


 ?>

<span style="font-weight: normal;">Tinggi Badan :  <?php echo $tb ?> CM</span>
<br>
<span style="font-weight: normal;">Berat Badan :  <?php echo $bb ?> KG</span>
<br>
<span style="font-weight: normal;">Suhu : <?php echo $suhu ?> C</span>
<br>
<span style="font-weight: normal;">Tensi Darah : <?php echo $td ?> mmHg</span>
<br>
<span style="font-weight: normal;">Lingkar Perut : <?php echo $lp ?> CM</span>
<br>
<span style="font-weight: normal;">Buta Warna : 
<select style="border:none !important;" onchange="document.getElementById('butawarna').innerHTML = this.value.toUpperCase()";>
<option value="Tidak Buta Warna">Tidak Buta Warna</option>
<option value="Buta Warna">Buta Warna</option>
</select>
</span>
<br>
<span style="font-weight: normal;">Golongan Darah : <?php echo $golda ?></span>
<br>
<br>
<span style="font-weight: normal;">
	Setelah diperiksa kesehatannya saat ini berada dalam keadaan <span style="font-weight: bold;">SEHAT dan <span id="butawarna" >TIDAK BUTA WARNA.</span></span><br>
	Surat Keterangan ini diberikan untuk keperluan : <br>
</span>
<h5 align="center"><u><b contenteditable="true" onclick="if(this.textContent == '..............................') this.textContent = ' '" onblur="if(this.textContent == ' ' || this.textContent == '') this.textContent = '..............................'">..............................</b></u></h5>
<span style="font-weight: normal;">Demikianlah Surat Keterangan ini kami buat dengan sebenarnya agar dapat dipergunakan seperlunya.</span><br>
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
