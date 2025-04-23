
<?php     
 



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
  $rest_json = file_get_contents("php://input");
  $_POST = json_decode($rest_json,true);




$kdcabang  = $_POST["kdcabang"];
$notrans  = $_POST["notrans"];
$norm  = $_POST["norm"];
$keterangan  = $_POST["keterangan"];


$nmfile = date("YmdHis");

$tgl = date("Y-m-d H:i:s");


 $kdcppt = $notrans.$kdcabang.$nmfile;

 $target_path=$kdcppt.'.jpg';



  $target_path = "gmb/".$target_path;

  $imagedata = $_POST['file'];
  $imagedata = str_replace('data:image/jpeg;base64','',$imagedata);
  $imagedata = str_replace('data:image/jpg;base64','',$imagedata);
  $imagedata = str_replace('data:image/png;base64','',$imagedata);
  $imagedata = str_replace('', '+', $imagedata);
  $imagedata = base64_decode($imagedata);


  file_put_contents($target_path, $imagedata);
  




$conn -> query("INSERT INTO hasilabm(notrans,norm,tgl,waktu,keterangan,status,nmfile,kdcabang) 
 values('$notrans','$norm','$tgl','$tgl','$keterangan','2','$kdcppt','$kdcabang')");

$conn -> query("DELETE FROM hasilabm where notrans=''");



$pesan='Berhasil';




 


echo json_encode($pesan);


 mysqli_close($conn);





?>