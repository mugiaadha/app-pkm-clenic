<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
 

 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);



  $normlama=$data->normlama;

  $normbaru=$data->normbaru;
$stssimpan = $data->stssimpan;


if($stssimpan === '1'){

   $conn -> autocommit(FALSE);


// echo $normlama;
// echo $normbaru;


 $conn -> query("UPDATE antrian set norm='$normbaru'
  where norm='$normlama' ");

 $conn -> query("UPDATE transaksipasien set norm='$normbaru'
 where norm='$normlama' ");

$conn -> query("UPDATE kunjunganpasien set norm='$normbaru'
where norm='$normlama'");


$conn -> query("UPDATE ermcppt set norm='$normbaru'
where norm='$normlama'");

$conn -> query("UPDATE pasien set norm='$normbaru'
where norm='$normlama'");


$conn -> query("UPDATE ermcpptdiagnosa set norm='$normbaru'
where norm='$normlama'");



$conn -> query("UPDATE jualobat set norm='$normbaru'
where norm='$normlama'");


$conn -> query("UPDATE jualobatd set norm='$normbaru'
where norm='$normlama'");


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