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



$query="SELECT angka from autonum where kdnomor='7' and kdcabang='$kdcabang'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$angka = $row['angka']+1;
}

$kdcabangf = 'SUP'.$kdcabang.$angka;




  $conn -> query("INSERT INTO suplier(kdsup,nama,alamat,hp,kdklinik,kdcabang) 
 values('$kdcabangf','$nama','$alamat','$hp','$kdklinik','$kdcabang')");
  $conn -> query("DELETE FROM rakobat where namarak=''");


$conn -> query("UPDATE autonum set angka='$angka' where kdcabang='$kdcabang' and  kdnomor='7' ");




 $pesan ='Berhasil Simpan';
  


}else if($stssimpan === '2'){

$kdsup  = $_POST["kdsup"];

$conn -> query("UPDATE suplier set nama='$nama',alamat='$alamat',hp='$hp' where kdcabang='$kdcabang' and kdsup='$kdsup'");
 $pesan ='Berhasil Edit  ';
  



}else if($stssimpan === '3'){



$kdsup  = $_POST["kdsup"];





    $sql="SELECT kdsuplier FROM obat WHERE kdcabang='$kdcabang' AND kdsuplier='$kdsup' ORDER BY kdsuplier LIMIT 1";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){

 $pesan =201;


}else{

  $conn -> query("DELETE from suplier where kdcabang='$kdcabang' and kdsup='$kdsup' ");
 $pesan =200;

}





}
   

 


echo json_encode($pesan);


 mysqli_close($conn);

?>