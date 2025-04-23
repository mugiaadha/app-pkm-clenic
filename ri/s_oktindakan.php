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
$nama = $data->nama;
$jenis = $data->jenis;




$stssimpan = $data->stssimpan;




if($stssimpan === '1'){

$conn -> autocommit(FALSE);


$query="SELECT angka from autonum where kdnomor='30' and kdcabang='$kdcabang'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$angka = $row['angka']+1;
}



$kdtindakan = 'T'.$kdcabang.$angka;





  $conn -> query("INSERT INTO oktindakan(kdtindakan,nama,kdcabang,jenis) 
 values('$kdtindakan','$nama','$kdcabang','$jenis')");


  $conn -> query("DELETE FROM oktindakan where nama=''");


$conn -> query("UPDATE autonum set angka='$angka' where kdcabang='$kdcabang' and  kdnomor='30' ");







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


$kdtindakan = $data->kdtindakan;





$conn -> query("UPDATE oktindakan set nama='$nama',jenis='$jenis'
  where kdcabang='$kdcabang' and  kdtindakan='$kdtindakan' ");







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


$kdtindakan = $data->kdtindakan;




$conn -> query("DELETE from oktindakan where kdcabang='$kdcabang' and  kdtindakan='$kdtindakan'");


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