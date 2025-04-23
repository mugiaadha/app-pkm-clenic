<?php



$notrans=$_POST['notrans'];
$norm=$_POST['norm'];
$nolembar=$_POST['nolembar'];

$obat=$_POST['obat'];

$x=$_POST['x'];
$y=$_POST['y'];
$kduser=$_POST['kduser'];

 date_default_timezone_set('Asia/Jakarta');

 $tgl = date("Y-m-d H:i");



 



include '../../config.php';


 

$sql="INSERT INTO ERMTTVDIAG (notrans, norm, nolembar, ket, ketx, kety)
        VALUES ('$notrans','$norm','$nolembar','$obat','$x','$y')";
$sqlq=sqlsrv_query($conn,$sql);





echo "<script> setTimeout(function(){ 
 window.location.href = 'ttv.php?notrans=$notrans&norm=$norm&nolembar=$nolembar&kduser=$kduser'}, 0);</script>";



?> 