<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
 

 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);


$tgl = date("Y-m-d H:i:s");






$tgltransaksi = $tgl;
$nofaktur = $data->notrans;
$kdkostumerd   = $data->kdkostumerd;
$norm = $data->norm;
$kddokter = $data->kddokter;
$kdpoli = $data->kdpoli;

$kdproduk  = $data->nmobat;





if(empty( $data->qtyk)){
$qty=0;
}else{
$qty = $data->qtyk;
}




if(empty( $data->frek)){
$frek='';
}else{
$frek = $data->frek;
}


if(empty( $data->jmlhari)){
$jmlhari='';
}else{
$jmlhari = $data->jmlhari;
}




if(empty( $data->jmlpakai)){
$jmlpakai='';
}else{
$jmlpakai = $data->jmlpakai;
}




if(empty( $data->signa)){
$signa='';
}else{
$signa = $data->signa;
}




$kdcppt =   $data->kdcppt;
$dari =   $data->dari;
$kduser =   $data->kduser;
$kdcabang=$data->kdcabang;
$stssimpan = $data->stssimpan;


if(empty( $data->keterangan)){
$keterangan='';
}else{
$keterangan = $data->keterangan;
}



$statuso= $data->statuso;
$cpptdari= $data->cpptdari;



if($stssimpan === '1'){

   $conn -> autocommit(FALSE);



$sql="SELECT hargajual,obat,hargabeli from obat where kdobat='$kdproduk' and kdcabang='$kdcabang' ";

$result=mysqli_query($conn,$sql);

  


while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {



  $hargajual=$row['hargajual'];
  $obat = $row['obat'];
  $hargabeli=$row['hargabeli'];


}

$harga = $qty * $hargajual;



$sql="SELECT nomor from jualobatd where kdcppt='$kdcppt' and kdcabang='$kdcabang' and norm='$norm'
    ORDER BY nomor desc limit 1";

$result=mysqli_query($conn,$sql);
$rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {



  $nomor=$row['nomor']+1;



}

}else{


  $nomor=1;

}







$aturan=$frek.' x '.$jmlpakai.' '.$signa;



  $conn -> query("INSERT INTO ermcpptintruksi(notransaksi,kdkostumerd,norm,kddokter,kdpoli,kdpruduk,aturan,
    qty,statuso,status,dari,kduser,kdcabang,tgl,kdcppt,kunci,tglpriksa,keterangan,harga,nama,no,hargasatuan,dari2,signa,hari,frekuensi,jmlpakai) 
 values('$nofaktur','$kdkostumerd','$norm','$kddokter','$kdpoli','$kdproduk','$aturan','$qty','$statuso','0','$dari','$kduser',
 '$kdcabang','$tgl','$kdcppt','0','$tgl','$keterangan','$harga','$obat','$nomor','$hargajual','CPPT','$signa','$jmlhari','$frek','$jmlpakai')");






 $conn -> query("INSERT INTO jualobatd(tgl,nomor,nofaktur,kdobat,qty,disc,harga,totalharga,kdcabang,kdcppt,norm,dari,status,hargabeli,ri) 
 values('$tgl','$nomor','$nofaktur','$kdproduk','$qty',0,'$hargajual','$harga','$kdcabang','$kdcppt','$norm','CPPT','0','$hargabeli','$cpptdari')");



 $conn -> query("DELETE FROM jualobatd where kdobat='' and kdcabang='$kdcabang'");





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

 $conn -> autocommit(FALSE);

$noracik = $data->noracik;

$sql="SELECT hargajual,obat,hargabeli from obat where kdobat='$kdproduk' and kdcabang='$kdcabang' ";

$result=mysqli_query($conn,$sql);

  


while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {



  $hargajual=$row['hargajual'];
  $obat = $row['obat'];
 $hargabeli=$row['hargabeli'];


}

$harga = $qty * $hargajual;





$sql="SELECT nomor from jualobatd where kdcppt='$kdcppt' and kdcabang='$kdcabang' and norm='$norm'
    ORDER BY nomor desc limit 1";

$result=mysqli_query($conn,$sql);
$rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {



  $nomor=$row['nomor']+1;



}

}else{


  $nomor=1;

}


