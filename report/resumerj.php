<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RESUME RJ</title>

    <!-- Bootstrap CSS -->
    <link href="Bootstrap/bootstrap.min.css" rel="stylesheet">

  </head>

    <style>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400&display=swap');

  body {
        font-family: 'Outfit', sans-serif;
        
        color: #000;
      }


      
</style>


  <body>


    <?php
  include '../koneksi.php';
$notrans=$_GET['notrans'];
$norm=$_GET['norm'];
$kdcabang=$_GET['kdcabang'];

$url = $notrans.$kdcabang.'.jpg';


 $query="SELECT 
a.*,b.nampoli,c.namdokter
FROM ermcppt a ,poliklinik b,dokter c
WHERE a.kdpoli = b.kdpoli AND a.kdcabang = b.kdcabang AND a.kddokter = c.kddokter and a.kdcabang='$kdcabang' and a.notrans='$notrans' and a.norm='$norm'";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                  $dpjp =$row['namdokter'];
                  $tglpriksa =$row['tgl'];
                   $poli =$row['nampoli'];
                 $subjek =$row['subjek'];
                   $td =$row['td'];
                    $tdd =$row['tdd'];
                     $bb =$row['bb'];
                  $nadi =$row['nadi'];
                     $suhu =$row['suhu'];
                     $rr =$row['rr'];
                      $spo =$row['spo'];
                    $pf =$row['pf'];
                    $planing =$row['planing'];

                      $hr =$row['hr'];
   $rwytp =$row['rwytp'];
   $gigi =$row['gigi'];
      $tb =$row['tb'];
      $tglkontrol =$row['tglkontrol'];
      $rencanatindakan =$row['rencanatindakan'];
         $tb =$row['tb'];
         $kesadaran =$row['nadi'];
         
         if($kesadaran === '01'){
             
             $kesadaran ='Compos Metis';
             
         }else{
               $kesadaran ='Compos Metis';
             
         }
                  }

    ?>
  
        <div class="container" style="margin-top: 25px">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="col-md-4 col-sm-4 col-xs-4">
          
             <?php
                  $query="SELECT * from cabang where kdcabang='$kdcabang'";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                    $namaklinik=$row['nama'];
                    $alamat=$row['alamat'];
                    $hp=$row['hp'];
                    
                    echo '<b>'.$namaklinik.'<b><br>';
                       echo $alamat;
                  }





                  ?>
            </div>
            <div class="col-md-5 col-md-offset-3 col-sm-5 col-sm-offset-3 col-xs-5 col-xs-offset-3" style="font-size: 11px">
<?php

$query="SELECT * from pasien where norm='$norm' and kdcabang='$kdcabang'";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                  $nama =$row['pasien'];
                  $norm =$row['norm'];
                  $tgllahir =$row['tgllahir'];
                  $alamat =$row['alamat'];
                  }
?>
              <div style="border: 1px solid #000; border-radius: 5px;padding: 7px; margin-bottom: 10px">
                <p style="margin-bottom: 5px"><b>Nama </b> :<?php echo $nama  ?> </p>
                <p style="margin-bottom: 5px"><b>No. RM</b>:<?php echo $norm  ?>  </p>
                <p style="margin-bottom: 5px"><b>Tgl.Lahir </b>: <?php  echo $tgllahir ?>  </p>
                 <p style="margin-bottom: 5px"><b>Alamat </b>: <?php echo $alamat  ?></p>
              </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
              <table class="table table-bordered">
                <tr>
                  <td colspan="2" class="text-center">
                    <strong>RESUME PASIEN RAWAT JALAN</strong><br>
                    <strong style="font-style:italic;">(Outpatient Medical Resume)</strong>
                  </td>
                </tr>
                <tr>
                  <th>DOKTER <br>
                  <span style="font-style: italic;">Doctor :</span> <?php echo $dpjp ?> </th>
                  <th>Tanggal dirawat<br>
  <span style="font-style: italic;">Date :</span>

                    <?php echo $tglpriksa  ?> </th>
                </tr>
                <tr>
                  <th colspan="2">Poliklinik 
<br>
  <span style="font-style: italic;">Polyclinic :</span>
                   <?php echo $poli   ?></th>
                </tr>
                <tr>
                  <th colspan="2" class="text-center">ALASAN MASUK KLINIK
<br> <strong style="font-style:italic;">(reason for entering the clinic)</strong>
                  </th>

                </tr>
                <tr>
                  <td colspan="2">
                    <p><strong>Masalah waktu masuk</strong><br>
                      <span style="font-style:italic;">Problem</span>

                    </p>
                  
