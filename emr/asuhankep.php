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

$tgl = date("Y-m-d H:i:s");

$diagnosakep = $data->diagnosakep;
$rencana = $data->rencana;
$pelaksana = $data->pelaksana;
$evaluasi = $data->evaluasi;
$paraf = $data->paraf;
$kdpoli=$data->kdpoli;
$kddokter = $data->kddokter;
$notransaksi = $data->notransaksi;







if($stssimpan === '1'){

   $conn -> autocommit(FALSE);
  




    $sql="SELECT * from emrasuhankeperawatan where notransaksi='$notransaksi'";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){


  $conn -> query("DELETE FROM emrasuhankeperawatan where notransaksi='$notransaksi'");


 $conn -> query("INSERT INTO emrasuhankeperawatan(tgl,diagnosakep,rencana,pelaksana,evaluasi,paraf,kdpoli,kddokter,notransaksi) 
 values('$tgl','$diagnosakep','$rencana','$pelaksana','$evaluasi','$paraf','$kdpoli','$kddokter','$notransaksi')");





}else{


  
  $conn -> query("INSERT INTO emrasuhankeperawatan(tgl,diagnosakep,rencana,pelaksana,evaluasi,paraf,kdpoli,kddokter,notransaksi) 
 values('$tgl','$diagnosakep','$rencana','$pelaksana','$evaluasi','$paraf','$kdpoli','$kddokter','$notransaksi')");



}




     



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
  


   $conn -> query("DELETE FROM emrasuhankeperawatan where notransaksi='$notransaksi'");


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




}
   

 




?>