<?php



$notrans=$_POST['notrans'];
$norm=$_POST['norm'];
$jmlkontraksi=$_POST['jmlkontraksi'];
$kontraksi=$_POST['kontraksi'];
$jam=$_POST['jam'];

 date_default_timezone_set('Asia/Jakarta');


     $tgl = date("Y-m-d H:i");

 



include '../../config.php';




$sqls = "SELECT * FROM   ERMVKRUMUS where ynilai='$jmlkontraksi' and ket='kontraksi' order by ynilai";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {

 
$yline = $rows['yatas'];
$yblok = $rows['yblok'];

$sql="INSERT INTO ERMVKPKONTRAKSI (notrans, norm, nilai, x, y, yblok, detik, tanggal)
        VALUES ('$notrans','$norm','$jmlkontraksi','$jam','$yline','$yblok','$kontraksi','$tgl')";
$sqlq=sqlsrv_query($conn,$sql);
}







echo "<script> setTimeout(function(){  window.location.href = 'index?notrans=$notrans&norm=$norm&pasien='; }, 0);</script>";



?> 