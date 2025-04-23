
<!DOCTYPE html>
<html>
<head>
    <title>Partograf</title>
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

    table, td {
  border: 1px solid black;
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
<?php 
// $notrans='BV-20-02-0090';
// $norm='20 268319';

$notrans=$_GET['notrans'];
$norm=$_GET['norm'];
$pasien=$_GET['pasien'];
include '../../config.php';

?>

<body >
    <div class="w3-container">
 
<div class="w3-row">
    <div class="w3-col s6 "><b>No Register : <?php echo $notrans; ?></b> <br>
       <b> No RM : <?php echo $norm; ?></b> <br>

        <?php

include '../../config.php';
$sql = "SELECT * FROM  ERMVKPJUDUL where  notrans='$notrans'";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $stmt );
   
if ($row_count <= 0){

$tuban='';
$msj = '';
$msktgl = '';
$mskjam = '';

}else if ($row_count > 0){
while( $rowjudul = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

$tuban=$rowjudul['ketubanpecah'];
$msj = $rowjudul['mulessejak'];
$msktgl = $rowjudul['tanggal'];
$mskjam = $rowjudul['menit'];

}

}

        ?>


       <!--  <input style="color:black;font-weight: bold;" value="<?php echo $tuban ?>" class="input" type="text" id="time" name="tuban"  placeholder="Jam">  -->
    <form  action="svpjudul" method="POST">
        <input  type="hidden" value="<?php echo $notrans?>" name="notrans"  placeholder="Jam">
          <input  type="hidden" value="<?php echo $norm?>" name="norm"  placeholder="Jam">
      <input  type="hidden" value="<?php echo $pasien?>" name="pasien"  placeholder="Jam">

       <b> Ketuban pecah sejak jam : <input style="color:black;font-weight: bold;"  type="text"  name="tuban" value="<?php echo $tuban ?>"   placeholder="Jam:Menit"></b> <b> Mules Sejak Jam</b> <input style="color:black;font-weight: bold;" value="<?php echo $msj ?>" type="text"  name="msj"   placeholder="Jam:Menit">
</div>
   <div class="w3-col s6 "><b>Pasien : <?php echo $pasien; ?> </b><br>
        <b>Masuk Tanggal : </b>  <input style="color:black;font-weight: bold;" name="mtgl" value="<?php echo $msktgl ?>" type="text" placeholder="Tanggal" >

         <input value="<?php echo $mskjam ?>"  style="color:black;font-weight: bold;" type="text"  name="mjam"   placeholder="Jam:Menit">
          <button type="submit" name="simpanjdl">V</button></form><br>

      <?php
      
$sqlx = "SELECT * FROM  ERMVKASKEBRODKS where  notrans='$notrans'";
$paramsx = array();
$optionsx =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmtx = sqlsrv_query( $conn, $sqlx , $paramsx, $optionsx );

$row_countx = sqlsrv_num_rows( $stmtx );
   
if ($row_countx <= 0){

echo "<b>  G P A Hamil:  Minggu </b>";
}else if ($row_countx > 0){
while( $rowjudulx = sqlsrv_fetch_array( $stmtx, SQLSRV_FETCH_ASSOC) ) {

echo "<b>  G:".$rowjudulx['g']." P: ".$rowjudulx['p']." A:".$rowjudulx['a']."  Hamil: ".$rowjudulx['hamil']." Minggu </b>";

}

}
      ?>    
      

</div>

</div>


<div style="padding: 5px;
  display: flex;

  justify-content: center;">

  <a data-x='55'  data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>'  data-pasien='<?php echo $pasien  ?>' data-toggle='modal' fill="white" data-target='#djj'><p class="w3-small">Denyut <br>
    Jantung<br> Janin<br>( X/Menit)
</p></a>

<svg height="242" width="625" style="background: url(denyutfix.jpg) no-repeat 0 0;" >

  <polyline points=




  "<?php



$sqls = "SELECT * FROM  ERMVKPDJJ where  notrans='$notrans' ORDER BY x ";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {


$xf=$rows['x'];
$yf=$rows['y'];


$polidjj=$xf.','.$yf.' ';


echo $polidjj;

}


