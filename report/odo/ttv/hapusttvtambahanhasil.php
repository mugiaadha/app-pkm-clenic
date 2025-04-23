<?php



date_default_timezone_set('Asia/Jakarta');

	
	

	



	 	$notrans=$_GET['notrans'];
$norm=$_GET['norm'];
$nolembar=$_GET['nolembar'];
$keterangan =$_GET['keterangan'];

$kduser =$_GET['kduser'];

$indek =$_GET['indek'];




	 	 	  	  
	

// echo $notrans.$norm.$nolembar.$keterangan.$kduser;


include '../../config.php';



 $sql2 ="DELETE ERMTTVPROPASIEN  where notrans='$notrans' and norm='$norm' and indek='$indek'";
$outp=sqlsrv_query($conn,$sql2);


echo $sql2;

echo "<script> setTimeout(function(){ 
 window.location.href = 'ttv.php?notrans=$notrans&norm=$norm&nolembar=$nolembar&kduser=$kduser'}, 0);</script>";

  
  
  
  
  ?>