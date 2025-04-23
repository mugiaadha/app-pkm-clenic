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


$stssimpan =$data->stssimpan;

$notransaksi =  $data->notransaksi;






if($stssimpan === '1'){
$conn -> autocommit(FALSE);
$aturan =$data->aturan;

$conn -> query("UPDATE ermcpptintruksi set kdObatSK='$data->kdObatSK',kdRacikan='$data->kdRacikan'
where  notransaksi='$notransaksi' and dari='obat' and kdpruduk='$data->kdpruduk'");





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
  
  
 $conn -> query("UPDATE antrian set

 status='SELESAI' where notransaksi='$notransaksi'");
 
  
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
  
  
 $conn -> query("UPDATE antrian set

 statusantrian='TERKIRIM' where notransaksi='$notransaksi'");
 
  
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
  
  
 $conn -> query("UPDATE antrian set

 statusantrian='HADIR' where notransaksi='$notransaksi'");
 
  
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