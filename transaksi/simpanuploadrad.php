
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
  



$conn -> query("INSERT INTO hasilrad(notransaksi,norm,tgl,kdproduk,hasil,klinis,kdcabang,status,nmfile) 
 values('$notrans','$norm','$tgl','','$keterangan','','$kdcabang','2','$kdcppt')");

$conn -> query("DELETE FROM hasilrad where notransaksi=''");



$pesan='Berhasil';




 


echo json_encode($pesan);


 mysqli_close($conn);





?>