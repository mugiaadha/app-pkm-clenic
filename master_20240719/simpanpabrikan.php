<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
  $rest_json = file_get_contents("php://input");
  $_POST = json_decode($rest_json,true);



$kdklinik  = $_POST["kdklinik"];
$kdcabang  = $_POST["kdcabang"];
$nama =  $_POST["nama"];
$alamat=  $_POST["alamat"];
$hp=  $_POST["hp"];


$stssimpan  = $_POST["stssimpan"];






if($stssimpan === '1'){



$query="SELECT angka from autonum where kdnomor='6' and kdklinik='$kdklinik'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$angka = $row['angka']+1;
}

$kdcabangf = 'PAB'.$kdcabang.$angka;




  $conn -> query("INSERT INTO pabrikan(kdpabrikan,nama,alamat,hp,kdklinik,kdcabang) 
 values('$kdcabangf','$nama','$alamat','$hp','$kdklinik','$kdcabang')");
  $conn -> query("DELETE FROM rakobat where namarak=''");


$conn -> query("UPDATE autonum set angka='$angka' where kdklinik='$kdklinik' and  kdnomor='6' ");




 $pesan ='Berhasil Simpan';
  


}else if($stssimpan === '2'){

$kdpabrikan  = $_POST["kdpabrikan"];

$conn -> query("UPDATE pabrikan set nama='$nama',alamat='$alamat',hp='$hp' where kdcabang='$kdcabang' and kdpabrikan='$kdpabrikan'");
 $pesan ='Berhasil Edit  ';
  



}else if($stssimpan === '3'){

  $kdpabrikan  = $_POST["kdpabrikan"];

      $sql="SELECT kdpabrikan FROM obat WHERE kdcabang='$kdcabang' AND kdpabrikan='$kdpabrikan' ORDER BY kdpabrikan LIMIT 1";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){


 $pesan =201;

}else{


$conn -> query("DELETE from pabrikan  where kdcabang='$kdcabang' and kdpabrikan='$kdpabrikan'");
 $pesan =200;
 

}




}
   

 


echo json_encode($pesan);


 mysqli_close($conn);

?>