
<!DOCTYPE html>
<html>
<head>
    <title>ODONTOGRAM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../css/w3.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../js/jquery-ui/jquery-ui.css">
     <link rel="shortcut icon" href="../favicon.ico" />



    <style>
    .w3-theme {color:#fff !important;background-color:#4CAF50 !important;}
    .w3-btn {background-color:#4CAF50 ;margin-bottom:4px;}
    .w3-code{border-left:4px solid #4CAF50}
    @media only screen and (max-width: 601px) {.w3-top{position:static;} #main{margin-top:0px !important}}


    .tbl th.header { 
        background-image: url(../js/table.sorter/themes/blue/bg.gif);
        cursor: pointer; 
        font-weight: bold; 
        background-repeat: no-repeat; 
        background-position: center left; 
        padding-left: 20px; 
        margin-left: -1px; 
    }

    .tbl th.headerSortUp { 
      background-image: url(../js/table.sorter/themes/blue/asc.gif);
      cursor: pointer; 
        font-weight: bold; 
        background-repeat: no-repeat; 
        background-position: center left; 
        padding-left: 20px; 
        margin-left: -1px; 

    } 
    .tbl th.headerSortDown { 
      background-image: url(../js/table.sorter/themes/blue/desc.gif);
      cursor: pointer; 
        font-weight: bold; 
        background-repeat: no-repeat; 
        background-position: center left; 
        padding-left: 20px; 
        margin-left: -1px; 
    } 
    .ui-datepicker {
        font-family: "Trebuchet MS", "Helvetica", "Arial",  "Verdana", "sans-serif";
        font-size: 80.5%;
    }
    .ui-tooltip-content {
        font-size: 80.5%;
    }

    .centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}


.container {
  position: relative;
  text-align: center;
  color: white;
}
input {
    background-color: transparent;
    border: 0px solid;
    height: 20px;
    width: 160px;
   
}

.hitam{
  color:black;
}
.sd{
  font-size: 17px;
}

.kontener{
  width: 100%;
  min-height: 100px;
}


    
    table{
        font-size: 18px;
    }
    tr{
         font-size: 18px;
    }


    </style>
<script src="../js/jquery-1.12.2.min.js"></script>
  
<script src="../js/bootstrap.min.js"></script>
<link href="../css/bootstrap.min.css" rel="stylesheet"/>

<script src="../js/jquery-ui/jquery-ui.min.js"></script>
<script src="../js/perfect-scrollbar.min.js"></script>
<script src="../js/sweetalert2.min.js"></script>
<script src="../js/jquery.number.js"></script>
<script src="../js/table.sorter/jquery.tablesorter.js"></script>
<script src="../js/w3codecolors.js"></script>
<script src="../js/pace.min.js"></script>
   
  <link rel="stylesheet" href="../waktu/css/bootstrap-material-datetimepicker.css" />
  
<script type="text/javascript" src="../waktu/js/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="../waktu/js/bootstrap-material-datetimepicker.js"></script>


  

</head>
</html>

<?php
  include '../../../koneksi.php';

  $kdcabang = $_GET['kdcabang'];
  $notrans = $_GET['notrans'];
$norm = $_GET['norm'];
$kddokter = $_GET['kddokter'];

 $query="SELECT * from cabang where kdcabang='$kdcabang'";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                    $namaklinik=$row['nama'];
                    $alamat=$row['alamat'];
                    $hp=$row['hp'];
                    
                    
                  }


?>

<div style="text-align: center;">
<h4>FORMULIR PEMERIKSAAN ODONTOGRAM</h4>
<span><?php echo $namaklinik ?></span>

</div>

<div style="text-align: left;color:black;border-bottom: 3px solid black;">

<table>
     <?php
$query="SELECT 
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,a.notransaksi,b.pasien,b.tgllahir,c.noantrian,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas
FROM kunjunganpasien a , pasien b,antrian c,poliklinik d, dokter e,kelompokkostumerd f,kelompokkostumer g
WHERE a.norm = b.norm 
AND a.notransaksi = c.notransaksi AND a.kdpoli = d.kdpoli AND a.kddokter = e.kddokter AND
a.kdkostumerd = f.kdkostumerd AND f.kdkostumer = g.kdkostumer AND a.kdcabang='$kdcabang' and a.notransaksi='$notrans'   order by a.kddokter,c.noantrian asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                  
                    ?>

                     No Transaksi : <?php echo $row['notransaksi'] ?></br>
            Nama  : <?php echo $row['pasien'] ?></br>
            Tgl Lahir   : <?php echo $row['tgllahir'] ?></br>
             Alamat : <?php echo $row['alamat'] ?></br>
            Klinik  : <?php echo $row['nampoli'] ?></br>
            Dokter   : <?php echo $row['namdokter'] ?></br>
                  Kostumer   : <?php echo $row['nama'] ?></br>    
                 <?php }


          ?>
          
</table>




</div>



  <div style="padding: 10px;" class="kontener" >

     <table style="width:100%">
         <tr >
            <td style="width:10%;border:1px solid black;">
11[51]
            </td>

            <td style="width:40%;border:1px solid black;">


   <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='11' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>



   <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='51' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>


            </td>
           <td style="width:40%;border:1px solid black;">


  <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='61' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>



   <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='21' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>






            </td>

                       <td style="width:10%;border:1px solid black;">
[61]21
            </td>



         </tr>

            <tr >
            <td style="width:10%;border:1px solid black;">
12[52]
            </td>

            <td style="width:40%;border:1px solid black;">



  <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='12' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>



   <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='52' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>


            </td>
           <td style="width:40%;border:1px solid black;">



  <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='62' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>



   <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='22' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>




            </td>

                       <td style="width:10%;border:1px solid black;">
[62]22
            </td>

         </tr>


         <tr >
            <td style="width:10%;border:1px solid black;">
13[53]
            </td>

            <td style="width:40%;border:1px solid black;">


  <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='13' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>



   <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='53' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }

