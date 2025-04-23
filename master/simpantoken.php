<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
 

 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);





  $stssimpan = $data->stssimpan;




if($stssimpan === '1'){

   $conn -> autocommit(FALSE);


 $token = $data->token;
 $conn -> query("DELETE FROM token");




  $conn -> query("INSERT INTO token(token) 
 values('$token')");
 


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


 $token = $data->token;
 $notransaksi = $data->notransaksi;
 $norm = $data->norm;
 $idpasien = $data->idpasien;

$query = "SELECT idsatusehat  from antrian where  notransaksi='$notransaksi' ";

$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {


  // $idd = $row['idsatusehat'];



$conn -> query("UPDATE antrian set idsatusehat ='$token' where notransaksi='$notransaksi' ");

// $conn -> query("UPDATE pasien set idpasien ='$idpasien' where norm='$norm' ");





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



}else if($stssimpan === '3'){

     $conn -> autocommit(FALSE);


 $iddiagnosa = $data->iddiagnosa;
 $notransaksi = $data->notransaksi;

 
$query = "SELECT iddiagnosa  from ermcpptdiagnosa where  notrans='$notransaksi' and status='diagnosa' order by tgl asc limit 1 ";

$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {


  $idd = $row['iddiagnosa'];



  if($idd == '0'){
$conn -> query("UPDATE ermcpptdiagnosa set iddiagnosa ='$iddiagnosa' where notrans='$notransaksi' ");





  }else{


  }

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



}


 




?>