
<!DOCTYPE html>
<html>
<head>
    <title>TTV</title>
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


/*td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}*/



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
$notrans  = $_GET['notrans'];
$norm     = $_GET['norm'];
$nolembar = $_GET['nolembar'];
$kduser   = $_GET['kduser'];

include '../../config.php';

if (empty($notrans) || empty($nolembar)) 
{
  echo 'Anda Belum Menambah Lembar atau memilih lembar';
  exit();
}



// echo $nolembar;

?>


<div style="text-align: center;">
<h4>GRAFIK TANDA TANDA VITAL</h4>

<?php
 $sql = "SELECT    *
FROM            ERMEWSNOLEMBAR
WHERE        (notrans = '$notrans') AND (status = 'TTV')
 ORDER BY tanggal desc";
$result = sqlsrv_query( $conn, $sql );



  $nomor = 0;
    $angka = 0;
 while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
 { 

$nomor++;
  $angka++;



if($angka == 1){
  $lembar='Hari Ke 1 - 6';
}else if ($angka == 2){
$lembar='Hari Ke 7 - 12';
}else if ($angka == 3){
$lembar='Hari Ke 13 - 18';  
}





}


$sqlx = "SELECT    *
FROM     PASIEN  WHERE        (KD_PASIEN = '$norm')";
$resultx = sqlsrv_query( $conn, $sqlx );



 
 while($rowx = sqlsrv_fetch_array($resultx, SQLSRV_FETCH_ASSOC))
 { 


$nama = $rowx['NAMAPASIEN'];
$tgllahir = date_format($rowx['TGL_LAHIR'],'Y-m-d');




}



?>


</div>

<div style="text-align: left;">


      <div class="col-md-5 col-md-offset-3 col-sm-5 col-sm-offset-3 col-xs-5 col-xs-offset-3" style="font-size: 11px">
   <div style="border: 1px solid #000; border-radius: 10px;padding: 5px; margin-bottom: 5px">
  
          <p style="margin-bottom: 5px"><b>Nama </b>: <?php echo $nama?></p>
          <p style="margin-bottom: 5px"><b>No. RM </b>: <?php echo $norm?></p>
          <p style="margin-bottom: 5px"><b>Tgl.Lahir </b>: <?php echo $tgllahir?></p>
             <p style="margin-bottom: 5px"><b>Konsulen </b>:

<?php
$sqlx = "SELECT   distinct kddokter,namadok
FROM     EDOCDPJPDOKTER  WHERE        (notrans  = '$notrans') and statushapus='0'";
$resultx = sqlsrv_query( $conn, $sqlx );



 
 while($rowx = sqlsrv_fetch_array($resultx, SQLSRV_FETCH_ASSOC))
 { 

echo $rowx['namadok']."|";



}



?>

              </p>
               <p style="color:red" onclick="window.open('http://192.168.2.189:8049/ermkopi/ttv/ttv/ttvprint.php?notrans=<?php echo $notrans ?>&nolembar=<?php echo $nolembar ?>&norm=<?php echo $norm ?>&kduser=<?php echo $kduser ?>', 'Popup', 'height=+w, width=+h, status=no, toolbar=no, menubar=no, location=no')">PRINT</p>



        </div>


  </div>
</div>



<div class="kontener" 
  ">




<svg height="531" width="1059" style="background: url(atass.jpg) no-repeat 0 0;" >
<!-- tanggal -->


<?php  
for ($x = 250; $x <= 1000; $x+=150) {

  echo "<text x='$x' y='20' fill='red' style='font-size: 11px;font-style: bold'>

<a data-x='$x' data-y='20' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar' data-kduser='$kduser'
     data-toggle='modal' fill='transparent' data-target='#tanggal' >20XXXXXXccc</a>

  </text>";

}
?>


<?php  
for ($x = 250; $x <= 1000; $x+=150) {

  echo "<text x='$x' y='40' fill='red' style='font-size: 11px;font-style: bold'>

<a data-x='$x' data-y='40' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar'
     data-toggle='modal' fill='white' data-target='#tanggal' >20XXXXXXccc</a>

  </text>";

}
?>