?>


            </td>
           <td style="width:40%;border:1px solid black;">


              <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='63' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>



   <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='23' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }

?>




            </td>

                       <td style="width:10%;border:1px solid black;">
[63]23
            </td>

         </tr>

 <tr >
            <td style="width:10%;border:1px solid black;">
14[54]
            </td>

            <td style="width:40%;border:1px solid black;">

          <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='14' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>



   <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='54' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }

?>



            </td>
           <td style="width:40%;border:1px solid black;">

               <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='64' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>



   <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='24' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }

?>




            </td>

                       <td style="width:10%;border:1px solid black;">
[64]24
            </td>

         </tr>

 <tr >
            <td style="width:10%;border:1px solid black;">
15[55]
            </td>

            <td style="width:40%;border:1px solid black;">
     <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='15' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>



   <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='55' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }

?>


            </td>
           <td style="width:40%;border:1px solid black;">
  <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='65' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>



   <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='25' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }

?>
            </td>

                       <td style="width:10%;border:1px solid black;">
[65]25
            </td>

         </tr>


 <tr >
            <td style="width:10%;border:1px solid black;">
16
            </td>

            <td style="width:40%;border:1px solid black;">
   <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='16' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>
            </td>
           <td style="width:40%;border:1px solid black;">

            </td>

                       <td style="width:10%;border:1px solid black;">
26
            </td>

         </tr>

 <tr >
            <td style="width:10%;border:1px solid black;">
17
            </td>

            <td style="width:40%;border:1px solid black;">
   <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='17' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>
            </td>
           <td style="width:40%;border:1px solid black;">

            </td>

                       <td style="width:10%;border:1px solid black;">
27
            </td>

         </tr>
 <tr >
            <td style="width:10%;border:1px solid black;">
            18
            </td>

            <td style="width:40%;border:1px solid black;">
        <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='18' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>
            </td>
           <td style="width:40%;border:1px solid black;">

               <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='28' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>



            </td>

                       <td style="width:10%;border:1px solid black;">
28
            </td>

         </tr>
     </table>

<br>
<div style="text-align:center;">









