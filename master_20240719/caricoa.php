<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$coa=$_GET['coa'];
$sts=$_GET['sts'];



if($sts === '1'){
$query="SELECT * FROM coa where parent='0' and akun like '%$coa%' and kdcabang ='$kdcabang' order by kdakun asc ";

}else{
$parent=$_GET['parent'];
$query="SELECT * FROM coa where parent='$parent' and akun like '%$coa%' and kdcabang ='$kdcabang' order by kdakun asc ";

}



$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>