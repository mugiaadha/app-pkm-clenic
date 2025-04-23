<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>KWITANSI</title>

    <!-- Favicon -->
    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />

    <!-- Invoice styling -->

        <style>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400&display=swap');
</style>

    <style>
     body {
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
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
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
        padding-bottom: 20px;
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
  $notransaksi = $_GET['notransaksi'];
  $kdcabang = $_GET['kdcabang'];
$username = $_GET['username'];


 date_default_timezone_set( 'Asia/Bangkok' );





$tgl = date("Y-m-d");

  ?>

  <body>
  
    <div class="invoice-box">
      <table>
        <tr class="top">
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
                  <b><?php echo $namaklinik ?></b><br/>


                   <b>KWITANSI</b>

                </td>
                


                <td>
                  Kwitansi #: <?php echo $notransaksi ?><br />
                  Tanggal: <?php  echo $tgl?><br />
                  
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <tr class="information">
          <td colspan="4">
            <table>
              <tr>
                <td>
                       <?php 
              $kdcabang=$_GET['kdcabang'];
              $notransaksi=$_GET['notransaksi'];
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
WHERE   a.kdcabang='$kdcabang' 
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

              No Transaksi : <?php echo $notransaksi ?></br>
            Nama  : <?php echo $pasien ?></br>


                </td>

                <td>
                
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <tr class="heading">
          <td>Keterangan</td>

          <td></td>
        
          <td></td>
           <td></td>
            <td></td>
             <td>Total</td>
        </tr>





        <tr class="details">
          <td>Pembayaran Pemeriksaan Rawat Inap Dan Penunjang</td>

         
        <td></td>
<td></td>
          <td>  <?php
$query="SELECT 
a.kdproduk,a.produk,a.harga,SUM(a.qty) AS qty,SUM(a.debet) AS debet,SUM(a.kridit) AS kridit,SUM(a.disc) AS disc
FROM transaksipasiend a
WHERE  a.nofaktur ='$notransaksi'
  and a.notransaksi <> ''  and a.kdproduk<>'10' and a.ri='1' and a.kdproduk <> '1'  and a.kdproduk <> '2'
  GROUP BY a.kdproduk,a.produk
  
   order BY a.kdproduk asc
";
                    $result=mysqli_query($conn, $query);
                     $tot_cash = 0;
                      $tot_cashp = 0;
                       $tot_cashpj = 0;

                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                      


$kdproduk = $row['kdproduk'];
                    $produk = $row['produk'];
                    $qty = $row['qty'];
                    $tarif = $row['harga'];
                       $jml = $row['debet'];



                        $Potongan = $row['disc'];
 $jmlx = $jml + $Potongan;
                       
 $tot_cash  += $jmlx ;
 $tot_cashp  += $Potongan ;
  $tot_cashpj  += $jml ;


}






        ?></td>
        </tr>

  <tr class='details' style="border-bottom: 0.5px dashed grey;">
                                <td><b>Total</b></td>
                                 <td></td>
                                  <td></td>
                                <td><b></b></td>
                                <td><b></b></td>
                                  <td ><b><?php echo number_format($tot_cashpj,0) ?></b></td>
                            </tr>









                            <tr class="details" style="border-bottom: 0.5px dashed grey;">
                                <td><b>Total + Pembulatan</b></td>
                                 <td></td>
                                  <td></td>
                                <td ><b></b></td>
                                <td><b></b></td>
                                  <td ><b><?php 

$totalharga = $tot_cashpj;
$totalharga=ceil($totalharga);
                            if (substr($totalharga,-3)>499){
                                $total_harga=round($totalharga,-3);
                            } else {
                                $total_harga=round($totalharga,-3)+1000;
                            } 
                             
                            echo number_format($total_harga,0,',','.');
?></b></td>
                            </tr>


                            <tr class="details" style="border-bottom: 0.5px dashed grey;">
                               
                                <td ><b>Uang Muka</b></td>
                                  <td></td>
                                 <td></td>
                                  <td></td>
                                <td ><b></b></td>
                                  <td ><b>   <?php
$query="SELECT 
SUM(a.kridit) AS uangmuka
FROM transaksipasiend a


wHERE a.nofaktur ='$notransaksi' and a.ri='1'
and a.kdcabang='$kdcabang' and a.kdproduk = '10'";




                    $result=mysqli_query($conn, $query);
                   

                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    $uangmuka =$row['uangmuka'];
                    echo number_format($uangmuka,0);

                  }?></b></td>
                                 
                            </tr>
          
<tr class="details" style="border-bottom: 0.5px dashed grey;">
                               
                                <td ><b>Bayar</b></td>
                                  <td></td>
                                 <td></td>
                                  <td></td>
                                <td><b></b></td>
                                  <td ><b>
                                    
                                    <?php
$query="SELECT 
SUM(a.kridit) AS bayar
FROM transaksipasiend a


wHERE a.nofaktur ='$notransaksi' and a.ri='1'
and a.kdcabang='$kdcabang' and   a.kdproduk = 1 ";




                    $result=mysqli_query($conn, $query);
                   

                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    $bayar =$row['bayar'];
                    echo number_format($bayar,0);

                  }?>
                                  </b></td>
                                 
                            </tr>



                            <tr class="details" style="border-bottom: 0.5px dashed grey;">
                               
                                <td ><b>Di Tanggung Asuransi <?php echo $nmkostumer ?></b></td>
                                  <td></td>
                                 <td></td>
                                  <td></td>
                                <td><b></b></td>
                                  <td ><b>
                                    
                                    <?php
$query="SELECT 
SUM(a.kridit) AS bayar
FROM transaksipasiend a


wHERE a.nofaktur ='$notransaksi' and a.ri='1'
and a.kdcabang='$kdcabang' and   a.kdproduk = 2 ";




                    $result=mysqli_query($conn, $query);
                   

                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    $bayard =$row['bayar'];
                    echo number_format($bayard,0);

                  }?>
                                  </b></td>
                                 
                            </tr>






<tr class="details" style="border-bottom: 0.5px dashed grey;">
                               
                                <td ><b>Sisa Yang Harus di Bayar</b></td>
                                  <td></td>
                                 <td></td>
                                  <td></td>
                                <td><b></b></td>
                                  <td ><b>
                                    
                                    <?php 
                                    $b = $bayar + $uangmuka+$bayard;

                                    echo number_format($total_harga - $b,0)?>
                                    
                                  </b></td>
                                 
                            </tr>

<tr class="details" style="border: 0.5px dashed grey;font-style: italic;">
                               
                                <td class="Rate" colspan="5"><h4> <?php
                          echo terbilang($total_harga - $b);
                        ?></h4></td>
                                
                                 
                            </tr>
  





        <tr class="heading">
          <td><?php
                         
                        ?></td>

          <td></td>
           <td></td>
            <td></td>
           <td></td>
        </tr>

     

       
        <tr class="item last">
          <td>Persetujuan</td>
 <td></td>
 
          <td><?php echo $tgl ?>
<br>
<br>
<br>


 <?php echo $username ?>
        </td>
 <td></td>
  
        </tr>

       
      </table>
    </div>
  </body>

</html>
