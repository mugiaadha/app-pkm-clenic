<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>KWITANSI</title>

    <!-- Favicon -->
    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />

    <!-- Invoice styling -->
    <style>
      body {
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        text-align: center;
        color: #777;
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
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        font-size: 12px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
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
        padding-bottom: 20px;
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
  $notransaksi = $_GET['notransaksi'];
  $kdcabang = $_GET['kdcabang'];
$username = $_GET['username'];


 date_default_timezone_set( 'Asia/Bangkok' );





$tgl = date("Y-m-d");

  ?>

  <body>
    <!-- <h1>A simple, clean, and responsive HTML invoice template</h1>
    <h3>Because sometimes, all you need is something simple.</h3>
    Find the code on <a href="https://github.com/sparksuite/simple-html-invoice-template">GitHub</a>. Licensed under the
    <a href="http://opensource.org/licenses/MIT" target="_blank">MIT license</a>.<br /><br /><br />
 -->
    <div class="invoice-box">
      <table>
        <tr class="top">
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
                  <b><?php echo $namaklinik ?></b>

                </td>
                


                <td>
                  Kwitansi #: <?php echo $notransaksi ?><br />
                  Tanggal: <?php  echo $tgl?><br />
                  
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <tr class="information">
          <td colspan="4">
            <table>
              <tr>
                <td>
                    <?php
$query="SELECT 
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,a.notransaksi,b.pasien,b.tgllahir,c.noantrian,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas
FROM kunjunganpasien a , pasien b,antrian c,poliklinik d, dokter e,kelompokkostumerd f,kelompokkostumer g
WHERE a.norm = b.norm 
AND a.notransaksi = c.notransaksi AND a.kdpoli = d.kdpoli AND a.kddokter = e.kddokter AND
a.kdkostumerd = f.kdkostumerd AND f.kdkostumer = g.kdkostumer AND a.kdcabang='$kdcabang' and a.notransaksi='$notransaksi' AND a.tglpriksa='$tgl'  order by a.kddokter,c.noantrian asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                  
                    ?>

                     No Transaksi : <?php echo $row['notransaksi'] ?></br>
            Nama  : <?php echo $row['pasien'] ?></br>
        <!--     Tgl Lahir   : <?php echo $row['tgllahir'] ?></br>
             Alamat : <?php echo $row['alamat'] ?></br>
            Klinik  : <?php echo $row['nampoli'] ?></br>
            Dokter   : <?php echo $row['namdokter'] ?></br>
                   -->  
                 <?php }


          ?>
                </td>

                <td>
                
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <tr class="heading">
          <td>Keterangan</td>

          <td>Qty</td>
        
          <td>Total</td>
        </tr>
<?php
 
    $queryxxf="SELECT  SUM(debet) as  total,SUM(disc) AS disc FROM transaksipasiend WHERE nofaktur='$notransaksi' and kdcabang='$kdcabang'";
                      $resultxxf=mysqli_query($conn, $queryxxf);
                    while($rowxxf=mysqli_fetch_array($resultxxf,MYSQLI_ASSOC)) {

$jmlrj = $rowxxf['total'];

}



  $queryxxfx="SELECT  SUM(totalbayar) as  total,SUM(totaldisc) AS disc FROM jualobat WHERE nofaktur='$notransaksi' and kdcabang='$kdcabang'";
                      $resultxxfx=mysqli_query($conn, $queryxxfx);
                    while($rowxxfx=mysqli_fetch_array($resultxxfx,MYSQLI_ASSOC)) {

$jmlfar = $rowxxfx['total'];

}

$totalall = $jmlrj + $jmlfar;



?>
        <tr class="details">
          <td>Pembayaran Pemeriksaan Rawat Jalan Dan Penunjang</td>

         
        <td>1</td>

          <td><?php echo number_format($totalall) ?></td>
        </tr>


        <tr class="heading">
          <td><?php
                          echo terbilang($totalall);
                        ?></td>

          <td></td>
           <td></td>
        </tr>

     

       
        <tr class="item last">
          <td>Persetujuan</td>

          <td><?php echo $tgl ?></td>

        </tr>

        <tr class="total">
          <td></td>

          <td><br>
            <br>
              <?php echo $username ?>
          </td>
        </tr>
      </table>
    </div>
  </body>
</html>
