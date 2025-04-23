<html>


 <style>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400&display=swap');
</style>

<style>

/*
th {
    border: 1px solid #dddddd;
    text-align: left;
  font-family: 'Outfit', sans-serif;
}*/

 body {
      font-family: 'Outfit', sans-serif;
        
        text-align: center;
        color: #000000;

      }

</style>


                   <?php
                     include '../koneksi.php';
                     $kdcabang = $_GET['kdcabang'];
                      $norm = $_GET['norm'];
                  $query="SELECT * from cabang where kdcabang='$kdcabang'";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                    $namaklinik=$row['nama'];
                    $alamat=$row['alamat'];
                    $hp=$row['hp'];
                    $url=$row['url'];

                    
                    
                  }

                    $queryx="SELECT * from pasien where kdcabang='$kdcabang' and norm='$norm'";
                    $resultx=mysqli_query($conn, $queryx);
                  while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {
                    $nama =$rowx['pasien'];
                    $norm =$rowx['norm'];
                    $tgllahir =$rowx['tgllahir'];
                    
                    
                    
                    
                  }


                  ?>

 <div  >

<table  style="border:1px solid black;padding: 10px;">
  
  <tr style="font-size:14px;">

    <td  colspan="2" style="border-bottom: 1px solid black;"><b>KARTU PASIEN</b><br>
      <?php echo $namaklinik ?></td>

  
</tr>


  <tr style="font-size:14px;">

    <td  colspan="2"><b>    <?php echo $nama ?>

<br>
  </b>


    </td>

  
</tr>


  <tr style="font-size:14px;">

    <td  colspan="2">
  </b>


    </td>

  
</tr>
  <tr style="font-size:14px;">

    <td  colspan="2">
  


<?php

 include 'phpqrcode/qrlib.php';

    QRcode::png($url.$norm,'qr/'.$norm.'.png','H',2,2);

  echo "<img  src='qr/$norm.png' style='border:0.5px solid grey;border-radius:5px' />" ;

     



?>




    </td>

  
</tr>
  <tr style="font-size:14px;">

    <td  colspan="2">
  </b>


    </td>

  
</tr>
  <tr style="font-size:14px;">

    <td  colspan="2">
  </b>


    </td>

  
</tr>



  <tr style="font-size:14px;">

    <td  colspan="2">Tgl.Lahir :<?php echo $tgllahir ?> </td>

  
</tr>

 <tr style="font-size:14px;">

    <td > Norm :  <?php echo $norm ?></td>

  
</tr>


</table>
 
</div>
 

  
  
  <script type="text/javascript">

  </script>
  </html>

 

 