<!DOCTYPE html>
<html lang="en" >
 
<head>
 
  <meta charset="UTF-8">
  <title>Tagihan Invoice RINCI</title>
 
        <style>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400&display=swap');
</style>

  <style>

   body {
        font-family: 'Outfit', sans-serif;
        
        color: #000;
      }
@media print {
    .page-break { display: block; page-break-before: always; }
}
      #invoice-POS {
  /*box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);*/
  padding: 2mm;
  margin: 0 auto;
  width: 100mm;
  background: #FFF;
}
#invoice-POS ::selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS ::moz-selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS h1 {
  font-size: 1.5em;
  color: #222;
}
#invoice-POS h2 {
  font-size: .9em;
}
#invoice-POS h3 {
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
#invoice-POS p {
  font-size: .7em;
  color: #666;
  line-height: 1.2em;
}
#invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
  /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
}
#invoice-POS #top {
  min-height: 100px;
}
#invoice-POS #mid {
  min-height: 80px;
}
#invoice-POS #bot {
  min-height: 50px;
}
#invoice-POS #top .logo {
  height: 40px;
  width: 150px;
  /*background: url(https://www.sistemit.com/wp-content/uploads/2020/02/SISTEMITCOM-smlest.png) no-repeat;*/
  background-size: 150px 40px;
}
#invoice-POS .clientlogo {
  float: left;
  height: 60px;
  width: 60px;
 /* background: url(https://www.sistemit.com/wp-content/uploads/2020/02/SISTEMITCOM-smlest.png) no-repeat;*/
  background-size: 60px 60px;
  border-radius: 50px;
}
#invoice-POS .info {
  display: block;
  margin-left: 0;
   color: black;
}
#invoice-POS .title {
  float: right;
}
#invoice-POS .title p {
  text-align: right;
}
#invoice-POS table {
  width: 100%;
  border-collapse: collapse;
}
#invoice-POS .tabletitle {
  font-size: .5em;
  background: #EEE;
}
#invoice-POS .service {
  border-bottom: 1px solid #EEE;
}
#invoice-POS .item {
  width: 24mm;
}
#invoice-POS .itemtext {
  font-size: .5em;
  color: black;
}
#invoice-POS #legalcopy {
  margin-top: 5mm;
}
 
    </style>
 
  <script>
  window.console = window.console || function(t) {};
</script>
 
 
 
  <script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>
 
 
</head>
 
<body translate="no" >
  <?php
  include '../koneksi.php';
  include 'terbilang.php';
  $notransaksi = $_GET['notransaksi'];
  $kdcabang = $_GET['kdcabang'];
  $username = $_GET['username'];


 date_default_timezone_set( 'Asia/Bangkok' );





$tgl = date("Y-m-d");

  ?>

 
  <div id="invoice-POS">
 
  <!--   <center id="top">
      <div class="logo"></div>
      <div class="info"> 
        <h2>SistemIT.com</h2>
      </div>
    </center> -->
 
    <div id="mid">
      <div class="info">
        <?php
                  $query="SELECT * from cabang where kdcabang='$kdcabang'";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                    $namaklinik=$row['nama'];
                    $alamat=$row['alamat'];
                    $hp=$row['hp'];
                    
                    
                  }


                  ?>
                  <b style="font-size:12px;"><?php echo $namaklinik ?></b><br>
                   <b style="font-size:12px;"><?php echo $alamat ?></b>
<hr>
        <div style="text-align: center;font-size:11px;">FAKTUR PELAYANAN<br>
        
        </div>
        <p> 


          <?php
$query="SELECT
a.*,b.pasien,b.tgllahir,c.nama
FROM jualobat a
left join pasien b ON a.norm = b.norm
LEFT JOIN kelompokkostumerd c ON a.kdkostumer = c.kdkostumerd 
WHERE a.notransaksi='$notransaksi'
and a.kdcabang='$kdcabang'";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                    $admresep=$row['adminresep'];
              $tuslah=$row['tuslah'];
  $pembulatan=$row['pembulatan'];
        $totaldisc=$row['totaldisc'];   
              $totalbayar=$row['totalbayar'];  
                    $userbayar=$row['userbayar'];          
                    ?>

                     No Transaksi : <?php echo $row['notransaksi'] ?></br>
            Nama  : <?php echo $row['pasien'] ?></br>
            Tgl Lahir   : <?php echo $row['tgllahir'] ?></br>
           
            Instalasi  : Farmasi</br>
         
               Kostumer   : <?php echo $row['nama'] ?></br>  
                   Tgl   : <?php echo $row['tgl'] ?></br>  
                  
                 <?php }


          ?>
          
        </p>
      </div>
    </div><!--End Invoice Mid-->
 
    <div id="bot">
 
                    <div id="table">
                        <table>
                            <tr class="tabletitle">
                                <td class="item"><h2>Obat</h2></td>
                                <td class="Hours"><h2>Qty</h2></td>
                                <td class="Rate"><h2>Harga</h2></td>
                                <td class="Rate"><h2>Jumlah</h2></td>
                            </tr>

                            <?php
                            $query="SELECT 
a.*,b.obat
from jualobatd a,obat b
WHERE a.kdobat = b.kdobat AND a.kdcabang =b.kdcabang AND a.notransaksi ='$notransaksi' AND a.kdcabang='$kdcabang'";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {


                   
                      echo "<tr class='service'>
                                <td class='tableitem'><p class='itemtext' >".$row['obat']."</p></td>
                                <td class='tableitem'><p class='itemtext'>".$row['qty']."</p></td>
                                <td class='tableitem'><p class='itemtext'>".number_format($row['harga'])."</p></td>
                                  <td class='tableitem'><p class='itemtext'>".number_format($row['totalharga'])."</p></td>
                            </tr>";

            

                    }


                    



                    ?>


 
                        </table>
                    </div><!--End Table-->
 
                    <div id="legalcopy">

                        <p class="legal">
                          

                              
                          <span>Adm Resep  : <?php echo number_format($admresep) ?> </span><br>
                       <span>Tuslah  : <?php echo number_format($tuslah) ?> </span><br>
                        <span>Ttl.Disc  :  <?php echo number_format($totaldisc) ?> </span><br>
                         <span>Pembulatan  : <?php echo number_format($pembulatan) ?> </span><br>
                          <strong>Netto  :   <?php echo number_format($totalbayar) ?> </strong><br>

                           <span>Terbilang  :  <?php  echo terbilang($totalbayar); ?> </span><br>

 <span>User  :  <?php  echo $userbayar; ?> </span><br>
                        </p>

                    </div>
 
                </div><!--End InvoiceBot-->
  </div><!--End Invoice-->
 
</body>
 <script type="text/javascript">
 	window.print()
 </script>
</html>