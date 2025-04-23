<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
  $rest_json = file_get_contents("php://input");
  $_POST = json_decode($rest_json,true);



$kdklinik  = $_POST["kdklinik"];
$kdcabang  = $_POST["kdcabang"];
$kdpoli  = $_POST["kdpoli"];
$kddokter  = $_POST["kddokter"];

$stssimpan  = $_POST["stssimpan"];



if($stssimpan === '1'){




    $sql="SELECT * from dokterklinik where kddokter='$kddokter' and kdpoli='$kdpoli' and kdcabang='$kdcabang'";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){

$pesan=201;


}else{

  $conn -> query("INSERT INTO dokterklinik(kddokter,kdpoli,kdcabang,kdklinik) 
 values('$kddokter','$kdpoli','$kdcabang','$kdklinik')");
  $conn -> query("DELETE FROM dokterklinik where kddokter=''");
$pesan=200;


}









 $pesan =$pesan;
  

}else if($stssimpan === '3'){



$conn -> query("DELETE from dokterklinik where kdcabang='$kdcabang' and kddokter='$kddokter' and kdpoli='$kdpoli'");
 $pesan ='Berhasil delete  ';
}
   

 


echo json_encode($pesan);


 mysqli_close($conn);

?>