?>" 


  style="fill:none;stroke:black;stroke-width:3" />



<?php



$sqls = "SELECT * FROM  ERMVKPDJJ where  notrans='$notrans' ORDER BY x ";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {


echo "<circle cx='".$rows['x']."' cy='".$rows['y']."' r='4'   fill='black' />";
echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='red' style='font-size: 12px;font-style: bold'>".$rows['nilai']."</text>";

}
?>





</svg>
</div>


<div style="padding: 3px;
  display: flex;

  justify-content: center;">
 <a   data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>'  data-pasien='<?php echo $pasien  ?>'  data-toggle='modal' fill="white" data-target='#airpen'><p class="w3-small">Air Ketbn<br>
 Penyusup </p></a>
 <div   >
<svg height="41" width="625" style="background: url(airpenfix.jpg) no-repeat 0 0; " >
    <!-- x kanan 19-->
<!-- 55 -->
<!-- air ketuban -->
<?php



$sqls = "SELECT * FROM  ERMVKAIRPEN where  notrans='$notrans' and status='AK' ORDER BY tanggal ";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {

$lineair=$rows['xline']+6;

echo "<text x='".$lineair."' y='15' fill='black' style='font-size: 10px'>".$rows['isi']."</text>";

}
?>


<!-- <text x="61" y="15" fill="black" style="font-size: 10px">A</text> 
<text x="80" y="15" fill="black" style="font-size: 10px">A</text>  -->

<!-- penyusupan -->
<?php



$sqls = "SELECT * FROM  ERMVKAIRPEN where  notrans='$notrans' and status='PENYU' ORDER BY tanggal ";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {

$lineair=$rows['xline']+6;

echo "<text x='".$lineair."' y='35' fill='black' style='font-size: 10px'>".$rows['isi']."</text>";

}
?>



<!-- <text x="61" y="35" fill="black" style="font-size: 10px">1</text>  -->
</svg>
 </div>

</div>



<div style="padding: 3px;
  display: flex;

  justify-content: center;">

 <!--  <p class="w3-tiny">Pembuk <br>aan
    Serviks<br>(CM)Tanda X<br>
    <br>Turunya<br>
Kepala <br>Tanda (O)</p> -->


<p class="w3-small"><a   data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>'  data-pasien='<?php echo $pasien  ?>' data-toggle='modal' fill="white" data-target='#serviks'>Pembukaa <br>
    aan<br> Serviks<br>Tanda X<br><br>
    Turunya<br>Kepala<br>Tanda O</a><br>
    <br>
    <br>
    <br>
    <br>
    <br>
  
    Waktu
</p></a>



<svg height="243" width="625" style="background: url(bukaservik.jpg) no-repeat 0 0;" >
 
<!-- poliserviks -->
  <polyline  points="
 <?php



$sqls = "SELECT * FROM  ERMVKPSERVIKS where  notrans='$notrans' and status='SERVIKS' ORDER BY x ";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {


$xf=$rows['x'];
$yf=$rows['y'];


$polidjj=$xf.','.$yf.' ';


echo $polidjj;

}


?>
 
 "
  style="fill:none;stroke:black;stroke-width:3" />
 
<!-- turun -->
  <polyline  points="
  <?php



$sqls = "SELECT * FROM  ERMVKPSERVIKS where  notrans='$notrans' and status='TURUN' ORDER BY x ";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {


$xf=$rows['x'];
$yf=$rows['y'];


$polidjj=$xf.','.$yf.' ';


echo $polidjj;

}


?>
 
 "
  style="fill:none;stroke:black;stroke-width:3" />

<!-- <text x="50" y="105" fill="red" style="font-size: 10px;font-style: bold">X</text> -->
 <?php



$sqls = "SELECT * FROM  ERMVKPSERVIKS where  notrans='$notrans' and status='TURUN' ORDER BY x";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {

$lineairx=$rows['x']-5;
$lineairy=$rows['y']+5;


echo "<text x='".$lineairx."' y='".$lineairy."' fill='blue' style='font-size: 12px;font-style: bold'>O</text>";

}
?>



<?php



