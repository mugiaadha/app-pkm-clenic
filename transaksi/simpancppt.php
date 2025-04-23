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


$cars=json_encode($data->rwytp);






if(empty($cars)){
$rwytp='';
}else{

$a = str_replace("["," ",$cars);
$a = str_replace("]"," ",$a);
$a = str_replace('"'," ",$a);
$rwytp = $a;


}





$notrans=$data->notrans;
$norm=$data->norm;
$kdpoli=$data->kdpoli;
$kddokter=$data->kddokter;
$dari=$data->dari;
$hakakses = $data->hakakses;


if($hakakses === 'Perawat'){

$kduser=$kddokter;

}else{

  $kduser=$data->kduser;
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
if(empty($data->stspulang)){
$stspulang='';
}else{

$stspulang=str_replace("'"," ` ",$data->stspulang);


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


if(empty($data->skalanyeri)){
$skalanyeri='';
}else{

$skalanyeri=str_replace("'"," ` ",$data->skalanyeri);

}

if(empty($data->imt)){
$imt='';
}else{

$imt=str_replace("'"," ` ",$data->imt);

}

if(empty($data->riwayatdahulu)){
    
   $riwayatdahulu=''; 
   
}else{
   $riwayatdahulu=str_replace("'"," ` ",$data->riwayatdahulu);
    
}


if(empty($data->riwayatkeluarga)){
    
   $riwayatkeluarga=''; 
   
}else{
   $riwayatkeluarga=str_replace("'"," ` ",$data->riwayatkeluarga);
    
}



$stssimpan = $data->stssimpan;


$tgl = date("Y-m-d H:i:s");
if($stssimpan === '1'){

   $conn -> autocommit(FALSE);


    $sql="SELECT * from ermcppt where notrans='$notrans' and kdcabang='$kdcabang'";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){



if($hakakses === 'Perawat'){
    
    $conn -> query("UPDATE ermcppt set
subjek='$subjekp',td='$td',bb='$bb',nadi='$nadi',suhu='$suhu',rr='$rr',spo='$spo',pf='$pf',planing='$planing',stspulang='$stspulang',
alergi='$alergi',tdd='$tdd',hr='$hr',tb='$tb',rwytp='$rwytp',subjekp='$subjekp',
tglkontrol='$tglkontrol',rencanatindakan='$rencanatindakan',skalanyeri='$skalanyeri',imt='$imt',
riwayatdahulu='$riwayatdahulu',riwayatkeluarga='$riwayatkeluarga'

 where notrans='$notrans' and
 kdcabang='$kdcabang'");
 
 

 $conn -> query("UPDATE antrian set

status='SIAP' where notransaksi='$notrans' and
 kdcabang='$kdcabang' and status='ANTRI' ");
}else{
    
    $conn -> query("UPDATE ermcppt set
subjek='$subjek',td='$td',bb='$bb',nadi='$nadi',suhu='$suhu',rr='$rr',spo='$spo',pf='$pf',planing='$planing',stspulang='$stspulang',
alergi='$alergi',tdd='$tdd',hr='$hr',tb='$tb',rwytp='$rwytp',subjekp='$subjekp',tglkontrol='$tglkontrol',
rencanatindakan='$rencanatindakan',skalanyeri='$skalanyeri',imt='$imt',riwayatdahulu='$riwayatdahulu',riwayatkeluarga='$riwayatkeluarga'
 where notrans='$notrans' and
 kdcabang='$kdcabang'");
 
 

if($dari === '1'){
$conn -> query("UPDATE kunjunganpasien set

koreksirmakhir='1' where notransaksi='$notrans' and
 kdcabang='$kdcabang'");
}else{

  $conn -> query("UPDATE kunjunganpasien set

koreksierm='SUDAH' where notransaksi='$notrans' and
 kdcabang='$kdcabang'");

  

}


$kdcppt=$notrans.$kddokter;

$conn -> query("UPDATE ermcpptintruksi set

kirim='Ya' where notransaksi='$notrans' and
 kdcabang='$kdcabang' and kdcppt='$kdcppt'");
 

$conn -> query("UPDATE jualobatd set

kirim='Ya' where 
 kdcabang='$kdcabang' and kdcppt='$kdcppt'");
 


 $conn -> query("UPDATE antrian set

status='SELESAI' where notransaksi='$notrans' and
 kdcabang='$kdcabang' ");
 


}




}else{



$kdcppt=$notrans.$kddokter;


if($hakakses === 'Perawat'){
    
      $conn -> query("INSERT INTO ermcppt(kduser,notrans,tgl,norm,kddokter,kdpoli,subjek,td,bb,nadi,suhu,rr,spo,pf,planing,kdcabang,alergi,tdd,hr,tb,rwytp,subjekp,
    tglkontrol,rencanatindakan,stspulang,skalanyeri,imt,riwayatdahulu,riwayatkeluarga) 
 values('$kduser','$notrans','$tgl','$norm','$kddokter','$kdpoli','$subjekp','$td',
 '$bb','$nadi','$suhu','$rr','$spo','$pf','$planing','$kdcabang','$alergi','$tdd',
 '$hr','$tb','$rwytp','$subjekp','$tglkontrol','$rencanatindakan','$stspulang','$skalanyeri','$imt','$riwayatdahulu','$riwayatkeluarga')");



 $conn -> query("UPDATE antrian set

status='SIAP' where notransaksi='$notrans' and
 kdcabang='$kdcabang' and status='ANTRI'");

}else{
    
    
       $conn -> query("INSERT INTO ermcppt(kduser,notrans,tgl,norm,kddokter,kdpoli,subjek,td,bb,nadi,suhu,rr,spo,pf,planing,kdcabang,alergi,tdd,hr,tb,rwytp,subjekp,
    tglkontrol,rencanatindakan,stspulang,skalanyeri,imt,riwayatdahulu,riwayatkeluarga) 
 values('$kduser','$notrans','$tgl','$norm','$kddokter','$kdpoli','$subjek','$td','$bb','$nadi',
 '$suhu','$rr','$spo','$pf','$planing','$kdcabang','$alergi','$tdd','$hr','$tb','$rwytp','$subjekp',
 '$tglkontrol','$rencanatindakan','$stspulang','$skalanyeri','$imt','$riwayatdahulu','$riwayatkeluarga')");






$conn -> query("UPDATE kunjunganpasien set

koreksierm='SUDAH' where notransaksi='$notrans' and
 kdcabang='$kdcabang'");
 

$conn -> query("UPDATE ermcpptintruksi set

kirim='Ya' where notransaksi='$notrans' and
 kdcabang='$kdcabang' and kdcppt='$kdcppt'");
 

$conn -> query("UPDATE jualobatd set

kirim='Ya' where 
 kdcabang='$kdcabang' and kdcppt='$kdcppt'");




 $conn -> query("UPDATE antrian set

status='SELESAI' where notransaksi='$notrans' and
 kdcabang='$kdcabang' ");

}


 

}





$kdcppt = $notrans.''.$kddokter;


 $sql="SELECT kirim FROM jualobatd WHERE nofaktur='$notrans' AND kdcppt='$kdcppt' AND STATUS='0'";



$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){

$kirimf=1;


}else{

$kirimf=0;

}




  $kirimfl = array(
         'metadata'=>array(
            'code'=> 200,
            'message'=>'Berhasil Simpanxxx',
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






}else if($stssimpan === '3'){











}
   

 




?>