<?php  
for ($x = 250; $x <= 1000; $x+=150) {

  echo "<text x='$x' y='60' fill='red' style='font-size: 11px;font-style: bold'>

<a data-x='$x' data-y='60' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar'
     data-toggle='modal' fill='white' data-target='#tanggal' >20XXXXXXccc</a>

  </text>";

}





?>



<?php


$sqls = "SELECT * FROM  ERMTTVTGL where  notrans='$notrans' and nolembar='$nolembar' order by tanggal";
 $stmts = sqlsrv_query( $conn, $sqls );
while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {



echo "<text x='".$rows['tglx']."' y='".$rows['tgly']."' fill='black' style='font-size: 11px;font-style: bold'>



<a data-x='".$rows['tglx']."' data-y='".$rows['tgly']."' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar' data-kduser='$kduser'
     data-toggle='modal' fill='black' data-target='#tanggal' >".$rows['tanggal']."</a>




</text>";

echo "<text x='".$rows['harix']."' y='".$rows['hariy']."' fill='black' style='font-size: 11px;font-style: bold'>".$rows['harike']."</text>";

echo "<text x='".$rows['bbx']."' y='".$rows['bby']."' fill='black' style='font-size: 11px;font-style: bold'>




<a data-x='".$rows['bbx']."' data-y='".$rows['bby']."' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar' data-kduser='$kduser'
     data-toggle='modal' fill='black' data-target='#tanggal' >".$rows['bb']."</a>


</text>";

}


?>



<text x='20' y='100' fill='red' style='font-size: 11px;font-style: bold'>

Nadi : Merah

  </text>
  <text x='20' y='115' fill='black' style='font-size: 11px;font-style: bold'>

Suhu  : Hitam

  </text>
    <text x='20' y='130' fill='blue' style='font-size: 11px;font-style: bold'>

Resp  : Biru

  </text>


<!-- setiap kekkanana satu kotak 36 -->



<?php  
for ($x = 193; $x <= 1058; $x+=36) {

  echo "<text x='$x' y='80' fill='red' style='font-size: 11px;font-style: bold'>

<a data-x='$x' data-y='80' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar' data-kduser='$kduser'
     data-toggle='modal' fill='transparent' data-target='#suhu' >$x xx</a>


  </text>";

}






for ($x = 193; $x <= 1058; $x+=36) {

  echo "<text x='$x' y='110' fill='transparent' style='font-size: 11px;font-style: bold'>

<a data-x='$x' data-y='110' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar' data-kduser='$kduser'
     data-toggle='modal' fill='transparent' data-target='#operasi' >$x xx</a>


  </text>";

}


for ($x = 193; $x <= 1058; $x+=36) {

  echo "<text x='$x' y='160' fill='transparent' style='font-size: 11px;font-style: bold'>

<a data-x='$x' data-y='160' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar' data-kduser='$kduser'
     data-toggle='modal' fill='transparent' data-target='#operasi' >$x</a>


  </text>";

}











?>

 



<?php 

$sqls = "SELECT * FROM  ERMTTVVITAL where  notrans='$notrans' and nolembar='$nolembar' order by suhux";
 $stmts = sqlsrv_query( $conn, $sqls );
while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {


$tsuhu=$rows['suhux']+5;

// suhu
echo "<circle cx='".$rows['suhux']."' cy='".$rows['suhuy']."' r='4'   fill='black' />";
  echo "<text x='".$tsuhu."' y='".$rows['suhuy']."' fill='black' style='font-size: 12px;'>".$rows['suhu']."</text>";




$tnadi=$rows['nadix']+5;


// nadi
  echo "<circle cx='".$rows['nadix']."' cy='".$rows['nadiy']."' r='4'   fill='red' />";
  echo "<text x='".$tnadi."' y='".$rows['nadiy']."' fill='red' style='font-size: 12px;'>".$rows['nadi']."</text>";


$tresp=$rows['respx']+5;


// resp
  echo "<circle cx='".$rows['respx']."' cy='".$rows['respy']."' r='4'   fill='blue' />";
  echo "<text x='".$tresp."' y='".$rows['respy']."' fill='blue' style='font-size: 12px;'>".$rows['resp']."</text>";


}


