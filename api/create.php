<?php
 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  
  $rest_json = file_get_contents("php://input");
  $_POST = json_decode($rest_json,true);
  
  $name = $_POST["user"];
  $email = $_POST["email"];
  $username = $_POST["username"];
    $password = $_POST["password"];
  
  
  $servername ="localhost";
  $username = "root";
  $password = "";
  $dbName = "banan";
  $conn = mysqli_connect($servername,$username,$password,$dbName);
  if ($conn->connect_error)
  {
  die("Connection failed:".$conn->connect_error);
  }
  $sql ="INSERT INTO users values("'.$username.'","'.$password.'","'.$name.'","'.$email.'")";

  if($conn->query($sql) === TRUE)
  {
  $outp = "Inserted".$username . "and" .$password
  }else{
  echo json_encode("Error:".$sql . "<br>".$conn->error);
  
  }
  
  $conn->close();
  
  ?>
