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


 $kdproduk= $data->kdproduk;  

 $kdtes= $data->kdtes;  



  $stssimpan = $data->stssimpan;




if($stssimpan === '1'){

   $conn -> autocommit(FALSE);







  $conn -> query("INSERT INTO mapinglaborat(kdproduk , kdtes , kdcabang) 
 values('$kdproduk','$kdtes','$kdcabang')");





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



$conn -> query("DELETE FROM mapinglaborat where kdproduk='$kdproduk' and kdtes='$kdtes' and kdcabang='$kdcabang'");

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