
<!DOCTYPE html>
<html>
<head>
  <title>Monitoring</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="../css/w3.css">
  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <link rel="stylesheet" href="../js/jquery-ui/jquery-ui.css">
  <link rel="shortcut icon" href="../favicon.ico" />
  <style>

    /* Style the tab */
    .tab {
      overflow: hidden;
      border: 1px solid #ccc;
      background-color: #f1f1f1;
    }
    /* Style the buttons inside the tab */
    .tab button {
      background-color: inherit;
      float: left;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 14px 16px;
      transition: 0.3s;
      font-size: 17px;
    }
    /* Change background color of buttons on hover */
    .tab button:hover {
      background-color: #ddd;
    }
    /* Create an active/current tablink class */
    .tab button.active {
      background-color: #ccc;
    }
    /* Style the tab content */
    .tabcontent {
      display: none;
      padding: 6px 12px;
      border: 1px solid #ccc;
      border-top: none;
    }
    .block {
      display: block;
      width: 100%;
      border: none;
      background-color: #4CAF50;
      color: white;
      padding: 14px 28px;
      font-size: 16px;
      cursor: pointer;
      text-align: center;
    }
    .block:hover {
      background-color: #ddd;
      color: black;
    }
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
      border: 0.5px solid #bbbfca;
      border-radius: 10px;
      height: 20px;
      width: 160px;
    }
    textarea {
      width: 100%;
      height: 150px;
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



<div style="text-align: center;color:black"> </div>

<?php
$notrans    = $_GET['notrans'];
$notransibs = $_GET['notransibs'];
$kduser     = $_GET['kduser'];




// $notrans    = 'BOK-20-11-34864';
// $notransibs = 'BOK-20-11-34864';
// $kduser     = '0001';




include '../../config.php';


// echo $notrans.$notransibs.$kduser;

date_default_timezone_set('Asia/Jakarta');
$tgl = date("Y-m-d H:i");

if (isset($_POST['simpan']))
{
  $notrans    = $_POST['notrans'];
  $notransibs = $_POST['notransibs'];

  $sql="INSERT INTO  ERMIBSMONITORINGANESTESI2 (tanggal, notrans, notransibs, Posisi, antiseptik, jarum, tusukan, Lumbal,Catheter,bevel, ett, lma, sungkup, tiva, o2, n20, Sevofluren, Isofluren, Lain, konversi, Premedikasi, oinduksi, obat, dokanas, peranas)
        VALUES ('".$tgl."','".$_POST['notrans']."','".$_POST['notransibs']."','".$_POST['Posisi']."','".$_POST['antiseptik']."','".$_POST['jarum']."','".$_POST['tusukan']."'
          ,'".$_POST['Lumbal']."',
          '".$_POST['Catheter']."',
          '".$_POST['bevel']."',
          '".$_POST['ett']."','".$_POST['lma']."','".$_POST['sungkup']."','".$_POST['tiva']."','".$_POST['o2']."','".$_POST['n20']."','".$_POST['Sevofluren']."',
          '".$_POST['Isofluren']."','".$_POST['Lain']."','".$_POST['konversi']."','".$_POST['Premedikasi']."','".$_POST['oinduksi']."','".$_POST['obat']."','".$_POST['dokanas']."','".$_POST['peranas']."')";

  $sqlq=sqlsrv_query($conn,$sql);

echo "<script> setTimeout(function(){ 
  window.location.href = 'monanas.php?notrans=$notrans&notransibs=$notransibs&kduser=$kduser'}, 0);</script>";

}else
if(isset($_POST['edit']))
{

  $notrans    = $_POST['notrans'];
  $notransibs = $_POST['notransibs'];

  $sql ="UPDATE ERMIBSMONITORINGANESTESI2 set
        Posisi='".$_POST['Posisi']."', 
        antiseptik='".$_POST['antiseptik']."',
        jarum='".$_POST['jarum']."', tusukan='".$_POST['tusukan']."', Lumbal='".$_POST['Lumbal']."'
        ,Catheter='".$_POST['Catheter']."',bevel='".$_POST['bevel']."'
        , ett='".$_POST['ett']."', lma='".$_POST['lma']."', sungkup='".$_POST['sungkup']."', tiva='".$_POST['tiva']."'
        , o2='".$_POST['o2']."', n20='".$_POST['n20']."',
        Sevofluren='".$_POST['Sevofluren']."', Isofluren='".$_POST['Isofluren']."',
        Lain='".$_POST['Lain']."'
        , konversi='".$_POST['konversi']."',
        Premedikasi='".$_POST['Premedikasi']."',
        oinduksi='".$_POST['oinduksi']."', 
        obat='".$_POST['obat']."', 
        dokanas='".$_POST['dokanas']."', 
        peranas='".$_POST['peranas']."'
        WHERE notransibs='".$_POST['notransibs']."' ";
  $sqlq=sqlsrv_query($conn,$sql);

echo "<script> setTimeout(function(){ 
  window.location.href = 'monanas.php?notrans=$notrans&notransibs=$notransibs&kduser=$kduser'}, 0);</script>";

}
?>
<div class="kontener">
 <div style="width: 1024px;overflow-y: scroll;">
  <svg height="602" width="1328" style="background: url(xxcsxxx.jpg) no-repeat 0 0;border:1px solid black " >

    <!-- tanggal -->



