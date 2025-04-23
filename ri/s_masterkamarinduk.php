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
$indukkamar = $data->indukkamar;
$stssimpan = $data->stssimpan;




if($stssimpan === '1'){

$conn -> autocommit(FALSE);


$query="SELECT angka from autonum where kdnomor='28' and kdcabang='$kdcabang'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$angka = $row['angka']+1;
}



$kdindukkamar = 'KI'.$kdcabang.$angka;





  $conn -> query("INSERT INTO kamarinduk(kdindukkamar,indukkamar,kdcabang) 
 values('$kdindukkamar','$indukkamar','$kdcabang')");


  $conn -> query("DELETE FROM kamarinduk where indukkamar=''");


$conn -> query("UPDATE autonum set angka='$angka' where kdcabang='$kdcabang' and  kdnomor='28' ");







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


$kdindukkamar = $data->kdindukkamar;


$conn -> query("UPDATE kamarinduk set indukkamar='$indukkamar' where kdcabang='$kdcabang' and  kdindukkamar='$kdindukkamar' ");







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


$kdindukkamar = $data->kdindukkamar;




$conn -> query("DELETE from kamarinduk where kdcabang='$kdcabang' and  kdindukkamar='$kdindukkamar'");


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