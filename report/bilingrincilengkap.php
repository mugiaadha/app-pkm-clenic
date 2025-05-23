<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Biaya Perawatan</title>

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
          <td colspan="7">
            <table>
              <tr>
                <td>

 <img src="../gmb/logo.png" width="4%">
                    <br>
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
                     <br>
                  <br>
                  <div style="border: 1px solid #000; border-radius: 10px;padding: 7px; margin-bottom: 10px">
                RINCIAN BIAYA RAWAT INAP
                </div>

         

                </td>
              </tr>


              <?php 
             
$query="SELECT 
a.*,d.nama AS namasps,e.nama AS nmkamar,f.namdokter,g.nama AS nmkostumer,h.nama AS kostumercob,i.pasien,i.hp,i.nopengenal,i.alamat,c.namakelas,j.kdtarif,i.tgllahir,i.jeniskelamin
FROM pasienrawatinap a 
LEFT JOIN 
kunjunganpasien b ON  a.notransaksi = b.notransaksi 
LEFT join kamarkelas c ON a.kdklas = c.kdkelas
LEFT join spesialis d ON a.kdspesial = d.kdspesial
LEFT JOIN kamar e ON a.kdkamar = e.kdkamar 
left join dokter f ON a.kddokter = f.kddokter
left join kelompokkostumerd g ON a.kdkostumer = g.kdkostumerd
left join kelompokkostumerd h ON a.kdkostumercob = g.kdkostumerd
left join kelompokkostumer j on j.kdkostumer = g.kdkostumer
LEFT JOIN pasien i ON a.norm = i.norm 
WHERE   a.kdcabang='$kdcabang' AND tglpulang IS null
and a.notransaksi ='$notransaksi'
order by e.nama,i.pasien asc";



$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

  $pasien = $row['pasien'];
  $norm = $row['norm'];
  $tgllahir = $row['tgllahir'];
  $jeniskelamin = $row['jeniskelamin'];

  if($jeniskelamin === 'L'){
    $jk ='Laki-Laki';

  }else{
$jk ='Perempuan';
    
  }
$nmkostumer = $row['nmkostumer'];
$namakelas = $row['namakelas'];
$alamat = $row['alamat'];

$nmkamar = $row['nmkamar'];
$namdokter = $row['namdokter'];
$tglmasuk = $row['tglmasuk'];
$tglpulang = $row['tglpulang'];


if(is_null($tglpulang)){
$tglpulangx = $tgl;

}else{
$tglpulangx = $tglpulang;

}



}
              ?>
          
                 <tr style="border: 1px solid #000; border-radius: 10px;padding: 7px;">
                  <td>
                  <span>  Nama Pasien&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $pasien ?></span><br>
                  <span>  No Rekam Medik&nbsp;:  <?php echo $norm ?></span><br>
                  <span>  Tgl Lahir&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<?php echo $tgllahir ?> </span><br>
                  <span>  Jenis Kelamin&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $jk ?> </span><br>
                  
                  <span>  Kostumer/Kelas &nbsp;&nbsp;&nbsp;&nbsp;:<?php echo $nmkostumer ?> | <?php echo $namakelas ?>   </span><br>
              <span>  Alamat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  <?php echo $alamat ?> </span><br>
                  

                  </td>
               
                   <td style=" text-align: justify;">
                   
                  <span>No Transaksi :  <?php echo $notransaksi ?>  </span><br>
                  <span>Ruang :  <?php echo $nmkamar ?>   </span><br>
                  <span>Dokter :    <?php echo $namdokter ?>  </span><br>
                  <span>Tgl Masuk :   <?php echo $tglmasuk ?>  </span><br>
                  <span>Tgl Pulang :    <?php echo $tglpulangx ?> </span><br>
                

                  </td>

                 </tr>

            </table>
          </td>
        </tr>

        <tr class="heading">
           
          <td>Produk
           
          </td>

          <td style="text-align:center;">Qty</td>
        
          <td>Tarif</td>
             <td>Jumlah</td>
        
          <td>Potongan</td>
           <td>Total</td>
            <td>Tgl
           
          </td>
        </tr>



   <?php
