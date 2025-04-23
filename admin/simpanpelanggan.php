<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
  $rest_json = file_get_contents("php://input");
  $_POST = json_decode($rest_json,true);
$data = json_encode( $_POST );

$data = json_decode( $data);

 $stssimpan = $data->stssimpan;


 $kdklinik=$data->kdklinik;
 $klinik=$data->klinik;
$hp=$data->hp;
$alamat=$data->alamat;
$pimpinan=$data->pimpinan;
$kodepos=$data->kodepos;


if($stssimpan === '1'){
  $conn -> autocommit(FALSE);



  $conn -> query("INSERT INTO masterklinik(kdklinik,nama,hp,alamat,pimpinan,kodepos) 
 values('$kdklinik','$klinik','$hp','$alamat','$pimpinan','$kodepos')");
 $conn -> query("DELETE FROM masterklinik where nama=''");



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



$conn -> query("UPDATE masterklinik set nama='$klinik',hp='$hp',alamat='$alamat',pimpinan='$pimpinan',kodepos='$kodepos'

  where kdklinik='$kdklinik' ");



// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode('Berhasil Edit');

}

// Rollback transaction
$conn -> rollback();

$conn -> close();

}else if($stssimpan === '3'){
   $conn -> autocommit(FALSE);



  $conn -> query("DELETE FROM masterklinik where kdklinik='$kdklinik'");



// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode('Berhasil Edit');

}

// Rollback transaction
$conn -> rollback();

$conn -> close();
}
   

 





?>