<?php echo $subjek ?>
                  </td>
                </tr>
                <tr>
                  <th class="text-center" colspan="2">TEMUAN FISIK<br>
                    <span style="font-style:italic;">physical findings</span>
                  </th>
                </tr>
                <tr>
                  <td colspan="2">
                    <strong>Tanda Vital </strong><br>
                     <span style="font-style:italic;">vitals signs :</span>
                    <p>
                      <span style="padding-right: 15px"><strong>Sistole </strong>: <?php echo $td  ?> /mmHg </span>
                       <span style="padding-right: 15px"><strong>Distole </strong>: <?php echo $tdd  ?> /mmHg </span>
                      <span style="padding-right: 15px"><strong>Kesadaran </strong>: <?php echo $kesadaran?> </span>
                       <span style="padding-right: 15px"><strong>TB </strong>: <?php echo $tb   ?> cm </span> 
                      <span style="padding-right: 15px"><strong>BB :</strong> <?php echo $bb  ?> Kg </span> 
                      <span style="padding-right: 15px"><strong>Suhu :</strong> <?php  echo $suhu ?> C </span> 
                      <span style="padding-right: 15px"><strong>RR </strong>:  <?php echo $rr  ?> x/menit</span>  
                      <span style="padding-right: 15px"><strong>SPO </strong>: <?php echo $spo   ?>% </span> 
                     <span style="padding-right: 15px"><strong>Heart Rate </strong>: <?php echo $hr   ?>x/menit </span> 
                      
                    </p>

                    <strong>Pemeriksaan Fisik </strong><br>
<span style="font-style:italic;">physical examination :</span>

                    <p> <?php  echo $pf ?></p>

                  
                    
                     <img style="width:20%" src="../transaksi/gmb/<?php echo $url ?>">
                   
                  </td>
                
                </tr>
                  <tr>
                      <td colspan="2">
                          <strong>Riwayat Penyakit </strong><br>
                          <span style="font-style:italic;">disease history :</span>

                           <p> <?php  echo $rwytp ?></p>



                      </td>
                  </tr>

                    <!--    <tr>
                      <td colspan="2">
                          <strong>Gigi Yang di Rawat </strong><br>
                          <span style="font-style:italic;">treated teeth :</span>

                           <p> <?php  echo $gigi ?></p>



                      </td>
                  </tr>
 -->


                <tr>
                  <th class="text-center" colspan="2">PROSEDUR DIAGNOSTIK DAN TERAPI<br>
                    <span style="font-style:italic;">Diagnostic Procedures and Therapy</span>

                  </th>
                </tr>
                <tr>
                  <td colspan="2">
                    <strong>Diagnosis </strong><br>
                    <span style="font-style:italic;">diagnosis :</span>

                    <?php

$queryl="SELECT * from ermcpptdiagnosa where norm='$norm' and notrans='$notrans' and kdcabang='$kdcabang' and status='diagnosa'";
                    $resultl=mysqli_query($conn, $queryl);
                  while($row=mysqli_fetch_array($resultl,MYSQLI_ASSOC)) {


                    echo "<p style='margin-left: 15px'>
                         ".$row['kddiagnosa'].'|'.$row['diagnosa']."                  
                    </p>";
                
                  }



                    ?>
                   
                      <br>

                    <strong>Tindakan </strong><br>
                      <span style="font-style:italic;">medical treatment :</span>
                        <?php

$queryl="SELECT * from ermcpptdiagnosa where norm='$norm' and notrans='$notrans' and kdcabang='$kdcabang'  and status='tindakan'";
                    $resultl=mysqli_query($conn, $queryl);
                  while($row=mysqli_fetch_array($resultl,MYSQLI_ASSOC)) {


                    echo "<p style='margin-left: 15px'>
                         ".$row['kddiagnosa'].'|'.$row['diagnosa']."                  
                    </p>";
                
                  }
                  ?>
                  </td>
                </tr>
                <tr>
                  <th class="text-center" colspan="2">MEDIKAMENTOSA<br>
                          <span style="font-style:italic;">Medikamentosa</span>

                  </th>
                </tr>
                <tr>
                  <td colspan="2">
                    <strong>Obat:</strong><br>
                    <p>
                      <?php  

$query="SELECT a.* ,
    CONCAT(
        COALESCE(a.frekuensi, ''), ' x', 
        COALESCE(a.jmlpakai, ''), ' ', 
        COALESCE(a.signa, '')
    ) AS aturan FROM ermcpptintruksi a 
WHERE a.notransaksi='$notrans' 
AND a.kdcabang='$kdcabang'AND a.dari='obat'AND 
a.dari2='CPPT'AND a.statuso='Non Racik'order BY a.tgl asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {


                    echo "
                    <p>
                       ".$row['nama']." -  ".$row['frekuensi']." x ".$row['jmlpakai']." ".$row['signa']."
                    </p>
                 ";
                }


                       ?>


                    </p>
                    
               
                    
                  </td>
                </tr>
                
                
            <?php

             $queryx="SELECT  DISTINCT kd,kdpruduk,nama,aturan,qty,keterangan
