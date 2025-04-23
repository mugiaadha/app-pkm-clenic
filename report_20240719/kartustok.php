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
 $kdobat = $_GET['kdobat'];

$tgldari = $_GET['tgldari'];
$tglsampai = $_GET['tglsampai'];
$status = $_GET['status'];




 date_default_timezone_set( 'Asia/Bangkok' );





$tgl = date("Y-m-d");

  ?>

  <body>
  
    <div class="invoice-box">
      <table>
        <tr class="top">
          <td colspan="6">
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


                   <?php
                  $query="SELECT obat from obat where kdcabang='$kdcabang' and kdobat='$kdobat'";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                    $obat=$row['obat'];
                 
                    
                    
                  }


                  ?>



                   <b>LAPORAN POSISI STOK OBAT  </b>

                </td>
                


                <td>
                 
                  Tanggal: <br />
                  <?php echo $tgldari ?> -  <?php echo $tglsampai ?> <br/>
                  <?php echo $obat ?><br>

                     <?php
                     if($status === '1'){

                        $gudang = 'SEMUA';
                        echo $gudang;
                        
                     }else{

                       $query="SELECT gudang from gudang where kdcabang='$kdcabang' and kdgudang='$status'";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                    $gudang=$row['gudang'];
                 echo $gudang;
                        
                    
                    
                  }
                     }
                 


                  ?>



                </td>
              </tr>
            </table>
          </td>
        </tr>

       

        <tr class="heading">
      
          <td >No Bukti</td>
          <td style="text-align:left;">Keterangan</td>
           <td>Jenis</td>
          <td>Masuk</td>
        <td>Keluar</td>
         <td>Akhir</td>
        
         
         
    
        </tr>


    <?php 





 if($status === '1'){
$query="SELECT 
a.nofaktur,a.kdcus,a.tgldate,a.kdgudang,a.stsmutasi,a.qty,b.pasien,c.nama AS suplier,d.gudang
 FROM kartustok a
 LEFT JOIN pasien b ON a.KDCUS = b.norm
 LEFT JOIN suplier c ON c.kdsup = a.KDCUS 
 LEFT JOIN gudang d ON a.KDCUS = d.kdgudang
  WHERE kdbarang='$kdobat' and a.tgldate between '$tgldari' and '$tglsampai' and a.kdcabang='$kdcabang' ORDER BY tgldate";

 }else{
$query="SELECT 
a.nofaktur,a.kdcus,a.tgldate,a.kdgudang,a.stsmutasi,a.qty,b.pasien,c.nama AS suplier,d.gudang
 FROM kartustok a
 LEFT JOIN pasien b ON a.KDCUS = b.norm
 LEFT JOIN suplier c ON c.kdsup = a.KDCUS 
 LEFT JOIN gudang d ON a.KDCUS = d.kdgudang
  WHERE kdbarang='$kdobat' and a.tgldate between '$tgldari' and '$tglsampai' and a.kdcabang='$kdcabang'
and a.kdgudang='$status'
   ORDER BY tgldate";


 }



              $result=mysqli_query($conn, $query);
                        $no = 0;
                       $total = 0;
                        $totalk = 0;
                         $totala = 0;
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
              $no ++;

              if($row['stsmutasi'] === 'BL'){
                  $keterangan= $row['suplier'];
                    $jenis='BELI';
 $masuk= $row['qty'];
 $keluar = 0;
$akhir = $masuk - $keluar;


              }else if($row['stsmutasi'] === 'JL'){
                $keterangan= $row['pasien'];
                  $jenis='JUAL';
                     $keluar= $row['qty'];
 $masuk= 0;
 $akhir = $masuk - $keluar;

              }else if($row['stsmutasi'] === 'RB'){
                $keterangan= $row['suplier'];
                $jenis='RETUR BELI';
                     $keluar= $row['qty'];
 $masuk= 0;
 $akhir = $masuk - $keluar;

                }else if($row['stsmutasi'] === 'RJ'){
                        $keterangan= $row['pasien'];
                          $jenis='RETUR JUAL';
                           $masuk= $row['qty'];
$keluar = 0;
$akhir = $masuk - $keluar;

 
                  }else if($row['stsmutasi'] === 'MUT'){
                        $keterangan= $row['gudang'];
                         $jenis='MUTASI';
                          $keluar= $row['qty'];
                           $masuk= 0;
                           $akhir = $masuk - $keluar;

                      }else if($row['stsmutasi'] === 'MUTIN'){
                      $keterangan= $row['suplier'];
                       $jenis='MUTASI MASUK';
                        $masuk= $row['qty'];
                        $keluar = 0;
                        $akhir = $masuk - $keluar;

 

                      }else if($row['stsmutasi'] === 'OUT'){
                      $keterangan= $row['suplier'];
                       $jenis='MUTASI KELUAR';
                        $keluar= $row['qty'];
                        $masuk = 0;
                        $akhir = $masuk - $keluar;

 

   }else if($row['stsmutasi'] === 'MUTOUT'){
                      $keterangan= $row['suplier'];
                       $jenis='MUTASI KELUAR';
                        $keluar= $row['qty'];
                        $masuk = 0;
                        $akhir = $masuk - $keluar;

 }



        
                echo   "<tr class='details'>
                   <td>".$row['nofaktur']."</td>
          <td style='text-align:left;'>".$keterangan."</td>

         
       <td >".$jenis."</td>

        <td>".$masuk."</td>
          <td>".$keluar."</td>
           <td>".$akhir."</td>

       
    
        </tr>";

        $total  += $masuk ;
        $totalk  += $keluar ;
        $totala  += $akhir ;

                     
                  }
 echo   "
 <tr class='details'>
                   <td></td>
          <td style='text-align:left;'></td>

         
       <td ><b>Total</b></td>

        <td>".$total ."</td>
          <td>".$totalk ."</td>
           <td>".$totala ."</td>

       
    
        </tr>";

                  ?>
                    
                 


     

      
      
      </table>
    </div>
  </body>

</html>
