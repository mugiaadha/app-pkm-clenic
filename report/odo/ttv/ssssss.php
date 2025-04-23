
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