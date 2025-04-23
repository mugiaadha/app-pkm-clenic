<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>
    
     <?php
  include '../koneksi.php';
  include 'terbilang.php';
  $noresep = $_GET['noresep'];
  $kdcabang = $_GET['kdcabang'];
  $username = $_GET['username'];


 date_default_timezone_set( 'Asia/Bangkok' );





$tgl = date("Y-m-d");

  ?>




 <div style="text-align: center;font-size:14px;"><b>KLINIK NABIYA MEDIKA</b><br>
<!--          <span>Ruko Azores Blok B17A No.12,Banjar Wijaya,Tangerang<br>-->
<!--Apoteker: apt.Dewi Rahma Fitri,M.Farm<br>-->

<!--SIPA: 446/Apt.036/SIP.I/DPMPTSP/2023</span>-->
        </div>
     

     <b>FORM PENGKAJIAN RESEP</b><br>
     <span>Nomor:<?php echo $noresep ?></span>
<table style="font-size:14px">
  <tr>
    <th>Kajian</th>
    <th>Status</th>
    <th>Penatalaksanaan</th>
  </tr>
  <tr>
        <tr>
    <th>Persyaratan Administrasi</th>
    <th></th>
    <th></th>
  </tr>
  <tr>
    <td>  <span class='itemtext' >Nama pasien</span><br>
                                  <span class='itemtext' >Alamat pasien</span><br>
                                  <span class='itemtext' >Umur</span><br>
                                  <span class='itemtext' >Berat badan</span><br>
                                 <span class='itemtext' > Jenis kelamin</span><br>
                                  <span class='itemtext' >Nama dokter</span><br>
                                  <span class='itemtext' >Nomor ijin (SIP)</span><br>
                                  <span class='itemtext' >Alamat dokter/no tlf</span><br>
                                  <span class='itemtext' >Paraf/tanda tangan dokter</span><br>
                                  <span class='itemtext' > Tempat dan tanggal penulisan resep</span><br></td>
    <td> <?php 
                                    
                                    $query="SELECT * from kajianresep where noresep='$noresep'";
                                    
                                   
                                    
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                      
                      echo " <span class='itemtext' >".$row['a1a']."</span><br>
                                  <span class='itemtext' >".$row['a2a']."</span><br>
                                  <span class='itemtext' >".$row['a3a']."</span><br>
                                  <span class='itemtext' >".$row['a4a']."</span><br>
                                 <span class='itemtext' > ".$row['a5a']."</span><br>
                                  <span class='itemtext' >".$row['a6a']."</span><br>
                                  <span class='itemtext' >".$row['a7a']."</span><br>
                                  <span class='itemtext' >".$row['a8a']."</span><br>
                                  <span class='itemtext' >".$row['a9a']."</span><br>
                                  <span class='itemtext' > ".$row['a10a']."</span><br>";
                                    
                  }
                                    ?></td>
    <td>                                  
 <?php 
                                    
                                    $query="SELECT * from kajianresep where noresep='$noresep'";
                                    
                                   
                                    
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                      
                      echo " <span class='itemtext' >".$row['ket1a']."</span><br>
                                  <span class='itemtext' >".$row['ket2a']."</span><br>
                                  <span class='itemtext' >".$row['ket3a']."</span><br>
                                  <span class='itemtext' >".$row['ket4a']."</span><br>
                                 <span class='itemtext' > ".$row['ket5a']."</span><br>
                                  <span class='itemtext' >".$row['ket6a']."</span><br>
                                  <span class='itemtext' >".$row['ket7a']."</span><br>
                                  <span class='itemtext' >".$row['ket8a']."</span><br>
                                  <span class='itemtext' >".$row['ket9a']."</span><br>
                                  <span class='itemtext' > ".$row['ket10a']."</span><br>";
                                    
                  }
                                    ?></td>
  </tr>
     <tr>
    <th>Persyaratan Farmasetik</th>
    <th></th>
    <th></th>
  </tr>
  
  <tr>
      <td>  <span class='itemtext' >Nama obat</b><br>
                                  <span class='itemtext' >Bentuk sediaan</span><br>
                                  <span class='itemtext' >Kekuatan sediaan obat</span><br>
                                  <span class='itemtext' >Jumlah obat</span><br>
                                 <span class='itemtext' > Stabilitas dan inkompabilitas</span><br>
                                  <span class='itemtext' >Aturan dan cara penggunaan obat</span><br>
                                 </td>
                                 
                                 
                                  <td> <?php 
                                    
                                    $query="SELECT * from kajianresepb where noresep='$noresep'";
                                    
                                   
                                    
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                      
                      echo " <span class='itemtext' >".$row['z1b']."</span><br>
                                  <span class='itemtext' >".$row['z2b']."</span><br>
                                  <span class='itemtext' >".$row['z3b']."</span><br>
                                  <span class='itemtext' >".$row['z4b']."</span><br>
                                 <span class='itemtext' > ".$row['z5b']."</span><br>
                                  <span class='itemtext' >".$row['z6b']."</span><br>
                               <br>";
                                    
                  }
                                    ?></td>
                                    
                                    
                                       <td> <?php 
                                    
                                    $query="SELECT * from kajianresepb where noresep='$noresep'";
                                    
                                   
                                    
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                      
                      echo " <span class='itemtext' >".$row['ket1b']."</span><br>
                                  <span class='itemtext' >".$row['ket2b']."</span><br>
                                  <span class='itemtext' >".$row['ket3b']."</span><br>
                                  <span class='itemtext' >".$row['ket4b']."</span><br>
                                 <span class='itemtext' > ".$row['ket5b']."</span><br>
                                  <span class='itemtext' >".$row['ket6b']."</span><br>
                               <br>";
                                    
                  }
                                    ?></td>
                                    
                                    
                                    
                                    
                                  
      
  </tr>
  
       <tr>
    <th>Masalah Terkait Obat</th>
    <th></th>
    <th></th>
  </tr>
  
  <tr>
      
      <td>  <span class='itemtext' >Ketidaktepatan seleksi obat</span><br>
                                  <span class='itemtext' >Dosis kurang</span><br>
                                  <span class='itemtext' >Dosis lebih</span><br>
                                  <span class='itemtext' >Duplikasi</span><br>
                                 <span class='itemtext' > Obat tanpa indiksi</span><br>
                                  <span class='itemtext' >Indikasi tidak diobati</span><br>
                                  <span class='itemtext' >Interaksi obat</span><br>
                                  <span class='itemtext' >Reaksi obat merugikan (ROM)</span><br>
                                   <span class='itemtext' >Gagal menerima obat</span><br>
                                 </td>
                                 
                                 
                                  <td> 
                                  
                                  <?php 
                                    
                                    $query="SELECT * from kajianresepc where noresep='$noresep'";
                                    
                                   
                                    
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                      
                      echo " <span class='itemtext' >".$row['z1c']."</span><br>
                                  <span class='itemtext' >".$row['z2c']."</span><br>
                                  <span class='itemtext' >".$row['z3c']."</span><br>
                                  <span class='itemtext' >".$row['z4c']."</span><br>
                                 <span class='itemtext' > ".$row['z5c']."</span><br>
                                  <span class='itemtext' >".$row['z6c']."</span><br>
                                  
                                  <span class='itemtext' >".$row['z7c']."</span><br>
                                  <span class='itemtext' >".$row['z8c']."</span><br>
                                 <span class='itemtext' > ".$row['z9c']."</span><br>
                                  <span class='itemtext' >".$row['z10c']."</span><br>
                                  
                               <br>";
                                    
                  }
                                    ?></td>
                                    
                                    
                                    
                                     <td> 
                                  
                                  <?php 
                                    
                                    $query="SELECT * from kajianresepc where noresep='$noresep'";
                                    
                                   
                                    
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                      
                      echo " <span class='itemtext' >".$row['ket1c']."</span><br>
                                  <span class='itemtext' >".$row['ket2c']."</span><br>
                                  <span class='itemtext' >".$row['ket3c']."</span><br>
                                  <span class='itemtext' >".$row['ket4c']."</span><br>
                                 <span class='itemtext' > ".$row['ket5c']."</span><br>
                                  <span class='itemtext' >".$row['ket6c']."</span><br>
                                  
                                  <span class='itemtext' >".$row['ket7c']."</span><br>
                                  <span class='itemtext' >".$row['ket8c']."</span><br>
                                 <span class='itemtext' > ".$row['ket9c']."</span><br>
                                  <span class='itemtext' >".$row['ket10c']."</span><br>
                                  
                               <br>";
                                    
                  }
                                    ?></td>
                                    
                                    
                                    
                                    
                                 
                                 
      </tr>
      
         <tr>
    <th>Analisis (Jika ditemukan ketidaksesuaian persyaratan)</th>
    <th></th>
    <th></th>
  </tr>
   <tr>
    <td colspan='3'><?php 
                                    
                                    $query="SELECT * from kajianresepc where noresep='$noresep'";
                                    
                                   
                                    
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                      
                      echo "<p>".$row['analis']."</p>";
                      
                                    
                  }
                                    ?></td>
    
  </tr>
  
  
</table>

</body>
 <script type="text/javascript">
 	window.print()
 </script>
</html>

