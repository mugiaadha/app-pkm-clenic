<?php



$notrans=$_POST['notrans'];
$norm=$_POST['norm'];
$pasien=$_POST['pasien'];

$mt=$_POST['mt'];
$jnmt=$_POST['jnmt'];
$porsimt=$_POST['porsimt'];

$mit=$_POST['mit'];
$jnmit=$_POST['jnmit'];
$porsimit=$_POST['porsimit'];


 date_default_timezone_set('Asia/Jakarta');


     $tgl = date("Y-m-d H:i");

 



include '../../config.php';

 $sql = "SELECT * FROM  ERMVKPBAWAH where  notrans='$notrans'";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $stmt );
   
if ($row_count <= 0){


$sql="INSERT INTO ERMVKPBAWAH ( notrans, norm, jammakan, jenis, porsi, jamminum, jenisminum, porsiminum

)
        VALUES ('$notrans','$norm','$mt','$jnmt','$porsimt','$mit','$jnmit','$porsimit')";
$sqlq=sqlsrv_query($conn,$sql);

}else if ($row_count > 0){

$sqledit="UPDATE ERMVKPBAWAH set jammakan='$mt',jenis='$jnmt',porsi='$porsimt',jamminum='$mit',jenisminum='$jnmit',porsiminum='$porsimit' where notrans='$notrans'";
$sqlqeditkk=sqlsrv_query($conn,$sqledit);



}

 










echo "<script> setTimeout(function(){  window.location.href = 'index?notrans=$notrans&norm=$norm&pasien=$pasien'; }, 0);</script>";



?> 