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


$norm = $data->norm;
$kdpoli = $data->kdpoli;
$kddokter  = $data->kddokter;
$kduser  = $data->kduser;
$kdcppt  = $data->kdcppt;
$stssimpan =$data->stssimpan;
$kdcabang =$data->kdcabang;
$notransaksi =  $data->notransaksi;
$no =  $data->no;

$kdpruduk = $data->kdpruduk;
// $kdtamplated =$data->kdtamplated;




if($stssimpan === '1'){
$conn -> autocommit(FALSE);
$aturan =$data->aturan;
$conn -> query("UPDATE ermcpptintruksi set aturan='$aturan' where kdcppt='$kdcppt' and notransaksi='$notransaksi' and norm='$norm' and kdpruduk='$kdpruduk' and statuso='Non Racik' and dari='obat' and kdcabang='$kdcabang'
 and no='$no'");





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


$keterangan =$data->keterangan;
$conn -> query("UPDATE ermcpptintruksi set keterangan='$keterangan' where kdcppt='$kdcppt' and notransaksi='$notransaksi' and norm='$norm' and kdpruduk='$kdpruduk' and statuso='Non Racik' and dari='obat' and kdcabang='$kdcabang' and no='$no'");




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


$qty =$data->qty;
$harga =$data->harga;

$sql="SELECT hargajual from obat where kdobat='$kdpruduk' and kdcabang='$kdcabang' ";

$result=mysqli_query($conn,$sql);

  


while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {



  $hargajual=$row['hargajual'];




}

$total = $qty * $hargajual;


$conn -> query("UPDATE ermcpptintruksi set qty='$qty',harga='$total' where kdcppt='$kdcppt' and notransaksi='$notransaksi' and norm='$norm' and kdpruduk='$kdpruduk' and statuso='Non Racik' and dari='obat' and kdcabang='$kdcabang'  and no='$no'");



$conn -> query("UPDATE jualobatd set qty='$qty',totalharga='$total' where kdcppt='$kdcppt' and nofaktur='$notransaksi' and norm='$norm' and kdobat='$kdpruduk'  and kdcabang='$kdcabang'  and nomor='$no'");


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


$qty =$data->qty;
$harga =$data->harga;

$sql="SELECT hargajual from obat where kdobat='$kdpruduk' and kdcabang='$kdcabang' ";

$result=mysqli_query($conn,$sql);

  


while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {



  $hargajual=$row['hargajual'];




}

$total = $qty * $hargajual;


$conn -> query("UPDATE ermcpptintruksi set qty='$qty',harga='$total' where kdcppt='$kdcppt' and notransaksi='$notransaksi' and norm='$norm' and kdpruduk='$kdpruduk' and statuso='Racik' and dari='obat'
 and kdcabang='$kdcabang' and no='$no'");



$conn -> query("UPDATE jualobatd set qty='$qty',totalharga='$total' where kdcppt='$kdcppt' and nofaktur='$notransaksi' and norm='$norm' and kdobat='$kdpruduk'  and kdcabang='$kdcabang' and nomor='$no'");


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

}else if($stssimpan === '5'){


$conn -> autocommit(FALSE);


$keterangan =$data->keterangan;
$conn -> query("UPDATE ermcpptintruksi set keterangan='$keterangan' where kdcppt='$kdcppt' and notransaksi='$notransaksi' and norm='$norm' and kdpruduk='$kdpruduk' and statuso='Racik' and dari='obat' and kdcabang='$kdcabang' and no='$no'");




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