<?php
  $host = "localhost"; //host server
  $user = "clen_clenic"; // user server
  $pass = "Clenic2024"; // isikan password jika user anda memiliki password
  $dbname = "clen_efamedika"; // nama database yang ingin anda koneksikan


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