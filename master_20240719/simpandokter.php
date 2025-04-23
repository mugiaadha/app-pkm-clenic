<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
  $rest_json = file_get_contents("php://input");
  $_POST = json_decode($rest_json,true);



$kdklinik  = $_POST["kdklinik"];
$kdcabang  = $_POST["kdcabang"];
$dokter  = $_POST["dokter"];
$online  = $_POST["online"];
$stssimpan  = $_POST["stssimpan"];
$sn  = $_POST["sn"];
$kddokterbpjs = $_POST['kddokterbpjs'];




if($stssimpan === '1'){



$query="SELECT angka from autonum where kdnomor='4' and kdklinik='$kdklinik'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$angka = $row['angka']+1;
}

$kdcabangf = 'DOK'.$kdcabang.$angka;


  $conn -> query("INSERT INTO dokter(kddokter,namdokter,statusonline,kdklinik,kdcabang,status,kddokterbpjs) 
 values('$kdcabangf','$dokter','$online','$kdklinik','$kdcabang','$sn','$kddokterbpjs')");
  $conn -> query("DELETE FROM dokter where namdokter=''");


$conn -> query("UPDATE autonum set angka='$angka' where kdklinik='$kdklinik' and  kdnomor='4' ");



 $pesan ='Berhasil Simpan';
  


}else if($stssimpan === '2'){
  
$kddokter  = $_POST["kddokter"];
$aktif  = $_POST["aktif"];


$conn -> query("UPDATE dokter set namdokter='$dokter',aktif='$aktif',kddokterbpjs='$kddokterbpjs',statusonline='$online',status='$sn' where kdcabang='$kdcabang' and kddokter='$kddokter'");
 $pesan ='Berhasil Edit  ';
  



}else if($stssimpan === '3'){

$kddokter  = $_POST["kddokter"];

$conn -> query("DELETE from dokter where kdcabang='$kdcabang' and kddokter='$kddokter'");
 $pesan ='Berhasil delete  ';
}else if($stssimpan === '4'){
$kddokter  = $_POST["kddokter"];


$conn -> query("UPDATE dokter set idhis='$sn' where kdcabang='$kdcabang' and kddokter='$kddokter'");
 $pesan ='Berhasil Update IHS  ';
}
   
   

 


echo json_encode($pesan);


 mysqli_close($conn);

?>