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

 $kddokter= $data->kddokter;  
 $nama= strtoupper($data->nama);  
 $detail= strtoupper($data->detail);  

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





  $conn -> query("INSERT INTO tsubjek(kdtamplate , nama , detail , status , kddokter , kdcabang
) 
 values('$kdcabangf','$nama','$detail','$status','$kddokter','$kdcabang')");

  $conn -> query("DELETE FROM tsubjek where nama=''");


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

  $kdtamplate=$data->kdtamplate;




$conn -> query("DELETE from  tsubjek  where kdcabang='$kdcabang' and kdtamplate='$kdtamplate'");


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