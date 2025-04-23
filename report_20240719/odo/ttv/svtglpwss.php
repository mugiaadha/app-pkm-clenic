<?php



$notrans=$_POST['notrans'];
$norm=$_POST['norm'];
$nolembar=$_POST['nolembar'];
$tanggal=$_POST['tanggal'];

$x=$_POST['x'];
$y=$_POST['y'];
 date_default_timezone_set('Asia/Jakarta');


$kduser=$_POST['kduser'];

 



include '../../config.php';


 

$sql="INSERT INTO ERMEWSTGLL (notrans, norm, nolembar, tanggal, x, y
)
        VALUES ('$notrans','$norm','$nolembar','$tanggal','$x','$y')";
$sqlq=sqlsrv_query($conn,$sql);



echo "<script> setTimeout(function(){ 
 window.location.href = 'pews.php?notrans=$notrans&norm=$norm&nolembar=$nolembar&kduser=$kduser'}, 0);</script>";



?> 