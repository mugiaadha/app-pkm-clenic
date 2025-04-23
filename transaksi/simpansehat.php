<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
 

 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);

















$stssimpan=$data->stssimpan;



if($stssimpan === '1'){

 $conn -> autocommit(FALSE);

  

$nokartu=$data->nokartu;

$nama=$data->nama;
$kdpolibpjs=$data->kdpolibpjs;
$tgl=$data->tgl;
 $nomor = $data->nomor;
  

 $conn -> query("INSERT INTO kunjungansehat(nokartu,nama,kdpolibpjs,tgl,nomor) 
 values('$nokartu','$nama','$kdpolibpjs','$tgl','$nomor')");






     



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




}
   

 




?>