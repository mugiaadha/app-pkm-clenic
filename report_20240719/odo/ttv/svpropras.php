<?php



$notrans=$_POST['notrans'];
$norm=$_POST['norm'];
$nolembar=$_POST['nolembar'];


$kduser=$_POST['kduser'];
$tanggal=$_POST['tanggal'];
$hari=$_POST['hari'];
$dinas=$_POST['dinas'];
$ket=$_POST['ket'];


 date_default_timezone_set('Asia/Jakarta');




include '../../config.php';


$sql="INSERT INTO ERMTTVPROPASIEN (tanggal, notrans, norm, nolembar, hari, dinas, keterangan, username

)
        VALUES ('$tanggal','$notrans','$norm','$nolembar','$hari','$dinas','$ket','$kduser')";
$sqlq=sqlsrv_query($conn,$sql);









echo "<script> setTimeout(function(){ 
 window.location.href = 'ttv.php?notrans=$notrans&norm=$norm&nolembar=$nolembar&kduser=$kduser'}, 0);</script>";



?> 