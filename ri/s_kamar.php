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
$kdkelas = $data->kdkelas;
$kdinduk = $data->kdinduk;
$nama = $data->nama;
$jmlbed = $data->jmlbed;



$stssimpan = $data->stssimpan;




if($stssimpan === '1'){

$conn -> autocommit(FALSE);


$query="SELECT angka from autonum where kdnomor='29' and kdcabang='$kdcabang'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$angka = $row['angka']+1;
}



$kdkamar = 'K'.$kdcabang.$angka;





  $conn -> query("INSERT INTO kamar(kdkamar,kdkelas,kdinduk,nama,jmlbed,kdcabang) 
 values('$kdkamar','$kdkelas','$kdinduk','$nama','$jmlbed','$kdcabang')");


  $conn -> query("DELETE FROM kamar where nama=''");


$conn -> query("UPDATE autonum set angka='$angka' where kdcabang='$kdcabang' and  kdnomor='29' ");







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


$kdkamar = $data->kdkamar;





$conn -> query("UPDATE kamar set kdkelas='$kdkelas',kdinduk='$kdinduk',nama='$nama',jmlbed='$jmlbed' 
  where kdcabang='$kdcabang' and  kdkamar='$kdkamar' ");







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


$kdkamar = $data->kdkamar;




$conn -> query("DELETE from kamar where kdcabang='$kdcabang' and  kdkamar='$kdkamar'");


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