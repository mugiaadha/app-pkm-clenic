<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>FAKTUR  RETUR PENJUALAN PRIODIK</title>

    <!-- Favicon -->
    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />

    <!-- Invoice styling -->
         <style>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400&display=swap');
</style>

    <style>
      body {
      
        text-align: center;
   
          font-family: 'Outfit', sans-serif;
        
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





$tgl = date("Y-m-d");

  ?>

  <body>
  
    <div class="invoice-box">
      <table>
     

        <tr class="information">
          <td colspan="11">
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
                   RETUR PENJUALAN PRIODIK <br> <?php echo $tgldari ?> - <?php echo $tglsampai ?> 
                  
                </div>

        

                </td>
              </tr>


            </table>
          </td>
        </tr>

        <tr class="heading" >
         

          <td >No Trans</td>
        
          <td style="text-align: left;">Pasien</td>
           <td>Kostumer</td>
          <td>Tgl</td>
         
        </tr>


             

     <?php
  $query="SELECT
a.*,b.pasien,b.tgllahir,c.nama
FROM jualobat a,pasien b,kelompokkostumerd c
WHERE a.norm = b.norm AND a.kdcabang = b.kdcabang
AND a.kdkostumer = c.kdkostumerd and a.kdcabang='$kdcabang' and a.stsr='1' and a.totaluangr > 0 AND a.tglretur BETWEEN '$tgldari' AND '$tglsampai' ORDER BY a.tglretur,a.notransaksi asc";
$totalhargaakhir=0;

  $result=mysqli_query($conn, $query);
  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
    echo "<tr class='details' style='border-bottom: 0.5px solid grey;'>

<td>".$row['noretur']."</td>
<td style='text-align: left;'>".$row['pasien']."</td>
<td>".$row['nama']."
 

</td>
<td>".$row['tglretur']."</td>
     </tr>";

    $notransaksi=$row['notransaksi'];

      $query1="SELECT 
a.*,b.obat
from jualobatd a,obat b
WHERE a.kdobat = b.kdobat AND a.kdcabang =b.kdcabang AND a.notransaksi ='$notransaksi' AND a.kdcabang='$kdcabang' and a.statusr='1' order by a.notransaksi asc";
 $result1=mysqli_query($conn, $query1);
 $jmlharga=0;
  while($row1=mysqli_fetch_array($result1,MYSQLI_ASSOC)) {
 echo "<tr class='details' style='border-bottom: 0.5px solid grey;'>

<td ></td>
<td style='text-align: left;'>".$row1['obat']."</td>
<td>".$row1['qtyr']." (".number_format($row1['harga']).")"."
 

</td>
<td>".number_format($row1['totalhargar'],2)."</td>
     </tr>";


$jmlharga += $row1['totalhargar'];

  }

 echo "<tr class='details' style='border-bottom: 0.5px solid grey;'>

<td ></td>
<td style='text-align: left;'></td>
<td>
 <b>Sub Total :</b>

</td>
<td>".number_format($jmlharga,2)."</td>
     </tr>";


     $totalhargaakhir += $jmlharga;


   }
     ?>




         

     

        <tr class="heading" >
         

        
          
          <td colspan="4" style="text-align:right;"><b>Total Akhir : </b><?php echo number_format($totalhargaakhir,2) ?></td>
         
        </tr>
       
      
       

     



      </table>


    </div>

 
  </body>

</html>
