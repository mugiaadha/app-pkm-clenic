<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
  $rest_json = file_get_contents("php://input");
  $_POST = json_decode($rest_json,true);



$kdklinik  = $_POST["kdklinik"];
$kdcabang  = $_POST["kdcabang"];
$poli  = $_POST["poli"];
$kdpolibpjs = $_POST['polibpjs'];

$stssimpan  = $_POST["stssimpan"];

$hakakses  = $_POST["hakakses"];
if($hakakses === 'ri'){
$filter = '1';

}else if ($hakakses === 'lab'){
$filter = '2';
}else if($hakakses === 'rad'){
$filter = '3';

}else if($hakakses === 'igd'){
$filter = '1';

}



if($stssimpan === '1'){


$query="SELECT angka from autonum where kdnomor='3' and kdklinik='$kdklinik'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$angka = $row['angka']+1;
}

$kdcabangf = 'POL'.$kdcabang.$angka; 





  $conn -> query("INSERT INTO poliklinik(kdklinik,kdcabang,kdpoli,nampoli,filter,sts,kdpolibpjs) 
 values('$kdklinik','$kdcabang','$kdcabangf','$poli','$filter','$hakakses','$kdpolibpjs')");
  $conn -> query("DELETE FROM poliklinik where nampoli=''");


$conn -> query("UPDATE autonum set angka='$angka' where kdklinik='$kdklinik' and  kdnomor='3' ");




 $pesan ='Berhasil Simpan';
  


}else if($stssimpan === '2'){
  
$kdpoli  = $_POST["kdpoli"];

$conn -> query("UPDATE poliklinik set nampoli='$poli'
,filter='$filter',sts='$hakakses',kdpolibpjs='$kdpolibpjs'

 where kdcabang='$kdcabang' and kdpoli='$kdpoli'");
 $pesan ='Berhasil Edit  ';
  



}else if($stssimpan === '3'){

$kdpoli  = $_POST["kdpoli"];


$sql="SELECT kdpoli FROM kunjunganpasien WHERE kdcabang='$kdcabang' AND kdpoli='$kdpoli' limit 1";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){

$pesan=201;


}else{


$conn -> query("DELETE from poliklinik where kdcabang='$kdcabang' and kdpoli='$kdpoli'");

$pesan=200;


}









}
   

 


echo json_encode($pesan);


 mysqli_close($conn);

?>