?>


   <polyline points=




  "<?php



$sqls = "SELECT * FROM  ERMTTVOPERASI where  notrans='$notrans' and nolembar='$nolembar' and status='TITIKATAS'";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {


$xf=$rows['x'];
$yf=$rows['y'];
$xf1=$rows['x1']+36;
$yf1=$rows['y1'];


$polidjj=$xf.','.$yf.' '.$xf1.','.$yf1.' ';


echo $polidjj;

}


?>" 


  style="fill:none;stroke:red;stroke-width:3" />



   <polyline points=




  "<?php



$sqls = "SELECT * FROM  ERMTTVOPERASI where  notrans='$notrans' and nolembar='$nolembar' and status='TITIKBAWAH'";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {


$xf=$rows['x'];
$yf=$rows['y'];
$xf1=$rows['x1']+36;
$yf1=$rows['y1'];


$polidjj=$xf.','.$yf.' '.$xf1.','.$yf1.' ';


echo $polidjj;

}


?>" 


  style="fill:none;stroke:red;stroke-width:3" />





 <polyline points=




  "<?php



$sqls = "SELECT * FROM  ERMTTVVITAL where  notrans='$notrans' and nolembar='$nolembar' order by suhux ";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {


$xf=$rows['suhux'];
$yf=$rows['suhuy'];


$polidjj=$xf.','.$yf.' ';


echo $polidjj;

}


?>" 


  style="fill:none;stroke:black;stroke-width:1" />

 <polyline points=




  "<?php



$sqls = "SELECT * FROM  ERMTTVVITAL where  notrans='$notrans' and nolembar='$nolembar' order by suhux ";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {


$xf=$rows['nadix'];
$yf=$rows['nadiy'];


$polidjj=$xf.','.$yf.' ';


echo $polidjj;

}


?>"style="fill:none;stroke:red;stroke-width:1" />




 <polyline points=




  "<?php



$sqls = "SELECT * FROM  ERMTTVVITAL where  notrans='$notrans' and nolembar='$nolembar' order by suhux ";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {


$xf=$rows['respx'];
$yf=$rows['respy'];


$polidjj=$xf.','.$yf.' ';


echo $polidjj;

}


?>"style="fill:none;stroke:blue;stroke-width:1" />






</svg>


</div>

 
  


<div class="kontener">

  <svg height="21" width="1058" style="background: url(gcsxxx.jpg) no-repeat 0 0;" >



 <?php 

$a=0;
for($x=193;$x <=1044;$x+=36){
$a++;

  echo "<text x='$x' y='15' fill='black' style='font-size: 12px;'>


<a data-x='$x' data-y='$a' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar' data-kduser='$kduser'
     data-toggle='modal' fill='transparent' data-target='#transfusi' >xxxx</a>

  </text>";

}

$sqls = "SELECT top 1 * FROM  ERMTTVOBAT where  notrans='$notrans' and nolembar='$nolembar' and status='transfusi' order by tanggal desc";
 $stmts = sqlsrv_query( $conn, $sqls );
while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {

echo "<rect x='195' y='3' width=".$rows['obaty']." height='30'  style='fill:red'/>";

}
?> 


</svg>

<svg height="93" width="1058" style="background: url(gcs.jpg) no-repeat 0 0;" >


<?php 

$sqls = "SELECT * FROM  ERMTTVVITAL where  notrans='$notrans' and nolembar='$nolembar' order by suhux";
 $stmts = sqlsrv_query( $conn, $sqls );
