<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>LABA RUGI</title>

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
        font-size: 14px;
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
          border: 1px solid #eee;

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
  $kdcabang = $_GET['kdcabang'];






  $tgldaril = strtotime($_GET['tgldari']);



$tahun = date('Y',$tgldaril);
$bulan = date('m',$tgldaril);



 date_default_timezone_set( 'Asia/Bangkok' );

 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=Laba Rugi   $tgldari - $tglsampai.xls");





  ?>

  <body>
  
    <div class="invoice-box">
      <table>
     

        <tr class="information">
          <td colspan="3">
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
                  LAPORAN LABA RUGI <br> <?php echo $tgldari ?> 
                  <br>
               <a href="labarugiklinikex.php?kdcabang=<?php echo $kdcabang ?>&tgldari=<?php echo $tgldari ?>">Export Excel</a>
                </div>

        

                </td>
              </tr>


            </table>
          </td>
        </tr>



        <tr class="heading" >
         
 <td >AKUN</td>
          <td >BULAN INI </td>
        
           <td >SAMPAI BULAN INI</td>
        
        </tr>


             

<tr class='details' style='border-bottom: 0.5px solid grey;'>
<td><b>PENDAPATAN</b></td>
<td></td>
</tr>


<tr class='details' style='border-bottom: 0.5px solid grey;'>

<td>-PENDAPATAN FARMASI</td>
<td>

                   <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '403.001' AND '403.002' and kdcabang='$kdcabang'
 AND   MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'
 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                

                   echo "<b>".number_format($row['total'],0)."<b/>";

                  }

                  ?>


</td>
<td>


                   <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '403.001' AND '403.002' and kdcabang='$kdcabang'

 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                

                   echo "<b>".number_format($row['total'],0)."<b/>";

                  }

                  ?>

</td>




  </tr>


<tr class='details' style='border-bottom: 0.5px solid grey;'>
<td>-PENDAPATAN INSTALASI</td>
<td>


                   <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '401.001' AND '401.200.09' and kdcabang='$kdcabang'
 AND   MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'
 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                

                   echo "<b>".number_format($row['total'],0)."<b/>";

                  }

                  ?>

</td>
<td>


                   <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '401.001' AND '401.200.09' and kdcabang='$kdcabang'

 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                

                   echo "<b>".number_format($row['total'],0)."<b/>";

                  }

                  ?>

</td>

</tr>

<tr class='details' style='border-bottom: 0.5px solid grey;'>
<td>-PENDAPATAN NON INSTALASI</td>
<td>          <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '402.001' AND '402.002.09' and kdcabang='$kdcabang'
 AND   MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'
 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                

                   echo "<b>".number_format($row['total'],0)."<b/>";

                  }

                  ?>

                </td>

                <td>          <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '402.001' AND '402.002.09' and kdcabang='$kdcabang'

 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                

                   echo "<b>".number_format($row['total'],0)."<b/>";

                  }

                  ?>

                </td>


</tr>

<tr class='details' style='border-bottom: 0.5px solid grey;'>
<td><b>TOTAL PENDAPATAN</b></td>
<td>


                   <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '401.001' AND '403.100' and kdcabang='$kdcabang'
 AND   MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'
 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                   $totalp = $row['total'];
 $totalpi = $row['total'];

                   echo "<b>".number_format($totalp,0)."<b/>";

                  }


                  ?>

</td>
<td>


                   <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '401.001' AND '403.100' and kdcabang='$kdcabang'

 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                   $totalpC = $row['total'];
                    $totalpik = $row['total'];

                   echo "<b>".number_format($totalpC,0)."<b/>";

                  }


                  ?>

</td>

</tr>


<tr class='details' style='border-bottom: 0.5px solid grey;'>
<td><b>HARGA POKOK</b></td>
<td>
</td>
<td>
</td>


</tr>











<tr class='details' style='border-bottom: 0.5px solid grey;'>
<td>-HARGA POKOK FARMASI</td>
<td>


                   <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '610.000' AND '610.100' and kdcabang='$kdcabang'
 AND   MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'
 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                   $totalp = $row['total'];

                   echo "<b>".number_format($totalp,0)."<b/>";

                  }


                  ?>

