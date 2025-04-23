<?php


$x=$_POST['x'];
$x2=$_POST['x']+19;


$notrans=$_POST['notrans'];
$norm=$_POST['norm'];
$pasien=$_POST['pasien'];


 date_default_timezone_set('Asia/Jakarta');


     $tgl = date("Y-m-d ".$_POST['waktu']."");

 $tgl2=date('Y-m-d H:i', strtotime('+30 Minutes', strtotime($tgl)));



include '../../config.php';



// satu
 $sql="INSERT INTO ERMVKPWAKTU (notrans, norm, waktu,garisx, urut, keterangan)
        VALUES ('$notrans','$norm','$tgl','$x','1','Utama')";
$sqlq=sqlsrv_query($conn,$sql);



 $sqlx="INSERT INTO ERMVKPWAKTU (notrans, norm, waktu,garisx, urut, keterangan)
        VALUES ('$notrans','$norm','$tgl2','$x2','2','30 Menit')";
$sqlqx=sqlsrv_query($conn,$sqlx);


echo "<script> setTimeout(function(){  window.location.href = 'index?notrans=$notrans&norm=$norm&pasien=$pasien'; }, 0);</script>";


?>