while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {




// sistole
  echo "<text x='".$rows['tdsx']."' y='".$rows['tdsy']."' fill='black' style='font-size: 12px;'>".$rows['tds']."</text>";

// distole

echo "<text x='".$rows['tddx']."' y='".$rows['tddy']."' fill='black' style='font-size: 12px;'>".$rows['tdd']."</text>";



// E

echo "<text x='".$rows['ex']."' y='".$rows['ey']."' fill='black' style='font-size: 12px;'>".$rows['e']."</text>";



// m

echo "<text x='".$rows['mx']."' y='".$rows['my']."' fill='black' style='font-size: 12px;'>".$rows['m']."</text>";



// v

echo "<text x='".$rows['vx']."' y='".$rows['vy']."' fill='black' style='font-size: 12px;'>".$rows['v']."</text>";



}
?>



</svg>

</div>


<div class="kontener" 
  ">


<svg height="128" width="1058" style="background: url(spom.jpg) no-repeat 0 0;" >



<?php 

$sqls = "SELECT * FROM  ERMTTVVITALD where  notrans='$notrans' and nolembar='$nolembar' order by spox";
 $stmts = sqlsrv_query( $conn, $sqls );
while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {




// spo
  echo "<text x='".$rows['spox']."' y='".$rows['spoy']."' fill='black' style='font-size: 12px;'>".$rows['spo']."</text>";



// spo
  echo "<text x='".$rows['balancex']."' y='".$rows['balancey']."' fill='black' style='font-size: 12px;'>".$rows['balance']."</text>";





// spo
  echo "<text x='".$rows['inputx']."' y='".$rows['inputy']."' fill='black' style='font-size: 12px;'>".$rows['input']."</text>";

// spo
  echo "<text x='".$rows['outputx']."' y='".$rows['outputy']."' fill='black' style='font-size: 12px;'>".$rows['output']."</text>";



// spo
  echo "<text x='".$rows['urinex']."' y='".$rows['uriney']."' fill='black' style='font-size: 12px;'>".$rows['urine']."</text>";




  // spo
  echo "<text x='".$rows['muntahx']."' y='".$rows['muntahy']."' fill='black' style='font-size: 12px;'>".$rows['muntah']."</text>";



  // spo
  echo "<text x='".$rows['defeksix']."' y='".$rows['defeksiy']."' fill='black' style='font-size: 12px;'>".$rows['defeksi']."</text>";

}



?>








</svg>

</div>


<div class="kontener" 
  ">
 

<svg height="415" width="1058" style="background: url(terapi.jpg) no-repeat 0 0;" >

<?php  
for ($y = 34; $y <= 415; $y+=15) {
  echo "<text x='10' y='$y' fill='transparent' style='font-size: 10px;font-style: bold'>

<a data-x='10' data-y='$y' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar' data-kduser='$kduser'
     data-toggle='modal' fill='transparent' data-target='#obat' >Adrenalin / Epinefrin Injeksi 1 mxxxxg</a>


  </text>";
}
?>


<?php 

$sqls = "SELECT * FROM  ERMTTVOBAT where  notrans='$notrans' and nolembar='$nolembar' and status='obat' order by obaty";
 $stmts = sqlsrv_query( $conn, $sqls );
while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {


if ($rows['jenisobat'] === 'Injeksi'){
  echo "<text x='".$rows['obatx']."' y='".$rows['obaty']."' fill='red' style='font-size: 11px;font-style: bold'>".$rows['obat']."</text>";

}else if ($rows['jenisobat'] === 'Non Injeksi'){
  echo "<text x='".$rows['obatx']."' y='".$rows['obaty']."' fill='black' style='font-size: 11px;font-style: bold'>".$rows['obat']."</text>";
}else{

}





}

?>



<?php 

$sqls = "SELECT * FROM  ERMTTVOBAT where  notrans='$notrans' and nolembar='$nolembar' and status='Signa' order by obaty";
 $stmts = sqlsrv_query( $conn, $sqls );
