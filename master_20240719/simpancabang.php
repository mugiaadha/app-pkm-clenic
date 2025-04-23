<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
  $rest_json = file_get_contents("php://input");
  $_POST = json_decode($rest_json,true);


$kdklinik  = $_POST["kdklinik"];
$nama  = $_POST["nama"];
$alamat  = $_POST["alamat"];
$hp  = $_POST["hp"];

$stssimpan  = $_POST["stssimpan"];



if($stssimpan === '1'){

    $sql="SELECT * FROM cabang WHERE kdklinik='$kdklinik'";

if ($result=mysqli_query($conn,$sql))
  {
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
  
if($rowcount >= 3){



 $pesan ='Tidak Bisa karena Cabang Lebih dari 3 ';
  


}else{

$query="SELECT angka from autonum where kdnomor='1' and kdklinik='$kdklinik'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$angka = $row['angka']+1;
}

$kdcabangf = 'CAB'.$kdklinik.$angka;





  $conn -> query("INSERT INTO cabang(kdcabang,nama,alamat,hp,kdklinik) 
 values('$kdcabangf','$nama','$alamat','$hp','$kdklinik')");
  $conn -> query("DELETE FROM cabang where nama=''");

  $conn -> query("UPDATE autonum set angka='$angka' where kdklinik='$kdklinik' and  kdnomor='1' ");


 $pesan ='Berhasil Simpan Cabang ';
  

}

  mysqli_free_result($result);
  }
}else if($stssimpan === '2'){
    $kdcabang  = $_POST["kdcabang"];


$conn -> query("UPDATE cabang set nama='$nama',alamat='$alamat',hp='$hp' where kdcabang='$kdcabang'");
 $pesan ='Berhasil Edit Cabang ';
  



}else if($stssimpan === '3'){
  $kdcabang  = $_POST["kdcabang"];


  $sqledit="SELECT kdcabang FROM transaksipasien WHERE kdcabang='$kdcabang' LIMIT 1";

      $resultedit=mysqli_query($conn,$sqledit);
       $rowcountedit=mysqli_num_rows($resultedit);
        
      if($rowcountedit > 0){

 $pesan ='201';
     }else{
$conn -> query("DELETE FROM cabang where kdcabang='$kdcabang'");

 $pesan ='200';


     }




}
   

 


echo json_encode($pesan);


 mysqli_close($conn);

?>