</td>
<td>


                   <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '610.000' AND '610.100' and kdcabang='$kdcabang'

 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                   $totalpC = $row['total'];

                   echo "<b>".number_format($totalpC,0)."<b/>";

                  }


                  ?>

</td>

</tr>




<tr class='details' style='border-bottom: 0.5px solid grey;'>
<td><b>TOTAL HARGA POKOK</b></td>
<td>


                   <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '610.000' AND '610.100' and kdcabang='$kdcabang'
 AND   MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'
 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                   $totalp = $row['total'];
 $totalpf = $row['total'];

                   echo "<b>".number_format($totalp,0)."<b/>";

                  }


                  ?>

</td>
<td>


                   <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '610.000' AND '610.100' and kdcabang='$kdcabang'

 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                   $totalpC = $row['total'];
 $totalpCs = $row['total'];

                   echo "<b>".number_format($totalpC,0)."<b/>";

                  }


                  ?>

</td>


</tr>








<tr class='details' style='border-bottom: 0.5px solid grey;'>
<td><b>LABA KOTOR</b></td>
<td>
<?php

$labakotbulaninia =   $totalpi - $totalpf;

echo "<b>".number_format($labakotbulaninia,0)."<b/>";



?>

</td>
<td>


   <?php

$labakotbulaninib =   $totalpik - $totalpCs;

echo "<b>".number_format($labakotbulaninib,0)."<b/>";



?>           

</td>


</tr>

<tr class='details' style='border-bottom: 0.5px solid grey;'>
<td><b></b></td>
<td>


</td>
<td>

         

</td>


</tr>












  
         

<tr class='details' style='border-bottom: 0.5px solid grey;'>
<td><b>BIAYA</b></td>
<td></td>
</tr>


  <tr class='details' style='border-bottom: 0.5px solid grey;'>
<td>-   BIAYA ADM UMUM</td>
<td> <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '510.000' AND '510.019' and kdcabang='$kdcabang'
 AND   MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'
 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                

                   echo "<b>".number_format($row['total'],0)."<b/>";

                  }

                  ?>

                </td>


                <td> <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '510.000' AND '510.019' and kdcabang='$kdcabang'

 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                

                   echo "<b>".number_format($row['total'],0)."<b/>";

                  }

                  ?>

                </td>


</tr>
<tr class='details' style='border-bottom: 0.5px solid grey;'>
<td>-   BIAYA ADM NON UMUM</td>
<td> <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '520.000' AND '520.029' and kdcabang='$kdcabang'
 AND   MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'
 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                

                   echo "<b>".number_format($row['total'],0)."<b/>";

                  }

                  ?>

                </td>

                <td> <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '520.000' AND '520.029' and kdcabang='$kdcabang'

 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                

                   echo "<b>".number_format($row['total'],0)."<b/>";

                  }

                  ?>

                </td>
</tr>
<tr class='details' style='border-bottom: 0.5px solid grey;'>
<td>-   BIAYA UTILITAS</td>
<td>
<?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '530.000' AND '530.039' and kdcabang='$kdcabang'
 AND   MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'
 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                

                   echo "<b>".number_format($row['total'],0)."<b/>";

                  }

                  ?>
</td>

<td>
<?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '530.000' AND '530.039' and kdcabang='$kdcabang'

 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                

                   echo "<b>".number_format($row['total'],0)."<b/>";

                  }

                  ?>
</td>


</tr>
<tr class='details' style='border-bottom: 0.5px solid grey;'>
<td>-   BIAYA PEMBELIAN BAHAN</td>
<td>

<?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '540.000' AND '540.049' and kdcabang='$kdcabang'
 AND   MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'
 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                

                   echo "<b>".number_format($row['total'],0)."<b/>";

                  }

                  ?>

</td>

<td>

<?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '540.000' AND '540.049' and kdcabang='$kdcabang'

 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                

                   echo "<b>".number_format($row['total'],0)."<b/>";

                  }

                  ?>

</td>


