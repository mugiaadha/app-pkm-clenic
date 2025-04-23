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









$stssimpan=$data->stssimpan;


if($stssimpan === '1'){

   $conn -> autocommit(FALSE);
  


  
  $conn -> query("INSERT INTO emrlaporantindakandokter(notrans,norm,perawat,dokter,preop,postop,jaringan,pa,jenis,tgltindakan,jamtindakan,jamselesai,laporan) 
 values(
 '$data->notrans',
 '$data->norm',
 '$data->perawat',
 '$data->dokter',
 '$data->preop',
 '$data->postop',
 '$data->jaringan',
  '$data->pa',
  '$data->jenis',
  '$data->tgltindakan',
  '$data->jamtindakan',
  '$data->jamselesai',
  '$data->laporan')");




     




if (!$conn -> commit()) {
  // echo "Commit transaction failed";

  $value = array(
    "kode"=>201,
    "pesan"=>"gagal"
  

);


    echo json_encode($value);
 

  exit();
}else{
  $value = array(
    "kode"=>200,
    "pesan"=>"Suksesx"
  

);


    echo json_encode($value);

}

// Rollback transaction
$conn -> rollback();

$conn -> close();



}else if($stssimpan === '2'){

  
     $conn -> autocommit(FALSE);
  


   $conn -> query("DELETE FROM emrlaporantindakandokter where notrans='$data->notrans'");


// Commit transaction

if (!$conn -> commit()) {
  // echo "Commit transaction failed";

  $value = array(
    "kode"=>201,
    "pesan"=>"gagal"
  

);


    echo json_encode($value);
 

  exit();
}else{
  $value = array(
    "kode"=>200,
    "pesan"=>"Suksesx"
  

);


    echo json_encode($value);

}

// Rollback transaction
$conn -> rollback();

$conn -> close();




}else if($stssimpan === '3'){




}
   

 




?>