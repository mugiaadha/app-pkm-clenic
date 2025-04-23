<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
  $rest_json = file_get_contents("php://input");
  $_POST = json_decode($rest_json,true);





$stssimpan  = $_POST["stssimpan"];

if($stssimpan === '1'){

$username  = $_POST["username"];



if(empty($_POST["password"])){
$password  = "";

}else{
  $password  = hash('md5',$_POST["password"]);

}
$nama  = $_POST["nama"];
$hakakses  = $_POST["hakakses"];
$kdklinik  = $_POST["kdklinik"];
$kdcabang  = $_POST["kdcabang"];
$kduser = $username;
$pass =  $_POST["password"];
$conn -> autocommit(FALSE);

// Insert some values


  $sqledit="SELECT * FROM user where kdcabang='$kdcabang' and username like '%$username%'";

      $resultedit=mysqli_query($conn,$sqledit);
       $rowcountedit=mysqli_num_rows($resultedit);
        
      if($rowcountedit > 0){

$pesan='User Sudah ada';

        }else{

$conn -> query("INSERT INTO user(kduser,username,password,pass,nama,hakakses,kdklinik,kdcabang,status) 
 values('$kduser','$username','$password','$pass','$nama','$hakakses','$kdklinik','$kdcabang','1')");

$conn -> query("DELETE FROM user where username=''");

$pesan='Berhasil';

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
}else if ($stssimpan === '2'){
$conn -> autocommit(FALSE);

$username  = $_POST["username"];



if(empty($_POST["password"])){
$password  = "";

}else{
  $password  = hash('md5',$_POST["password"]);

}
$nama  = $_POST["nama"];
$hakakses  = $_POST["hakakses"];
$kdklinik  = $_POST["kdklinik"];
$kdcabang  = $_POST["kdcabang"];
$kduser =  $_POST["kduserlogin"];

$pass =  $_POST["password"];









     $sql="SELECT user FROM transaksiakhir WHERE kdcabang='$kdcabang' AND user='$username' ORDER BY user LIMIT 1";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){


$pasan=201;

if(empty($_POST["password"])){

$conn -> query("UPDATE user set nama='$nama',hakakses='$hakakses'
 where kdklinik='$kdklinik' and  kduser='$kduser' and kdcabang='$kdcabang' ");


$pasan=201;

}else{


$conn -> query("UPDATE user set password='$password',pass='$pass',
nama='$nama',hakakses='$hakakses'
 where kdklinik='$kdklinik' and  kduser='$kduser' and kdcabang='$kdcabang' ");


$pasan=201;
}



}else{


if(empty($_POST["password"])){

$conn -> query("UPDATE user set username='$username',
nama='$nama',hakakses='$hakakses'
 where kdklinik='$kdklinik' and  kduser='$kduser' and kdcabang='$kdcabang' ");


$pasan=200;

}else{


$conn -> query("UPDATE user set username='$username',password='$password',pass='$pass',
nama='$nama',hakakses='$hakakses'
 where kdklinik='$kdklinik' and  kduser='$kduser' and kdcabang='$kdcabang' ");


$pasan=200;
}




}



// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode($pasan);

}

// Rollback transaction
$conn -> rollback();

$conn -> close();
}else if ($stssimpan === '3'){
$conn -> autocommit(FALSE);


$kddokter  = $_POST["kddokter"];
$kdklinik  = $_POST["kdklinik"];
$username   = $_POST["username"];
$kdcabang  = $_POST["kdcabang"];
$conn -> query("UPDATE user set kduser='$kddokter' 


 where kdklinik='$kdklinik' and  username='$username' and kdcabang='$kdcabang' ");




// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode('Sukses');

}

// Rollback transaction
$conn -> rollback();

$conn -> close();

}









?>