<?php

// $data = json_decode(file_get_contents('php://input'), true);
// $employee_name=$data["employee_name"];
// $employee_salary=$data["employee_salary"];
// $employee_age=$data["employee_age"];


// $query="INSERT INTO tb_employee SET
//  employee_name='".$employee_name."',
//  employee_salary='".$employee_salary."',
// employee_age='".$employee_age."'";

// if(mysqli_query($conn, $query)) {
// $response=array(
// 'status' => 1,
// 'status_message' =>'Employee Added Successfully.'
// );
// }
// else {
// $response=array(
// 'status' => 0,
// 'status_message' =>'Employee Addition Failed.'
// );


 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
  $rest_json = file_get_contents("php://input");
  $_POST = json_decode($rest_json,true);



// $username  = $_POST["username"];
// $password  = hash('md5',$_POST["password"]);
// $nama  = $_POST["nama"];
// $hakakses  = $_POST["hakakses"];
// $kdklinik  = $_POST["kdklinik"];
// $kdcabang  = $_POST["kdcabang"];
// $kduser = $kdklinik.$kdcabang.$username;





$conn -> autocommit(FALSE);

// Insert some values
$conn -> query("INSERT INTO user(kduser,username,password,nama,hakakses,kdklinik,kdcabang) 
 values('$kduser','$username','$password','$nama','$hakakses','$kdklinik','$kdcabang')");

$conn -> query("DELETE FROM user where username=''");




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






?>