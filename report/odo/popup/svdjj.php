<?php



$notrans=$_POST['notrans'];
$norm=$_POST['norm'];
$ynilai=$_POST['ynilai'];
$xjam=$_POST['jam'];

 date_default_timezone_set('Asia/Jakarta');


     $tgl = date("Y-m-d H:i");

 



include '../../config.php';




$sqls = "SELECT * FROM   ERMVKRUMUS where ynilai='$ynilai' and ket='djj' order by ynilai";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {

 
$yline = $rows['yatas'];

  $sql="INSERT INTO ERMVKPDJJ (notrans, norm, nilai, x, y, tanggal)
        VALUES ('$notrans','$norm','$ynilai','$xjam','$yline','$tgl')";
$sqlq=sqlsrv_query($conn,$sql);







echo "<script> setTimeout(function(){  window.location.href = 'index?notrans=$notrans&norm=$norm&pasien='; }, 0);</script>";




                                      }







?> 