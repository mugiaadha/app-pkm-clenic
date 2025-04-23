<?php



$notrans=$_POST['notrans'];
$norm=$_POST['norm'];
$ttltetes=$_POST['ttltetes'];

$jam=$_POST['jam'];

 date_default_timezone_set('Asia/Jakarta');


     $tgl = date("Y-m-d H:i");

 



include '../../config.php';

 

$sql="INSERT INTO ERMVKPOKS (notrans, norm, nilai, x, tanggal)
        VALUES ('$notrans','$norm','$ttltetes','$jam','$tgl')";
$sqlq=sqlsrv_query($conn,$sql);








echo "<script> setTimeout(function(){  window.location.href = 'index?notrans=$notrans&norm=$norm&pasien='; }, 0);</script>";



?> 