<?php

  echo "<text x='95' y='15' style='font-size: 12px;font-weight: bold;'>
  

<a data-x='95' data-y='15' fill='transparent'  data-notrans='$notrans'  data-notransibs='$notransibs'
    data-kduser='$kduser'  data-id='1' data-toggle='modal'  data-target='#tanggal'>Tanggalxxxxxx</a>

  </text";



?>




  <!-- waktu -->

<text x='95' y='55' style='font-size: 25px;font-weight: bold;'>

  <a data-x='95' data-y='55' fill='transparent'  data-notrans='<?php echo $notrans ?>'  data-notransibs='<?php echo $notransibs ?>'
    data-kduser='<?php echo $kduser ?>' data-id='2' data-toggle='modal'  data-target='#tanggal'>waktuxx</a>



  </text>



  <?php


  for ($x = 300; $x <= 1245; $x+=105) 
  {
    // waktu
    echo "<text x='$x' y='45'  style='font-size: 12px;font-weight:bold'>
    <a data-x='$x' data-y='45' fill='transparent'  data-notrans='$notrans'  data-notransibs='$notransibs'
    data-kduser='$kduser' data-id='3'  data-toggle='modal'  data-target='#tanggal'>12:00</a>
    </text>";
  }

  ?>



<!-- atas batas -->

<?php

  for ($x = 202; $x <= 1330; $x+=17) 
  {
  
    echo "<text x='$x' y='90'  style='font-size: 12px;font-weight:bold'>
    <a data-x='$x' data-y='90' fill='transparent'  data-notrans='$notrans'  data-notransibs='$notransibs'
    data-kduser='$kduser' data-id='23' data-toggle='modal'  data-target='#tanggal'>X</a>
    </text>";
  }

  ?>





<!-- anastesi dan operasi -->
  <?php

  for ($x = 202; $x <= 1330; $x+=17) 
  {




  for ($y = 110; $y <= 502; $y+=17) {

 echo "<text x='$x' y='$y'  style='font-size: 12px;font-weight:bold'>
    <a data-x='$x' data-y='$y' fill='transparent'  data-notrans='$notrans'  data-notransibs='$notransibs'
    data-kduser='$kduser' data-id='isigrafik' data-toggle='modal'  data-target='#tanggal'>X</a>
    </text>";

  }

  
   
  }


  ?>  




<?php


  for ($y = 112; $y <= 502; $y+=16) {

 // echo "<circle cx='205' cy='$y' r='4'   fill='black'/>";
// echo "<text x='205' y='$y'  style='font-size: 12px;font-weight:bold'>$y</text>";
  }



?>




  <?php

  for ($x = 210; $x <= 1315; $x+=105) 
  {
    // IVLINNE1
    echo "<text x='$x' y='510'  style='font-size: 12px;font-weight:bold'>
    <a data-x='$x' data-y='510' fill='transparent'  data-notrans='$notrans'  data-notransibs='$notransibs'
    data-kduser='$kduser' data-id='4' data-toggle='modal'  data-target='#tanggal'>XXXXXXX</a>
    </text>";
  }


  for ($x = 210; $x <= 1315; $x+=105) 
  {
    // IVLINNE2
    echo "<text x='$x' y='530'  style='font-size: 12px;font-weight:bold'>
    <a data-x='$x' data-y='530' fill='transparent'  data-notrans='$notrans'  data-notransibs='$notransibs'
    data-kduser='$kduser' data-id='5' data-toggle='modal'  data-target='#tanggal'>XXXXXXX</a>
    </text>";
  }



  for ($x = 210; $x <= 1315; $x+=105) 
  {
    // CVP
    echo "<text x='$x' y='545'  style='font-size: 12px;font-weight:bold'>
    <a data-x='$x' data-y='545' fill='transparent'  data-notrans='$notrans'  data-notransibs='$notransibs'
    data-kduser='$kduser' data-id='6' data-toggle='modal'  data-target='#tanggal'>XXXXXXX</a>
    </text>";
  }



