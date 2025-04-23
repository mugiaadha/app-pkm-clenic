<?php



$notrans=$_POST['notrans'];
$norm=$_POST['norm'];
$jam=$_POST['jam'];
$temp=$_POST['temp'];

 date_default_timezone_set('Asia/Jakarta');


     $tgl = date("Y-m-d H:i");

 



include '../../config.php';





  $sql="INSERT INTO ERMVKPTEMP (notrans, norm, nilai, x, tanggal)
        VALUES ('$notrans','$norm','$temp','$jam','$tgl')";
$sqlq=sqlsrv_query($conn,$sql);










echo "<script> setTimeout(function(){  window.location.href = 'index?notrans=$notrans&norm=$norm&pasien='; }, 0);</script>";



?> 