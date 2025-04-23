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

$norm=$data->norm;
$notrans=$data->notrans;

$stssimpan = $data->stssimpan;
$hasil= str_replace("'"," ` ",$data->hasil);
$kdproduk=$data->kdproduk;
$klinis=str_replace("'"," ` ",$data->klinis);
$status=$data->status;

$tgl = date("Y-m-d H:i:s");
if($stssimpan === '1'){

   $conn -> autocommit(FALSE);




 
 $conn -> query("INSERT INTO hasilrad(notransaksi,norm,tgl,kdproduk,hasil,klinis,kdcabang,status) 
 values('$notrans','$norm','$tgl','$kdproduk','$hasil','$klinis','$kdcabang','$status')");



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



                      $conn -> query("UPDATE hasilrad set

                        hasil='$hasil',klinis='$klinis' where
                         notransaksi='$notrans' and kdcabang='$kdcabang' and kdproduk='$kdproduk' ");


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