$aturan='';

  $conn -> query("INSERT INTO ermcpptintruksi(notransaksi,kdkostumerd,norm,kddokter,kdpoli,kdpruduk,aturan,
    qty,statuso,status,dari,kduser,kdcabang,tgl,kdcppt,kunci,tglpriksa,keterangan,harga,nama,kd,no,hargasatuan,dari2) 
 values('$nofaktur','$kdkostumerd','$norm','$kddokter','$kdpoli','$kdproduk','$aturan','$qty','$statuso','0','$dari','$kduser','$kdcabang','$tgl','$kdcppt','0','$tgl','$keterangan','$harga','$obat','$noracik','$nomor','$hargajual','CPPT')");



 $conn -> query("INSERT INTO jualobatd(tgl,nomor,nofaktur,kdobat,qty,disc,harga,totalharga,kdcabang,kdcppt,norm,dari,status,hargabeli,ri) 
 values('$tgl','$nomor','$nofaktur','$kdproduk','$qty',0,'$hargajual','$harga','$kdcabang','$kdcppt','$norm','CPPT','0','$hargabeli','$cpptdari')");


 $conn -> query("DELETE FROM jualobatd where kdobat='' and kdcabang='$kdcabang'");


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

}else if($stssimpan === '3'){
 $conn -> autocommit(FALSE);
$noracik = $data->noracik;
$metode=$data->metode;


$frekracik = $data->frekracik;
$jmlpakairacik= $data->jmlpakairacik;
$aturanracik= $data->aturanracik;
$jmlhariracik= $data->jmlhariracik;


$aturan=$frekracik.' x '.$jmlhariracik.' '.$aturanracik;



  $conn -> query("INSERT INTO ermcpptintruksi(notransaksi,kdkostumerd,norm,kddokter,kdpoli,kdpruduk,nama,aturan,
    qty,statuso,status,dari,kduser,kdcabang,tgl,kdcppt,kunci,tglpriksa,keterangan,kd,dari2,signa,hari,frekuensi,jmlpakai) 
 values('$nofaktur','$kdkostumerd','$norm','$kddokter','$kdpoli','$kdproduk','$metode','$aturan','$qty','$statuso','0','$dari','$kduser',
 '$kdcabang','$tgl','$kdcppt','0','$tgl','$keterangan','$noracik','CPPT','$aturanracik','$jmlhariracik','$frekracik','$jmlpakairacik')");


  $conn -> query("INSERT INTO nomorracik(notransaksi,norm,kdcabang,nomor,status) 
 values('$nofaktur','$norm','$kdcabang','$noracik','0')");





 $conn -> query("DELETE FROM jualobatd where kdobat='' and kdcabang='$kdcabang'");


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

}else if($stssimpan === '4'){



   $conn -> autocommit(FALSE);



$sql="SELECT hargajual,obat,hargabeli from obat where kdobat='$kdproduk' and kdcabang='$kdcabang' ";

$result=mysqli_query($conn,$sql);

  


while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {



  $hargajual=$row['hargajual'];
  $obat = $row['obat'];
  $hargabeli=$row['hargabeli'];


}

$harga = $qty * $hargajual;









$aturan=$frek.' x '.$jmlpakai.' '.$signa;

$no = $data->no;













$sql="SELECT * FROM jualobatd  where nofaktur='$nofaktur'
   and nomor='$no' and kdcabang='$kdcabang' and kdobat='$kdproduk' and status='1'";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){

// $pesan='Tidak Bisa di Edit Obat Karena Sudah Terverif Oleh Farmasi..Silahkan Hubungi Bagian Farmasi';


  $pesan =0;



}else{


 $conn -> query("UPDATE ermcpptintruksi set aturan='$aturan',qty='$qty',harga='$harga',hargasatuan='$hargajual',signa='$signa',hari='$jmlhari',
 frekuensi='$frek',
 jmlpakai='$jmlpakai' where  kdcppt='$kdcppt' and notransaksi='$nofaktur' and norm='$norm' and kdpruduk='$kdproduk' and statuso='Non Racik' and dari='obat' and kdcabang='$kdcabang'
 and no='$no'   ");





$conn -> query("UPDATE jualobatd set qty='$qty',harga='$hargajual' ,totalharga='$harga',hargabeli='$hargabeli'  
  where nomor='$no' and nofaktur='$nofaktur' and kdobat='$kdproduk' and 
norm='$norm' and kdcppt='$kdcppt' and dari ='CPPT' and kdcabang='$kdcabang' and status='0'  ");


$pesan =1;
  
  



}















// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode($pesan);

}

// Rollback transaction
$conn -> rollback();

$conn -> close();



}else if($stssimpan === '5'){





}
   

 




?>