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
$notrans=$data->notrans;
$kdpoli=$data->kdpoli;
$notransx=$data->notransx;
$status=$data->status;
$stssimpan = $data->stssimpan;


$tgl = date("Y-m-d H:i:s");
if($stssimpan === '1'){

   $conn -> autocommit(FALSE);


$query="SELECT  * FROM ermcpptdiagnosa where notrans='$notrans' and kdcabang='$kdcabang' and status='$status'  order by  diagnosa";



$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

  $norm = $row['norm'];
  $kddokter = $row['kddokter'];
  $kddiagnosa = $row['kddiagnosa'];
  $diagnosa = $row['diagnosa'];

  $conn -> query("INSERT INTO ermcpptdiagnosa(tgl,notrans,norm,kddokter,kdpoli,kddiagnosa,diagnosa,status,kdcabang) 
 values('$tgl','$notransx','$norm','$kddokter','$kdpoli','$kddiagnosa','$diagnosa','$status','$kdcabang')");



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





}else if($stssimpan === '3'){











}
   

 




?>