$sqls = "SELECT * FROM  ERMVKPSERVIKS where  notrans='$notrans' and status='SERVIKS' ORDER BY x";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {

$lineairx=$rows['x']-5;
$lineairy=$rows['y']+5;


echo "<text x='".$lineairx."' y='".$lineairy."' fill='red' style='font-size: 12px;font-style: bold'>X</text>";

}
?>





<!-- waktu -->

<text x="17" y="235"  style="font-size: 10px;font-style: bold">
<a data-x='17' data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>'  data-pasien='<?php echo $pasien  ?>'  data-toggle='modal' fill="white" data-target='#buatwaktu' >15.30</a></text>


<text x="55" y="235"  style="font-size: 10px;font-style: bold">
<a data-x='55' data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>'  data-pasien='<?php echo $pasien  ?>' data-toggle='modal' fill="white" data-target='#buatwaktu' >15.30</a></text>


<text x="93" y="235"  style="font-size: 10px;font-style: bold">
<a data-x='93' data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>'  data-pasien='<?php echo $pasien  ?>' data-toggle='modal' fill="white" data-target='#buatwaktu' >15.30</a></text>
<text x="131" y="235"  style="font-size: 10px;font-style: bold">

<a data-x='131' data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>'  data-pasien='<?php echo $pasien  ?>'  data-toggle='modal' fill="white" data-target='#buatwaktu' >15.30</a></text>
<text x="169" y="235"  style="font-size: 10px;font-style: bold">
<a data-x='169'  data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>' data-pasien='<?php echo $pasien  ?>'  data-toggle='modal' fill="white" data-target='#buatwaktu'>15.30</a></text>

<text x="207" y="235"  style="font-size: 10px;font-style: bold">
<a data-x='207' data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>'  data-pasien='<?php echo $pasien  ?>'  data-toggle='modal' fill="white" data-target='#buatwaktu' >15.30</a></text>

<text x="245" y="235"  style="font-size: 10px;font-style: bold">
<a data-x='245' data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>' data-pasien='<?php echo $pasien  ?>'   data-toggle='modal' fill="white" data-target='#buatwaktu' >15.30</a></text>

<text x="283" y="235"  style="font-size: 10px;font-style: bold">
<a data-x='283' data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>'  data-pasien='<?php echo $pasien  ?>' data-toggle='modal' fill="white" data-target='#buatwaktu' >15.30</a></text>

<text x="321" y="235"  style="font-size: 10px;font-style: bold">
<a data-x='321' data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>'  data-pasien='<?php echo $pasien  ?>' data-toggle='modal' fill="white" data-target='#buatwaktu' >15.30</a></text>

<text x="359" y="235"  style="font-size: 10px;font-style: bold">
<a data-x='359' data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>'  data-pasien='<?php echo $pasien  ?>'  data-toggle='modal' fill="white" data-target='#buatwaktu' >15.30</a></text>

<text x="397" y="235"  style="font-size: 10px;font-style: bold">
<a data-x='397' data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>'  data-pasien='<?php echo $pasien  ?>'  data-toggle='modal' fill="white" data-target='#buatwaktu' >15.30</a></text>

<text x="435" y="235"  style="font-size: 10px;font-style: bold">
<a data-x='435' data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>'  data-pasien='<?php echo $pasien  ?>'   data-toggle='modal' fill="white" data-target='#buatwaktu' >15.30</a></text>

<text x="473" y="235"  style="font-size: 10px;font-style: bold">
<a data-x='473'  data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>'  data-pasien='<?php echo $pasien  ?>' data-toggle='modal' fill="white" data-target='#buatwaktu' >15.30</a></text>

<text x="511" y="235"  style="font-size: 10px;font-style: bold">
<a data-x='511' data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>'   data-pasien='<?php echo $pasien  ?>' data-toggle='modal' fill="white" data-target='#buatwaktu' >15.30</a></text>

<text x="549" y="235"  style="font-size: 10px;font-style: bold">
<a data-x='549' data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>'  data-pasien='<?php echo $pasien  ?>' data-toggle='modal' fill="white" data-target='#buatwaktu' >15.30</a></text>