$query="SELECT 
a.*
FROM transaksipasiend a
WHERE  a.nofaktur='$notransaksi'  and a.notransaksi <> '' and a.ri='1'  order by a.tgltransaksi,a.nomor asc ";




                    $result=mysqli_query($conn, $query);
                     $tot_cash = 0;
                      $tot_cashp = 0;
                       $tot_cashpj = 0;

                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                      

                    $nofakturx = $row['notransaksi'];

                    $kdproduk = $row['kdproduk'];
                    $produk = $row['produk'];
                    $qty = $row['qty'];
                    $tarif = $row['harga'];
                       $jml = $row['debet'];
                       $tglxx = $row['tgltransaksi'];



                        $Potongan = $row['disc'];
 $jmlx = $jml + $Potongan;
                       
 $tot_cash  += $jmlx ;
 $tot_cashp  += $Potongan ;
  $tot_cashpj  += $jml ;
?>


<tr class='details' style='border-bottom: 0.5px dashed grey;'>
  
        
          <td><?php echo $produk ;     ?>

<?php


  $queryf="SELECT b.obat ,a.qty

from jualobatd a
,obat b
 where 
 a.kdobat = b.kdobat and 
 a.notransaksi='$nofakturx'";


   $resultf=mysqli_query($conn, $queryf);
     while($rowf=mysqli_fetch_array($resultf,MYSQLI_ASSOC)) {
      echo "<p>".$rowf['obat']." (".$rowf['qty'].")</p>";
     }







 ?>





      </td>

         
        <td  style="text-align:center;"><?php echo $qty ?></td>

          <td ><?php echo number_format($tarif,0) ?></td>
             <td><?php echo number_format($jmlx,0) ?> </td>

          <td><?php echo number_format($Potongan,0) ?></td>
          <td ><?php echo number_format($jml,0) ?></td>
          <td><?php echo $tglxx ?>
        </td>

          
        </tr>



<?php
                  }?>


      
                            <tr class="tabletitle" style="border-bottom: 0.5px dashed grey;">
                                <td></td>
                                 <td></td>
                                  <td></td>
                                <td class="Rate"><h4><?php echo number_format($tot_cash,0) ?></h4></td>
                                <td class="payment"><h4><?php echo number_format($tot_cashp,0) ?></h4></td>
                                  <td class="payment"><h4><?php echo number_format($tot_cashpj,0) ?></h4></td>
                            </tr>




                            <tr class="tabletitle" style="border-bottom: 0.5px dashed grey;">
                               
                                <td class="Rate"><h4>Uang Muka</h4></td>
                                  <td></td>
                                 <td></td>
                                  <td></td>
                                <td class="payment"><h4></h4></td>
                                  <td class="payment"><h4>   <?php
$query="SELECT 
SUM(a.debet) AS uangmuka
FROM transaksipasiend a


wHERE a.nofaktur ='$notransaksi' and a.ri='1'
and a.kdcabang='$kdcabang' and a.kdproduk = '10'";
                    $result=mysqli_query($conn, $query);
                   

                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    $uangmuka =$row['uangmuka'];
                    echo number_format($uangmuka,0);

                  }?></h4></td>
                                 
                            </tr>
          

<tr class="tabletitle" style="border-bottom: 0.5px dashed grey;">
                               
                                <td class="Rate"><h4>Sisa Yang Harus di Bayar</h4></td>
                                  <td></td>
                                 <td></td>
                                  <td></td>
                                <td class="payment"><h4></h4></td>
                                  <td class="payment"><h4>
                                    
                                    <?php echo number_format($tot_cashpj - $uangmuka,0)?>
                                    
                                  </h4></td>
                                 
                            </tr>

<tr class="tabletitle" style="border: 0.5px dashed grey;font-style: italic;">
                               
                                <td class="Rate" colspan="5"><h4> <?php
                          echo terbilang($tot_cashpj - $uangmuka);
                        ?></h4></td>
                                
                                 
                            </tr>
  

     

         



  
         
          <tr class="item last">
          <td colspan="3">
            <br>
            <br>
            
          </td>

          <td colspan="3"><?php echo $tgl ?>
            <br>
            Penata Jasa
            <br>
            <br>
            <br>
             <span>------------------</span>
          </td>

        </tr>


     

       
      
       




      </table>
    </div>
  </body>

</html>
