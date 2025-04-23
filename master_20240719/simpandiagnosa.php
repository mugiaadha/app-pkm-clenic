<?php

 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
 

 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);



$stssimpan  = $data->stssimpan;

 


if($stssimpan === '1'){

$conn -> autocommit(FALSE);
$kddiagnosa =  $data->kddiagnosa; 
$diagnosa = $data->diagnosa;
$freetext = $data->freetext;

 $conn -> query("INSERT INTO mdiagnosa(kddiagnosa,diagnosa , freetext ) 
 values('$kddiagnosa','$diagnosa','$freetext')");







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

  $kddiagnosa=$data->kddiagnosa;


$conn -> query("DELETE from  mdiagnosa  where kddiagnosa='$kddiagnosa' ");


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
$kdtindakan =  $data->kdtindakan; 
$tindakan = $data->tindakan;
 

 $conn -> query("INSERT INTO mtindakan(kdtindakan,tindakan  ) 
 values('$kdtindakan','$tindakan')");


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

  $kdtindakan=$data->kdtindakan;


$conn -> query("DELETE from  mtindakan  where kdtindakan='$kdtindakan' ");

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

 


$conn -> query("DELETE from  tplaning  where kdcabang='$kdcabang' and kdtamplated='$kdtamplate'");
$conn -> query("DELETE from  tplaningr  where kdcabang='$kdcabang' and kdtamplated='$kdtamplate'");


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