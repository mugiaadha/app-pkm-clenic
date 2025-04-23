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
  $notrans=$data->notrans;
  $kddokter=$data->kddokter;









$conn -> autocommit(FALSE);





$conn -> query("UPDATE kunjunganpasien set

kddokter='$kddokter' where notransaksi='$notrans' and kdcabang='$kdcabang'");

$conn -> query("UPDATE antrian set

kddokter='$kddokter' where notransaksi='$notrans' and kdcabang='$kdcabang'");








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






?>