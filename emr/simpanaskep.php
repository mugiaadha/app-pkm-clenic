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
  



  
  $conn -> query("INSERT INTO emrasesmenkep( ku,
 rps,
 bb,
 tb,
 imt,
 lingkarkepala,
 mobil,
 toilet,
 makan,
 mandi,
 berpakaian,
 hasil,
 psikologis,
 sosialekonomi,
 masalah,
 rencana,
 notransaksi,
tgl,
 kduser,norm) 
 values(
 '$data->ku',
 '$data->rps',
 '$data->bb',
 '$data->tb',
 '$data->imt',
 '$data->lingkarkepala',
 '$data->mobil',
  '$data->toilet',
  '$data->makan',
  '$data->mandi',
  '$data->berpakaian',
  '$data->hasil',
  '$data->psikologis',
  '$data->sosialekonomi',
  '$data->masalah',
  '$data->rencana',
  '$data->notransaksi',
  '$tgl',
  '$data->kduser','$data->norm')");




     




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
  


   $conn -> query("DELETE FROM emrasesmenkep where notransaksi='$data->notransaksi'");


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