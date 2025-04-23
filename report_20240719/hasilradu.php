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
        color: #000;
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
  $x = $_GET['kdproduk'];

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
          <td colspan="5">
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
                  <div style="border: 1px solid #000; border-radius: 10px;padding: 7px; margin-bottom: 10px">
                  HASIL PEMERIKSAAN RADIOLOGI DARI LUAR<br>
                  RADIOLOGI RESULT EXAMINATION 
                </div>

 

                </td>
              </tr>
            

            </table>
          </td>
        </tr>

       



      

  

         



  
         

     
<table>
   <img src="../transaksi/gmb/<?php echo $x ?>.jpg">



</table>
       
      
       




      </table>
    </div>
  </body>

</html>
