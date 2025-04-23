<?php

 
 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
 

 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);






$stssimpan = $data->stssimpan;


  $conn -> autocommit(FALSE);


$kdgudang = $data->kdgudang;

 $sqlsaldo="SELECT * from userpcare where consid='$data->consid'";

  $resultsaldo=mysqli_query($conn,$sqlsaldo);
   $rowcountsaldo=mysqli_num_rows($resultsaldo);
    
  if($rowcountsaldo > 0){
$conn -> query("UPDATE userpcare set username='$data->username',password='$data->password'
                 where consid='$data->consid'");




     }else{

    

$conn -> query("INSERT INTO userpcare(consid,screetkey,username,password,userkey,userkantrean) 
   values('$data->consid','$data->screetkey','$data->username','$data->password','$data->userkey','$data->userkantrean')");

 $conn -> query("DELETE from userpcare  where consid=''");


}

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