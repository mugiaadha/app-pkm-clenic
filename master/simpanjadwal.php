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

 $kddokter= $data->kddokter;  
 $kdpoli= $data->poli;  



 $kuota= $data->kuota;  

  $stssimpan = $data->stssimpan;



if(empty($data->senin)){
$senin='';
}else{
$senin=str_replace("'"," ` ",$data->senin);
}

if(empty($data->selasa)){
$selasa='';
}else{
$selasa=str_replace("'"," ` ",$data->selasa);
}

if(empty($data->rabu)){
$rabu='';
}else{
$rabu=str_replace("'"," ` ",$data->rabu);
}


if(empty($data->kamis)){
$kamis='';
}else{
$kamis=str_replace("'"," ` ",$data->kamis);
}

if(empty($data->jumat)){
$jumat='';
}else{
$jumat=str_replace("'"," ` ",$data->jumat);
}

if(empty($data->sabtu)){
$sabtu='';
}else{
$sabtu=str_replace("'"," ` ",$data->sabtu);
}


if(empty($data->minggu)){
$minggu='';
}else{
$minggu=str_replace("'"," ` ",$data->minggu);
}

if($stssimpan === '1'){

   $conn -> autocommit(FALSE);




    $sql="SELECT * from jadwalpraktek where kddokter='$kddokter' and kdpoli='$kdpoli' and kdcabang='$kdcabang'";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){

$conn -> query("UPDATE jadwalpraktek set

senin='$senin' , selasa='$selasa' , rabu='$rabu' , kamis='$kamis',jumat='$jumat',sabtu='$sabtu',minggu='$minggu',kuota='$kuota' 
 where kddokter='$kddokter' and kdpoli='$kdpoli' and
 kdcabang='$kdcabang'");
 
 
 $conn -> query("UPDATE dokterklinik set

kodeantrian='$data->kodeantrian'
 where kddokter='$kddokter' and kdpoli='$kdpoli' and
 kdcabang='$kdcabang'");
 
 
 
 
 


}else{


  $conn -> query("INSERT INTO jadwalpraktek(kddokter , kdpoli , senin , selasa , rabu , kamis,jumat,sabtu,minggu,kuota,kdklinik,kdcabang
) 
 values('$kddokter','$kdpoli','$senin','$selasa','$rabu','$kamis','$jumat','$sabtu','$minggu','$kuota','$kdklinik','$kdcabang')");



 $conn -> query("UPDATE dokterklinik set

kodeantrian='$data->kodeantrian'
 where kddokter='$kddokter' and kdpoli='$kdpoli' and
 kdcabang='$kdcabang'");
 
 
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


$conn -> query("DELETE from jadwalpraktek where kdcabang='$kdcabang' and  kdpoli='$kdpoli' and kddokter='$kddokter'");





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