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
  $kode=$data->kode;
  $diagfree=$data->diagfree;
$notrans=$data->notrans;
$norm=$data->norm;
$no=$data->no;

$stssimpan = $data->stssimpan;




if($stssimpan === '1'){

   $conn -> autocommit(FALSE);






 $conn -> query("UPDATE ermcpptdiagnosa set kddiagnosa='$kode'
  where  notrans='$notrans' and kdcabang='$kdcabang' and norm='$norm'
 and no='$no'   ");




 $query="SELECT  freetext from mdiagnosa where kddiagnosa='$kode'";

$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {


$freediag=$row['freetext'];


}


$freediage = $freediag.','.$diagfree;


 $conn -> query("UPDATE mdiagnosa set freetext='$freediage'
  where kddiagnosa='$kode' ");




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