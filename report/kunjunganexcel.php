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

$tgldari = $_GET['tgldari'];
$tglsampai = $_GET['tglsampai'];
$status = $_GET['status'];


 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=kunjungan $tgldari - $tglsampai.xls");


       


 date_default_timezone_set( 'Asia/Bangkok' );





$tgl = date("Y-m-d");

  ?>

  <body>
  
    <div class="invoice-box">
      <table>
        <tr class="top">
          <td colspan="6">
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

                   <b>LAPORAN KUNJUNGAN RAWAT JALAN</b>

                </td>
                


                <td>
                 
                  Tanggal: <br />
                  <?php echo $tgldari ?> -  <?php echo $tglsampai ?>
                </td>
              </tr>
            </table>
          </td>
        </tr>

       

        <tr class="heading">
      
          <td>no</td>
          <td style="text-align:left;">Pasien</td>
          <td>Norm</td>
          <td>Klinik</td>
        
          <td>Kostumer</td>
          <td>Dokter</td>
     
        <td>Kddiagnosa</td>
        <td>diagnosa</td>
             <td>status Kunjungan</td>
                     <td>NO Kunjungan</td>
        </tr>


    <?php 



 if($status === '1'){
$query="SELECT 
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,a.notransaksi,b.pasien,b.tgllahir,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas,
(SELECT diagnosa FROM ermcpptdiagnosa WHERE notrans=a.notransaksi AND STATUS='diagnosa' ORDER BY NO ASC LIMIT 1 ) 
AS diagnosa,(SELECT kddiagnosa FROM ermcpptdiagnosa WHERE notrans=a.notransaksi AND STATUS='diagnosa' ORDER BY NO ASC LIMIT 1 ) AS kddiagnosa,a.jeniskunjungan,a.nokunjungan
FROM kunjunganpasien a , pasien b,poliklinik d, dokter e,kelompokkostumerd f,kelompokkostumer g
WHERE a.norm = b.norm 
AND  a.kdpoli = d.kdpoli AND a.kddokter = e.kddokter AND
a.kdkostumerd = f.kdkostumerd AND f.kdkostumer = g.kdkostumer AND a.kdcabang='$kdcabang' 
 and a.tglpriksa BETWEEN '$tgldari' and '$tglsampai'  order BY a.tglpriksa";


 }else{
$query="SELECT 
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,a.notransaksi,b.pasien,b.tgllahir,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas,
(SELECT diagnosa FROM ermcpptdiagnosa WHERE notrans=a.notransaksi AND STATUS='diagnosa' ORDER BY NO ASC LIMIT 1 ) AS diagnosa,
(SELECT kddiagnosa FROM ermcpptdiagnosa WHERE notrans=a.notransaksi AND STATUS='diagnosa' ORDER BY NO ASC LIMIT 1 ) AS kddiagnosa,a.jeniskunjungan,a.nokunjungan
FROM kunjunganpasien a , pasien b,poliklinik d, dokter e,kelompokkostumerd f,kelompokkostumer g
WHERE a.norm = b.norm 
AND  a.kdpoli = d.kdpoli AND a.kddokter = e.kddokter AND
a.kdkostumerd = f.kdkostumerd AND f.kdkostumer = g.kdkostumer AND a.kdcabang='$kdcabang' 
  and a.kdpoli='$status' and a.tglpriksa BETWEEN '$tgldari' and '$tglsampai' order BY a.tglpriksa";

 }
                    $result=mysqli_query($conn, $query);
                        $no = 0;
                     $totalRujuk = 0;
$totalRawatJalan = 0;
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
              $no ++;

        

 if ($row['jeniskunjungan'] === '4') {
        $jkun = 'Rujuk';
        $totalRujuk++; // Tambahkan 1 untuk Rujuk
    } else {
        $jkun = 'Rawat jalan';
        $totalRawatJalan++; // Tambahkan 1 untuk Rawat Jalan
    }
            
                echo   "<tr class='details'>
                   <td>".$no."</td>
          <td style='text-align:left;'>".$row['pasien']."</td>

         
        <td>".$row['norm']."</td>

          <td>".$row['nampoli']."</td>
           <td>".$row['nama']."</td>

         
        <td>".$row['namdokter']."</td>
  <td>".$row['kddiagnosa']."</td>
       <td>".$row['diagnosa']."</td>
            <td>".$jkun."</td>
      <td>".$row['nokunjungan']."</td>
    
        </tr>";
                    
                  }
echo "<tr class='totals'>
    <td colspan='8' style='text-align:right;'><strong>Total Rujuk:</strong></td>
    <td colspan='2'><strong>$totalRujuk</strong></td>
</tr>";
echo "<tr class='totals'>
    <td colspan='8' style='text-align:right;'><strong>Total Rawat Jalan:</strong></td>
    <td colspan='2'><strong>$totalRawatJalan</strong></td>
</tr>";
                  ?>
                    
                 


     

      
      
      </table>
    </div>
  </body>

</html>