</tr>
<tr class='details' style='border-bottom: 0.5px solid grey;'>
<td>-  BIAYA JASA MEDIK DAN JASA PELY LAIN</td>
<td>
  <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '550.000' AND '550.059' and kdcabang='$kdcabang'
 AND   MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'
 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                

                   echo "<b>".number_format($row['total'],0)."<b/>";

                  }

                  ?>

</td>
<td>
  <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '550.000' AND '550.059' and kdcabang='$kdcabang'

 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                

                   echo "<b>".number_format($row['total'],0)."<b/>";

                  }

                  ?>

</td>
</tr>
<tr class='details' style='border-bottom: 0.5px solid grey;'>
<td>-   BIAYA PENYUSUTAN</td>
<td>

  <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '560.000' AND '560.069' and kdcabang='$kdcabang'
 AND   MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'
 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                

                   echo "<b>".number_format($row['total'],0)."<b/>";

                  }

                  ?>

</td>
<td>

  <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '560.000' AND '560.069' and kdcabang='$kdcabang'

 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                

                   echo "<b>".number_format($row['total'],0)."<b/>";

                  }

                  ?>

</td>
</tr>
<tr class='details' style='border-bottom: 0.5px solid grey;'>
<td>-   BIAYA PAJAK</td>
<td>
  <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '570.000' AND '570.079' and kdcabang='$kdcabang'
 AND   MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'
 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                

                   echo "<b>".number_format($row['total'],0)."<b/>";

                  }

                  ?>

</td>
<td>
  <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '570.000' AND '570.079' and kdcabang='$kdcabang'

 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                

                   echo "<b>".number_format($row['total'],0)."<b/>";

                  }

                  ?>

</td>
</tr>
<tr class='details' style='border-bottom: 0.5px solid grey;'>
<td>-   BIAYA BANK</td>
<td>
  
  <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '580.000' AND '580.089' and kdcabang='$kdcabang'
 AND   MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'
 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                

                   echo "<b>".number_format($row['total'],0)."<b/>";

                  }

                  ?>

</td>
<td>
  
  <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '580.000' AND '580.089' and kdcabang='$kdcabang'

 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                

                   echo "<b>".number_format($row['total'],0)."<b/>";

                  }

                  ?>

</td>
</tr>
<tr class='details' style='border-bottom: 0.5px solid grey;'>
<td>-   BIAYA LAIN - LAIN</td>
<td>

  <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '590.000' AND '590.099' and kdcabang='$kdcabang'
 AND   MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'
 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                

                   echo "<b>".number_format($row['total'],0)."<b/>";

                  }

                  ?>

</td>
<td>

  <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa BETWEEN '590.000' AND '590.099' and kdcabang='$kdcabang'

 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                

                   echo "<b>".number_format($row['total'],0)."<b/>";

                  }

                  ?>

</td>
</tr>
<tr class='details' style='border-bottom: 0.5px solid grey;'>
<td><b>TOTAL BIAYA</b></td>
<td>

            <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa  BETWEEN '510.001' AND '590.012' and kdcabang='$kdcabang'
 AND   MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'
 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                   $ttlbiaya = $row['total'];

                   echo "<b>".number_format($ttlbiaya,0)."<b/>";

                  }


                  ?>
</td>
<td>

            <?php
                  $query="SELECT SUM(jml) AS total FROM glpusatd

WHERE kdcoa  BETWEEN '510.000' AND '590.099' and kdcabang='$kdcabang'

 ORDER BY kdcoa asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                   
                   $ttlbiayaC = $row['total'];

                   echo "<b>".number_format($ttlbiayaC,0)."<b/>";

                  }


                  ?>
</td>
</tr>         

     
<tr class='details' style='border-bottom: 0.5px solid grey;'>
<td><b>LABA RUGI</b></td>
<td>
  
<?php 


// echo $labakotbulaninia ;

$ttlakhir = $labakotbulaninia - $ttlbiaya;

echo "<b>".number_format($ttlakhir,0)."<b/>";

?>

</td>
<td>
  
<?php 

$ttlakhirC = $labakotbulaninib  - $ttlbiayaC;

echo "<b>".number_format($ttlakhirC,0)."<b/>";

?>

</td>

</tr>       
       
      
       

     



      </table>


    </div>

 
  </body>

</html>
