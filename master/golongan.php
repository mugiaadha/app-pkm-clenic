<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$nama = $_GET['nama'];
$dari = $_GET['dari'];
$kdcabang = $_GET['kdcabang'];




if($dari == '1'){


$query="SELECT  * FROM metodelab where kdcabang='$kdcabang' and status='golongan' order by  urut asc ";

}else if($dari == '2'){
$query="SELECT  * FROM metodelab where metode like '%$nama%' and kdcabang='$kdcabang' and status='golongan' order by  urut asc ";

}else if($dari == '3'){
$query="SELECT  * FROM metodelab where metode like '%$nama%' and kdcabang='$kdcabang' and status='PERKEJAAN' order by  urut asc ";
    
}else{


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