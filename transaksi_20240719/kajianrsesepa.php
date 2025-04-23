<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
 

 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);









$notrans=$data->notrans;
$noresep=$data->noresep;








$stssimpan = $data->stssimpan;


$tgl = date("Y-m-d H:i:s");
if($stssimpan === '1'){

   $conn -> autocommit(FALSE);

$z1a=$data->z1a;
$z2a=$data->z2a;
$z3a=$data->z3a;
$z4a=$data->z4a;
$z5a=$data->z5a;
$z6a=$data->z6a;
$z7a=$data->z7a;
$z8a=$data->z8a;
$z9a=$data->z9a;
$z10a=$data->z10a;

$ket1a=$data->ket1a;
$ket2a=$data->ket2a;
$ket3a=$data->ket3a;
$ket4a=$data->ket4a;
$ket5a=$data->ket5a;
$ket6a=$data->ket6a;
$ket7a=$data->ket7a;
$ket8a=$data->ket8a;
$ket9a=$data->ket9a;
$ket10a=$data->ket10a;


    $sql="SELECT * from kajianresep where noresep='$noresep' ";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){


 


$conn -> query("UPDATE kajianresep set
 noresep='$noresep',notransaksi='$notrans',a1a='$z1a'
  ,a2a='$z2a'
  ,a3a='$z3a'
  ,a4a='$z4a'
  ,a5a='$z5a'
  ,a6a='$z6a'
  ,a7a='$z7a'
  ,a8a='$z8a'
  ,a9a='$z9a'
  ,a10a='$z10a'
  ,ket1a='$ket1a'
  ,ket2a='$ket2a'
  ,ket3a='$ket3a'
  ,ket4a='$ket4a'
  ,ket5a='$ket5a'
  ,ket6a='$ket6a'
  ,ket7a='$ket7a'
  ,ket8a='$ket8a'
  ,ket9a='$ket9a'
  ,ket10a='$ket10a'
where noresep='$noresep'");






}else{





  $conn -> query("INSERT INTO kajianresep( noresep,
  notransaksi,
  a1a,
  a2a,
  a3a,
  a4a,
  a5a,
  a6a,
  a7a,
  a8a,
  a9a,
  a10a,
  ket1a,
  ket2a,
  ket3a,
  ket4a,
  ket5a,
  ket6a,
  ket7a,
  ket8a,
  ket9a,
  ket10a) 
 values('$noresep',
  '$notrans',
  '$z1a',
  '$z2a',
  '$z3a',
  '$z4a',
  '$z5a',
  '$z6a',
  '$z7a',
  '$z8a',
  '$z9a',
  '$z10a',
  '$ket1a',
  '$ket2a',
  '$ket3a',
  '$ket4a',
  '$ket5a',
  '$ket6a',
  '$ket7a',
  '$ket8a',
  '$ket9a',
  '$ket10a')");


 

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

$z1b=$data->z1b;
$z2b=$data->z2b;
$z3b=$data->z3b;
$z4b=$data->z4b;
$z5b=$data->z5b;
$z6b=$data->z6b;


$ket1b=$data->ket1b;
$ket2b=$data->ket2b;
$ket3b=$data->ket3b;
$ket4b=$data->ket4b;
$ket5b=$data->ket5b;
$ket6b=$data->ket6b;


    $sql="SELECT * from kajianresepb where noresep='$noresep' ";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){


 


$conn -> query("UPDATE kajianresepb set
 noresep='$noresep',notransaksi='$notrans',.
 
 z1b='$z1b'
  ,z2b='$z2b'
  ,z3b='$z3b'
  ,z4b='$z4b'
  ,z5b='$z5b'
  ,z6b='$z6b'
 
  ,ket1b='$ket1b'
  ,ket2b='$ket2b'
  ,ket3b='$ket3b'
  ,ket4b='$ket4b'
  ,ket5b='$ket5b'
  ,ket6b='$ket6b'
  
where noresep='$noresep'");






}else{





  $conn -> query("INSERT INTO kajianresepb( noresep,
  notransaksi,
  z1b,
  z2b,
  z3b,
  z4b,
  z5b,
  z6b,
  ket1b,
  ket2b,
  ket3b,
  ket4b,
  ket5b,
  ket6b
) 
 values('$noresep',
  '$notrans',
  '$z1b',
  '$z2b',
  '$z3b',
  '$z4b',
  '$z5b',
  '$z6b',
 
  '$ket1b',
  '$ket2b',
  '$ket3b',
  '$ket4b',
  '$ket5b',
  '$ket6b')");


 

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

$z1c=$data->z1c;
$z2c=$data->z2c;
$z3c=$data->z3c;
$z4c=$data->z4c;
$z5c=$data->z5c;
$z6c=$data->z6c;
$z7c=$data->z7c;
$z8c=$data->z8c;
$z9c=$data->z9c;


$ket1c=$data->ket1c;
$ket2c=$data->ket2c;
$ket3c=$data->ket3c;
$ket4c=$data->ket4c;
$ket5c=$data->ket5c;
$ket6c=$data->ket6c;

$ket7c=$data->ket7c;
$ket8c=$data->ket8c;
$ket9c=$data->ket9c;

$analis=$data->analis;
    $sql="SELECT * from kajianresepc where noresep='$noresep' ";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){


 


$conn -> query("UPDATE kajianresepc set
 noresep='$noresep',notransaksi='$notrans',.
 
 z1c='$z1c'
  ,z2c='$z2c'
  ,z3c='$z3c'
  ,z4c='$z4c'
  ,z5c='$z5c'
  ,z6c='$z6c'
 
   ,z7c='$z7c'
  ,z8c='$z8c'
  ,z9c='$z9c'
  
  ,ket1c='$ket1b'
  ,ket2c='$ket2b'
  ,ket3c='$ket3b'
  ,ket4c='$ket4b'
  ,ket5c='$ket5b'
  ,ket6c='$ket6b'
  ,ket7c='$ket7c'
  ,ket8c='$ket8c'
  ,ket9c='$ket9c'
 ,analis='$analis'
where noresep='$noresep'");






}else{





  $conn -> query("INSERT INTO kajianresepc( noresep,
  notransaksi,
  z1c,
  z2c,
  z3c,
  z4c,
  z5c,
  z6c,
   z7c,
  z8c,
  z9c,
  
  ket1c,
  ket2c,
  ket3c,
  ket4c,
  ket5c,
  ket6c,
   ket7c,
  ket8c,
  ket9c,
  analis
) 
 values('$noresep',
  '$notrans',
  '$z1c',
  '$z2c',
  '$z3c',
  '$z4c',
  '$z5c',
  '$z6c',
    '$z7c',
  '$z8c',
  '$z9c',
 
  '$ket1c',
  '$ket2c',
  '$ket3c',
  '$ket4c',
  '$ket5c',
  '$ket6c',
  '$ket7c',
  '$ket8c',
  '$ket9c',
    '$analis')");


 

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