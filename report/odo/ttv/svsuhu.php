<?php



$notrans=$_POST['notrans'];
$norm=$_POST['norm'];
$nolembar=$_POST['nolembar'];
$tanggal=$_POST['tanggal'];
$harike=$_POST['harike'];
$bb=$_POST['bb'];
$x=$_POST['x'];
$y=$_POST['y'];


 date_default_timezone_set('Asia/Jakarta');



 



include '../../config.php';


 

$sql="INSERT INTO ERMTTVTGL (notrans, norm, nolembar, tanggal, tglx, tgly, harike, harix, hariy, bb, bbx, bby)
        VALUES ('$notrans','$norm','$nolembar','$tanggal','$x','20','$harike','$x','40','$bb','$x','60')";
$sqlq=sqlsrv_query($conn,$sql);

// echo $notrans.$norm.$nolembar.$tanggal.$x.'20'.$harike.$x.'40'.$bb.$x.'60';












// echo "<script> setTimeout(function(){ 
//  window.location.href = 'index.php?notrans=$notrans&norm=$norm&nolembar=$nolembar'}, 0);</script>";

echo "<script> setTimeout(function(){ 
 window.location.href = 'ttv.php?notrans=$notrans&norm=$norm&nolembar=$nolembar&kduser=$kduser'}, 0);</script>";


?> 