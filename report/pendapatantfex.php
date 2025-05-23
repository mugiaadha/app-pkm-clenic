<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>REKAP TRANSFER</title>

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


 date_default_timezone_set( 'Asia/Bangkok' );

 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=Pendapatan-TF $tgldari - $tglsampai.xls");




$tgl = date("Y-m-d");

  ?>

  <body>
  
    <div class="invoice-box">
      <table>
        <tr class="top">
          <td colspan="7">
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

                   <b>LAPORAN TRANSFER RAWAT JALAN </b>

                </td>
                


                <td>
                 
                  Tanggal: <br />
                  <?php echo $tgldari ?> -  <?php echo $tglsampai ?><br>
                   
                
                </td>
              </tr>
            </table>
          </td>
        </tr>

       

        <tr class="heading">

          <td>Pasien</td>
          <td>Norm</td>
          <td>Klinik</td>
        
          <td>Jenis</td>
          <td>Nominal</td>

          <td>Bank</td>
        
          <td>Keterangan</td>
        </tr>

<?php 

$query="SELECT
a.tanggal,a.nominal,a.kodebayar,b.akun,a.keterangan,a.norm,c.pasien,d.bayar,d.tampil,a.user,f.nampoli
FROM transferbayar a
LEFT JOIN coa b ON a.bank = b.kdakun AND a.kdcabang = b.kdcabang
LEFT JOIN pasien c ON a.norm = c.norm AND a.kdcabang = c.kdcabang
LEFT JOIN jenisbayar d ON a.kodebayar = d.kd 
LEFT JOIN poliklinik f ON a.kdpoli = f.kdpoli AND a.kdcabang = f.kdcabang
WHERE d.tampil='1' AND a.kdcabang='$kdcabang' AND a.tanggal BETWEEN '$tgldari' AND '$tglsampai'  order by a.tanggal asc";


                    $result=mysqli_query($conn, $query);
                        $tot_tagihan = 0;
                      
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
            
              $tot_tagihan  += $row['nominal'];
             

                echo   "<tr class='details'>
          <td>".$row['pasien']."</td>

         
        <td>".$row['norm']."</td>

          <td>".$row['nampoli']."</td>
           <td>".$row['bayar']."</td>

         
        <td>".number_format($row['nominal'])."</td>

          <td>".$row['akun']."</td>
          <td>".$row['keterangan']."</td>
          
        </tr>";
                    
                  }

                  ?>
        


        <tr class="heading">
          <td></td>

          <td></td>
           <td></td>
           <td></td>
           <td><?php echo number_format($tot_tagihan) ?></td>
           <td></td>
           <td></td>
        </tr>

     

       
      
         <tr class="total">
          <td>Total Cash</td>

          <td>
            <?php echo number_format($tot_tagihan) ?> 
          </td>
        </tr>
      </table>
    </div>
  </body>

</html>
