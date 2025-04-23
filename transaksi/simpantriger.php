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
  $totaltagihan=$data->totaltagihan;
  $sudahdibayar=$data->sudahdibayar;
  $sisa=$data->sisa;







$conn -> autocommit(FALSE);


  $sql="SELECT *  from trigerbayar where notrans='$notrans' and kdcabang='$kdcabang' and status='1'";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){


$conn -> query("UPDATE trigerbayar set

totaltagihan='$totaltagihan' where notrans='$notrans' and kdcabang='$kdcabang' and status='1'");

}else{

$conn -> query("INSERT INTO trigerbayar(notrans,totaltagihan,sudahdibayar,sisa,kdcabang,status) 
 values('$notrans','$totaltagihan','$sudahdibayar','0','$kdcabang','1')");


  $conn -> query("DELETE FROM trigerbayar where notrans=''");


}




// Insert some values




// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode('Sukses Update Tagihan');

}

// Rollback transaction
$conn -> rollback();

$conn -> close();






?>