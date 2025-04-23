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
  $kdklinik=$data->kdklinik;

 $namatamplates= $data->namatamplates;  




  $stssimpan = $data->stssimpan;
$status = $data->status;



if($stssimpan === '1'){

   $conn -> autocommit(FALSE);




$query="SELECT angka from autonum where kdnomor='16' and kdklinik='$kdklinik'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$angka = $row['angka']+1;
}

$kdcabangf = 'ML'.$kdcabang.$angka;





  $conn -> query("INSERT INTO metodelab(kdmetode , metode , kdcabang,status) 
 values('$kdcabangf','$namatamplates','$kdcabang','$status')");

  $conn -> query("DELETE FROM metodelab where metode=''");


$conn -> query("UPDATE autonum set angka='$angka' where kdklinik='$kdklinik' and  kdnomor='16' ");



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

  $kdmetode=$data->kdmetode;

$conn -> query("UPDATE metodelab set metode='$namatamplates' where kdcabang='$kdcabang' and status='$status' and kdmetode='$kdmetode'");


if($status == 'METODE'){
$conn -> query("UPDATE teslab set metode='$namatamplates' where kdcabang='$kdcabang'  and kdmetode='$kdmetode'");
}else{
$conn -> query("UPDATE teslab set golongan='$namatamplates' where kdcabang='$kdcabang'  and kdgolongan='$kdmetode'");
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



}else if($stssimpan === '3'){








 $conn -> autocommit(FALSE);

  $kdmetode=$data->kdmetode;




$conn -> query("DELETE from  metodelab  where kdcabang='$kdcabang'  and status='$status' and kdmetode='$kdmetode'");


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