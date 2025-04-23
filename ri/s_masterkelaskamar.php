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
$namakelas = $data->namakelas;
$stssimpan = $data->stssimpan;




if($stssimpan === '1'){

$conn -> autocommit(FALSE);


$query="SELECT angka from autonum where kdnomor='27' and kdcabang='$kdcabang'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$angka = $row['angka']+1;
}



$kdkelas = 'KLS'.$kdcabang.$angka;





  $conn -> query("INSERT INTO kamarkelas(kdkelas,namakelas,kdcabang) 
 values('$kdkelas','$namakelas','$kdcabang')");


  $conn -> query("DELETE FROM kamarkelas where namakelas=''");


$conn -> query("UPDATE autonum set angka='$angka' where kdcabang='$kdcabang' and  kdnomor='27' ");







// Insert some values




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


$kdkelas = $data->kdkelas;


$conn -> query("UPDATE kamarkelas set namakelas='$namakelas' where kdcabang='$kdcabang' and  kdkelas='$kdkelas' ");







// Insert some values




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


$kdkelas = $data->kdkelas;




$conn -> query("DELETE from kamarkelas where kdcabang='$kdcabang' and  kdkelas='$kdkelas'");


// Insert some values




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


}











?>