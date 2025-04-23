<?php


include '../koneksi.php';


$query="SELECT * from coa where parent='0'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {


    // `kdakun` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
    // `parent` VARCHAR(200) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
    // `akun` VARCHAR(200) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
    // `kdcabang` VARCHAR(200) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
    // `kdklinik` VARCHAR(200) NULL DEFAULT NULL COLLATE '


$kdakun=$row['kdakun'];
$parent=$row['parent'];
$akun=$row['akun'];


$conn -> query("INSERT INTO coa(kdakun,parent,akun,kdcabang,kdklinik) 
 values('$kdakun','$parent','$akun','003','3')");



}


mysqli_close($conn);


?>