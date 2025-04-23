<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>SURAT</title>

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
        border: 1px solid black;
     
        font-size: 14px;
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


  <body>

  	    <?php

  	    include '../koneksi.php';

  	    $noRujukan = $_GET['nokunjungan'];

                  $query="SELECT a.*,b.tgllahir,b.jeniskelamin,TIMESTAMPDIFF (YEAR, b.tgllahir, CURDATE()) AS umur
 FROM riwayatkunjungan a,pasien b,kunjunganpasien c
 
  WHERE a.noRujukan = c.nokunjungan AND c.norm = b.norm
  and a.noRujukan='$noRujukan'";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
               
                 		$nmPst=$row['nmPst'];
                     $nokaPst=$row['nokaPst'];
                     $noRujukan=$row['noRujukan'];
                     $tglKunjungan=$row['tglKunjungan'];
                     $tglEstRujuk=$row['tglEstRujuk'];
                     $tglAkhirRujuk=$row['tglAkhirRujuk'];
                     $nmPPK=$row['nmPPK'];
                  
                     $nmPoli=$row['nmPoli'];
                 
                     $kdDiag=$row['kdDiag'];
                     $nmDiag=$row['nmDiag'];
                     $nmPPKa=$row['nmPPKa'];
                
                     $nmDokter=$row['nmDokter'];
                 
                     $nmDati=$row['nmDati'];
                     $nmKR=$row['nmKR'];
                 
                     $pisa=$row['pisa'];
                     $ketpisa=$row['ketpisa'];
                    $umur=$row['umur'];
                    $tgllahir=$row['tgllahir'];
                      $jeniskelamin=$row['jeniskelamin'];
                     $jadwal=$row['jadwal'];
                    
                  }


                  ?>
  
    <div class="invoice-box">
      <table>
        <tr class="top">
          <td colspan="5">
            <table>
              <tr>
                <td class="title">
                 
                 <img src="images.png" width="30%">

                 

                </td>
                


                <td>
                 
                 <b>Kedeputian Wilayah:<b> <?php echo $nmKR ?> <br />
                <b>Kantor Cabang:<b> <?php echo $nmDati ?>  <br />
                 
                </td>
              </tr>
            </table>
          </td>
        </tr>

       


      
      
      </table>
         <div> <b>SURAT RUJUKAN FKTP</b></div>
    <table style="border:1px solid black;">
    	
    	 <tr >

    	 	 <td >
                 
                  <b>No Rujukan:<b> <?php echo $noRujukan ?> 

                </td>
                 <td style="text-align:left" >
                 
              

                </td>
                 <td >
                 
                

                </td>
                

    	 </tr>
    	 <tr >

    	 	 <td >
                 
                  <b>FKTP:<b>   <?php echo $nmPPKa ?> 

                </td>
                 <td >
                 
                

                </td>
                 <td >
                 
                

                </td>
                

    	 </tr>

    	 <tr >

    	 	 <td >
                 
                  <b>Kabupaten/Kota:<b>
<?php echo $nmDati ?> 
                </td>
                 <td >
                 
                

                </td>
                 <td >
                 
                

                </td>
                

    	 </tr>
    </table>




 
 <table >

    	<tr>
    	     <td >
                  <b>Kepada Yth.TS Dokter :</b><br>
                <span>Di:  <?php echo $nmPPK ?> / <?php echo $nmPoli?> </span>
<br>
 <b>Mohon Pemeriksaan dan Penanganan lanjut pasien:</b><br>
<span>Nama : <?php echo $nmPst ?></span> <br>

<span>No Kartu BPJS : <?php echo $nokaPst ?> </span><br>

<span>Diagnosa :</span><br>

  
               <?php 
  
  
  			
  
                         $queryv="SELECT 
b.kddiagnosa,b.diagnosa
FROM kunjunganpasien a , ermcpptdiagnosa b
WHERE a.notransaksi = b.notrans AND a.nokunjungan='$noRujukan'";
            $resultv=mysqli_query($conn, $queryv);
                    $rowcount=mysqli_num_rows($resultv);
                   if($rowcount > 0){
                       while($rowv=mysqli_fetch_array($resultv,MYSQLI_ASSOC)) {
                    
                    echo "-".$rowv['diagnosa']."(".$rowv['kddiagnosa'].")</br>";
                    
                    
                  }
                   }else{
                       echo "-".$nmDiag."(".$kdDiag.")</br>";
                   }
                   
  


  
                
  
  ?>
            

                </td>
                 <td  style="text-align:left">
           <span>Umur : <?php echo $umur ?> </span> <br>

<span>Status :  <?php echo $pisa ?>  </span><br>

<span>Catatan : </span><br>      



                </td>
                
<td  style="text-align:left">
           <span>Tahun : <?php echo $tgllahir ?> </span> <br>

<span>JK : <?php echo $jeniskelamin ?></span><br>

 



                </td>


    	</tr>


<tr>
   <td  colspan="2">
      

   	Telah di berikan :

                </td>

                <td  style="text-align:left">
      
                


                </td>
</tr>
<tr>
   <td  colspan="3">
      

   	Atas Bantuanya,di ucapkan Terima Kasih 

                </td>

             
</tr>


<tr>
   <td  colspan="2">
      
Tgl.Rencana Berkunjung : <?php echo $tglEstRujuk ?> <br>
Jadwal Praktek : <?php echo $jadwal ?> <br>
Surat Rujukan berlaku 1[satu] kali kunjungan,berlaku sampai :<?php echo $tglAkhirRujuk ?> 


                </td>

            <td  >
      	Salam Sejawat , <?php echo $tglKunjungan ?>
<br>
<br>
<br>
<?php echo $nmDokter ?>






                </td>    
</tr>



    	</table>




    </div>
<script type="text/javascript">window.print()</script>

  </body>

</html>
