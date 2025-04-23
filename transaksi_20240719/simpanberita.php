
<?php     
 



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
  $rest_json = file_get_contents("php://input");
  $_POST = json_decode($rest_json,true);





$stssimpan  = $_POST["stssimpan"];



$judul  = $_POST["sp"];
$isi  = $_POST["isi"];
$katagori  = $_POST["katagori"];


$nmfile = date("YmdHis");

$tgl = date("Y-m-d H:i:s");



if($stssimpan === '1'){



 $kdcppt = $nmfile;
 $kdcpptx = 'http://clenicapp.com/clenic/gmb/'.$nmfile.'.png';


 $target_path=$kdcppt.'.png';



  $target_path = "../gmb/".$target_path;

  $imagedata = $_POST['file'];
  $imagedata = str_replace('data:image/jpeg;base64','',$imagedata);
  $imagedata = str_replace('data:image/jpg;base64','',$imagedata);
  $imagedata = str_replace('data:image/png;base64','',$imagedata);
  $imagedata = str_replace('', '+', $imagedata);
  $imagedata = base64_decode($imagedata);


  file_put_contents($target_path, $imagedata);
  


$conn -> query("INSERT INTO berita(kdberita,judul,isi,kdkatagori,gambar,tgl) 
 values('$nmfile','$judul','$isi','$katagori','$kdcpptx','$tgl')");



$pesan='Berhasil';

}else if($stssimpan === '2'){

$kdberita  = $_POST["kdberita"];






 $conn -> query("UPDATE berita set judul='$judul',isi='$isi'
         where kdberita='$kdberita'");



$pesan='Berhasil';


}else if($stssimpan === '3'){
$kdberita  = $_POST["kdberita"];



// $query="SELECT  * FROM promo  where kdcabang='$kdcabang' 
//     and kdpromo='$kdpromo'";

// $result=mysqli_query($conn, $query);
// while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

// unlink($row['gambar']);

// }




$conn -> query("DELETE from berita where kdberita='$kdberita'");



$pesan='Berhasil';


}


 


echo json_encode($pesan);


 mysqli_close($conn);





?>