<text x="587" y="235"  style="font-size: 10px;font-style: bold">
<a data-x='587' data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>'  data-pasien='<?php echo $pasien  ?>'  data-toggle='modal' fill="white" data-target='#buatwaktu' >15.30</a></text>



<!-- query waktu -->

<?php



$sqls = "SELECT * FROM  ERMVKPWAKTU where urut='1' and notrans='$notrans'";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {



echo "<text x=".$rows['garisx']." y='235'  style='font-size: 10px;font-style: bold'>
".date_format ($rows['waktu'],'H:i')."</text>";


                                      }

?>

</svg>
</div>


<div style="padding: 5px;
  display: flex;

  justify-content: center;">

<a   data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>'   data-pasien='<?php echo $pasien  ?>' data-toggle='modal' fill="white" data-target='#kontrasiv'>  <p class="w3-small">Kontraksi <br>
    Hitam>40<br>
    Biru<br>20-40<br>
    Merah<br> < 20 <br>
    
    
   </p></a>


<svg height="104" width="625"  style="background: url(kontraksifix.jpg) no-repeat 0 0;" >


<?php



$sqls = "SELECT * FROM  ERMVKPKONTRAKSI where notrans='$notrans'";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {








if($rows['detik'] < 20){
// echo "kurang 20";

echo "<rect x=".$rows['x']." y=".$rows['y']." width='20' height=".$rows['yblok']."  style='fill:red'/> ";

}else if($rows['detik'] >= 20 && $rows['detik'] < 40 ){
echo "<rect x=".$rows['x']." y=".$rows['y']." width='20' height=".$rows['yblok']."  style='fill:blue'/> ";
}else if ($rows['detik'] >= 40){
// echo "lebih 40";
echo "<rect x=".$rows['x']." y=".$rows['y']." width='20' height=".$rows['yblok']."  style='fill:black'/> ";
}else{
  
}

                                      }

?>
<!-- y atas 20 hitam-->






<!-- x kanan 19 -->
<!-- <rect x="74" y="80" width="20" height="20" style="fill:blue"; />
<rect x="93" y="80" width="20" height="20" style="fill:red"; />
<rect x="55" y="0" width="20" height="20" /> -->
</svg>
</div>



<div style="padding: 3px;
  display: flex;

  justify-content: center;">
 <a   data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>'  data-pasien='<?php echo $pasien  ?>'  data-toggle='modal' fill="white" data-target='#oksitosi'><p class="w3-small">OksitosU/I<br>
 Tts/menit </p></a>
 <div   >
<svg height="43" width="625" style="background: url(ketubanfix.jpg) no-repeat 0 0;" >
<!-- <text x="61" y="15" fill="black" style="font-size: 10px">A</text> 

 -->
<?php



$sqls = "SELECT * FROM  ERMVKPOKS where notrans='$notrans' order by tanggal";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {
echo "<text x=".$rows['x']." y='15' fill='black' style='font-size: 10px'>Oxt</text> ";

echo "<text x=".$rows['x']." y='35' fill='black' style='font-size: 10px'>".$rows['nilai']."</text> ";

                                      }
?>
</svg>
 </div>

</div>



<div style="padding: 5px;
  display: flex;

  justify-content: center;">
 <a   data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>'   data-pasien='<?php echo $pasien  ?>'  data-toggle='modal' fill="white" data-target='#obatcairan'><p class="w3-small">Obat &<br>
Cairan IV</p></a>
 <div>
<svg height="75" width="625" style="background: url(obatcairanfixss.jpg) no-repeat 0 0;">
   

   <?php



$sqls = "SELECT * FROM  ERMVKPOBAT where  notrans='$notrans' order by x,y";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {



echo "<text x=".$rows['x']." y=".$rows['y']." fill='black' style='font-size: 10px;font-style: bold'>".$rows['nama']."</text>";


                                      }

?>



</svg>
 </div>

</div>




<div style="
  display: flex;

  justify-content: center;">
 <p class="w3-small"><a   data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>'  data-pasien='<?php echo $pasien  ?>' data-toggle='modal' fill="white" data-target='#nadishow'>Nadi</a><br>
  <br>
  <br>
