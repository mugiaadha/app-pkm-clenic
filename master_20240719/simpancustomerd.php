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
  $kdklinik=$data->kdklinik;

  $kdkelompok=$data->kdkelompok;

 $nama= strtoupper($data->nama);  
 $alamat= strtoupper($data->alamat);  
 $hp= $data->hp;  


  $stssimpan = $data->stssimpan;



if($stssimpan === '1'){

   $conn -> autocommit(FALSE);




$query="SELECT angka from autonum where kdnomor='11' and kdklinik='$kdklinik'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$angka = $row['angka']+1;
}

$kdcabangf = 'CUSD'.$kdcabang.$angka;


  $conn -> query("INSERT INTO kelompokkostumerd(kdkostumer,kdkostumerd,nama,alamat,hp,kdklinik,kdcabang) 
 values('$kdkelompok','$kdcabangf','$nama','$alamat','$hp','$kdklinik','$kdcabang')");

  $conn -> query("DELETE FROM kelompokkostumerd where nama=''");


$conn -> query("UPDATE autonum set angka='$angka' where kdklinik='$kdklinik' and  kdnomor='11' ");



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

  $kdkostumerd=$data->kdkostumerd;

$conn -> query("UPDATE kelompokkostumerd set nama='$nama',alamat='$alamat',hp='$hp' where kdcabang='$kdcabang' and kdkostumerd='$kdkostumerd'");


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

  $kdkostumerd=$data->kdkostumerd;
  $status=$data->statusaktif;




$conn -> query("UPDATE kelompokkostumerd set status='$status' where kdcabang='$kdcabang' and kdkostumerd='$kdkostumerd'");


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