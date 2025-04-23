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











$stssimpan=$data->stssimpan;



if($stssimpan === '1'){

   $conn -> autocommit(FALSE);


$notrans=$data->notrans;

$kddokter=$data->kddokter;
$kddokterasal=$data->kddokterasal;
   $notransasal=$data->notransasal;
  
if(empty($data->isi)){
$isi='';
}else{

$isi=str_replace("'"," ` ",$data->isi);

}
 $conn -> query("INSERT INTO konsultasirj(notransasal,notrans,kddokterasal,kddokter,isi,kdcabang) 
 values('$notransasal','$notrans','$kddokterasal','$kddokter','$isi','$kdcabang')");







     



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


$notrans=$data->notrans;


  $conn -> query("DELETE FROM konsultasirj where notrans='$notrans'  and kdcabang='$kdcabang' ");


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