while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {


$geserx=$rows['obatx']+10;

if ($rows['jenisobat'] === 'Injeksi'){
  echo "<text x='".$geserx."' y='".$rows['obaty']."' fill='red' style='font-size: 12px;font-style: bold'>".$rows['obat']."</text>";

}else if ($rows['jenisobat'] === 'Non Injeksi'){
  echo "<text x='".$geserx."' y='".$rows['obaty']."' fill='black' style='font-size: 12px;font-style: bold'>".$rows['obat']."</text>";
}else{

}





}

?>


<?php  
for ($y = 34; $y <= 415; $y+=15) {

 echo "<text x='193' y='$y' fill='transparent' style='font-size: 10px;font-style: bold'>

<a data-x='193' data-y='$y' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar' data-kduser='$kduser'
     data-toggle='modal' fill='transparent' data-target='#signa' >Kolom1xxxxxxxxxxxxxxxxxx</a>


  </text>";


}
?>

<?php  
for ($y = 34; $y <= 415; $y+=15) {
 echo "<text x='337' y='$y' fill='transparent' style='font-size: 10px;font-style: bold'>

<a data-x='337' data-y='$y' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar' data-kduser='$kduser'
     data-toggle='modal' fill='transparent' data-target='#signa' >Kolom1xxxxxxxxxxxxxxxxxx</a>


  </text>";
}
?>


<?php  
for ($y = 34; $y <= 415; $y+=15) {


   echo "<text x='481' y='$y' fill='transparent' style='font-size: 10px;font-style: bold'>

<a data-x='481' data-y='$y' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar' data-kduser='$kduser'
     data-toggle='modal' fill='transparent' data-target='#signa' >Kolom1xxxxxxxxxxxxxxxxxx</a>


  </text>";
}
?>


<?php  
for ($y = 34; $y <= 415; $y+=15) {
 



   echo "<text x='625' y='$y' fill='transparent' style='font-size: 10px;font-style: bold'>

<a data-x='625' data-y='$y' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar' data-kduser='$kduser'
     data-toggle='modal' fill='transparent' data-target='#signa' >Kolom1xxxxxxxxxxxxxxxxxx</a>


  </text>";


}
?>


<?php  
for ($y = 34; $y <= 415; $y+=15) {
 

     echo "<text x='769' y='$y' fill='transparent' style='font-size: 10px;font-style: bold'>

<a data-x='769' data-y='$y' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar' data-kduser='$kduser'
     data-toggle='modal' fill='transparent' data-target='#signa' >Kolom1xxxxxxxxxxxxxxxxxx</a>


  </text>";


}
?>


<?php  
for ($y = 34; $y <= 415; $y+=15) {



       echo "<text x='913' y='$y' fill='transparent' style='font-size: 10px;font-style: bold'>

<a data-x='913' data-y='$y' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar' data-kduser='$kduser'
     data-toggle='modal' fill='transparent' data-target='#signa' >Kolom1xxxxxxxxxxxxxxxxxx</a>


  </text>";


}
?> 

</svg>

</div>



<div class="kontener" 
  ">



<svg height="212" width="1058" style="background: url(diagx.jpg) no-repeat 0 0;" >
  


<?php 

$sqlsd = "SELECT * FROM  ERMTTVDIAG where  notrans='$notrans' and nolembar='$nolembar' ";
 $stmtsd = sqlsrv_query( $conn, $sqlsd );
while( $rowsd = sqlsrv_fetch_array( $stmtsd, SQLSRV_FETCH_ASSOC) ) {



$ttvdiagdata = preg_replace("/[<]/", "< ", $rowsd['ket']);

  echo "<text x='".$rowsd['ketx']."' y='".$rowsd['kety']."' fill='black' style='font-size: 12px;font-style: bold'>".$ttvdiagdata."</text>";






}

?>



<?php  
for ($y = 25; $y <= 212; $y+=14) {

       echo "<text x='49' y='$y' fill='transparent' style='font-size: 10px;font-style: bold'>

<a data-x='49' data-y='$y' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar' data-kduser='$kduser'
     data-toggle='modal' fill='transparent' data-target='#diag' >Kolom1xxxxxxxxxxxxxxxxxx</a>


  </text>";

}
?>


