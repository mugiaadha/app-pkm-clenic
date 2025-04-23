<?php



$notrans=$_POST['notrans'];
$norm=$_POST['norm'];
$pembukaan=$_POST['pembukaan'];
$turun=$_POST['turun'];
$jam=$_POST['jam'];

 date_default_timezone_set('Asia/Jakarta');


     $tgl = date("Y-m-d H:i");

 



include '../../config.php';




$sqls = "SELECT * FROM   ERMVKRUMUS where ynilai='$pembukaan' and ket='serviks' order by ynilai";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {

 
$yline = $rows['yatas'];

  $sql="INSERT INTO ERMVKPSERVIKS (notrans, norm, nilai, x, y, tanggal, status
)
        VALUES ('$notrans','$norm','$pembukaan','$jam','$yline','$tgl','SERVIKS')";
$sqlq=sqlsrv_query($conn,$sql);
}




$sqlsx = "SELECT * FROM   ERMVKRUMUS where ynilai='$turun' and ket='serviks' order by ynilai";
                                      $stmtsx = sqlsrv_query( $conn, $sqlsx );
                                     

                                      while( $rowsx = sqlsrv_fetch_array( $stmtsx, SQLSRV_FETCH_ASSOC) ) {

 
$ylinex = $rowsx['yatas'];

  $sqlx="INSERT INTO ERMVKPSERVIKS (notrans, norm, nilai, x, y, tanggal, status
)
        VALUES ('$notrans','$norm','$turun','$jam','$ylinex','$tgl','TURUN')";
$sqlqx=sqlsrv_query($conn,$sqlx);
}




echo "<script> setTimeout(function(){  window.location.href = 'index?notrans=$notrans&norm=$norm&pasien='; }, 0);</script>";



?> 