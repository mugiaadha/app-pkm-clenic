<?php



$notrans=$_POST['notrans'];
$norm=$_POST['norm'];
$nolembar=$_POST['nolembar'];

$obat=$_POST['signa'];
$sobat=$_POST['sobat'];
$x=$_POST['x'];
$y=$_POST['y'];
$kduser = $_POST['kduser'];

 date_default_timezone_set('Asia/Jakarta');

 $tgl = date("Y-m-d H:i");



 



include '../../config.php';


 $sql="UPDATE ERMTTVOBAT set obat='$obat', jenisobat='$sobat', obatx='$x', obaty='$y',status='Signa'
where  (nolembar = '$nolembar')  AND (obatx = '$x') AND (obaty = '$y') and notrans='$notrans'
  ";

// $sql="INSERT INTO ERMTTVOBAT (notrans, norm, nolembar, tanggal, obat, jenisobat, obatx, obaty,status)
//         VALUES ('$notrans','$norm','$nolembar','$tgl','$obat','$sobat','$x','$y','Signa')";
$sqlq=sqlsrv_query($conn,$sql);





echo "<script> setTimeout(function(){ 
 window.location.href = 'ttv.php?notrans=$notrans&norm=$norm&nolembar=$nolembar&kduser=$kduser'}, 0);</script>";



?> 