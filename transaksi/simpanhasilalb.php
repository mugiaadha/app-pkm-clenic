<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
 

 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);



$hasil=$data->hasil;
$kdcabang=$data->kdcabang;
$kdgolongan =$data->kdgolongan;
$kdlab=$data->kdlab;
$kdproduk=$data->kdproduk;
$keterangan=$data->keterangan;
$norm=$data->norm;
$notrans=$data->notrans;
$status=$data->status;
$username=$data->username;
$specimen = isset($data->specimen) ? $data->specimen : null ;
$stssimpan = $data->stssimpan;



if (empty($data->warna)) {
 // do something

    $warna       = '';
}else{
  $warna      = $data->warna;
}




$tgl = date("Y-m-d H:i:s");
if($stssimpan === '1'){

   $conn -> autocommit(FALSE);




  // $conn -> query("DELETE FROM hasillab where notrans='$notrans' and kdcabang='$kdcabang'");




  $conn -> query("INSERT INTO hasillab(notrans,norm,kdgolongan,kdlab,kdproduk,hasil,username,keterangan,kdcabang,status,warna,specimen) 
 values('$notrans','$norm','$kdgolongan','$kdlab','$kdproduk','$hasil','$username','$keterangan','$kdcabang','$status','$warna','$specimen')");



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

$keteranganx=$data->keteranganx;
 $statusx=$data->statusx;

  $conn -> query("INSERT INTO hasilabm(notrans,norm,tgl,waktu,keterangan,status,kdcabang) 
 values('$notrans','$norm','$tgl','$tgl','$keteranganx','$statusx','$kdcabang')");




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








//  $conn -> autocommit(FALSE);

//   $kdmetode=$data->kdmetode;




// $conn -> query("DELETE from  metodelab  where kdcabang='$kdcabang'  and status='$status' and kdmetode='$kdmetode'");


// if (!$conn -> commit()) {
//   // echo "Commit transaction failed";
//     echo json_encode('Gagal');
 

//   exit();
// }else{
// echo json_encode('Sukses');

// }

// // Rollback transaction
// $conn -> rollback();

// $conn -> close();






}
   

 




?>