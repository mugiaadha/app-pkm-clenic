<?php  



include 'config.php';
 include '../koneksi.php';

$kdcabang='004';
$statust='RI';
$tglb='2023-05-21';
$tgla='2023-05-21';



 
$sql = "SELECT * from PINDAHTARIFCL WHERE  parent='TRD00415'  ";


$result = sqlsrv_query( $connc, $sql );

 while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
 { 
 

$kdtarifmasli = $row['kdtarifmasli'];
$parent = $row['parent'];
$kdtarif = $row['kdtarif'];
$nama = $row['nama'];
$tarif = $row['tarif'];

   $conn -> query("INSERT INTO tarifdetail(kdtarifmasli,kdtarifm,kdtarif,nama,harga,kdcabang,statust,tglberlaku,tglberakhir) 
 values('$kdtarifmasli','$parent','$kdtarif','$nama','$tarif','$kdcabang','$statust','$tglb','$tgla')");



// $jasaklinik=$row['jsrs'];
// $jasadokter=$row['jasdok'];
// $jasapel=$row['jaspel'];
// $jasasewa=$row['jswtmpt'];
// $jasaalat=$row['jswal'];
// $jasaasisdok=$row['jsasisten'];
// $jasajp=$row['jasper'];
// $jasdokp=$row['jdp'];
// $jasabhp=$row['jbhp'];




// if($jasaklinik === NULL ){

// }else{
//   $conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
//  values('$kdtarif','1','$jasaklinik','$kdcabang')");

// }

// if($jasadokter === NULL){
 
// }else{
//  $conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
//  values('$kdtarif','3','$jasadokter','$kdcabang')");
// }

// if($jasapel === NULL){

// }else{
// $conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
//  values('$kdtarif','2','$jasapel','$kdcabang')");
// }

// if($jasasewa === NULL){

// }else{
// $conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
//  values('$kdtarif','4','$jasasewa','$kdcabang')");
// }

// if($jasaalat === NULL){

// }else{
// $conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
//  values('$kdtarif','5','$jasaalat','$kdcabang')");
// }

// if($jasaasisdok === NULL){

// }else{
// $conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
//  values('$kdtarif','6','$jasaasisdok','$kdcabang')");
// }

// if($jasajp === NULL){

// }else{
// $conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
//  values('$kdtarif','7','$jasajp','$kdcabang')");
// }


// if($jasdokp === NULL){

// }else{
// $conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
//  values('$kdtarif','8','$jasdokp','$kdcabang')");
// }

// if($jasabhp === NULL){

// }else{
// $conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
//  values('$kdtarif','9','$jasabhp','$kdcabang')");
// }




// $sqlxxll ="UPDATE PINDAHTARIFCL set  status='1'   WHERE  statust = 'RI'  and tarif is not null  ";
//   $outp=sqlsrv_query($connc,$sqlxxll);





}

 ?>