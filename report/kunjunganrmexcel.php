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




 date_default_timezone_set( 'Asia/Bangkok' );



 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=Buku Register $tgldari - $tglsampai.xls");



$tgl = date("Y-m-d");

  ?>

  <body>
  
    <div class="invoice-box">
      <table>
        <tr class="top">
          <td colspan="3">
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

                   <b>BUKU REGISTER RAWAT JALAN</b>

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
       
          <td style="text-align:left;">Poliklinik</td>
          <td>Kostumer</td>
           <!--   <td>Laki-Laki</td>
                 <td>Perempuan</td> -->
          <td>Jumlah</td>
      
    
        </tr>


    <?php 






$query="SELECT
SUM(a.ttl) AS total, a.kdpoli,d.nampoli
 FROM kunjunganpasien a ,kelompokkostumerd b,kelompokkostumer c,
 poliklinik d
 WHERE a.kdkostumerd = b.kdkostumerd 
 AND b.kdkostumer = c.kdkostumer AND 
a.kdpoli = d.kdpoli 
AND a.tglpriksa BETWEEN '$tgldari' AND '$tglsampai'
and a.kdcabang='$kdcabang'
GROUP BY kdpoli";

          $result=mysqli_query($conn, $query);
                        $no = 0;
                     
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
              $no ++;
                $kdpoli = $row['kdpoli'];

        
                echo   "<tr class='details'>
                 
          <td style='text-align:left;'>".$row['nampoli']."</td>

         
        <td></td>
    

          <td>".$row['total']."</td>
         

       
    
        </tr>";



$queryx="SELECT
SUM(a.ttl) AS total, c.kdkostumer,c.costumer
 FROM kunjunganpasien a ,kelompokkostumerd b,kelompokkostumer c,
 poliklinik d
 WHERE a.kdkostumerd = b.kdkostumerd 
 AND b.kdkostumer = c.kdkostumer AND 
a.kdpoli = d.kdpoli  and a.kdpoli='$kdpoli'
and a.kdcabang='$kdcabang' and a.tglpriksa  
BETWEEN '$tgldari' AND '$tglsampai'
GROUP BY c.kdkostumer";

// echo $queryx;
   $resultx=mysqli_query($conn, $queryx);
                   
                     
                  while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {
                    
      echo   "<tr class='details'>
             
          <td style='text-align:left;'></td>

         
        <td>".$rowx['costumer']."</td>

          <td>".$rowx['total']."</td>
         

       
    
        </tr>";




                    }
                  }

                  ?>
                    
                 


     

      
      
      </table>
    </div>
  </body>

</html>
