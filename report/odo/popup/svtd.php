<?php



$notrans=$_POST['notrans'];
$norm=$_POST['norm'];
$tds=$_POST['tds'];
$jam=$_POST['jam'];
$tdd=$_POST['tdd'];

 date_default_timezone_set('Asia/Jakarta');


     $tgl = date("Y-m-d H:i");

 



include '../../config.php';




$sqls = "SELECT * FROM   ERMVKRUMUS where ynilai='$tds' and ket='nadi' order by ynilai";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {

 
$yline = $rows['yatas'];

  $sql="INSERT INTO ERMVKPTD (notrans, norm, nilai, x, y, tanggal, status)
        VALUES ('$notrans','$norm','$tds','$jam','$yline','$tgl','ATAS')";
$sqlq=sqlsrv_query($conn,$sql);

}



$sqls = "SELECT * FROM   ERMVKRUMUS where ynilai='$tdd' and ket='nadi' order by ynilai";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {

 
$ylinex = $rows['yatas'];

$sqlx="INSERT INTO ERMVKPTD (notrans, norm, nilai, x, y, tanggal, status)
        VALUES ('$notrans','$norm','$tdd','$jam','$ylinex','$tgl','BAWAH')";
$sqlqx=sqlsrv_query($conn,$sqlx);

}




echo "<script> setTimeout(function(){  window.location.href = 'index?notrans=$notrans&norm=$norm&pasien='; }, 0);</script>";



?> 