<?php  
for ($y = 25; $y <= 212; $y+=14) {

    echo "<text x='193' y='$y' fill='transparent' style='font-size: 10px;font-style: bold'>

<a data-x='193' data-y='$y' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar' data-kduser='$kduser'
     data-toggle='modal' fill='transparent' data-target='#diag' >Kolom1xxxxxxxxxxxxxxxxxx</a>


  </text>";


}
?>

<?php  
for ($y = 25; $y <= 212; $y+=14) {
  // echo "<text x='337' y='$y' fill='black' style='font-size: 10px;font-style: bold'>Kolom2</text>";

   echo "<text x='337' y='$y' fill='transparent' style='font-size: 10px;font-style: bold'>

<a data-x='337' data-y='$y' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar' data-kduser='$kduser'
     data-toggle='modal' fill='transparent' data-target='#diag' >Kolom1xxxxxxxxxxxxxxxxxx</a>


  </text>";



}
?>


<?php  
for ($y = 25; $y <= 212; $y+=14) {


   echo "<text x='481' y='$y' fill='transparent' style='font-size: 10px;font-style: bold'>

<a data-x='481' data-y='$y' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar' data-kduser='$kduser'
     data-toggle='modal' fill='transparent' data-target='#diag' >Kolom1xxxxxxxxxxxxxxxxxx</a>


  </text>";



}
?>


<?php  
for ($y = 25; $y <= 212; $y+=14) {


    echo "<text x='625' y='$y' fill='transparent' style='font-size: 10px;font-style: bold'>

<a data-x='625' data-y='$y' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar' data-kduser='$kduser'
     data-toggle='modal' fill='transparent' data-target='#diag' >Kolom1xxxxxxxxxxxxxxxxxx</a>


  </text>";


}
?>

<?php  
for ($y = 25; $y <= 212; $y+=14) {




    echo "<text x='769' y='$y' fill='transparent' style='font-size: 10px;font-style: bold'>

<a data-x='769' data-y='$y' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar' data-kduser='$kduser'
     data-toggle='modal' fill='transparent' data-target='#diag' >Kolom1xxxxxxxxxxxxxxxxxx</a>


  </text>";
}
?>


<?php  
for ($y = 25; $y <= 212; $y+=14) {



    echo "<text x='913' y='$y' fill='transparent' style='font-size: 10px;font-style: bold'>

<a data-x='913' data-y='$y' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar' data-kduser='$kduser'
     data-toggle='modal' fill='transparent' data-target='#diag' >Kolom1xxxxxxxxxxxxxxxxxx</a>


  </text>";



}?>

</svg>

</div>

  <div style="text-align: center; ">
<h4>Program Pasien Rawat Inap</h4>




</div>
<div class="kontener" 
  ">

<table>
  <tr style="border-bottom: 1px solid black">
  <th>Tanggal</th>
    <th>Hari Rawat/Operasi</th>
        <th>Dinas</th>
            <th>Keterangan</th>
    <th>Perawat</th>
    <th>Hapus</th>
   
  </tr>
 

<?php 

$sqlsfd = "SELECT a.tanggal, notrans, norm, nolembar, hari, dinas, keterangan, a.username, indek
,b.nama


 FROM  ERMTTVPROPASIEN a
 left join ERMUSER b on b.user_id = a.username
  where  notrans='$notrans' and nolembar='$nolembar' order by tanggal asc";
 $stmtsfd = sqlsrv_query( $conn, $sqlsfd );
while( $rowsfd = sqlsrv_fetch_array( $stmtsfd, SQLSRV_FETCH_ASSOC) ) {

echo "
 <tr style='border-bottom:1px dashed black'>

<td>".date_format($rowsfd['tanggal'],'Y-m-d')."</td>
<td>".$rowsfd['hari']."</td>
<td>".$rowsfd['dinas']."</td>
<td><p>".$rowsfd['keterangan']."</p></td>
<td>".$rowsfd['nama']."</td>
 <td>
<a href='hapusttvtambahanhasil.php?notrans=".$notrans."&norm="
.$norm."&kduser=".$kduser."&nolembar=".$nolembar."&keterangan=".$rowsfd['keterangan']."&indek=".$rowsfd['indek']."' ><p>Hapus</p></a>
</td>

</tr>
";


}


