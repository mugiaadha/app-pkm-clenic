<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
 

 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);








$kdcabang=$data->kdcabang;






$notrans=$data->notrans;
$norm=$data->norm;
$kdpoli=$data->kdpoli;
$kddokter=$data->kddokter;
$dari=$data->dari;
$hakakses = $data->hakakses;




$stssimpan = $data->stssimpan;




$tgl = date("Y-m-d H:i:s");
if($stssimpan === '1'){

   $conn -> autocommit(FALSE);



if($hakakses === 'Perawat'){

$kduser=$kddokter;

}else{

  $kduser=$data->kduser;
}






$cars=json_encode($data->rwytp);






if(empty($cars)){
$rwytp='';
}else{

$a = str_replace("["," ",$cars);
$a = str_replace("]"," ",$a);
$a = str_replace('"'," ",$a);
$rwytp = $a;


}

if(empty($data->subjek)){
$subjek='';
}else{
$subjek=str_replace("'"," ` ",$data->subjek);




}

if(empty($data->td)){
$td='';
}else{

$td=str_replace("'"," ` ",$data->td);


}

if(empty($data->tdd)){
$tdd='';
}else{

$tdd=str_replace("'"," ` ",$data->tdd);


}


if(empty($data->hr)){
$hr='';
}else{

$hr=str_replace("'"," ` ",$data->hr);


}


if(empty($data->bb)){
$bb='';
}else{
$bb=$data->bb;
}

if(empty($data->nadi)){
$nadi='';
}else{
$nadi=$data->nadi;
}

if(empty($data->suhu)){
$suhu='';
}else{
$suhu=$data->suhu;
}

if(empty($data->rr)){
$rr='';
}else{
$rr=$data->rr;
}

if(empty($data->spo)){
$spo='';
}else{
$spo=$data->spo;
}

if(empty($data->pf)){
$pf='';
}else{

$pf=str_replace("'"," ` ",$data->pf);


}

if(empty($data->planing)){
$planing='';
}else{

$planing=str_replace("'"," ` ",$data->planing);

}

if(empty($data->planing)){
$planing='';
}else{

$planing=str_replace("'"," ` ",$data->planing);

}



if(empty($data->alergi)){
$alergi='';
}else{

$alergi=str_replace("'"," ` ",$data->alergi);

}

if(empty($data->tb)){
$tb='';
}else{

$tb=str_replace("'"," ` ",$data->tb);

}


if(empty($data->subjekp)){
$subjekp='';
}else{

$subjekp=str_replace("'"," ` ",$data->subjekp);

}

if(empty($data->tglkontrol)){
$tglkontrol='';
}else{

$tglkontrol=str_replace("'"," ` ",$data->tglkontrol);

}


if(empty($data->rencanatindakan)){
$rencanatindakan='';
}else{

$rencanatindakan=str_replace("'"," ` ",$data->rencanatindakan);

}


$cpptasal='CPPTRI';

if(empty($data->diagnosa)){
$diagnosa='';
}else{

$diagnosa=str_replace("'"," ` ",$data->diagnosa);

}

if(empty($data->tindakan)){
$tindakan='';
}else{

$tindakan=str_replace("'"," ` ",$data->tindakan);

}

$nomorcppt = $data->nomorcppt;

if(empty($data->insobat)){
$insobat='';
}else{

$insobat=str_replace("'"," ` ",$data->insobat);

}

if(empty($data->inspenunjang)){
$inspenunjang='';
}else{

$inspenunjang=str_replace("'"," ` ",$data->inspenunjang);

}

$jeniscppt = $data->jeniscppt;

$kdcpptl=$notrans.$kddokter.$nomorcppt;




  $conn -> query("INSERT INTO ermcppt(kduser,notrans,tgl,norm,kddokter,kdpoli,subjek,td,bb,nadi,suhu,rr,spo,pf,planing,kdcabang,alergi,tdd,hr,tb,rwytp,subjekp,
    tglkontrol,rencanatindakan,kdcppt,cpptasal,diagnosa,tindakan,nourut,insobat,inspenunjang,jeniscppt,jam) 
 values('$kduser','$notrans','$tgl','$norm','$kddokter','$kdpoli','$subjek','$td','$bb','$nadi','$suhu','$rr','$spo','$pf','$planing','$kdcabang',
 '$alergi','$tdd','$hr','$tb','$rwytp','$subjekp','$tglkontrol','$rencanatindakan',
 '$kdcpptl','$cpptasal','$diagnosa','$tindakan','$nomorcppt','$insobat','$inspenunjang','$jeniscppt','$tgl')");




 

$conn -> query("UPDATE ermcpptintruksi set

kirim='Ya' where notransaksi='$notrans' and
 kdcabang='$kdcabang' and kdcppt='$kdcpptl'");
 

$conn -> query("UPDATE jualobatd set

kirim='Ya' where 
 kdcabang='$kdcabang' and kdcppt='$kdcpptl'");












  $kirimfl = array(
         'metadata'=>array(
            'code'=> 200,
            'message'=>'Simpan Hapus',
              'messagexx'=>0
         )
    );
  







// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode($kirimfl);

}

// Rollback transaction
$conn -> rollback();

$conn -> close();



}else if($stssimpan === '2'){


   $conn -> autocommit(FALSE);


   $kdcppt = $data->kdcppt;
   $notrans = $data->notrans;



     $conn -> query("DELETE from ermcppt where kdcabang='$kdcabang' 
    and notrans='$notrans' and kdcppt='$kdcppt'");




    $conn -> query("DELETE from ermcpptintruksi where kdcabang='$kdcabang' 
    and notransaksi='$notrans' and kdcppt='$kdcppt'");



  $kirimfl = array(
         'metadata'=>array(
            'code'=> 200,
            'message'=>'Berhasil Hapus',
              'messagexx'=>0
         )
    );
  



// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode($kirimfl);

}

// Rollback transaction
$conn -> rollback();

$conn -> close();

}else if($stssimpan === '3'){











}
   

 




?>