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

  $kdcabang=$data->kdcabang;
  $kdklinik=$data->kdklinik;
$stssimpan = $data->stssimpan;
$notrans=$data->notrans;
$notransri=$data->notransri;
 $kdpoli=$data->kdpoli;
$kdtf=$data->kdtf;
$nmtf=$data->nmtf;
$kridit=$data->kridit;
$harga=$data->harga;
$user=$data->user;
$norm=$data->norm;
$kdkostumerd=$data->kdkostumerd;
if($stssimpan === '1'){
     $conn -> autocommit(FALSE);


      $sql="SELECT nomor from transaksipasiend where nofaktur='$notransri' and kdcabang='$kdcabang' 
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

    $conn -> query("INSERT INTO transaksiakhir(notrans,nomor,tglfaktur,waktu,norm,kdpoli,kdkostumer,jenistransaksi,
     namabank,
     totalcash,totalpiutang,tagihan,transfer

     ,kdcabang,keterangan,user,status) 
  values('$notrans','$nomor','$tgl','$tgl','$norm','$kdpoli','$kdkostumerd','2',''
  ,'0','0','$kridit','$kridit','$kdcabang','Lab Transfer Tagihan Ke RI','$user','1')");









  $conn -> query("INSERT INTO transaksipasiend(notransaksi,nofaktur,tgltransaksi,waktu,nomor,kdproduk,produk,kdpoli,
    qty,harga,debet,kridit,jenistransaksi,tarifasli,disc,kdcabang,user,ri) 
 values('$notrans','$notransri','$tgl','$tgl','$nomor','$kdtf','$nmtf','$kdpoli','1',
 '$harga','$harga','0'

 ,'KR','0','0','$kdcabang','$user','1')");


  $conn -> query("INSERT INTO transaksipasiend(notransaksi,nofaktur,tgltransaksi,waktu,nomor,kdproduk,produk,kdpoli,
    qty,harga,debet,kridit,jenistransaksi,tarifasli,disc,kdcabang,user,ri) 
 values('$notrans','$notrans','$tgl','$tgl','$nomor','$kdtf','$nmtf','$kdpoli','1',
 '$harga','0','$kridit'

 ,'KR','0','0','$kdcabang','$user','0')");

   



$conn -> query("DELETE from transaksipasiend  where harga <= 0 and kdcabang='$kdcabang'");



$conn -> query("UPDATE kunjunganpasien set

layan='1'  where nofaktur='$notrans' 
 and kdcabang='$kdcabang'");






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


      $sql="SELECT nomor from transaksipasiend where nofaktur='$notransri' and kdcabang='$kdcabang' 
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

    $conn -> query("INSERT INTO transaksiakhir(notrans,nomor,tglfaktur,waktu,norm,kdpoli,kdkostumer,jenistransaksi,
     namabank,
     totalcash,totalpiutang,tagihan,transfer

     ,kdcabang,keterangan,user,status) 
  values('$notrans','$nomor','$tgl','$tgl','$norm','$kdpoli','$kdkostumerd','2',''
  ,'0','0','$kridit','$kridit','$kdcabang','Rad Transfer Tagihan Ke RI','$user','1')");









  $conn -> query("INSERT INTO transaksipasiend(notransaksi,nofaktur,tgltransaksi,waktu,nomor,kdproduk,produk,kdpoli,
    qty,harga,debet,kridit,jenistransaksi,tarifasli,disc,kdcabang,user,ri) 
 values('$notrans','$notransri','$tgl','$tgl','$nomor','$kdtf','$nmtf','$kdpoli','1',
 '$harga','$harga','0'

 ,'KR','0','0','$kdcabang','$user','1')");


  $conn -> query("INSERT INTO transaksipasiend(notransaksi,nofaktur,tgltransaksi,waktu,nomor,kdproduk,produk,kdpoli,
    qty,harga,debet,kridit,jenistransaksi,tarifasli,disc,kdcabang,user,ri) 
 values('$notrans','$notrans','$tgl','$tgl','$nomor','$kdtf','$nmtf','$kdpoli','1',
 '$harga','0','$kridit'

 ,'KR','0','0','$kdcabang','$user','0')");

   



$conn -> query("DELETE from transaksipasiend  where harga <= 0 and kdcabang='$kdcabang'");



$conn -> query("UPDATE kunjunganpasien set

layan='1'  where nofaktur='$notrans' 
 and kdcabang='$kdcabang'");






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


      $sql="SELECT nomor from transaksipasiend where nofaktur='$notransri' and kdcabang='$kdcabang' 
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

    $conn -> query("INSERT INTO transaksiakhir(notrans,nomor,tglfaktur,waktu,norm,kdpoli,kdkostumer,jenistransaksi,
     namabank,
     totalcash,totalpiutang,tagihan,transfer

     ,kdcabang,keterangan,user,status) 
  values('$notrans','$nomor','$tgl','$tgl','$norm','$kdpoli','$kdkostumerd','2',''
  ,'0','0','$kridit','$kridit','$kdcabang','$nmtf','$user','1')");









  $conn -> query("INSERT INTO transaksipasiend(notransaksi,nofaktur,tgltransaksi,waktu,nomor,kdproduk,produk,kdpoli,
    qty,harga,debet,kridit,jenistransaksi,tarifasli,disc,kdcabang,user,ri) 
 values('$notrans','$notransri','$tgl','$tgl','$nomor','$kdtf','$nmtf','$kdpoli','1',
 '$harga','$harga','0'

 ,'KR','0','0','$kdcabang','$user','1')");


  $conn -> query("INSERT INTO transaksipasiend(notransaksi,nofaktur,tgltransaksi,waktu,nomor,kdproduk,produk,kdpoli,
    qty,harga,debet,kridit,jenistransaksi,tarifasli,disc,kdcabang,user,ri) 
 values('$notrans','$notrans','$tgl','$tgl','$nomor','$kdtf','$nmtf','$kdpoli','1',
 '$harga','0','$kridit'

 ,'KR','0','0','$kdcabang','$user','0')");

   



$conn -> query("DELETE from transaksipasiend  where harga <= 0 and kdcabang='$kdcabang'");



$conn -> query("UPDATE kunjunganpasien set

layan='1'  where nofaktur='$notrans' 
 and kdcabang='$kdcabang'");






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
}

?>