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

$tgldari = $_GET['tgldari'];
$tglsampai = $_GET['tglsampai'];




 date_default_timezone_set( 'Asia/Bangkok' );




 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=Pasien-Baru $tgldari - $tglsampai.xls");


$tgl = date("Y-m-d");

  ?>

  <body>
  
    <div class="invoice-box">
      <table>
        <tr class="top">
          <td colspan="5">
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

                   <b>PASIEN BARU PRIODIK</b>

                </td>
                


                <td>
                 
                  Tanggal: <br />
                  <?php echo $tgldari ?> -  <?php echo $tglsampai ?>
                </td>
              </tr>
            </table>
          </td>
        </tr>

       

        <tr class="heading">
        <td>Pasein</td>
          <td style="text-align:left;">NoRm</td>
          <td>Alamat</td>
          <td>Tgl Lahir</td>
          <td>No</td>
    
        </tr>


    <?php 






$query="SELECT * from pasien where tgl BETWEEN '$tgldari' and '$tglsampai' and kdcabang='$kdcabang' order by tgl asc";

          $result=mysqli_query($conn, $query);
                        $no = 0;
                     
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
              $no ++;
               
        
                echo   "<tr class='details'>
                   <td>".$row['pasien']."</td>
          <td style='text-align:left;'>".$row['norm']."</td>

     
    

          <td>".$row['alamatsekarang']."</td>
         
  <td>".$row['tgllahir']."</td>
       <td>".$no."</td>  
    
        </tr>";


                  }

                  ?>
                    
                 


     

      
      
      </table>
    </div>
  </body>

</html>