?>



</table>





</div>



  <div style="text-align: center; ">



<?php

echo "<a data-x='913' data-y='200'  data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar' data-kduser='$kduser'
     data-toggle='modal' fill='white' data-target='#propas' ><p>Tambah Program</p></a>";

?>





</div>

<br>
<br>



</div>

<div class="modal fade" id="propas" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     
                    <h5 class="modal-title">Tambah Program Pasien</h5>
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
                     
                    <h5 class="modal-title">Tanggal</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>



<div class="modal fade" id="suhu" role="dialog">
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



<div class="modal fade" id="obat" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     
                    <h5 class="modal-title w3-pink">Nama Obat</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>


<div class="modal fade" id="transfusi" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     
                    <h5 class="modal-title w3-pink">Apakah Transfusi sampai kolom ini</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>
<div class="modal fade" id="diag" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     
                    <h5 class="modal-title w3-pink">Diagnosa dan Penunjang</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>


<div class="modal fade" id="signa" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     
                    <h5 class="modal-title w3-pink">Signa</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>


<div class="modal fade" id="operasi" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     
                    <h5 class="modal-title w3-pink">Operasi</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>


  <script type="text/javascript">

    $('#propas').on('show.bs.modal', function (e) {
           
            var notrans = $(e.relatedTarget).data('notrans');
            var norm = $(e.relatedTarget).data('norm');
var nolembar = $(e.relatedTarget).data('nolembar');

var kduser = $(e.relatedTarget).data('kduser');

       console.log(notrans);
         
            $.ajax({
                type : 'post',
                url : 'propras.php',
               
    data :  'notrans='+notrans+'&'+'norm='+norm+'&'+'nolembar='+nolembar+'&'+'kduser='+kduser,
                success : function(data){
                $('.modal-data').html(data);
             
                }
            });
         });




$('#tanggal').on('show.bs.modal', function (e) {
           
            var notrans = $(e.relatedTarget).data('notrans');
            var norm = $(e.relatedTarget).data('norm');
var nolembar = $(e.relatedTarget).data('nolembar');
var x = $(e.relatedTarget).data('x');
var y = $(e.relatedTarget).data('y');
       console.log(notrans,norm,nolembar,x,y);
       var kduser = $(e.relatedTarget).data('kduser');
         
            $.ajax({
                type : 'post',
                url : 'tgl.php',
               
                 data :  'notrans='+notrans+'&'+'norm='+norm+'&'+'nolembar='+nolembar+'&'+'x='+x+'&'+'y='+y+'&'+'kduser='+kduser,
            
                success : function(data){
                $('.modal-data').html(data);
             
                }
            });
         });



$('#suhu').on('show.bs.modal', function (e) {
           
            var notrans = $(e.relatedTarget).data('notrans');
            var norm = $(e.relatedTarget).data('norm');
var nolembar = $(e.relatedTarget).data('nolembar');
var x = $(e.relatedTarget).data('x');
var y = $(e.relatedTarget).data('y');
var kduser = $(e.relatedTarget).data('kduser');

       console.log(notrans,norm,nolembar,x,y);
         
            $.ajax({
                type : 'post',
                url : 'suhu.php',
               
    data :  'notrans='+notrans+'&'+'norm='+norm+'&'+'nolembar='+nolembar+'&'+'x='+x+'&'+'y='+y+'&'+'kduser='+kduser,
            
                success : function(data){
                $('.modal-data').html(data);
             
                }
            });
         });



