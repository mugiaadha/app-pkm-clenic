<?php
 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  


 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);


$tgldaftar = date("Y-m-d H:i");





  include '../koneksi.php';
  



$kdcabang=$data->kdcabang;

$kduser=$data->kduser;

$stssimpan=$data->stssimpan;

$status=$data->status;



if($stssimpan === '1'){


 $conn -> autocommit(FALSE);
 


$conn -> query("UPDATE user set status='1' where kdcabang='$kdcabang' and username='$kduser'");





// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode($pesan );

}

// Rollback transaction
$conn -> rollback();

$conn -> close();



}else if($stssimpan === '2'){



 $conn -> autocommit(FALSE);
 






// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode($pesan );

}

// Rollback transaction
$conn -> rollback();

$conn -> close();

}else if($stssimpan === '3'){


 $conn -> autocommit(FALSE);





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

