<?php



$notrans=$_POST['notrans'];
$norm=$_POST['norm'];
$airket=$_POST['airket'];
$penyu=$_POST['penyu'];
$jam=$_POST['jam'];

 date_default_timezone_set('Asia/Jakarta');


     $tgl = date("Y-m-d H:i");

 



include '../../config.php';

// air ketuba
$sql="INSERT INTO ERMVKAIRPEN (notrans, norm, isi, xline, tanggal, status)
        VALUES ('$notrans','$norm','$airket','$jam','$tgl','AK')";
$sqlq=sqlsrv_query($conn,$sql);


// penyuspan
$sqlx="INSERT INTO ERMVKAIRPEN (notrans, norm, isi, xline, tanggal, status)
        VALUES ('$notrans','$norm','$penyu','$jam','$tgl','PENYU')";
$sqlqx=sqlsrv_query($conn,$sqlx);






echo "<script> setTimeout(function(){  window.location.href = 'index?notrans=$notrans&norm=$norm&pasien='; }, 0);</script>";




                                      







?> 