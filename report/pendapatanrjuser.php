<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>PENDAPATAN</title>

    <!-- Favicon -->
    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />

    <!-- Invoice styling -->
    <style>
      body {
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
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
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        font-size: 12px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
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
$username = $_GET['username'];
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
          <td colspan="9">
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

                   <b>LAPORAN PENDAPATAN RAWAT JALAN KASIR   <?php echo $username ?> </b>

                </td>
                


                <td>
                 
                  Tanggal: <br />
                  <?php echo $tgldari ?> -  <?php echo $tglsampai ?><br>
                      Kasir: 
                  <?php echo $username ?> 
                </td>
              </tr>
            </table>
          </td>
        </tr>

       

        <tr class="heading">

          <td>Pasien</td>
          <td>Norm</td>
          <td>Klinik</td>
        
          <td>Kostumer</td>
          <td>Tagihan</td>

          <td>Piutang</td>
        
          <td>Tunai</td>
          
          <td>Transfer RI</td>

           <td>Tgl</td>
        </tr>

<?php 

 if($status === '1'){
$query="SELECT
a.*,b.kdpoli,b.nampoli,c.nama,d.pasien
FROM transaksiakhir a,poliklinik b , kelompokkostumerd c,pasien d
WHERE a.kdpoli = b.kdpoli 
 AND a.kdcabang = b.kdcabang AND a.kdkostumer = c.kdkostumerd AND a.norm = d.norm and a.kdcabang='$kdcabang' and a.tglfaktur between '$tgldari' and '$tglsampai' and a.user='$username' and a.tagihan <> 0 order by b.kdpoli,a.tglfaktur asc";
   }else{
  $kdpoli=$_GET['kdpoli'];
$query="SELECT
a.*,b.kdpoli,b.nampoli,c.nama,d.pasien
FROM transaksiakhir a,poliklinik b , kelompokkostumerd c,pasien d
WHERE a.kdpoli = b.kdpoli 
 AND a.kdcabang = b.kdcabang AND a.kdkostumer = c.kdkostumerd AND a.norm = d.norm AND a.kdpoli='$kdpoli' and a.kdcabang='$kdcabang' and a.tglfaktur between '$tgldari' and '$tglsampai' and a.user='$username' and a.tagihan <> 0 order by b.kdpoli,a.tglfaktur asc";
}

                    $result=mysqli_query($conn, $query);
                        $tot_tagihan = 0;
                         $tot_piutang = 0;
                        $tot_cash = 0;
                           $tot_cashtf = 0;
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
            
              $tot_tagihan  += $row['tagihan'];
               $tot_piutang  += $row['totalpiutang'];
                $tot_cash  += $row['totalcash'];
                  $tot_cashtf  += $row['transfer'];
                echo   "<tr class='details'>
          <td>".$row['pasien']."</td>

         
        <td>".$row['norm']."</td>

          <td>".$row['nampoli']."</td>
           <td>".$row['nama']."</td>

         
        <td>".number_format($row['tagihan'])."</td>

          <td>".number_format($row['totalpiutang'])."</td>
          <td>".number_format($row['totalcash'])."</td>
           
              <td>".number_format($row['transfer'])."</td>
            <td>".$row['tglfaktur']."</td>
        </tr>";
                    
                  }

                  ?>
        


        <tr class="heading">
          <td></td>

          <td></td>
           <td></td>
           <td></td>
           <td><?php echo number_format($tot_tagihan) ?></td>
           <td><?php echo number_format($tot_piutang) ?></td>
           <td><?php echo number_format($tot_cash) ?></td>
             <td><?php echo number_format($tot_cashtf) ?></td>
             <td></td>
              <td></td>
        </tr>

     

       
        <tr class="item last">
          <td>Total Tagihan</td>

          <td><?php echo number_format($tot_tagihan) ?></td>

        </tr>

        <tr class="total">
          <td>Total Piutang</td>

          <td><?php echo number_format($tot_piutang) ?>
             
          </td>
        </tr>
         <tr class="total">
          <td>Total Cash</td>

          <td><?php echo number_format($tot_cash) ?>
             
          </td>
        </tr>
          <tr class="total">
          <td>Total Tagihan Transfer RI</td>

          <td><?php echo number_format($tot_cashtf) ?>
             
          </td>
        </tr>
      </table>
    </div>
  </body>
   <script type="text/javascript">
  window.print()
 </script>
</html>
