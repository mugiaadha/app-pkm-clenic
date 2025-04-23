<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>FAKTUR PEMBELIAN</title>

    <!-- Favicon -->
    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />

    <!-- Invoice styling -->
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
  $kdcabang = $_GET['kdcabang'];


 date_default_timezone_set( 'Asia/Bangkok' );





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
                  <div style="border: 1px solid #000; border-radius: 10px;padding: 7px; margin-bottom: 10px">
                  RESEP DARI DOKTER<br>
                
                </div>

        

                </td>
              </tr>


              <?php
   $sekarang = new DateTime("today");

                 $query="SELECT 
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,a.notransaksi,b.pasien,b.tgllahir,c.noantrian,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas,b.jeniskelamin
FROM kunjunganpasien a , pasien b,antrian c,poliklinik d, dokter e,kelompokkostumerd f,kelompokkostumer g
WHERE a.norm = b.norm 
AND a.notransaksi = c.notransaksi AND a.kdpoli = d.kdpoli AND a.kddokter = e.kddokter AND
a.kdkostumerd = f.kdkostumerd AND f.kdkostumer = g.kdkostumer AND a.kdcabang='$kdcabang' and a.notransaksi='$nofaktur'   order by a.kddokter,c.noantrian asc";


                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                    $norm=$row['norm'];
                     $Poliklinik=$row['nampoli'];
$namdokter=$row['namdokter'];
$tglpriksa=$row['tglpriksa'];
$tgllahir=$row['tgllahir'];
$pasien=$row['pasien'];
if($row['jeniskelamin'] === 'L'){
  $jk='Laki-Laki';

}else{
$jk='Perempuan';

//   $tanggal_lahir = $row['tgllahir'];
//     if ($tanggal_lahir > $sekarang) { 
//     $thn = "0";
//     $bln = "0";
//     $tgl = "0";
//     }
//     $thn = $sekarang->diff($tanggal_lahir)->y;
//     $bln = $sekarang->diff($tanggal_lahir)->m;
//     $tgl = $sekarang->diff($tanggal_lahir)->d;
//     $umur =  $thn." tahun ".$bln." bulan ".$tgl." hari";

// echo $umur;
  

}
                     
                  }

              ?>
        
                 <tr style="border: 1px solid #000; border-radius: 10px;padding: 7px;">
                  <td>
                  <span>  Pasien &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $norm ?> | <?php echo $pasien ?> </span><br>
                  <span>  Poliklinik&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                    <?php echo $Poliklinik ?>
                   </span><br>
                  <span>  Dokter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  <?php echo $namdokter ?> </span><br>
                  <span>  Tgl Priksa&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<?php echo $tglpriksa ?>  </span><br>
               

                  </td>
                               
                   <td style=" text-align: justify;">
                   
                  <span>Tgl Lahir : <?php echo $tgllahir ?> </span><br>
                     <span>Notransaksi :  <?php echo $nofaktur ?>  </span><br>
                  <span>Jenis Kelamin : <?php echo $jk ?>  </span><br>
               
                
                

                  </td>

                 </tr>

            </table>
          </td>
        </tr>

        <tr class="heading">
         

          <td >Obat</td>
        
          <td>Signa</td>
           
          <td>Qty</td>
         
            <td>Keterangan</td>
        </tr>


             

            <?php

            $query="SELECT * FROM ermcpptintruksi 
WHERE notransaksi='$nofaktur' AND kdcabang='$kdcabang' AND dari='obat' and dari2='CPPT'  and statuso='Non Racik' order BY  tgl asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {




                    echo "<tr class='details' style='border-bottom: 0.5px solid grey;'>
      
         <td>".$row['nama']."</td>
         <td>".$row['aturan']."</td>
         <td>".$row['qty']."</td>
         <td>".$row['keterangan']."</td>
   
        </tr>";


                  }





            ?>


            <?php

             $queryx="SELECT  DISTINCT kd,kdpruduk,nama,aturan,qty,keterangan
FROM ermcpptintruksi WHERE 
notransaksi='$nofaktur' AND kdcabang='$kdcabang' AND dari='MObat'  and statuso='MRacik' AND dari2='CPPT'
order BY  tgl asc";
                    $resultx=mysqli_query($conn, $queryx);
                  while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {
                    $kd = $rowx["kd"];
   ?>





         

     <tr>
    <th><?php echo $rowx['kdpruduk']  ?></th>
    <th><?php echo $rowx['aturan']  ?> </th>
    <th><?php echo $rowx['qty']  ?> <?php echo $rowx['nama']  ?> </th>
     <th><?php echo $rowx['keterangan']  ?></th>
  </tr>



<?php 



$queryxl="SELECT * FROM ermcpptintruksi 
WHERE notransaksi='$nofaktur' AND kdcabang='$kdcabang' AND dari='Obat'  and statuso='Racik' AND dari2='CPPT' and
kd='$kd' order BY  tgl asc ";
                    $resultxl=mysqli_query($conn, $queryxl);
                  while($rowxl=mysqli_fetch_array($resultxl,MYSQLI_ASSOC)) {


         echo "<tr class='details' style='border-bottom: 0.5px solid grey;'>
      
         <td>".$rowxl['nama']."</td>
         <td>".$rowxl['aturan']."</td>
         <td>".$rowxl['qty']."</td>
         <td>".$rowxl['keterangan']."</td>
   
        </tr>";


}





}?>
  
         



  
         

     

       
      
       



      </table>


    </div>

  <button class="btn btn-primary"   onclick="window.print()" >Cetak</button>
  </body>

</html>