FROM ermcpptintruksi WHERE 
notransaksi='$notrans' AND kdcabang='$kdcabang' AND dari='MObat'  and statuso='MRacik' AND dari2='CPPT'
order BY  tgl asc";


                    $resultx=mysqli_query($conn, $queryx);
                  while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {
                    $kd = $rowx["kd"];
   ?>





         

     <tr>
    <th><?php echo $rowx['kdpruduk']  ?> : <?php echo $rowx['aturan']  ?> 
    <?php echo $rowx['qty']  ?> <?php echo $rowx['nama']  ?><?php echo $rowx['keterangan']  ?> </th>
  
  </tr>



<?php 



$queryxl="SELECT * FROM ermcpptintruksi 
WHERE notransaksi='$notrans' AND kdcabang='$kdcabang' 
AND dari='Obat'  and statuso='Racik' AND dari2='CPPT' and
kd='$kd' order BY  tgl asc ";
                    $resultxl=mysqli_query($conn, $queryxl);
                  while($rowxl=mysqli_fetch_array($resultxl,MYSQLI_ASSOC)) {
$signa = substr($rowxl['signa'], 0, 25);
$frekuensi = $rowxl['frekuensi'];
$jmlpakai = $rowxl['jmlpakai'];

$hasil = $frekuensi.'x'.$jmlpakai.' '.$signa;

         echo "<tr class='details' style='border-bottom: 0.5px solid grey;'>
      
         <td>".$rowxl['nama']." -- ".$rowxl['qty']."-- ".$rowxl['keterangan']."</td>
        
       
   
        </tr>";


}





}?>
  
                <tr>
                  <th class="text-center" colspan="2">INSTRUKSI TINDAK LANJUT<br>

                    <span  style="font-style:italic;">instructions</span>
                  </th>
                </tr>
<tr>

                  <td colspan='2'>
                <?php

$query="SELECT * from ermcpptintruksi where norm='$norm' and notransaksi='$notrans' and kdcabang='$kdcabang'
AND dari<>'obat' and dari<>'mobat'
 order by dari";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {


                    echo "
                    <p>
                       ".$row['nama'].' ('.$row['tgl'].')'."
                    </p>
                 ";
                
                  }


                ?>
               </td>
                </tr>
                 <tr>
                  <th class="text-center" colspan="2">RENCANA TERAPI <br>
  <span  style="font-style:italic;">therapy plan</span>
                  </th>
                </tr>
                <tr>
                  <td colspan="2">
                    <p>
                       <?php echo $planing  ?>
                    </p>
                  </td>
                </tr>

                 <tr>
                  <th class="text-center" colspan="2">RENCANA KONTROL <br>
  <span  style="font-style:italic;">Control plan</span>
                  </th>
                </tr>

   <tr>
                  <td colspan="2">
                    <p>
                      Tanggal :   <?php echo $tglkontrol ?> <br>
                      <?php echo $rencanatindakan ?>
                    </p>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <div class="text-center">
                      <span> <?php echo $tglpriksa ?> </span><br>
                      <br>
                      <br>
                      <br>
                      <b><?php echo $dpjp  ?></b>
                      <br>
                      <span>Doctor</span>
                    </div>
                    <div class="text-center">
                  
                      <p><strong > </strong></p>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
          </div>

        <?php


$queryrj="SELECT * from keteranganrujuk where  notrans='$notrans' and kdcabang='$kdcabang'";
                    $resultrj=mysqli_query($conn, $queryrj);
                  while($rowrj=mysqli_fetch_array($resultrj,MYSQLI_ASSOC)) {



echo "

<div class='col-md-12 col-sm-12 col-xs-12'>
 <div class='table-responsive'>
              <table class='table table-bordered'>
 <tr>
                  <td colspan='2' class='text-center'>
                    <strong>RUJUKAN </strong><br>
                    <strong style='font-style:italic'> REFERRAL FROM CLINIC  </strong>
                  
                  </td>
                </tr>





                    <tr>
                  <td colspan='2'>
                    <strong>Rujukan Untuk </strong><br>
                    <span style='font-style:italic;'> For : ".$rowrj['rujukanuntuk']."</span>

            
                   
                      <br>
                      
                    <strong>Keterangan Rujuk </strong><br>
                      <span style='font-style:italic;'> Note :  ".$rowrj['keteranganrujuk']."</span>
                      
                  <br>
                 <strong>Instansi </strong><br>
                    <span style='font-style:italic;'> Departmen : ".$rowrj['instansi']."</span>

            
                   
                      <br>

<strong>Catatan Medis </strong><br>
                    <span style='font-style:italic;'> medical records :  ".$rowrj['catatan']."</span>


                  </td>
                </tr>

   <tr>
                  <td colspan='2'>
                    <div class='text-center'>
                      <span> ".$tglpriksa." </span><br>
                      <br>
                      <br>
                      <br>
                      <b> ".$dpjp."</b>
                      <br>
                      <span>Doctor</span>
                    </div>
                    <div class='text-center'>
                  
                      <p><strong > </strong></p>
                    </div>
                  </td>
                </tr>



             <table>
</div

</div>";




}?> 



        </div>
     
    <button class="btn btn-primary noprint" onclick="window.print()" style="position: fixed;top: 0; margin: 10px;right: 50px">PRINT</button>
  























  </body>
</html>
<script type="text/javascript" src="Bootstrap/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="Bootstrap/bootstrap.min.js"></script>

<style type="text/css">
.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th{
  padding: 2px 5px;
  font-size: 11px;
}  
@media print
{    
  .noprint{
    display: none !important;
  }
  .marg_2_onprint{
    margin: 2px;
  }
}
</style>