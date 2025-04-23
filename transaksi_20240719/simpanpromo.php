
<?php     
 



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
  $rest_json = file_get_contents("php://input");
  $_POST = json_decode($rest_json,true);




$kdcabang  = $_POST["kdcabang"];
$kdklinik  = $_POST["kdklinik"];
$sp  = $_POST["sp"];
$diskripsi  = $_POST["diskripsi"];
$statusaktif  = $_POST["statusaktif"];
$stssimpan  = $_POST["stssimpan"];
$showkkk  = $_POST["showkkk"];
$nmfile = date("YmdHis");

$tgl = date("Y-m-d H:i:s");



if($stssimpan === '1'){



 $kdcppt = $kdcabang.$nmfile;
 $kdcpptx = 'https://clenicapp.com/clenic/gmb/'.$kdcabang.$nmfile.'.png';


 $target_path=$kdcppt.'.png';



  $target_path = "../gmb/".$target_path;

  $imagedata = $_POST['file'];
  $imagedata = str_replace('data:image/jpeg;base64','',$imagedata);
  $imagedata = str_replace('data:image/jpg;base64','',$imagedata);
  $imagedata = str_replace('data:image/png;base64','',$imagedata);
  $imagedata = str_replace('', '+', $imagedata);
  $imagedata = base64_decode($imagedata);


  file_put_contents($target_path, $imagedata);
  


$conn -> query("INSERT INTO promo(judulpromo,tgl,keterangan,gambar,kdcabang,kdklinik,aktif) 
 values('$sp','$tgl','$diskripsi','$kdcpptx','$kdcabang','$kdklinik','$statusaktif')");



$pesan='Berhasil';

}else if($stssimpan === '2'){

$kdpromo  = $_POST["kdpromo"];
$showkkk  = $_POST["showkkk"];





 $conn -> query("UPDATE promo set judulpromo='$sp',keterangan='$diskripsi',aktif='$statusaktif'
         where kdpromo='$kdpromo' and kdcabang='$kdcabang'");



$pesan='Berhasil';


}else if($stssimpan === '3'){
$kdpromo  = $_POST["kdpromo"];



// $query="SELECT  * FROM promo  where kdcabang='$kdcabang' 
//     and kdpromo='$kdpromo'";

// $result=mysqli_query($conn, $query);
// while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

// unlink($row['gambar']);

// }




$conn -> query("DELETE from promo where kdcabang='$kdcabang' 
    and kdpromo='$kdpromo'");



$pesan='Berhasil';


}


 


echo json_encode($pesan);


 mysqli_close($conn);





?>