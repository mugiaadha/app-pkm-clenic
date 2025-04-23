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
  $kdklinik=$data->kdklinik;
 $nama= strtoupper($data->nama);  
  $harga=$data->harga;
  $kdtarifm=$data->kdtarifm;
  $jenist=$data->jenist;
  $stssimpan = $data->stssimpan;




  $jasaklinik=$data->jasaklinik;
  $jasadokter=$data->jasadokter;
  $jasapel=$data->jasapel;
  $jasasewa=$data->jasasewa;
  $jasaalat=$data->jasaalat;
  $jasaasisdok=$data->jasaasisdok;

 $jasaalat=$data->jasaalat;
  $jasaasisdok=$data->jasaasisdok;

$jasdokp=$data->jasdokp;
$jasajp=$data->jasajp;
$kdbapak=$data->kdbapak;
$jasabhp=$data->jasabhp;


if($stssimpan === '1'){

   $conn -> autocommit(FALSE);


  $tglb=$data->tglb;
  $tgla=$data->tgla;

$query="SELECT angka from autonum where kdnomor='14' and kdklinik='$kdklinik'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$angka = $row['angka']+1;
}

$kdcabangf = 'TRD'.$kdcabang.$angka;


 




  $conn -> query("INSERT INTO tarifdetail(kdtarifmasli,kdtarifm,kdtarif,nama,harga,kdcabang,statust,tglberlaku,tglberakhir,kdTindakan) 
 values('$kdtarifm','$kdbapak','$kdcabangf','$nama','$harga','$kdcabang','$jenist','$tglb','$tgla','$data->tbpjs')");




if($jasaklinik > 0){
  $conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
 values('$kdcabangf','1','$jasaklinik','$kdcabang')");

}else{

}

if($jasadokter > 0){
  $conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
 values('$kdcabangf','3','$jasadokter','$kdcabang')");
}else{

}

if($jasapel > 0){
$conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
 values('$kdcabangf','2','$jasapel','$kdcabang')");
}else{

}

if($jasasewa > 0){
$conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
 values('$kdcabangf','4','$jasasewa','$kdcabang')");
}else{

}

if($jasaalat > 0){
$conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
 values('$kdcabangf','5','$jasaalat','$kdcabang')");
}else{

}

if($jasaasisdok > 0){
$conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
 values('$kdcabangf','6','$jasaasisdok','$kdcabang')");
}else{

}

if($jasajp > 0){
$conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
 values('$kdcabangf','7','$jasajp','$kdcabang')");
}else{

}


if($jasdokp > 0){
$conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
 values('$kdcabangf','8','$jasdokp','$kdcabang')");
}else{

}

if($jasabhp > 0){
$conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
 values('$kdcabangf','9','$jasabhp','$kdcabang')");
}else{

}


  $conn -> query("DELETE FROM tarifdetail where nama=''");


$conn -> query("UPDATE autonum set angka='$angka' where kdklinik='$kdklinik' and  kdnomor='14' ");




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

  $kdtarif=$data->kdtarif;

  $tglb=$data->tglb;
  $tgla=$data->tgla;


   $conn -> query("DELETE FROM tarifkomponen  where kdcabang='$kdcabang' and kdtarif='$kdtarif'");




$conn -> query("UPDATE tarifdetail set nama='$nama',harga='$harga',kdTindakan='$data->tbpjs'  where kdcabang='$kdcabang' and kdtarif='$kdtarif'");






if($jasaklinik > 0){
  $conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
 values('$kdtarif','1','$jasaklinik','$kdcabang')");

}else{

}

if($jasadokter > 0){
  $conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
 values('$kdtarif','3','$jasadokter','$kdcabang')");
}else{

}

if($jasapel > 0){
$conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
 values('$kdtarif','2','$jasapel','$kdcabang')");
}else{

}

if($jasasewa > 0){
$conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
 values('$kdtarif','4','$jasasewa','$kdcabang')");
}else{

}

if($jasaalat > 0){
$conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
 values('$kdtarif','5','$jasaalat','$kdcabang')");
}else{

}

if($jasaasisdok > 0){
$conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
 values('$kdtarif','6','$jasaasisdok','$kdcabang')");
}else{

}



if($jasajp > 0){
$conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
 values('$kdtarif','7','$jasajp','$kdcabang')");
}else{

}


if($jasdokp > 0){
$conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
 values('$kdtarif','8','$jasdokp','$kdcabang')");
}else{

}

if($jasabhp > 0){
$conn -> query("INSERT INTO tarifkomponen(kdtarif,kdkomponen,harga,kdcabang) 
 values('$kdtarif','9','$jasabhp','$kdcabang')");
}else{

}



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
 
  $kdtarif=$data->kdtarif;
  // $status=$data->statusaktif;






    $sql="SELECT * from transaksipasiend where  kdcabang='$kdcabang' and kdproduk='$kdtarif'";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){

$pesan='Kd Tarif Tidak bisa di hapus karena sudah di pakai';


}else{

 $conn -> query("DELETE FROM tarifkomponen  where kdcabang='$kdcabang' and kdtarif='$kdtarif'");

 $conn -> query("DELETE FROM tarifdetail  where kdcabang='$kdcabang' and kdtarif='$kdtarif'");

$pesan='Berhasil';

}







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
}
   

 




?>