for ($x = 210; $x <= 1315; $x+=105) 
  {
    // Temperatur
    echo "<text x='$x' y='560'  style='font-size: 12px;font-weight:bold'>
    <a data-x='$x' data-y='560' fill='transparent'  data-notrans='$notrans'  data-notransibs='$notransibs'
    data-kduser='$kduser' data-id='7' data-toggle='modal'  data-target='#tanggal'>XXXXXXX</a>
    </text>";
  }



for ($x = 210; $x <= 1315; $x+=105) 
  {
    // Produksi 
    echo "<text x='$x' y='575'  style='font-size: 12px;font-weight:bold'>
    <a data-x='$x' data-y='575' fill='transparent'  data-notrans='$notrans'  data-notransibs='$notransibs'
    data-kduser='$kduser' data-id='8' data-toggle='modal'  data-target='#tanggal'>XXXXXXX</a>
    </text>";
  }



for ($x = 210; $x <= 1315; $x+=105) 
  {
    // CVP
    echo "<text x='$x' y='595'  style='font-size: 12px;font-weight:bold'>
    <a data-x='$x' data-y='595' fill='transparent'  data-notrans='$notrans'  data-notransibs='$notransibs'
    data-kduser='$kduser' data-id='9' data-toggle='modal'  data-target='#tanggal'>XXXXXXX</a>
    </text>";
  }




  ?>






<!-- tampil data -->

<?php
  $sqls  = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='TGLATAS' ";
  $stmts = sqlsrv_query( $conn, $sqls );
  while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
  {
    echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='black' style='font-size: 12px;font-weight: bold'>".$rows['tanggal']."</text>";
  }


  $sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='JAMATAS' ";
  $stmts = sqlsrv_query( $conn, $sqls );
  while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
  {
    echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='black' style='font-size: 25px;font-weight: bold'>".$rows['tanggal']."</text>";
  }





  $sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='MENITATAS' ";
  $stmts = sqlsrv_query( $conn, $sqls );
  while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
  {
    echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='black' style='font-size: 18px;font-weight: bold'>".$rows['tanggal']."</text>";
  }



    $sqls  = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='IV1' ";
  $stmts = sqlsrv_query( $conn, $sqls );
  while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
  {
    echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='black' style='font-size: 12px;font-weight: bold'>".$rows['tanggal']."</text>";
  }



$sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='IV2' ";
  $stmts = sqlsrv_query( $conn, $sqls );
  while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
  {
    echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='black' style='font-size: 12px;font-weight: bold'>".$rows['tanggal']."</text>";
  }

  $sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='CVP' ";
  $stmts = sqlsrv_query( $conn, $sqls );
  while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
  {
    echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='black' style='font-size: 12px;font-weight: bold'>".$rows['tanggal']."</text>";
  }

  $sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='TEMP' ";
  $stmts = sqlsrv_query( $conn, $sqls );
  while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
  {
    echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='black' style='font-size: 12px;font-weight: bold'>".$rows['tanggal']."</text>";
  }

  $sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='PU' ";
  $stmts = sqlsrv_query( $conn, $sqls );
  while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
  {
    echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='black' style='font-size: 12px;font-weight: bold'>".$rows['tanggal']."</text>";
  }

  $sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='JP' ";
  $stmts = sqlsrv_query( $conn, $sqls );
  while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
  {
    echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='black' style='font-size: 12px;font-weight: bold'>".$rows['tanggal']."</text>";
  }




$sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='ANAS' ";
  $stmts = sqlsrv_query( $conn, $sqls );
  while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
  {
    echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='blue' style='font-size: 12px;font-weight: bold'>".$rows['tanggal']."</text>";
  }



$sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='OP' ";
  $stmts = sqlsrv_query( $conn, $sqls );
  while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
  {
    echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='blue' style='font-size: 14px;font-weight: bold'>".$rows['tanggal']."</text>";
  }





  $sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='NADI' ";
  $stmts = sqlsrv_query( $conn, $sqls );
  while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
  {
    echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='red' style='font-size: 12px;font-style: bold'>".$rows['tanggal']."</text>";
    echo "<circle cx='".$rows['x']."' cy='".$rows['y']."' r='4'   fill='red'/>";
  }



  $sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='RESP' ";
  $stmts = sqlsrv_query( $conn, $sqls );
  while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
  {
    echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='black' style='font-size: 12px;font-style: bold'>".$rows['tanggal']."</text>";
    echo "<circle cx='".$rows['x']."' cy='".$rows['y']."' r='4'   fill='black'/>";
  }



$sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='TDS' ";
  $stmts = sqlsrv_query( $conn, $sqls );
  while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
  {

    $yy= $rows['y']-15;
    $x= $rows['x']-4; 
    echo "<text x='".$x."' y='".$yy."' fill='red' style='font-size: 12px;font-style: bold'>".$rows['tanggal']."</text>";
    
    echo "<text x='".$x."' y='".$rows['y']."' fill='black' style='font-size: 20px;font-weight: bold'>V</text>";
  }

  $sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='TDD' ";
  $stmts = sqlsrv_query( $conn, $sqls );
  while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
  {

        $yy= $rows['y']+14;

    $x= $rows['x']-4;
        echo "<text x='".$x."' y='".$yy."' fill='red' style='font-size: 12px;font-style: bold'>".$rows['tanggal']."</text>";
    

    echo "<text x='".$x."' y='".$rows['y']."' fill='black' style='font-size: 20px;font-weight: bold'>A</text>";
  }




?>
  <polyline points=
  "<?php
  $sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='ANAS' order by x";
  $stmts = sqlsrv_query( $conn, $sqls );
  while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
  {
    $xf      = $rows['x'];
    $yf      = $rows['y']-4;
    $polidjj = $xf.','.$yf.' ';
    echo $polidjj;
  }?>"style="fill:none;stroke:blue;stroke-width:2" />

  <polyline points=
  "<?php
  $sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='OP' order by x";
  $stmts = sqlsrv_query( $conn, $sqls );
  while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
  {
    $xf      = $rows['x'];
    $yf      = $rows['y']-4;
    $polidjj = $xf.','.$yf.' ';
    echo $polidjj;
  }?>"style="fill:none;stroke:blue;stroke-width:2" />



<polyline points=
  "<?php
  $sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='NADI' order by x";
  $stmts = sqlsrv_query( $conn, $sqls );
  while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
  {
    $xf=$rows['x'];
    $yf=$rows['y'];
    $polidjj=$xf.','.$yf.' ';
    echo $polidjj;
  }?>"style="fill:none;stroke:red;stroke-width:2" />



  <polyline points=
  "<?php
  $sqls  = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='RESP' order by x";
  $stmts = sqlsrv_query( $conn, $sqls );
  while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
  {
    $xf      = $rows['x'];
    $yf      = $rows['y'];
    $polidjj = $xf.','.$yf.' ';
    echo $polidjj;
  }?>"style="fill:none;stroke:black;stroke-width:2" />



  <polyline points=
  "<?php
  $sqls  = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='TDS' order by x";
  $stmts = sqlsrv_query( $conn, $sqls );
  while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
  {
    $xf      = $rows['x'];
    $yf      = $rows['y'];
    $polidjj = $xf.','.$yf.' ';
    echo $polidjj;
  }?>"style="fill:none;stroke:black;stroke-width:2" />


  <polyline points=
  "<?php
  $sqls  = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='TDD' order by x";
  $stmts = sqlsrv_query( $conn, $sqls );
  while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
  {
    $xf      = $rows['x'];
    $yf      = $rows['y']-15;
    $polidjj = $xf.','.$yf.' ';
    echo $polidjj;
  }?>"style="fill:none;stroke:black;stroke-width:2" />







  </svg>
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
                     
                    <h5 class="modal-title w3-pink">INPUT</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>








  <script type="text/javascript">

$('#tanggal').on('show.bs.modal', function (e) {
           
            var notrans = $(e.relatedTarget).data('notrans');
            var notransibs = $(e.relatedTarget).data('notransibs');
var kduser = $(e.relatedTarget).data('kduser');
var x = $(e.relatedTarget).data('x');
var y = $(e.relatedTarget).data('y');
var id = $(e.relatedTarget).data('id');

         
            $.ajax({
                type : 'post',
                url : 'tglibs.php',
               
                 data :  'notrans='+notrans+'&'+'notransibs='+notransibs+'&'+'kduser='+kduser+'&'+'x='+x+'&'+'y='+y+'&'+'id='+id,
            
                success : function(data){
                $('.modal-data').html(data);
             
                }
            });
         });




$('#tandavital').on('show.bs.modal', function (e) {
           
            var notrans = $(e.relatedTarget).data('notrans');
            var norm = $(e.relatedTarget).data('norm');
var nolembar = $(e.relatedTarget).data('nolembar');
var x = $(e.relatedTarget).data('x');
var y = $(e.relatedTarget).data('y');
       console.log(notrans,norm,nolembar,x,y);
         
            $.ajax({
                type : 'post',
                url : 'inputews.php',
               
                 data :  'notrans='+notrans+'&'+'norm='+norm+'&'+'nolembar='+nolembar+'&'+'x='+x+'&'+'y='+y,
            
                success : function(data){
                $('.modal-data').html(data);
             
                }
            });
         });

    $('.modal-data').on('click','.selection__form', function(e){

      var id = $(this).data('id');
      $('.modal-data').find('.__selection').hide('slow');
      $('.modal-data').find('#'+id).show('slow');
    })


</script> 
 
    




</body>




</html>