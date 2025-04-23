
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


<div style="text-align: center;border-bottom: 1px dashed black">
	<h4>Monitoring Anastesi</h4>
</div>
<div style="text-align: center;color:black"> </div>

<?php
$notrans    = $_GET['notrans'];
$notransibs = $_GET['notransibs'];
$kduser     = $_GET['kduser'];
include '../../config.php';


echo $notrans.$notransibs.$kduser;

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
 	window.location.href = 'monanas.php?notrans=$notrans&notransibs=$notransibs'}, 0);</script>";

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
 	window.location.href = 'monanas.php?notrans=$notrans&notransibs=$notransibs'}, 0);</script>";

}
?>
<div style="padding: 10px; display: flex; justify-content: center; " >
	<svg height="453" width="1138" style="background: url(ibs1.jpg) no-repeat 0 0;border:1px solid black " >

	<!-- <circle cx='213' cy='328' r='4'   fill='red' />

	<circle cx='213' cy='308' r='4'   fill='red' />

	<circle cx='213' cy='288' r='4'   fill='red' />
	 -->

	<?php
	$sqls  = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='TGLATAS' ";
	$stmts = sqlsrv_query( $conn, $sqls );
	while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
	{
		echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='red' style='font-size: 12px;font-style: bold'>".$rows['tanggal']."</text>";
	}

	$sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='JAMATAS' ";
 	$stmts = sqlsrv_query( $conn, $sqls );
	while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
	{
		echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='red' style='font-size: 12px;font-style: bold'>".$rows['tanggal']."</text>";
	}

	$sqls  = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='WAKTUATAS' ";
 	$stmts = sqlsrv_query( $conn, $sqls );
	while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
	{
		echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='red' style='font-size: 12px;font-style: bold'>".$rows['tanggal'].":</text>";
	}

	$sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='MENITATAS' ";
 	$stmts = sqlsrv_query( $conn, $sqls );
	while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
	{
		$y=$rows['y']+20;
		echo "<text x='".$rows['x']."' y='".$y."' fill='red' style='font-size: 12px;font-style: bold'>".$rows['tanggal']."</text>";
	}

	$sqls  = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='IV1' ";
 	$stmts = sqlsrv_query( $conn, $sqls );
	while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
	{
		echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='red' style='font-size: 12px;font-style: bold'>".$rows['tanggal']."</text>";
	}

	$sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='IV2' ";
 	$stmts = sqlsrv_query( $conn, $sqls );
	while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
	{
		echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='red' style='font-size: 12px;font-style: bold'>".$rows['tanggal']."</text>";
	}

	$sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='CVP' ";
 	$stmts = sqlsrv_query( $conn, $sqls );
	while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
	{
		echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='red' style='font-size: 12px;font-style: bold'>".$rows['tanggal']."</text>";
	}

	$sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='TEMP' ";
 	$stmts = sqlsrv_query( $conn, $sqls );
	while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
	{
		echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='red' style='font-size: 12px;font-style: bold'>".$rows['tanggal']."</text>";
	}

	$sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='PU' ";
 	$stmts = sqlsrv_query( $conn, $sqls );
	while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
	{
		echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='red' style='font-size: 12px;font-style: bold'>".$rows['tanggal']."</text>";
	}

	$sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='JP' ";
 	$stmts = sqlsrv_query( $conn, $sqls );
	while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
	{
		echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='red' style='font-size: 12px;font-style: bold'>".$rows['tanggal']."</text>";
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
		echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='red' style='font-size: 12px;font-style: bold'>".$rows['tanggal']."</text>";
		echo "<circle cx='".$rows['x']."' cy='".$rows['y']."' r='4'   fill='black'/>";
	}

	$sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='ANAS' ";
 	$stmts = sqlsrv_query( $conn, $sqls );
	while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
	{
		echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='blue' style='font-size: 12px;font-style: bold'>".$rows['tanggal']."</text>";
	}

	$sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='OP' ";
 	$stmts = sqlsrv_query( $conn, $sqls );
	while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
	{
		echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='black' style='font-size: 12px;font-style: bold'>".$rows['tanggal']."</text>";
	}

	$sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='TDS' ";
 	$stmts = sqlsrv_query( $conn, $sqls );
	while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
	{
		echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='blue' style='font-size: 12px;font-style: bold'>".$rows['tanggal']."</text>";
		$x= $rows['x']-8;
		echo "<text x='".$x."' y='".$rows['y']."' fill='red' style='font-size: 20px;font-style: bold'>V</text>";
	}

	$sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='TDD' ";
 	$stmts = sqlsrv_query( $conn, $sqls );
	while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
	{
		echo "<text x='".$rows['x']."' y='".$rows['y']."' fill='blue' style='font-size: 12px;font-style: bold'>".$rows['tanggal']."</text>";
		$x= $rows['x']-8;
		echo "<text x='".$x."' y='".$rows['y']."' fill='red' style='font-size: 20px;font-style: bold'>n</text>";
	}
	?>
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
	}?>"style="fill:none;stroke:black;stroke-width:1" />


	<polyline points=
	"<?php
	$sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='ANAS' order by x";
	$stmts = sqlsrv_query( $conn, $sqls );
	while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
	{
		$xf      = $rows['x'];
		$yf      = $rows['y']-3;
		$polidjj = $xf.','.$yf.' ';
		echo $polidjj;
	}?>"style="fill:none;stroke:blue;stroke-width:1" />


	<polyline points=
	"<?php
	$sqls = "SELECT * FROM  ERMIBSMONITORINGANESTESITGL where  notransibs='$notransibs' and status='OP' order by x";
	$stmts = sqlsrv_query( $conn, $sqls );
	while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
	{
		$xf      = $rows['x'];
		$yf      = $rows['y']-3;
		$polidjj = $xf.','.$yf.' ';
		echo $polidjj;
	}?>"style="fill:none;stroke:black;stroke-width:1" />

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
	}?>"style="fill:none;stroke:black;stroke-width:1" />

	<?php
	echo "<text x='105' y='20' style='font-size: 12px'>
	<a data-x='105' data-y='20' data-notrans='$notrans'  data-notransibs='$notransibs'
	data-kduser='$kduser' data-id='1'  fill='transparent'
	data-toggle='modal'  data-target='#tanggal' >15.dfgdfgdfgd</a>
	</text>";

	echo "<text x='105' y='50' style='font-size: 12px'>
	<a data-x='105' data-y='50' data-notrans='$notrans'  data-notransibs='$notransibs'
	data-kduser='$kduser' data-id='2'   fill='transparent'
	data-toggle='modal'  data-target='#tanggal' >15.0XXXXXXX</a>
	</text>";

	for ($x = 218; $x <= 1125; $x+=20) 
	{
		// waktu
	  echo "<text x='$x' y='40'  style='font-size: 12px'>
		<a data-x='$x' data-y='40' fill='transparent'  data-notrans='$notrans'  data-notransibs='$notransibs'
		data-kduser='$kduser' data-id='3' data-toggle='modal'  data-target='#tanggal'>12:</a>
	  </text>";
	}

	for ($x = 218; $x <= 1125; $x+=20) 
	{
	  // line 1
	  echo "<text x='$x' y='340' fill='black' style='font-size: 11px'>
	  <a data-x='$x' data-y='340'fill='transparent'data-notrans='$notrans'  data-notransibs='$notransibs'
		data-kduser='$kduser' data-id='4'  
		data-toggle='modal'  data-target='#tanggal'>12:</a>
	  </text>";

	  // line 2

	  echo "<text x='$x' y='360' fill='black' style='font-size: 11px'>
	 	<a data-x='$x' data-y='360' fill='transparent' data-notrans='$notrans'  data-notransibs='$notransibs'
		data-kduser='$kduser' data-id='5' data-toggle='modal'  data-target='#tanggal'>12:</a>
	  </text>";

	  // cvp
	  echo "<text x='$x' y='380' fill='black' style='font-size: 11px'>
	  <a data-x='$x' data-y='380'fill='transparent' data-notrans='$notrans'  data-notransibs='$notransibs'
		data-kduser='$kduser' data-id='6' data-toggle='modal'  data-target='#tanggal'>12:</a>
	  </text>";

	  // temp
	  echo "<text x='$x' y='400' fill='black' style='font-size: 11px'>
	  <a data-x='$x' data-y='400' fill='transparent'data-notrans='$notrans'  data-notransibs='$notransibs'
		data-kduser='$kduser' data-id='7'data-toggle='modal'  data-target='#tanggal'>12:</a>
	  </text>";

		// produksi
	  
	  echo "<text x='$x' y='420' fill='black' style='font-size: 11px'>
	  <a data-x='$x' data-y='420' fill='transparent' data-notrans='$notrans'  data-notransibs='$notransibs' 
	  data-kduser='$kduser' data-id='8'data-toggle='modal'  data-target='#tanggal'>12:</a>
	  </text>";

		// jmlp
	  echo "<text x='$x' y='440' fill='black' style='font-size: 11px'>
	  <a data-x='$x' data-y='440'fill='transparent'data-notrans='$notrans'  data-notransibs='$notransibs'
		data-kduser='$kduser' data-id='9' data-toggle='modal'  data-target='#tanggal' >12:</a>
	  </text>";
	}

	for ($x = 218; $x <= 1125; $x+=20) 
	{
		for ($y = 88; $y <= 328; $y+=20) 
		{
		  echo "<text x='$x' y='$y'  style='font-size: 12px'>
			<a data-x='$x' data-y='$y'fill='transparent'  data-notrans='$notrans'  data-notransibs='$notransibs'
			data-kduser='$kduser' data-id='isigrafik' data-toggle='modal'  data-target='#tanggal'>12:</a>
		  </text>";
		}
	}
	?>
	</svg>
