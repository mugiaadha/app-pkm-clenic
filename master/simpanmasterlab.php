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
  $nama= $data->nama;  
  $kdgolongan= $data->kdgolongan;  
  $golongan= $data->golongan;  

$kdmetode= $data->kdmetode;  
$metode= $data->metode;  
$satuan= $data->satuan;  
$reflaki= $data->reflaki;  
$refperempuan= $data->refperempuan;  

$lmin= $data->lmin;  
$lmax= $data->lmax;  
$pmin= $data->pmin;  
$pmax= $data->pmax;  
$nourut= $data->nourut;  
$spesimenSatuSehat= $data->spesimenSatuSehat;  
$stssimpan = $data->stssimpan;




if($stssimpan === '1'){

   $conn -> autocommit(FALSE);




$query="SELECT angka from autonum where kdnomor='17' and kdklinik='$kdklinik'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$angka = $row['angka']+1;
}

$kdcabangf = 'TS'.$kdcabang.$angka;





  $conn -> query("INSERT INTO teslab(kdlab , nama , kdgolongan,golongan,kdmetode,metode,satuan,
    reflaki,refperempuan,lmin,lmax,pmin,pmax,kdcabang,nourut,spesimenSatuSehat) 
 values('$kdcabangf','$nama','$kdgolongan','$golongan','$kdmetode','$metode','$satuan','$reflaki','$refperempuan','$lmin','$lmax','$pmin','$pmax','$kdcabang','$nourut','$spesimenSatuSehat')");

  $conn -> query("DELETE FROM teslab where metode=''");


$conn -> query("UPDATE autonum set angka='$angka' where kdklinik='$kdklinik' and  kdnomor='17' ");



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

  $kdlab=$data->kdlab;

$conn -> query("UPDATE teslab set 

nama ='$nama', kdgolongan='$kdgolongan',golongan='$golongan',kdmetode='$kdmetode',metode='$metode',satuan='$satuan',
    reflaki='$reflaki',refperempuan='$refperempuan',lmin='$lmin',lmax='$lmax',pmin='$pmin',pmax='$pmax',nourut='$nourut',spesimenSatuSehat='$spesimenSatuSehat'

  where kdcabang='$kdcabang'  and kdlab='$kdlab'");


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

  $kdlab=$data->kdlab;




$conn -> query("DELETE from  teslab  where kdcabang='$kdcabang'  and kdlab='$kdlab'");


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