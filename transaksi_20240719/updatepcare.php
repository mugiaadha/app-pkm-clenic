<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
 

 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);





$stssimpan =$data->stssimpan;

$notransaksi =  $data->notransaksi;








if($stssimpan === '1'){
$conn -> autocommit(FALSE);

$noantrian =$data->noantrian;

$conn -> query("UPDATE kunjunganpasien set spcare='TERDAFTAR DI PCARE',
kdtkp='$data->kdtkp',jeniskun='$data->jeniskun'
 where notransaksi='$notransaksi'");


$conn -> query("UPDATE antrian set noantrianbpjs='$noantrian'
 where notransaksi='$notransaksi'");




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


$nokunjungan=$data->nokunjungan;
$kdpoli=$data->kdpoli;
$kddokter=$data->kddokter;
$jeniskunjungan=$data->jeniskunjungan;


$conn -> query("UPDATE kunjunganpasien set spcare='SUDAH KIRIM KUNJUNGAN',nokunjungan='$nokunjungan',skunjungan=1,jeniskunjungan='$jeniskunjungan'
 where notransaksi='$notransaksi' and kdpoli='$kdpoli' and kddokter='$kddokter'");




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

$kdpoli=$data->kdpoli;
$noRujukan=$data->noRujukan;
$nokaPst=$data->nokaPst;
$conn -> query("UPDATE kunjunganpasien set nokunjungan='0',skunjungan=0,jeniskunjungan='0'
 where notransaksi='$notransaksi' and kdpoli='$kdpoli'");

$conn -> query("DELETE from riwayatkunjungan  where noRujukan='$noRujukan' and nokaPst='$nokaPst' ");





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






}else if($stssimpan === '4'){
$conn -> autocommit(FALSE);







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

}else if($stssimpan === '5'){




}
   

 




?>