</div>

<?php 

include '../../config.php';
$sqlrt     = "SELECT  * from ERMIBSMONITORINGANESTESI2 where  notransibs='$notransibs' ";
$paramsrt  = array();
$optionsrt = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmtrt    = sqlsrv_query( $conn, $sqlrt , $paramsrt, $optionsrt );
$row_countrt = sqlsrv_num_rows( $stmtrt );

if($row_countrt <= 0)
{
	?>
	<form  action="monanas.php" method="POST" >
		<div>
			<b style="font-size: 18px">Regional Anestesi</b>
		  <input  type='hidden' name="notrans" value="<?php echo $notrans ?>">
		  <input  type='hidden' name="notransibs" value="<?php echo $notransibs ?>" >
			<table style="border-top: 1px solid black">
			  <tr>
				  <th> <p> Posisi : <input type="text" name="Posisi" placeholder="Posisi" > </p> </th>
					<th> <p> Antiseptik : <input type="text" name="antiseptik" placeholder="Antiseptik" > </p> </th>
				</tr>
			  <tr>
				  <th> <p> Jarum : <input type="text" name="jarum" placeholder="jarum" > </p> </th>
					<th> <p> Tusukan : <input type="text" name="tusukan" placeholder="Tusukan" > </p> </th>
			    <th> <p> Bevel : <input type="text" name="bevel" placeholder="Bevel" > </p> </th>
			  </tr>
			  <tr>
				  <th> <p> Catheter : <input type="text" name="Catheter" placeholder="Catheter" > </p> </th>
					<th> <p> Lumbal : <input type="text" name="Lumbal" placeholder="Lumbal" > </p> </th>
			  </tr>
			</table>

			<b style="font-size: 18px">General Anestesi</b>
			<table style="border-top: 1px solid black">
  			<tr>
  				<th> <p> ETT : <input type="text" name="ett" placeholder="ETT" > </p> </th>
					<th> <p> LMA : <input type="text" name="lma" placeholder="LMA" > </p> </th>
				  <th> <p> Sungkup : <input type="text" name="sungkup" placeholder="Sungkup" > </p> </th>
				  <th> <p> TIVA : <input type="text" name="tiva" placeholder="Tiva" > </p> </th>
			  </tr>
			</table>

			<table style="border-top: 1px solid black">
  			<tr>
				  <th> <p> O2 : <input type="text" name="o2" placeholder="O2" > </p> </th>
			  </tr>
			  <tr>
				  <th> <p> N2O : <input type="text" name="n20" placeholder="N2O" > </p> </th>
			  </tr>
		    <tr>
				  <th> <p> Sevofluren : <input type="text" name="Sevofluren" placeholder="Sevofluren" > </p> </th>
			  </tr>
				<tr>
				  <th> <p> Isofluren : <input type="text" name="Isofluren" placeholder="Isofluren" > </p> </th>
			  </tr>
				<tr>
  				<th> <p> Lain : <input type="text" name="Lain" placeholder="Lain" > </p> </th>
			  </tr>
			</table>



<b style="font-size: 18px">Konversi dari Regional ke General</b>

<table style="border-top: 1px solid black">
  <tr>
<th>
  <textarea type="text" name="konversi" placeholder="Konversi dari Regional ke General" ></textarea> 
</th>
  </tr>

 
  
</table>



<b style="font-size: 18px">Premedikasi</b>

<table style="border-top: 1px solid black">
  <tr>
<th>
  <textarea type="text" name="Premedikasi" placeholder="Premedikasi" ></textarea> 
</th>
  </tr>

 
  
</table>



<b style="font-size: 18px">Obat-Obat Induksi</b>

<table style="border-top: 1px solid black">
  <tr>
<th>
  <textarea type="text" name="oinduksi" placeholder="Obat-Obat Induksi" ></textarea> 
</th>
  </tr>

 
  
</table>



<b style="font-size: 18px">Obat-Obatan </b>

<table style="border-top: 1px solid black">
  <tr>
<th>
  <textarea type="text" name="obat" placeholder="Obat-Obatan" ></textarea> 
</th>
  </tr>

 
  
</table>


<table style="border-top: 1px solid black">
  <tr>
<th>
  <b style="font-size: 18px">Dokter Anastesi </b>
  <input type="text" name="dokanas" placeholder="Dokter Anastesi" >
</th>
<th>
  <b style="font-size: 18px">Perawat Anastesi </b>
   <input type="text" name="peranas" placeholder="Perawat Anastesi" >
</th>
  </tr>

 
  
</table>




  <button type="submit" name="simpan" class="block" >SIMPAN</button>




</div>
</form>


<?php?><?php

}else{


 
?> 

<?php

 $stmtrt = sqlsrv_query( $conn, $sqlrt );
                                     
 while( $rowsrt = sqlsrv_fetch_array( $stmtrt, SQLSRV_FETCH_ASSOC) ) {

?>

<form  action="monanas.php" method="POST" >
<div>
<b style="font-size: 18px">Regional Anestesi</b>

<input  name="notrans" type='hidden' value="<?php echo $notrans ?>">
  <input  name="notransibs" type='hidden' value="<?php echo $notransibs ?>" >

<table style="border-top: 1px solid black">
  <tr>
  <th>
<p> Posisi : <input type="text" name="Posisi" value="<?php echo $rowsrt['Posisi'] ?>" placeholder="Posisi" >
</p>

  </th>
 <th>
<p> Antiseptik : <input type="text" name="antiseptik" value="<?php echo $rowsrt['antiseptik'] ?>" placeholder="Antiseptik" >
</p>

  </th>
  </tr>
  <tr>
  <th>
<p> Jarum : <input type="text" name="jarum"  value="<?php echo $rowsrt['jarum'] ?>"  placeholder="jarum" >
</p>

  </th>
 <th>
<p> Tusukan : <input type="text" name="tusukan"  value="<?php echo $rowsrt['tusukan'] ?>"  placeholder="Tusukan" >
</p>

  </th>
   <th>
<p> Bevel : <input type="text"  name="bevel"  value="<?php echo $rowsrt['bevel'] ?>"  placeholder="Bevel" >
</p>

  </th>
  </tr>
  <tr>
  <th>
<p> Catheter : <input type="text" name="Catheter"   value="<?php echo $rowsrt['Catheter'] ?>" placeholder="Catheter" >
</p>

  </th>
 <th>
<p> Lumbal : <input type="text" name="Lumbal"  value="<?php echo $rowsrt['Lumbal'] ?>"  placeholder="Lumbal" >
</p>

  </th>
  </tr>
</table>



<b style="font-size: 18px">General Anestesi</b>

<table style="border-top: 1px solid black">
  <tr>
  <th>
<p> ETT : <input type="text" name="ett" value="<?php echo $rowsrt['ett'] ?>" placeholder="ETT" >
</p>

  </th>
 <th>
<p> LMA : <input type="text" name="lma" value="<?php echo $rowsrt['lma'] ?>" placeholder="LMA" >
</p>

  </th>
  <th>
<p> Sungkup : <input type="text" name="sungkup" value="<?php echo $rowsrt['sungkup'] ?>" placeholder="Sungkup" >
</p>

  </th>
  <th>
<p> TIVA : <input type="text" name="tiva"  value="<?php echo $rowsrt['tiva'] ?>" placeholder="Tiva" >
</p>

  </th>
  </tr>
 
  
</table>



<table style="border-top: 1px solid black">
  <tr>
  <th>
<p> O2 : <input type="text" name="o2" placeholder="O2" value="<?php echo $rowsrt['o2'] ?>" >
</p>

  </th>

  </tr>
  <tr>
  <th>
<p> N2O : <input type="text" name="n20" placeholder="N2O" value="<?php echo $rowsrt['n20'] ?>" >
</p>

  </th>

  </tr>
  
   <tr>
  <th>
<p> Sevofluren : <input type="text" name="Sevofluren" value="<?php echo $rowsrt['Sevofluren'] ?>" placeholder="Sevofluren" >
</p>

  </th>

  </tr>


<tr>
  <th>
<p> Isofluren : <input type="text" value="<?php echo $rowsrt['Isofluren'] ?>" name="Isofluren" placeholder="Isofluren" >
</p>

  </th>

  </tr>

<tr>
  <th>
<p> Lain : <input type="text" name="Lain" placeholder="Lain" value="<?php echo $rowsrt['Lain'] ?>" >
</p>

  </th>

  </tr>

</table>



<b style="font-size: 18px">Konversi dari Regional ke General</b>

<table style="border-top: 1px solid black">
  <tr>
<th>
  <textarea type="text" name="konversi" placeholder="Konversi dari Regional ke General" >
    
    <?php echo $rowsrt['konversi'] ?>
  </textarea> 
</th>
  </tr>

 
  
</table>



<b style="font-size: 18px">Premedikasi</b>

<table style="border-top: 1px solid black">
  <tr>
<th>
  <textarea type="text" name="Premedikasi"   placeholder="Premedikasi" >
    
    <?php echo $rowsrt['Premedikasi'] ?>
  </textarea> 
</th>
  </tr>

 
  
</table>



<b style="font-size: 18px">Obat-Obat Induksi</b>

<table style="border-top: 1px solid black">
  <tr>
<th>
  <textarea type="text" name="oinduksi"   placeholder="Obat-Obat Induksi" >
    
    <?php echo $rowsrt['oinduksi'] ?>
  </textarea> 
</th>
  </tr>

 
  
</table>



<b style="font-size: 18px">Obat-Obatan </b>

<table style="border-top: 1px solid black">
  <tr>
<th>
  <textarea type="text" name="obat"  placeholder="Obat-Obatan" >
    <?php echo $rowsrt['obat'] ?>
  </textarea> 
</th>
  </tr>

 
  
</table>


<table style="border-top: 1px solid black">
  <tr>
<th>
  <b style="font-size: 18px">Dokter Anastesi </b>
  <input type="text" name="dokanas"  value="<?php echo $rowsrt['dokanas'] ?>"  placeholder="Dokter Anastesi" >
</th>
<th>
  <b style="font-size: 18px">Perawat Anastesi </b>
   <input type="text" name="peranas"  value="<?php echo $rowsrt['peranas'] ?>"  placeholder="Perawat Anastesi" >
</th>
  </tr>

 
  
</table>


<br>


  <button type="submit" name="edit" class="block" >EDIT</button>

<br>


</div>
</form>



<?php }?>

<?php





}

?>

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
                     
                    <h5 class="modal-title w3-pink">Tanggal</h5>
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