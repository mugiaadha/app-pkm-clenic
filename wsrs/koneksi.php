<?php
  $host = "localhost"; //host server
  $user = "root"; // user server
  $pass = ""; // isikan password jika user anda memiliki password
  $dbname = "clenic"; // nama database yang ingin anda koneksikan





  try
  {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    // echo 'Koneksi Sukses';
  }
  catch(PDOException $error)
  {
    echo 'Koneksi Gagal '.$error -> getMessage();
  }

?>