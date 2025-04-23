<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
 

 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);





  $stssimpan = $data->stssimpan;



if($stssimpan === '1'){

   $conn -> autocommit(FALSE);



  $kdcabang=$data->kdcabang;
  $kdklinik=$data->kdklinik;
 $costumer= strtoupper($data->kelompok);  
$keltarif = $data->keltarif;

$query="SELECT angka from autonum where kdnomor='10' and kdklinik='$kdklinik'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$angka = $row['angka']+1;
}

$kdcabangf = 'CUS'.$kdcabang.$angka;

$queryx="SELECT jenis from tarif where kdtarifm='$keltarif' and kdcabang='$kdcabang'";
$resultx=mysqli_query($conn, $queryx);
while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {

$jenis = $rowx['jenis'];
}





  $conn -> query("INSERT INTO kelompokkostumer(kdkostumer,costumer,kdklinik,kdcabang,kdtarif,dash) 
 values('$kdcabangf','$costumer','$kdklinik','$kdcabang','$keltarif','$jenis')");
  $conn -> query("DELETE FROM kelompokkostumer where costumer=''");


$conn -> query("UPDATE autonum set angka='$angka' where kdklinik='$kdklinik' and  kdnomor='10' ");



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
  $kdcabang=$data->kdcabang;
  $kdklinik=$data->kdklinik;
 $costumer= strtoupper($data->kelompok);  
$keltarif = $data->keltarif;

  $kdkelompok=$data->kdkelompok;

$conn -> query("UPDATE kelompokkostumer set costumer='$costumer',kdtarif='$keltarif' where kdcabang='$kdcabang' and kdkostumer='$kdkelompok'");


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
 
  
   $kdcabang=$data->kdcabang;
  $kdklinik=$data->kdklinik;


  $kdkelompok=$data->kdkelompok;
  $status=$data->statusaktif;







$conn -> query("UPDATE kelompokkostumer set status='$status' where kdcabang='$kdcabang' and kdkostumer='$kdkelompok'");
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
 
  
   $kdcabang=$data->kdcabang;
  $kdklinik=$data->kdklinik;


  $kdkelompok=$data->kdkelompok;
  $status=$data->statusaktif;







$conn -> query("UPDATE tarif set status='$status' where kdcabang='$kdcabang' and kdtarifm='$kdkelompok'");
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