$('#transfusi').on('show.bs.modal', function (e) {
           
            var notrans = $(e.relatedTarget).data('notrans');
            var norm = $(e.relatedTarget).data('norm');
var nolembar = $(e.relatedTarget).data('nolembar');
var x = $(e.relatedTarget).data('x');
var y = $(e.relatedTarget).data('y');
var kduser = $(e.relatedTarget).data('kduser');

       console.log(notrans,norm,nolembar,x,y);
         
            $.ajax({
                type : 'post',
                url : 'transfusi.php',
               
    data :  'notrans='+notrans+'&'+'norm='+norm+'&'+'nolembar='+nolembar+'&'+'x='+x+'&'+'y='+y+'&'+'kduser='+kduser,
            
                success : function(data){
                $('.modal-data').html(data);
             
                }
            });
         });









$('#obat').on('show.bs.modal', function (e) {
           
            var notrans = $(e.relatedTarget).data('notrans');
            var norm = $(e.relatedTarget).data('norm');
var nolembar = $(e.relatedTarget).data('nolembar');
var x = $(e.relatedTarget).data('x');
var y = $(e.relatedTarget).data('y');
var kduser = $(e.relatedTarget).data('kduser');

       console.log(notrans,norm,nolembar,x,y);
         
            $.ajax({
                type : 'post',
                url : 'obat.php',
               
                 data :  'notrans='+notrans+'&'+'norm='+norm+'&'+'nolembar='+nolembar+'&'+'x='+x+'&'+'y='+y+'&'+'kduser='+kduser,
            
                success : function(data){
                $('.modal-data').html(data);
             
                }
            });
         });





$('#signa').on('show.bs.modal', function (e) {
           
            var notrans = $(e.relatedTarget).data('notrans');
            var norm = $(e.relatedTarget).data('norm');
var nolembar = $(e.relatedTarget).data('nolembar');
var x = $(e.relatedTarget).data('x');
var y = $(e.relatedTarget).data('y');
       console.log(notrans,norm,nolembar,x,y);
       var kduser = $(e.relatedTarget).data('kduser');


         
            $.ajax({
                type : 'post',
                url : 'signa.php',
               
                 data :  'notrans='+notrans+'&'+'norm='+norm+'&'+'nolembar='+nolembar+'&'+'x='+x+'&'+'y='+y+'&'+'kduser='+kduser,
            
                success : function(data){
                $('.modal-data').html(data);
             
                }
            });
         });




$('#diag').on('show.bs.modal', function (e) {
           
            var notrans = $(e.relatedTarget).data('notrans');
            var norm = $(e.relatedTarget).data('norm');
var nolembar = $(e.relatedTarget).data('nolembar');
var x = $(e.relatedTarget).data('x');
var y = $(e.relatedTarget).data('y');
       console.log(notrans,norm,nolembar,x,y);
       var kduser = $(e.relatedTarget).data('kduser');


         
            $.ajax({
                type : 'post',
                url : 'diag.php',
               
                 data :  'notrans='+notrans+'&'+'norm='+norm+'&'+'nolembar='+nolembar+'&'+'x='+x+'&'+'y='+y+'&'+'kduser='+kduser,
            
                success : function(data){
                $('.modal-data').html(data);
             
                }
            });
         });




$('#operasi').on('show.bs.modal', function (e) {
           
            var notrans = $(e.relatedTarget).data('notrans');
            var norm = $(e.relatedTarget).data('norm');
var nolembar = $(e.relatedTarget).data('nolembar');
var x = $(e.relatedTarget).data('x');
var y = $(e.relatedTarget).data('y');
       console.log(notrans,norm,nolembar,x,y);
       var kduser = $(e.relatedTarget).data('kduser');


         
            $.ajax({
                type : 'post',
                url : 'operasi.php',
               
                 data :  'notrans='+notrans+'&'+'norm='+norm+'&'+'nolembar='+nolembar+'&'+'x='+x+'&'+'y='+y+'&'+'kduser='+kduser,
            
                success : function(data){
                $('.modal-data').html(data);
             
                }
            });
         });



</script>

<script type="text/javascript">
   $('#urine').keyup(function(){



    console.log('urine')




 });


</script>




 
    

     



</body>




</html>