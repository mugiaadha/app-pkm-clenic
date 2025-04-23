<?php




 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
  $rest_json = file_get_contents("php://input");
  $_POST = json_decode($rest_json,true);


$kduser = $_POST['kduser'];
$username = $_POST['username'];

$kdcabang = $_POST['kdcabang'];






$conn -> autocommit(FALSE);



     $sql="SELECT user FROM transaksiakhir WHERE kdcabang='$kdcabang' AND user='$username' ORDER BY user LIMIT 1";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){


$pesan=201;

}else{

$conn -> query("DELETE FROM user where kduser='$kduser' and kdcabang='$kdcabang'");
$pesan=200;

// $q = "DELETE FROM user where kduser='$kduser' and kdcabang='$kdcabang'";

// echo $q;

}






// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode($pesan);

}

// Rollback transaction
$conn -> rollback();

$conn -> close();






?>