<a   data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>'   data-pasien='<?php echo $pasien  ?>' data-toggle='modal' fill="white" data-target='#tdshow'>Tekanan <br>Darah</a></p>
 <div   >
<svg height="243" width="625" style="background: url(tdfix.jpg) no-repeat 0 0;" >



 

<!-- nadi -->
<!--  <polyline points="
  55,80
  55,180
  "style="fill:none;stroke:black;stroke-width:2" />
  <circle cx="55" cy="240" r="4"   fill="black" />
<circle cx="55" cy="220" r="4"   fill="black" />
<circle cx="93" cy="160" r="5"   fill="black" /> -->


<!-- td -->



<?php
include '../../config.php';
$sqlds = "SELECT x,notrans FROM  ERMVKPTD where  notrans='BV-20-02-0090' group by x,notrans";
                                      $stmtds = sqlsrv_query( $conn, $sqlds );
                                     

                                      while( $rowds = sqlsrv_fetch_array( $stmtds, SQLSRV_FETCH_ASSOC) ) {



$xtdd=$rowds['x'];


?>


<polyline points="
 <?php



$sqlsds = "SELECT *  FROM  ERMVKPTD where  notrans='$notrans'  and x='$xtdd' order by x ";
                                      $stmtsds = sqlsrv_query( $conn, $sqlsds );
                                     

                                      while( $rowsds = sqlsrv_fetch_array( $stmtsds, SQLSRV_FETCH_ASSOC) ) {


$xfds=$rowsds['x'];
$yfds=$rowsds['y'];


$polidjjds=$xfds.','.$yfds.' ';


echo $polidjjds;

}


?>

"style="fill:none;stroke:black;stroke-width:3" />

<?php } ?>





  <?php






                                      $sqls = "SELECT * FROM  ERMVKPTD where status='ATAS' and  notrans='$notrans'  order by x,y";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {

$xfsn=$rows['x']+4;
$xfs=$rows['x']-4;
$yfs=$rows['y']+7;
echo "<text x=".$xfs." y=".$yfs." fill='black' style='font-size: 13px;font-style: bold'>A</text>";
echo "<text x=".$xfsn." y=".$yfs." fill='red' style='font-size: 12px;font-style: bold'>".$rows['nilai']."</text>";


                                      }



                                      $sqls = "SELECT * FROM  ERMVKPTD where status='BAWAH'and notrans='$notrans'  order by x,y";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {



$xfs=$rows['x']-4;
$yfs=$rows['y'];
$xfsn=$rows['x']+4;
echo "<text x=".$xfs." y=".$yfs." fill='black' style='font-size: 13px;font-style: bold'>V</text>";
echo "<text x=".$xfsn." y=".$yfs." fill='red' style='font-size: 12px;font-style: bold'>".$rows['nilai']."</text>";

                                      }




?>




<?php

$sqls = "SELECT * FROM  ERMVKPNADI where  notrans='$notrans' order by x";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {


$xfsn=$rows['x']+4;

echo "<circle cx=".$rows['x']." cy=".$rows['y']." r='4'   fill='black' />";
echo "<text x=".$xfsn." y=".$rows['y']." fill='red' style='font-size: 12px;font-style: bold'>".$rows['nilai']."</text>";

                                      }


?>


<polyline points="
   <?php



$sqlsds = "SELECT *  FROM  ERMVKPNADI where  notrans='$notrans'  order by x ";
                                      $stmtsds = sqlsrv_query( $conn, $sqlsds );
                                     

                                      while( $rowsds = sqlsrv_fetch_array( $stmtsds, SQLSRV_FETCH_ASSOC) ) {


$xfds=$rowsds['x'];
$yfds=$rowsds['y'];


$polidjjds=$xfds.','.$yfds.' ';


echo $polidjjds;

}


?>"
 style="fill:none;stroke:black;stroke-width:3" />


<!--  <text x="51" y="180" fill="black" style="font-size: 12px;font-style: bold">V</text>
<text x="51" y="80" fill="black" style="font-size: 12px;font-style: bold">A</text>
 -->



<!--   <polyline points="
  55,160
  55,200"
 style="fill:none;stroke:black;stroke-width:2" />



    <polyline points="
    74,160
  74,200"
 style="fill:none;stroke:black;stroke-width:2" /> -->


