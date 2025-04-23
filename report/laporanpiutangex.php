<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>FAKTUR PENJUALAN PRIODIK</title>

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
        max-width: 1000px;
        margin: auto;
        padding: 10px;
        border: 1px solid #eee;
        /*box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);*/
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

        .bdr{
          border-radius: 5px;
          border:dashed grey 1px;
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
  $tgldari = $_GET['tgldari'];
  $tglsampai = $_GET['tglsampai'];
  $kdcabang = $_GET['kdcabang'];





 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=Laporan Piutang  $tgldari - $tglsampai.xls");




 date_default_timezone_set( 'Asia/Bangkok' );





  ?>

  <body>
  
    <div class="invoice-box">
      <table>
     

        <tr class="information">
          <td colspan="8">
            <table>
              <tr>
                <td>


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
                  <div>
                  LAPORAN  PIUTANG <br> <?php echo $tgldari ?> - <?php echo $tglsampai ?>  
                  <br>
               <a href="laporanpiutangex.php?kdcabang=<?php echo $kdcabang ?>&tgldari=<?php echo $tgldari ?>&tglsampai=<?php echo $tglsampai?>">Export Excel</a>
                </div>

        

                </td>
              </tr>


            </table>
          </td>
        </tr>



        <tr class="heading" >
         
 <td >Tgl </td>
          <td style="text-align:left">Notransaksi</td>
        
          <td style="text-align: left;">No.RM</td>
          
          <td>Pasien</td>
        
          <td>Kostumer</td>
                <td>Poliklinik</td>
    <td>Total</td>     
<td>Status</td>

        </tr>


             

    <?php
  $query="SELECT
a.notrans,a.tglfaktur AS tgl,a.norm,c.pasien,b.nampoli,a.kdkostumer,d.nama,a.tagihan - a.totalcash AS total,'RJ' AS sts,a.kdpoli
FROM transaksiakhir a , poliklinik b, pasien c ,kelompokkostumerd d
WHERE a.kdpoli = b.kdpoli AND a.norm = c.norm AND a.kdcabang='$kdcabang'
AND a.kdkostumer = d.kdkostumerd
AND (a.tagihan - a.totalcash) > 0 
AND a.tglfaktur BETWEEN  '$tgldari' AND '$tglsampai' 
UNION ALL
SELECT 
a.notransaksi,a.tgl,a.norm,c.pasien,b.nampoli,a.kdkostumer,d.nama,a.totalbayar - a.sudahbayar AS total,'FARMASI' AS sts,a.kdpoli
FROM jualobat a, poliklinik b, pasien c ,kelompokkostumerd d
WHERE a.kdpoli = b.kdpoli AND a.norm = c.norm AND a.kdkostumer = d.kdkostumerd
AND a.kdcabang='$kdcabang' AND (a.totalbayar - a.sudahbayar) > 0
AND a.tgl BETWEEN  '$tgldari' AND '$tglsampai'";




  $result=mysqli_query($conn, $query);

          $totalpiutang=0;
  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
   

$totalpiutang  += $row['total'];


echo"<tr class='details' style='border-bottom: 0.5px solid grey;'>
<td>".$row['tgl']."</td>
<td style='text-align:left'>".$row['notrans']."</td>
<td style='text-align: left;'>".$row['norm']."</td>
<td>".$row['pasien']."</td>


<td>".$row['nama']."</td>
<td>".$row['nampoli']."</td>
<td >".number_format($row['total'])."</td>
<td >".$row['sts']."</td>




     </tr>";


}


?>






  
         
<tr class='details' style='border-bottom: 0.5px solid grey;'>
      
         <td><b>TOTAL</b></td>
         <td></td>
             <td></td>
               <td></td>
                <td></td>
      
                <td></td>
      
  <td><b><?php echo number_format($totalpiutang) ?></b></td>
       
         
        
        </tr>


  
         

     

       
      
       

     



      </table>


    </div>

 
  </body>

</html>
