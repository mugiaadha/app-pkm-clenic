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
      body {
        font-family: font-family: 'Nunito', sans-serif;;
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
        font-family: 'Arial,Helvetica Neue', 'Helvetica', Helvetica, sans-serif;
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



 // $status = $_GET['status'];

 $kds = $_GET['kds'];
 $kdsup = $_GET['kdsup'];


 date_default_timezone_set( 'Asia/Bangkok' );




 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=Pembelian By Suplier  Detail $tgldari - $tglsampai.xls");



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
                  FAKTUR PEMBELIAN PRIODIK <br> <?php echo $tgldari ?> - <?php echo $tglsampai ?> 
                  
                </div>

        

                </td>
              </tr>


            </table>
          </td>
        </tr>

        <tr class="heading" >
         

          <td >KD SUP</td>
        
          <td style="text-align: left;">SUPLIER</td>
           <td>OBAT</td>
          <td>QTY</td>
         
        </tr>


             

     <?php

     if($kds  === 'true'){
  $query="SELECT  a.KDSUPLIER,b.nama AS suplier
 FROM beliobatd a,suplier b ,beliobat c
WHERE a.KDSUPLIER = b.kdsup AND c.NOFAKTUR = a.NOFAKTUR AND c.TGLFAKTUR BETWEEN '$tgldari' AND '$tglsampai'
and a.KDSUPLIER='$kdsup'
  GROUP BY a.KDSUPLIER ORDER BY b.nama asc";
     }else{
  $query="SELECT  a.KDSUPLIER,b.nama AS suplier
 FROM beliobatd a,suplier b ,beliobat c
WHERE a.KDSUPLIER = b.kdsup AND c.NOFAKTUR = a.NOFAKTUR AND c.TGLFAKTUR BETWEEN '$tgldari' AND '$tglsampai'

  GROUP BY a.KDSUPLIER ORDER BY b.nama asc";

     }

  $result=mysqli_query($conn, $query);
  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
    echo "<tr class='details' style='border-bottom: 0.5px solid grey;'>

<td>".$row['KDSUPLIER']."</td>
<td style='text-align: left;'><b>".$row['suplier']."</b></td>
<td>

</td>
<td></td>
     </tr>";

     $kdsup = $row['KDSUPLIER'];
    

      $query1="SELECT distinct c.NOFAKTUR,c.TGLFAKTUR
 FROM beliobatd a,suplier b ,beliobat c
WHERE a.KDSUPLIER = b.kdsup AND c.NOFAKTUR = a.NOFAKTUR AND c.TGLFAKTUR BETWEEN '$tgldari' AND '$tglsampai'AND a.KDSUPLIER='$kdsup'
 ORDER BY b.nama asc";
 $result1=mysqli_query($conn, $query1);
  while($row1=mysqli_fetch_array($result1,MYSQLI_ASSOC)) {
 echo "<tr class='details' style='border-bottom: 0.5px solid grey;'>

<td ></td>
<td style='text-align: left;'>".$row1['TGLFAKTUR']." | ".$row1['NOFAKTUR']." </td>
<td>
 

</td>
<td></td>
     </tr>";

 $nofak= $row1['NOFAKTUR'];

 $query2="SELECT c.NOFAKTUR,c.TGLFAKTUR,a.OBAT,a.QTY
 FROM beliobatd a,suplier b ,beliobat c
WHERE a.KDSUPLIER = b.kdsup AND c.NOFAKTUR = a.NOFAKTUR AND c.TGLFAKTUR BETWEEN '$tgldari' AND '$tglsampai'AND a.NOFAKTUR='$nofak'
 ORDER BY b.nama asc";
 $result2=mysqli_query($conn, $query2);
  while($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)) {

     echo "<tr class='details' style='border-bottom: 0.5px solid grey;'>

<td ></td>
<td style='text-align: left;'></td>
<td>
 
".$row2['OBAT']." 
</td>
<td>".$row2['QTY']." </td>
     </tr>";
  }




  }



   }
     ?>




         

     

       
      
       

     



      </table>


    </div>

 
  </body>

</html>