<!-- <text x="51" y="200" fill="black" style="font-size: 12px;font-style: bold">V</text>
<text x="51" y="160" fill="black" style="font-size: 12px;font-style: bold">A</text>


<text x="70" y="200" fill="black" style="font-size: 12px;font-style: bold">V</text>
<text x="70" y="160" fill="black" style="font-size: 12px;font-style: bold">A</text>

 -->
</svg>
 </div>

</div>


<div style="
  display: flex;

  justify-content: center;">
 <a   data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>'  data-pasien='<?php echo $pasien  ?>' data-toggle='modal' fill="white" data-target='#tempcshow'><p class="w3-small">Temp C</p></a>
 <div   >
<svg height="22" width="625" style="background: url(tempfix.jpg) no-repeat 0 0;" >
<?php



$sqlsds = "SELECT *  FROM  ERMVKPTEMP where  notrans='$notrans'  order by x ";
                                      $stmtsds = sqlsrv_query( $conn, $sqlsds );
                                     

                                      while( $rowsds = sqlsrv_fetch_array( $stmtsds, SQLSRV_FETCH_ASSOC) ) {


if ($rowsds['x'] == '55'){

echo "<text x=".$rowsds['x']." y='12' fill='black' style='font-size: 10px;font-style: bold'>".$rowsds['nilai']." C</text>";
}else {

$xtemp=$rowsds['x'];
echo "<text x=".$xtemp." y='12' fill='black' style='font-size: 10px;font-style: bold'>".$rowsds['nilai']." C</text>";


}




}
?>

<!-- <text x="93" y="12" fill="black" style="font-size: 10px;font-style: bold">36 C</text> -->
</svg>
 </div>

</div>

<div style="
  display: flex;

  justify-content: center;">
  <a   data-notrans='<?php echo $notrans  ?>' data-norm='<?php echo $norm  ?>'  data-pasien='<?php echo $pasien  ?>' data-toggle='modal' fill="white" data-target='#urineshow'><p class="w3-small">Protein<br>
    Aseton<br>
Volume</p></a>
 <div   >
<svg height="62" width="625" style="background: url(urinefix.jpg) no-repeat 0 0;" >

   <?php



$sqlsds = "SELECT *  FROM  ERMVKPURINE where  notrans='$notrans' and status='Protein'  order by x ";
                                      $stmtsds = sqlsrv_query( $conn, $sqlsds );
                                     

                                      while( $rowsds = sqlsrv_fetch_array( $stmtsds, SQLSRV_FETCH_ASSOC) ) {


echo "<text x=".$rowsds['x']." y='12' fill='black' style='font-size: 10px;font-style: bold'>".$rowsds['nilai']."</text>";

}


?>


   <?php



$sqlsds = "SELECT *  FROM  ERMVKPURINE where  notrans='$notrans' and status='Aseston'  order by x ";
                                      $stmtsds = sqlsrv_query( $conn, $sqlsds );
                                     

                                      while( $rowsds = sqlsrv_fetch_array( $stmtsds, SQLSRV_FETCH_ASSOC) ) {


echo "<text x=".$rowsds['x']." y='32' fill='black' style='font-size: 10px;font-style: bold'>".$rowsds['nilai']."</text>";

}


?>


 <?php



$sqlsds = "SELECT *  FROM  ERMVKPURINE where  notrans='$notrans' and status='Volume'  order by x ";
                                      $stmtsds = sqlsrv_query( $conn, $sqlsds );
                                     

                                      while( $rowsds = sqlsrv_fetch_array( $stmtsds, SQLSRV_FETCH_ASSOC) ) {


echo "<text x=".$rowsds['x']." y='52' fill='black' style='font-size: 10px;font-style: bold'>".$rowsds['nilai']."</text>";

}


?>


</svg>
 </div>

</div>


<div style="
  display: flex;

  justify-content: center;">

 <div   >
      <?php


$sql = "SELECT * FROM  ERMVKPBAWAH where  notrans='$notrans'";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $stmt );
   
