<?php



$notrans=$_POST['notrans'];
$norm=$_POST['norm'];

$obat1=$_POST['obat1'];
$obat2=$_POST['obat2'];
$obat3=$_POST['obat3'];
$obat4=$_POST['obat4'];

$cairan1=$_POST['cairan1'];
$cairan2=$_POST['cairan2'];
$cairan3=$_POST['cairan3'];
$cairan4=$_POST['cairan4'];



$jam=$_POST['jam'];

 date_default_timezone_set('Asia/Jakarta');


     $tgl = date("Y-m-d H:i");

 



include '../../config.php';

 

$sql="INSERT INTO ERMVKPOBAT (notrans, norm, nama, x, y, jenis, tanggal)
        VALUES ('$notrans','$norm','$obat1','$jam','10','obat','$tgl')";
$sqlq=sqlsrv_query($conn,$sql);


$sql1="INSERT INTO ERMVKPOBAT (notrans, norm, nama, x, y, jenis, tanggal)
        VALUES ('$notrans','$norm','$obat2','$jam','16','obat','$tgl')";
$sqlq1=sqlsrv_query($conn,$sql1);

$sql2="INSERT INTO ERMVKPOBAT (notrans, norm, nama, x, y, jenis, tanggal)
        VALUES ('$notrans','$norm','$obat3','$jam','22','obat','$tgl')";
$sqlq2=sqlsrv_query($conn,$sql2);

$sql3="INSERT INTO ERMVKPOBAT (notrans, norm, nama, x, y, jenis, tanggal)
        VALUES ('$notrans','$norm','$obat4','$jam','28','obat','$tgl')";
$sqlq3=sqlsrv_query($conn,$sql3);




$sqlx="INSERT INTO ERMVKPOBAT (notrans, norm, nama, x, y, jenis, tanggal)
        VALUES ('$notrans','$norm','$cairan1','$jam','37','cairan','$tgl')";
$sqlqx=sqlsrv_query($conn,$sqlx);


$sql1x="INSERT INTO ERMVKPOBAT (notrans, norm, nama, x, y, jenis, tanggal)
        VALUES ('$notrans','$norm','$cairan2','$jam','43','cairan','$tgl')";
$sqlq1x=sqlsrv_query($conn,$sql1x);

$sql2x="INSERT INTO ERMVKPOBAT (notrans, norm, nama, x, y, jenis, tanggal)
        VALUES ('$notrans','$norm','$cairan3','$jam','49','cairan','$tgl')";
$sqlq2x=sqlsrv_query($conn,$sql2x);

$sql3x="INSERT INTO ERMVKPOBAT (notrans, norm, nama, x, y, jenis, tanggal)
        VALUES ('$notrans','$norm','$cairan4','$jam','55','cairan','$tgl')";
$sqlq3x=sqlsrv_query($conn,$sql3x);



echo "<script> setTimeout(function(){  window.location.href = 'index?notrans=$notrans&norm=$norm&pasien='; }, 0);</script>";



?> 