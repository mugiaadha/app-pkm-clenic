<?php



$notrans=$_POST['notrans'];
$norm=$_POST['norm'];
$protein=$_POST['protein'];
$aseston=$_POST['aseston'];
$jam=$_POST['jam'];
$volume=$_POST['volume']; 


 date_default_timezone_set('Asia/Jakarta');


     $tgl = date("Y-m-d H:i");

 



include '../../config.php';



$sqlxs="INSERT INTO ERMVKPURINE (notrans, norm, nilai, x, tanggal, status)
        VALUES ('$notrans','$norm','$protein','$jam','$tgl','Protein')";
$sqlqxs=sqlsrv_query($conn,$sqlxs);


$sqlxss="INSERT INTO ERMVKPURINE (notrans, norm, nilai, x, tanggal, status)
        VALUES ('$notrans','$norm','$aseston','$jam','$tgl','Aseston')";
$sqlqxss=sqlsrv_query($conn,$sqlxss);

$sqlxsss="INSERT INTO ERMVKPURINE (notrans, norm, nilai, x, tanggal, status)
        VALUES ('$notrans','$norm','$volume','$jam','$tgl','Volume')";
$sqlqxsss=sqlsrv_query($conn,$sqlxsss);


echo "<script> setTimeout(function(){  window.location.href = 'index?notrans=$notrans&norm=$norm&pasien='; }, 0);</script>";



?> 