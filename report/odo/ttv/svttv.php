<?php



$notrans=$_POST['notrans'];
$norm=$_POST['norm'];
$nolembar=$_POST['nolembar'];


$x=$_POST['x'];
// $y=$_POST['y'];
 date_default_timezone_set('Asia/Jakarta');

 $tgl = date("Y-m-d H:i");
$suhu=$_POST['suhu'];
$ssuhu=$_POST['ssuhu']; 
$nadi = $_POST['nadi'];
$snadi = $_POST['snadi'];
$resp = $_POST['resp'];
$sresp = $_POST['sresp'];
$sis = $_POST['sis'];
$dis = $_POST['dis'];
$e = $_POST['e'];
$m = $_POST['m'];
$v = $_POST['v'];


$spo = $_POST['spo'];
$bal = $_POST['bal'];
$input = $_POST['input'];
$out = $_POST['out'];
$urine = $_POST['urine'];
$muntah = $_POST['muntah'];
$defeksi = $_POST['defeksi'];
$kduser=$_POST['kduser'];



//  $spo = 'spo';
// $bal = 'spo';
// $input = 'spo';
// $out ='spo';
// $urine = 'spo';
// $muntah ='spo';
// $defeksi = 'spo';



include '../../config.php';



$sqls = "SELECT * FROM   ERMTTVRMS where angka='$suhu' ";
  $stmts = sqlsrv_query( $conn, $sqls );
                                     
 while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {
 $suhufix=$rows['rumus'];
}



$sqls = "SELECT * FROM   ERMTTVRMS where angka='$nadi' ";
  $stmts = sqlsrv_query( $conn, $sqls );
                                     
 while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {
 $nadifix=$rows['rumus'];
}

$sqln = "SELECT * FROM   ERMTTVRMS where angka='$resp' ";
  $stmtn = sqlsrv_query( $conn, $sqln );
                                     
 while( $rown = sqlsrv_fetch_array( $stmtn, SQLSRV_FETCH_ASSOC) ) {
 $respfix=$rown['rumus'];
}






$sql="INSERT INTO ERMTTVVITAL ( tanggal, notrans, norm, nolembar, suhu, suhux, suhuy, nadi, nadix, nadiy, resp, respx, respy, tds, tdsx, tdsy, tdd, tddx, tddy, e, ex, ey, m, mx, my, v, vx,vy,username)
        VALUES ('$tgl','$notrans','$norm','$nolembar','$suhu,$ssuhu','$x','$suhufix','$nadi,$snadi','$x','$nadifix','$resp,$sresp','$x','$respfix','$sis','$x','15','$dis','$x','35','$e','$x','52','$m','$x','70','$v','$x','88','$kduser')";
$sqlq=sqlsrv_query($conn,$sql);



$sqlx="INSERT INTO ERMTTVVITALD ( tanggal, notrans, norm, nolembar, spo, spox, spoy, balance, balancex, balancey, input, inputx, inputy, output, outputx, outputy, urine, urinex, uriney, muntah, muntahx, muntahy, defeksi, defeksix, defeksiy)
        VALUES ('$tgl','$notrans','$norm','$nolembar','$spo','$x','16','$bal','$x','34','$input','$x','52','$out','$x','70','$urine','$x','88','$muntah','$x','106','$defeksi','$x','124')";





$sqlqx=sqlsrv_query($conn,$sqlx);






// echo "<script> setTimeout(function(){ 
//  window.location.href = 'index.php?notrans=$notrans&norm=$norm&nolembar=$nolembar'}, 0);</script>";


echo "<script> setTimeout(function(){ 
 window.location.href = 'ttv.php?notrans=$notrans&norm=$norm&nolembar=$nolembar&kduser=$kduser'}, 0);</script>";

?> 