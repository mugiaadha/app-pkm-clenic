<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>FAKTUR PEMBELIAN PRIODIK</title>

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


 // header("Content-type: application/vnd-ms-excel");
 // header("Content-Disposition: attachment; filename=Penjualan Obat  $tgldari - $tglsampai.xls");




$tgl = date("Y-m-d");

  ?>

  <body>
  
    <div class="invoice-box">
      <table>
     

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
                  <div>
                  FAKTUR PENJUALAN OBAT PERIODIK <br> <?php echo $tgldari ?> - <?php echo $tglsampai ?> 
                  
                </div>

        

                </td>
              </tr>


            </table>
          </td>
        </tr>



        <tr class="heading" >
         

          <td >Kd Obat</td>
        
          <td style="text-align: left;">Obat</td>
          
          <td>Qty</td>
          <td>Jml Disc</td>
          <td>Total</td>
         
          
        </tr>


             

    <?php



  $queryx="SELECT * from dokter where kdcabang='$kdcabang'";
  $resultx=mysqli_query($conn, $queryx);
while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {
   

echo"<tr class='details' style='border-bottom: 0.5px solid grey;'>

<td>".$rowx['kddokter']."</td>
<td style='text-align: left;'><b>".$rowx['namdokter']."</b></td>
<td></td>
<td></td>

<td></td>


     </tr>";



$kod =$rowx['kddokter'];

  $query="SELECT 
a.kdobat,b.obat,sum(a.qty) AS ttlqty,SUM(a.jmldisc) jmldisc,
SUM(a.totalharga) AS total,c.jenis,d.golongan,e.kddokter
FROM jualobatd a ,obat b,jenisobat c,golonganobat d,jualobat e 
WHERE a.kdobat = b.kdobat AND 
a.notransaksi = e.notransaksi and
b.jenisobat = c.kdjenis AND b.golonganobat = d.kdgolongan AND 
a.kdcabang = b.kdcabang AND a.kdcabang='$kdcabang'  and
a.tgl BETWEEN '$tgldari' AND '$tglsampai'
  and e.kddokter='$kod' GROUP BY a.kdobat";
  $result=mysqli_query($conn, $query);
 
  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
   

echo"<tr class='details' style='border-bottom: 0.5px solid grey;'>

<td>".$row['kdobat']."</td>
<td style='text-align: left;'>".$row['obat']."</td>
<td>".$row['ttlqty']."</td>
<td>".number_format($row['jmldisc'],0)."</td>

<td>".number_format($row['total'],0)."</td>


     </tr>";



}



}


?>






  
         


  
         

     

       
      
       

     



      </table>


    </div>

 
  </body>

</html>