if ($row_count <= 0){

$jammt='';
$jenismt = '';
$porsimt = '';


$jammit='';
$jenismit = '';
$porsimit = '';

}else if ($row_count > 0){
while( $rowjudul = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

$jammt=$rowjudul['jammakan'];
$jenismt = $rowjudul['jenis'];
$porsimt = $rowjudul['porsi'];


$jammit=$rowjudul['jamminum'];
$jenismit = $rowjudul['jenisminum'];
$porsimit =  $rowjudul['porsiminum'];

}

}

        ?>..
  <form action="svakhir" method="POST">
       <input  type="hidden" value="<?php echo $notrans?>" name="notrans"  placeholder="Jam">
          <input  type="hidden" value="<?php echo $norm?>" name="norm"  placeholder="Jam">
      <input  type="hidden" value="<?php echo $pasien?>" name="pasien"  placeholder="Jam">
<p  ><b>Makan terakhir: Jam</b> <input value="<?php echo $jammt ?>" style="color:black;font-weight: bold;" placeholder="Jam:Menit" name="mt"> <b>Jenis</b> <input value="<?php echo $jenismt ?>"  style="color:black;font-weight: bold;" type="text" placeholder="?" name="jnmt"><b> Porsi </b><input value="<?php echo $porsimt ?>" style="color:black;font-weight: bold;" placeholder="?"  type="text" name="porsimt"></p>
<p ><b>Minum terakhir: Jam </b><input value="<?php echo $jammit ?>"  style="color:black;font-weight: bold;" placeholder="Jam:Menit" name="mit"><b> Jenis</b> <input value="<?php echo $jenismit ?>"  style="color:black;font-weight: bold;" type="text" placeholder="?" name="jnmit"> <b>Porsi </b><input value="<?php echo $porsimit ?>" style="color:black;font-weight: bold;" placeholder="?" type="text" name="porsimit"><button type="submit" name="svakhir">V</button></form></p>
 </div>

</div>



</div>



</div>


<div class="modal fade" id="buatwaktu" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     <img src="../icon/watch.png">
                    <h5 class="modal-title">Buat Waktu</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>


<div class="modal fade" id="djj" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     <img src="../icon/health.png">
                    <h5 class="modal-title">Denyut Jantung Janin</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>



<div class="modal fade" id="airpen" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     <img src="../icon/vagina.png">
                     <br>
                    <h5 class="modal-title">Air Ketuban & Penyusupan</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>


<div class="modal fade" id="serviks" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     <img src="../icon/pregnancy.png">
                     <br>
                    <h5 class="modal-title">Pembukaan Serviks & Turunya Kepala</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>



<div class="modal fade" id="kontrasiv" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     <img src="../icon/pregnancy.png">
                     <br>
                    <h5 class="modal-title">Kontraksi Tiap 10 Menit</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>



<div class="modal fade" id="oksitosi" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     <img src="../icon/pregnancy.png">
                     <br>
                    <h5 class="modal-title">Cairan Oksitosin</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>



<div class="modal fade" id="obatcairan" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     <img src="../icon/pill.png">
                     <br>
                    <h5 class="modal-title">Obat dan Cairan</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>



<div class="modal fade" id="nadishow" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     <img src="../icon/heart.png">
                     <br>
                    <h5 class="modal-title">Nadi</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>


<div class="modal fade" id="tdshow" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     <img src="../icon/blood.png">
                     <br>
                    <h5 class="modal-title">Tekanan Darah</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>




<div class="modal fade" id="tempcshow" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     <img src="../icon/blood.png">
                     <br>
                    <h5 class="modal-title">Temp C</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>

