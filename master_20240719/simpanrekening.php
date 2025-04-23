<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
  $rest_json = file_get_contents("php://input");
  $_POST = json_decode($rest_json,true);



$kdklinik  = $_POST["kdklinik"];
$kdcabang  = $_POST["kdcabang"];
$norekening  = $_POST["norekening"];
$namarekening  = $_POST["namarekening"];
$norekeningl  = $_POST["norekeningl"];
$kdcoa  = $_POST["kdcoa"];


$stssimpan  = $_POST["stssimpan"];



if($stssimpan === '1'){



  $conn -> query("INSERT INTO rekening(norekening,namarekening,kdcoa,kdklinik,kdcabang) 
 values('$norekening','$namarekening','$kdcoa','$kdklinik','$kdcabang')");
  // $conn -> query("DELETE FROM rekening where namarekening=''");






 $pesan ='Berhasil Simpan rekening ';
  


}else if($stssimpan === '2'){
  


$conn -> query("UPDATE rekening set  norekening='$norekening',namarekening='$namarekening',kdcoa='$kdcoa' where kdcabang='$kdcabang' and norekening='$norekeningl'");
 $pesan ='Berhasil Edit rekening ';
  



}else if($stssimpan === '3'){


$conn -> query("DELETE from rekening  where kdcabang='$kdcabang' and norekening='$norekeningl'");
 $pesan ='Berhasil Hapus rekening ';
}
   

 


echo json_encode($pesan);


 mysqli_close($conn);

?>