<!-- 
<img src="odonx.png" alt="Workplace" usemap="#workmap" width="662" height="335">




<map name="workmap">

  <area shape="rect" coords="38,64,75,56" alt="Computer" href="#tanggal" data-toggle='modal' fill='red'  >
  
</map>
 -->


<!-- <svg width="500" height="250">
    <defs>
        <clipPath id="circleView">
            <circle cx="250" cy="125" r="125" fill="#FFFFFF" />
        </clipPath>
    </defs>
    <image 
      width="500" 
      height="250" 
      xlink:href="amf.png" 
      clip-path="url(#circleView)"
    />
 </svg>
 -->

<svg height="680" width="1340" style="background: url(odon1.jpg) no-repeat 0 0;border-bottom: 1px solid black" 



onclick="clicked(evt)"

 >


              <?php

                  $query ="SELECT * from odontogram where notrans='$notrans'";
                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                    $x = $row['x'];
                    $y = $row['y'];
                     $kode = $row['kode'];




if($kode === 'fmc'){
echo " <image x='$x' y='$y' width='70' 
     xlink:href='$kode.png' />";
}elseif($kode === 'poc'){

  echo " <image x='$x' y='$y' width='70' 
     xlink:href='$kode.png' />";  



}else{
echo " <image x='$x' y='$y' width='35' 
     xlink:href='$kode.png' />";

}


}?>

 



</svg>













<br>
<br>
  <table style="width:100%">
         <tr >
            <td style="width:10%;border:1px solid black;">
48
            </td>

            <td style="width:40%;border:1px solid black;">
   <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='48' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>
            </td>
           <td style="width:40%;border:1px solid black;">
 <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='38' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>
            </td>

                       <td style="width:10%;border:1px solid black;">
38
            </td>



         </tr>



    <tr >
            <td style="width:10%;border:1px solid black;">
47
            </td>

            <td style="width:40%;border:1px solid black;">
 <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='47' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>
            </td>
           <td style="width:40%;border:1px solid black;">
 <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='37' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>
            </td>

                       <td style="width:10%;border:1px solid black;">
37
            </td>



         </tr>



<tr >
            <td style="width:10%;border:1px solid black;">
46
            </td>

            <td style="width:40%;border:1px solid black;">
 <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='46' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>
            </td>
           <td style="width:40%;border:1px solid black;">
 <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='36' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>
            </td>

                       <td style="width:10%;border:1px solid black;">
36
            </td>



         </tr>



<tr >
            <td style="width:10%;border:1px solid black;">
45[85]
            </td>

            <td style="width:40%;border:1px solid black;">
 <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='45' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>

                   <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='85' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>


            </td>
           <td style="width:40%;border:1px solid black;">
 <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='75' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>

                   <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='35' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>
            </td>

                       <td style="width:10%;border:1px solid black;">
75[35]
            </td>



         </tr>




         <tr >
            <td style="width:10%;border:1px solid black;">
44[84]
            </td>

            <td style="width:40%;border:1px solid black;">
 <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='44' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>

                   <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='84' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>
            </td>
           <td style="width:40%;border:1px solid black;">
 <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='74' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>

                   <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='34' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>
            </td>

                       <td style="width:10%;border:1px solid black;">
74[34]
            </td>



         </tr>





       <tr >
            <td style="width:10%;border:1px solid black;">
43[83]
            </td>

            <td style="width:40%;border:1px solid black;">
 <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='43' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>

                   <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='83' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>
            </td>
           <td style="width:40%;border:1px solid black;">
 <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='73' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>

                   <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='33' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>
            </td>

                       <td style="width:10%;border:1px solid black;">
73[33]
            </td>



         </tr>








       <tr >
            <td style="width:10%;border:1px solid black;">
42[82]
            </td>

            <td style="width:40%;border:1px solid black;">
 <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='42' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>

                   <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='82' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>
            </td>
           <td style="width:40%;border:1px solid black;">
 <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='72' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>

                   <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='32' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>
            </td>

                       <td style="width:10%;border:1px solid black;">
