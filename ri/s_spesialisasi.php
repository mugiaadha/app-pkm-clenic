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
$nama = $data->nama;
$stssimpan = $data->stssimpan;





if($stssimpan === '1'){

$conn -> autocommit(FALSE);
$kdpoli = $data->kdpoli;

$query="SELECT angka from autonum where kdnomor='31' and kdcabang='$kdcabang'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$angka = $row['angka']+1;
}



$kdspesial = 'SP'.$kdcabang.$angka;





  $conn -> query("INSERT INTO spesialis(kdspesial,nama,kdcabang,kdpoli) 
 values('$kdspesial','$nama','$kdcabang','$kdpoli')");


  $conn -> query("DELETE FROM spesialis where nama=''");


$conn -> query("UPDATE autonum set angka='$angka' where kdcabang='$kdcabang' and  kdnomor='31' ");







// Insert some values




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

$kdpoli = $data->kdpoli;
$kdspesial = $data->kdspesial;





$conn -> query("UPDATE spesialis set nama='$nama',kdpoli='$kdpoli'
  where kdcabang='$kdcabang' and  kdspesial='$kdspesial' ");







// Insert some values




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


$kdspesial = $data->kdspesial;




$conn -> query("DELETE from spesialis where kdcabang='$kdcabang' and  kdspesial='$kdspesial'");


// Insert some values




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


$kdspesial = $data->kdspesial;
$kddokter = $data->kddokter;



$conn -> query("UPDATE dokter set kdspesial='$kdspesial'
  where kdcabang='$kdcabang' and  kddokter='$kddokter' ");











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



$kddokter = $data->kddokter;



$conn -> query("UPDATE dokter set kdspesial=''
  where kdcabang='$kdcabang' and  kddokter='$kddokter' ");











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