<div class="modal fade" id="urineshow" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     <img src="../icon/blood.png">
                     <br>
                    <h5 class="modal-title">Urine</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>

  <script type="text/javascript">

 $('#buatwaktu').on('show.bs.modal', function (e) {
            var x = $(e.relatedTarget).data('x');
            var notrans = $(e.relatedTarget).data('notrans');
            var norm = $(e.relatedTarget).data('norm');
            var pasien = $(e.relatedTarget).data('pasien');

        console.log(x,notrans,norm);

       
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'buatwaktu.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'x='+x+'&'+'notrans='+notrans+'&'+'norm='+norm+'&'+'pasien='+pasien,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });


  $('#djj').on('show.bs.modal', function (e) {
           
            var notrans = $(e.relatedTarget).data('notrans');
            var norm = $(e.relatedTarget).data('norm');
            var pasien = $(e.relatedTarget).data('pasien');

    
  console.log(notrans,norm,pasien);
       
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'djj.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'notrans='+notrans+'&'+'norm='+norm+'&'+'pasien='+pasien,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });




$('#airpen').on('show.bs.modal', function (e) {
           
            var notrans = $(e.relatedTarget).data('notrans');
            var norm = $(e.relatedTarget).data('norm');
 var pasien = $(e.relatedTarget).data('pasien');
    
  console.log(notrans,norm);
       
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'airket.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
               data :  'notrans='+notrans+'&'+'norm='+norm+'&'+'pasien='+pasien,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });



$('#serviks').on('show.bs.modal', function (e) {
           
            var notrans = $(e.relatedTarget).data('notrans');
            var norm = $(e.relatedTarget).data('norm');
 var pasien = $(e.relatedTarget).data('pasien');
    
  console.log(notrans,norm);
       
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'serviks.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                 data :  'notrans='+notrans+'&'+'norm='+norm+'&'+'pasien='+pasien,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });



$('#kontrasiv').on('show.bs.modal', function (e) {
           
            var notrans = $(e.relatedTarget).data('notrans');
            var norm = $(e.relatedTarget).data('norm');
 var pasien = $(e.relatedTarget).data('pasien');
    
  console.log(notrans,norm);
       
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'kontraksi.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'notrans='+notrans+'&'+'norm='+norm+'&'+'pasien='+pasien,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });


$('#oksitosi').on('show.bs.modal', function (e) {
           
            var notrans = $(e.relatedTarget).data('notrans');
            var norm = $(e.relatedTarget).data('norm');
 var pasien = $(e.relatedTarget).data('pasien');
    
  console.log(notrans,norm);
       
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'oks.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                 data :  'notrans='+notrans+'&'+'norm='+norm+'&'+'pasien='+pasien,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });



$('#obatcairan').on('show.bs.modal', function (e) {
           
            var notrans = $(e.relatedTarget).data('notrans');
            var norm = $(e.relatedTarget).data('norm');
 var pasien = $(e.relatedTarget).data('pasien');
    
  console.log(notrans,norm);
       
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'oc.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                 data :  'notrans='+notrans+'&'+'norm='+norm+'&'+'pasien='+pasien,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });


$('#tdshow').on('show.bs.modal', function (e) {
           
            var notrans = $(e.relatedTarget).data('notrans');
            var norm = $(e.relatedTarget).data('norm');
        console.log(notrans,norm);
        var pasien = $(e.relatedTarget).data('pasien');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'td.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
               data :  'notrans='+notrans+'&'+'norm='+norm+'&'+'pasien='+pasien,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });


$('#nadishow').on('show.bs.modal', function (e) {
           
            var notrans = $(e.relatedTarget).data('notrans');
            var norm = $(e.relatedTarget).data('norm');
        console.log(notrans,norm);
        var pasien = $(e.relatedTarget).data('pasien');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'nadi.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'notrans='+notrans+'&'+'norm='+norm+'&'+'pasien='+pasien,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });


$('#tempcshow').on('show.bs.modal', function (e) {
           
            var notrans = $(e.relatedTarget).data('notrans');
            var norm = $(e.relatedTarget).data('norm');
        console.log(notrans,norm);
        var pasien = $(e.relatedTarget).data('pasien');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'tempc.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                 data :  'notrans='+notrans+'&'+'norm='+norm+'&'+'pasien='+pasien,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });


$('#urineshow').on('show.bs.modal', function (e) {
           
            var notrans = $(e.relatedTarget).data('notrans');
            var norm = $(e.relatedTarget).data('norm');
        console.log(notrans,norm);
        var pasien = $(e.relatedTarget).data('pasien');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'urine.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                 data :  'notrans='+notrans+'&'+'norm='+norm+'&'+'pasien='+pasien,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });



</script>


 
    

     



</body>




</html>