72[32]
            </td>



         </tr>


       <tr >
            <td style="width:10%;border:1px solid black;">
41[81]
            </td>

            <td style="width:40%;border:1px solid black;">
 <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='41' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>

                   <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='81' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>
            </td>
           <td style="width:40%;border:1px solid black;">
             <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='71' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>

                   <?php

                  $query ="SELECT * from odontogram where notrans='$notrans' and nomor='31' order by tgl asc limit 1";

                  $result=mysqli_query($conn, $query);
                  
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    echo $row['keterangan'];

                  }


                  ?>


            </td>

                       <td style="width:10%;border:1px solid black;">
71[31]
            </td>



         </tr>




     </table>





</div>


<!-- <b>Occlusi : </b>  <br>

<b>Torus Palatinus : </b>  <br>
<b>Torus Mandibularis : </b>  <br>
<b>Palatum : </b>  <br>
<b>Diastema : </b>  <br>
<b>Gigi Anomali : </b>  <br>
<b>Lain - Lain : </b>  <br>
<b>D :     M:        F:            </b>  <br>

<p>Jumlah photo yang di ambil </p>
<p>Jumlah rontgen photo yang di ambil </p> -->
</div>
   
<!-- <ul class="nav nav-tabs" >
  <li class="active"><a    href="#gigi" data-toggle="tab">PERMUKAAN GIGI</a></li>
  <li ><a   href="#ke" data-toggle="tab">KEADAAN GIGI</a></li>
  <li><a href="#br" data-toggle="tab">BAHAN RESTORASI</a></li>
  <li><a href="#rs" data-toggle="tab">RESTORASI</a></li>
</ul>
<div class="panel-body" >



 <div class="tab-content">
<div  class="tab-pane fade in active"  id="gigi" >
<table>
    <tr>
        <td>
        M
        </td>
         <td>
Mesial
        </td>
          <td >
<button type='submit' name='simpan' class='btn w3-green'>P</button>
        </td>
    </tr>

      <tr>
        <td>
        O
        </td>
         <td>
Occlusal
        </td>
          <td >
<button type='submit' name='simpan' class='btn w3-green'>P</button>
        </td>
    </tr>


 <tr>
        <td>
        D
        </td>
         <td>
Distal
        </td>
          <td >
<button type='submit' name='simpan' class='btn w3-green'>P</button>
        </td>
    </tr>
<tr>
        <td>
        V
        </td>
         <td>
Vestibular/Bukal/Labial
        </td>
          <td >
<button type='submit' name='simpan' class='btn w3-green'>P</button>
        </td>
    </tr>
</table>
 </div>
 <div  class="tab-pane fade" id="ke">
dddd
sadsd
 </div>
  <div  class="tab-pane fade" id="br">
dddd
sadsd
 </div>

  <div  class="tab-pane fade" id="rs">
dddd
sadsd
 </div>
 </div>
</div> -->
<div class="modal fade" id="hapuslembar" role="hapuslembar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     
                    <h5 class="modal-title w3-pink">HAPUS LEMBAR</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>

<div class="modal fade" id="tandavital" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     
                    <h5 class="modal-title w3-pink">Input Tanda Vital</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>


<div class="modal fade" id="tanggal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     
                    <h5 class="modal-title w3-pink">Status</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>








  <script type="text/javascript">
   function clicked(evt){
        var e = evt.target;
        var dim = e.getBoundingClientRect();
        var x = evt.clientX - dim.left;
        var y = evt.clientY - dim.top;
   



$('#tanggal').modal(



             $.ajax({
                type : 'post',
                url : 'pilihan.php',
              
                   data :  'x='+x+'&'+'y='+y+'&'+'notrans=<?php echo $notrans ?>'+'&'+'norm=<?php echo $norm ?>',
            
                success : function(data){
                $('.modal-data').html(data);
                   

             
                }
            })




    );




      
    }      





</script>


 
    

     

<script>

</script>

</body>

 <button class="btn btn-primary noprint" onclick="window.print()" style="position: fixed;top: 0; margin: 10px;right: 50px">PRINT</button>
  



</html>