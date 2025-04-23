<?php



$notrans=$_POST['notrans'];
$norm=$_POST['norm'];
$tuban=$_POST['tuban'];
$msj=$_POST['msj'];
$mtgl=$_POST['mtgl'];
$pasien=$_POST['pasien'];

$mjam=$_POST['mjam'];


 date_default_timezone_set('Asia/Jakarta');


     $tgl = date("Y-m-d H:i");

 



include '../../config.php';

 

 $sql = "SELECT * FROM  ERMVKPJUDUL where  notrans='$notrans'";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $stmt );
   
if ($row_count <= 0){

$sql="INSERT INTO ERMVKPJUDUL ( notrans, norm, ketubanpecah, mulessejak, tanggal,menit)
        VALUES ('$notrans','$norm','$tuban','$msj','$mtgl','$mjam')";
$sqlq=sqlsrv_query($conn,$sql);
}else if ($row_count > 0){
	
$sqledit="UPDATE ERMVKPJUDUL set ketubanpecah='$tuban',mulessejak='$msj',tanggal='$mtgl',menit='$menit'";
$sqlqeditkk=sqlsrv_query($conn,$sqledit);

}













echo "<script> setTimeout(function(){  window.location.href = 'index?notrans=$notrans&norm=$norm&pasien=$pasien'; }, 0);</script>";



?> 