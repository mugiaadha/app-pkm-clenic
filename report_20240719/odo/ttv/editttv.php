<?php



$notrans=$_POST['notrans'];
$norm=$_POST['norm'];
$nolembar=$_POST['nolembar'];


$x=$_POST['x'];

 date_default_timezone_set('Asia/Jakarta');

 $tgl = date("Y-m-d H:i");
$suhu=$_POST['suhu'];
$ssuhu=$_POST['ssuhu']; 
$nadi = $_POST['nadi'];
$snadi = $_POST['snadi'];
$resp = $_POST['resp'];
$sresp = $_POST['sresp'];
$sis = $_POST['sis'];
$dis = $_POST['dis'];
$e = $_POST['e'];
$m = $_POST['m'];
$v = $_POST['v'];


$spo = $_POST['spo'];
$bal = $_POST['bal'];
$input = $_POST['input'];
$out = $_POST['out'];
$urine = $_POST['urine'];
$muntah = $_POST['muntah'];
$defeksi = $_POST['defeksi'];
$kduser=$_POST['kduser'];





include '../../config.php';


if(isset($_POST["simpan"])){

// echo "simpan";

$sqls = "SELECT * FROM   ERMTTVRMS where angka='$suhu' ";
  $stmts = sqlsrv_query( $conn, $sqls );
                                     
 while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {
 $suhufix=$rows['rumus'];
}



$sqls = "SELECT * FROM   ERMTTVRMS where angka='$nadi' ";
  $stmts = sqlsrv_query( $conn, $sqls );
                                     
 while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {
 $nadifix=$rows['rumus'];
}

$sqln = "SELECT * FROM   ERMTTVRMS where angka='$resp' ";
  $stmtn = sqlsrv_query( $conn, $sqln );
                                     
 while( $rown = sqlsrv_fetch_array( $stmtn, SQLSRV_FETCH_ASSOC) ) {
 $respfix=$rown['rumus'];
}









$sql ="UPDATE ERMTTVVITAL set 

suhu ='$suhu,$ssuhu',suhux='$x', suhuy='$suhufix',
 nadi='$nadi,$snadi', nadix='$x', nadiy='$nadifix'
 , resp='$resp,$sresp', respx='$x', respy='$respfix', tds='$sis', tdsx='$x', tdsy='15', tdd='$dis', tddx='$x', tddy='35', e='$e', ex='$x', ey='52', m='$m', mx='$x', my='70', v='$v', vx='$x',vy='88'
where notrans = '$notrans'  and nolembar='$nolembar' AND suhux = '$x'";
$sqlq=sqlsrv_query($conn,$sql);




$sqlx ="UPDATE ERMTTVVITALD set spo='$spo', spox='$x', spoy='16', balance='$bal', balancex='$x', balancey='34', input='$input', inputx='$x', inputy='52', output='out', outputx='$x', outputy='70', urine='$urine', urinex='$x', uriney='88', muntah='$muntah', muntahx='$x', muntahy='106', defeksi='$defeksi', defeksix='$x', defeksiy='124' where notrans = '$notrans'  and nolembar='$nolembar' AND spox = '$x'";
$sqlqx=sqlsrv_query($conn,$sqlx);




}else if(isset($_POST["hapus"])){
 	$sql ="DELETE    ERMTTVVITAL  where notrans = '$notrans'  and nolembar='$nolembar' AND suhux = '$x' ";
$outp=sqlsrv_query($conn,$sql);

 	$sqls ="DELETE    ERMTTVVITALD  where notrans = '$notrans'  and nolembar='$nolembar' AND spox = '$x' ";
$outp=sqlsrv_query($conn,$sqls);

// echo "hapus";
}









echo "<script> setTimeout(function(){ 
 window.location.href = 'ttv.php?notrans=$notrans&norm=$norm&nolembar=$nolembar&kduser=$kduser'}, 0);</script>";

?> 