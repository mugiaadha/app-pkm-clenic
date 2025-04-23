<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
 

 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);





$kduser=$data->kduser;


if(empty($data->nmPst)){
$nmPst='';
}else{

$nmPst=str_replace("'"," ` ",$data->nmPst);

}

if(empty($data->nokaPst)){
$nokaPst='';
}else{

$nokaPst=str_replace("'"," ` ",$data->nokaPst);

}

if(empty($data->noRujukan)){
$noRujukan='';
}else{

$noRujukan=str_replace("'"," ` ",$data->noRujukan);

}
if(empty($data->tglKunjungan)){
$tglKunjungan='';
}else{

$tglKunjungan=str_replace("'"," ` ",$data->tglKunjungan);

}


if(empty($data->tglEstRujuk)){
$tglEstRujuk='';
}else{

$tglEstRujuk=str_replace("'"," ` ",$data->tglEstRujuk);

}

if(empty($data->tglAkhirRujuk)){
$tglAkhirRujuk='';
}else{

$tglAkhirRujuk=str_replace("'"," ` ",$data->tglAkhirRujuk);

}

if(empty($data->nmPPK)){
$nmPPK='';
}else{

$nmPPK=str_replace("'"," ` ",$data->nmPPK);

}
if(empty($data->kdPPK)){
$kdPPK='';
}else{

$kdPPK=str_replace("'"," ` ",$data->kdPPK);

}

if(empty($data->nmPoli)){
$nmPoli='';
}else{

$nmPoli=str_replace("'"," ` ",$data->nmPoli);

}

if(empty($data->kdPoli)){
$kdPoli='';
}else{

$kdPoli=str_replace("'"," ` ",$data->kdPoli);

}

if(empty($data->kdDiag)){
$kdDiag='';
}else{

$kdDiag=str_replace("'"," ` ",$data->kdDiag);

}

if(empty($data->nmDiag)){
$nmDiag='';
}else{

$nmDiag=str_replace("'"," ` ",$data->nmDiag);

}
if(empty($data->nmPPKa)){
$nmPPKa='';
}else{

$nmPPKa=str_replace("'"," ` ",$data->nmPPKa);

}

if(empty($data->kdPPKa)){
$kdPPKa='';
}else{

$kdPPKa=str_replace("'"," ` ",$data->kdPPKa);

}
if(empty($data->nmDokter)){
$nmDokter='';
}else{

$nmDokter=str_replace("'"," ` ",$data->nmDokter);

}
if(empty($data->kdDati)){
$kdDati='';
}else{

$kdDati=str_replace("'"," ` ",$data->kdDati);

}
if(empty($data->nmDati)){
$nmDati='';
}else{

$nmDati=str_replace("'"," ` ",$data->nmDati);

}
if(empty($data->nmKR)){
$nmKR='';
}else{

$nmKR=str_replace("'"," ` ",$data->nmKR);

}


if(empty($data->pisa)){
$pisa='';
}else{

$pisa=str_replace("'"," ` ",$data->pisa);

}

if(empty($data->ketpisa)){
$ketpisa='';
}else{

$ketpisa=str_replace("'"," ` ",$data->ketpisa);

}
if(empty($data->jadwal)){
$jadwal='';
}else{

$jadwal=str_replace("'"," ` ",$data->jadwal);

}


$stssimpan = $data->stssimpan;


$tgl = date("Y-m-d H:i:s");
if($stssimpan === '1'){

   $conn -> autocommit(FALSE);


    $sql="SELECT * from riwayatkunjungan where noRujukan='$noRujukan' and nokaPst='$nokaPst'";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){

$conn -> query("UPDATE riwayatkunjungan set 
  nmPst='$nmPst',nokaPst='$nokaPst',noRujukan='$noRujukan',tglKunjungan='$tglKunjungan',
  tglEstRujuk='$tglEstRujuk',tglAkhirRujuk='$tglAkhirRujuk',nmPPK='$nmPPK',kdPPK='$kdPPK',
  nmPoli='$nmPoli',kdPoli='$kdPoli',kdDiag='$kdDiag',nmDiag='$nmDiag',nmPPKa='$nmPPKa',
  kdPPKa='$kdPPKa',nmDokter='$nmDokter',kdDati='$kdDati',nmDati='$nmDati',nmKR='$nmKR',
  kduser='$kduser',pisa='$pisa',ketpisa='$ketpisa',jadwal='$jadwal'


where noRujukan='$noRujukan' and nokaPst='$nokaPst'");




}else{




  $conn -> query("INSERT INTO riwayatkunjungan(nmPst,nokaPst,noRujukan,tglKunjungan,tglEstRujuk,tglAkhirRujuk,nmPPK,kdPPK,nmPoli,kdPoli,kdDiag,nmDiag,nmPPKa,kdPPKa,nmDokter,kdDati,nmDati,nmKR,kduser,pisa,ketpisa,notransaksi,jadwal) 
 values('$nmPst','$nokaPst','$noRujukan','$tglKunjungan','$tglEstRujuk','$tglAkhirRujuk','$nmPPK','$kdPPK','$nmPoli','$kdPoli','$kdDiag','$nmDiag','$nmPPKa','$kdPPKa','$nmDokter','$kdDati','$nmDati','$nmKR','$kduser','$pisa','$ketpisa','$data->notransaksi','$jadwal')");



 

}









// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode('Sukses');

}

// Rollback transaction
$conn -> rollback();

$conn -> close();



}else if($stssimpan === '2'){






}else if($stssimpan === '3'){











}
   

 




?>