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


$query="SELECT angka from autonum where kdnomor='32' and kdcabang='$kdcabang'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$angka = $row['angka']+1;
}



$kdperawat = 'KP'.$kdcabang.$angka;





  $conn -> query("INSERT INTO mperawat(kdperawat,nama,jenis,kdcabang) 
 values('$kdperawat','$nama','$jenis','$kdcabang')");


  $conn -> query("DELETE FROM mperawat where nama=''");


$conn -> query("UPDATE autonum set angka='$angka' where kdcabang='$kdcabang' and  kdnomor='32' ");







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


$kdperawat = $data->kdperawat;





$conn -> query("UPDATE mperawat set nama='$nama',jenis='$jenis'
  where kdcabang='$kdcabang' and  kdperawat='$kdperawat' ");







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


$kdperawat = $data->kdperawat;




$conn -> query("DELETE from mperawat where kdcabang='$kdcabang' and  kdperawat='$kdperawat'");


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