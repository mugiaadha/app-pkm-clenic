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
 $nama= $data->nama;  

  $kode=$data->kode;
  $stssimpan = $data->stssimpan;

 $jenistarif=$data->jenistarif;

if($stssimpan === '1'){

   $conn -> autocommit(FALSE);




$query="SELECT angka from autonum where kdnomor='13' and kdklinik='$kdklinik'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$angka = $row['angka']+1;
}

$kdcabangf = 'TR'.$kdcabang.$angka;




  $conn -> query("INSERT INTO tarif(kdtarifm,nama,kode,kdcabang,jenis) 
 values('$kdcabangf','$nama','$kode','$kdcabang','$jenistarif')");
  $conn -> query("DELETE FROM tarif where nama=''");


$conn -> query("UPDATE autonum set angka='$angka' where kdklinik='$kdklinik' and  kdnomor='13' ");



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

  $kdtarifm=$data->kdkelompok;

$conn -> query("UPDATE tarif set nama='$nama',kode='$kode' where kdcabang='$kdcabang' and kdtarifm='$kdtarifm'");


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
 
   $kdtarifm=$data->kdkelompok;
  $status=$data->statusaktif;







$conn -> query("UPDATE tarif set status='$status' where kdcabang='$kdcabang' and kdtarifm='$kdtarifm'");

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