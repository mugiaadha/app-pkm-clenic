<?php

 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
 

 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);


$kdklinik=$data->kdklinik;
$kdcabang=$data->kdcabang;
$kdtamplate=$data->kdtamplate;
$kddokter= $data->kddokter;  
$kdobat= $data->obat;  
$aturan= $data->aturan; 

$qty= $data->qty; 

$nama= $data->nama;  
$keterangan= $data->keterangan;  
$status= $data->status;  

$stssimpan = $data->stssimpan;

 


if($stssimpan === '1'){

$conn -> autocommit(FALSE);




$query="SELECT angka from autonum where kdnomor='12' and kdklinik='$kdklinik'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$angka = $row['angka']+1;
}

$kdcabangf = 'TM'.$kdcabang.$angka;



 $conn -> query("INSERT INTO tplaning(kdtamplated,kdtamplate , kddokter , 
    nama , kdobat , obat , aturan,qty,
    satuan,keterangan,status,kdcabang) 
 values('$kdtamplate','$kdcabangf','$kddokter','$nama','$kdobat','','$aturan','$qty','','$keterangan','$status','$kdcabang')");



  $conn -> query("DELETE FROM tplaning where nama=''");


$conn -> query("UPDATE autonum set angka='$angka' where kdklinik='$kdklinik' and  kdnomor='12' ");



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

  $kdtamplate=$data->kdtamplate;

$conn -> query("UPDATE tsubjek set nama='$nama',detail='$detail' where kdcabang='$kdcabang' and kdtamplate='$kdtamplate'");


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

 
  $kdtamplatex=$data->kdtamplatex;


$conn -> query("DELETE from  tplaning  where kdcabang='$kdcabang' and kdtamplate='$kdtamplatex'");


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

 $conn -> query("INSERT INTO autonumobat(kdtamplatem,kdcabang,kduser ) 
 values('$kdtamplate','$kdcabang','$kddokter')");

// $conn -> query("DELETE from  autonumobat  where kdtamplatem=''");

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

 


$conn -> query("DELETE from  tplaning  where kdcabang='$kdcabang' and kdtamplated='$kdtamplate'");
$conn -> query("DELETE from  tplaningr  where kdcabang='$kdcabang' and kdtamplated='$kdtamplate'");


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