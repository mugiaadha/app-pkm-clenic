<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>FAKTUR PEMBELIAN</title>

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
        color: #000000;
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
  $nofaktur = $_GET['nofaktur'];
  $noretur = $_GET['noretur'];
  $kdcabang = $_GET['kdcabang'];


 date_default_timezone_set( 'Asia/Bangkok' );





$tgl = date("Y-m-d");

  ?>

  <body>
  
    <div class="invoice-box">
      <table>
     

        <tr class="information">
          <td colspan="9">
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
                  FAKTUR RETUR PEMBELIAN<br>
                
                </div>

        

                </td>
              </tr>


              <?php

                  $query ="SELECT
a.*,b.nama,c.gudang
FROM beliobat a , suplier b,gudang c
WHERE a.KDSUPPLIER = b.kdsup AND
a.KDGUDANG = c.kdgudang AND 
 a.KDCABANG = b.kdcabang and a.noretur='$noretur' AND a.nofaktur='$nofaktur' and a.kdcabang='$kdcabang'
 AND a.STSR='1'  order by a.NOFAKTUR asc";
                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    $supplier = $row['nama'];
                    $gudang = $row['gudang'];    
                    $KETERANGAN = $row['KETERANGANR'];    
                    $tglfaktur = $row['TGLRETUR'];
                    $sysbayar = $row['SYSTEMBAYAR'];

                    $ttlsblum = $row['DPP'];
                    $ppn = $row['PPNR'];
                    $JMLPPN = $row['JMLPPNR'];


                    $JUMLAH = $row['JUMLAH'];
                   

                    
                    if($sysbayar == '2'){
                      $cara = 'Kridit';

                    }else{
                      $cara = 'Cash';
                      
                    }

                    $tgltempo = $row['TGLJATUHTEMPO'];  

                         
                  }

              ?>
        
                 <tr style="border: 1px solid #000; border-radius: 10px;padding: 7px;">
                  <td>
                  <span>  No Retur Faktur&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $nofaktur ?> </span><br>
                  <span>  Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                    <?php echo $supplier ?>
                   </span><br>
                  <span>  Gudang&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  <?php echo $gudang ?> </span><br>
                  <span>  Keterangan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<?php echo $KETERANGAN ?>  </span><br>
               

                  </td>
                               
                   <td style=" text-align: justify;">
                   
                  <span>Tgl Retur Faktur Beli : <?php echo $tglfaktur ?> </span><br>
                  <span>System Pembayaran : <?php echo $cara ?>  </span><br>
                  <span>Tgl Jatuh Tempo :  <?php echo $tgltempo ?>  </span><br>
                
                

                  </td>

                 </tr>

            </table>
          </td>
        </tr>

        <tr class="heading">
         

          <td >Obat</td>
        
          <td>Satuan</td>
           <td>Hna</td>
        
          <td>Qty Beli</td>
          <td>Retur</td>
           <td>Disc %</td>
          <td>Disc Rp</td>
          <td>Total</td>
           
        </tr>


             

            <?php

            $query="SELECT * from beliobatd where NOFAKTUR='$nofaktur' and statusr='1' and statusrv='1' and kdcabang='$kdcabang' order by nomor desc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {




                    echo "<tr class='details' style='border-bottom: 0.5px solid grey;'>
      
         <td>".$row['OBAT']."</td>
         <td>".$row['SATUAN']."</td>
         <td>".number_format($row['HNA'],2)."</td>
         <td>".$row['QTY']."</td>
             <td>".$row['QTYR']."</td>
         <td>".$row['DISCPERSENR']."</td>
         <td>".number_format($row['DISCRPR'],2)."</td>
         <td>".number_format($row['TOTALR'],2)."</td>
      
        </tr>";









                  }





            ?>

     



  
         



  
         

     

       
      
       

          <tr class="item last">
          <td >
            <div style="border-radius: 5px;
          border:dashed grey 1px;padding: 2px;">

            <b>Dasar Pengenaan Pajak : </b>Rp. <?php echo number_format($ttlsblum,2) ?><br>
            <b>PPN <?php echo $ppn ?>: </b>Rp. <?php echo number_format($JMLPPN,2) ?> <br>
            <b>Total Setelah PPN : </b>Rp. <?php echo number_format($JUMLAH,2) ?> <br>
           
            
            </div>
            
          </td>
          <td>

          </td>


        </tr>



      </table>


    </div>

  <button class="btn btn-primary"   onclick="window.print()" >Cetak</button>
  </body>

</html>
