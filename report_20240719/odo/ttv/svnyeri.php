<?php




 



include '../../config.php';

if (isset($_POST['simpan'])){

  $notrans = $_POST['notrans'];
$norm = $_POST['norm'];


$nomerews = '001';
$tgl = $_POST["tgl"];
$tgltime = $_POST["tgltime"];


$p = $_POST["p"];       
$q = $_POST["q"];
$r = $_POST["r"];
$s = $_POST["s"];
$t = $_POST["t"];
$intervensi = $_POST["infar"];
  
     $sql ="INSERT INTO ERMEWSNYERI (tanggal,tgltime,nomerews,notrans,norm,p,q,r,s,t,intervensi) 
     values('$tgl','$tgltime','$nomerews','$notrans','$norm','$p','$q','$r','$s','$t','$intervensi')";
      $outp=sqlsrv_query($conn,$sql);


      echo $sql;

// echo "<script> setTimeout(function(){ 
//  window.location.href = 'asesmennyeri.php?notrans=$notrans&norm=$norm'}, 0);</script>";



}else if(isset($_POST['edit'])){




$nomerews = '001';
$tgl = $_POST["tgl"];
$tgltime = $_POST["tgltime"];
$no = $_POST["no"];



$notrans = $_POST['notrans'];
$norm = $_POST['norm'];


$p = $_POST["p"];       
$q = $_POST["q"];
$r = $_POST["r"];
$s = $_POST["s"];
$t = $_POST["t"];
$intervensi = $_POST["infar"];
  
     // $sql ="UPDATE ERMEWSNYERI set tanggal='$tgl',tgltime='$tgltime',p='$p',q='$q',r='$r',s='$s',t='$t',intervensi='$intervensi' where no='$no'";
     //  $outp=sqlsrv_query($conn,$sql);



// echo "<script> setTimeout(function(){ 
//  window.location.href = 'asesmennyeri.php?notrans=$notrans&norm=$norm'}, 0);</script>";
}else{

}

?> 