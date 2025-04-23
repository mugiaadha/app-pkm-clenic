<?php
$serverName = "TEAMOS-PC"; //serverName\instanceName
$connectionInfo = array( "Database"=>"RSBHINARMBG", "UID"=>"sa", "PWD"=>"54321");
$connsql = sqlsrv_connect( $serverName, $connectionInfo);

include '../koneksi.php';

$conn -> autocommit(FALSE);

$sql = "SELECT        ACCOUNT, PARENT, DESCRIPTION
FROM            ACCOUNT ";

$result = sqlsrv_query( $connsql, $sql );


 while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
 { 

$a=$row['ACCOUNT'];
$b=$row['PARENT'];
$c=$row['DESCRIPTION'];



// Insert some values
$conn -> query("INSERT INTO coa(kdakun,parent,akun) 
 values('$a','$b','$c')");









}


// Commit transaction
if (!$conn -> commit()) {
  echo "Commit transaction failed";
 
  exit();
}else{


}

// Rollback transaction
$conn -> rollback();

$conn -> close();


?>
