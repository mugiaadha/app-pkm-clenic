<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>BELUM BAYAR PRIODIK</title>

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


 date_default_timezone_set( 'Asia/Bangkok' );


 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=Belum Bayar $tgldari - $tglsampai.xls");



$tgl = date("Y-m-d");

  ?>

  <body>
  
    <div class="invoice-box">
      <table>
     

        <tr class="information">
          <td colspan="7">
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
                  BELUM BAYAR PRIODIK <br> <?php echo $tgldari ?> - <?php echo $tglsampai ?> 
                  <br>
                
                </div>

        

                </td>
              </tr>


            </table>
          </td>
        </tr>

        <tr class="heading" >
         

          <td >TGL</td>
        
          <td>NOFAKTUR</td>
           <td>NORM</td>
          <td>PASIEN</td>
          <td>KDPOLI</td>
           <td>POLI</td>

          <td>BELUM BAYAR</td>
          
        </tr>


             

            <?php

            $query="SELECT b.tgltransaksi,a.notransaksi,
 SUM(a.debet) - SUM(a.kridit) AS KREDIT,b.norm,b.kdpoli,c.pasien,d.nampoli


FROM transaksipasiend a,transaksipasien b,pasien c,poliklinik d
WHERE
a.notransaksi = b.notransaksi AND b.norm = c.norm AND b.kdpoli = d.kdpoli
 and a.tgltransaksi BETWEEN '$tgldari' AND '$tglsampai' AND a.kdcabang='$kdcabang'
GROUP BY a.notransaksi,b.norm,b.kdpoli
HAVING( SUM(a.debet) - SUM(a.kridit) > 0) order BY a.notransaksi";



                    $result=mysqli_query($conn, $query);
                  
                   
                     $nettottl=0;
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {


                    echo "<tr class='details' style='border-bottom: 0.5px solid grey;'>
      
         <td>".$row['tgltransaksi']."</td>
         <td>".$row['notransaksi']."</td>
             <td>".$row['norm']."</td>
           
               <td>".$row['pasien']."</td>
               <td>".$row['kdpoli']."</td>
                <td>".$row['nampoli']."</td>
                <td>".number_format($row['KREDIT'],2)."</td>
            
             
        
        </tr>";





$nettottl += $row['KREDIT'];

                  }


 
            ?>

     



  
         
<tr class='details' style='border-bottom: 0.5px solid grey;'>
      
         <td><b>TOTAL</b></td>
         <td></td>
             <td></td>
               <td></td>
                <td></td>
             
            
                 <td></td>
      
         <td><b><?php echo number_format($nettottl,2) ?></b></td>
        
        </tr>


  
         

     

       
      
       

     



      </table>


    </div>

 
  </body>

</html>
