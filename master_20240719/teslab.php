<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$nama = $_GET['nama'];
$kdcabang = $_GET['kdcabang'];
$kdgolongan = $_GET['kdgolongan'];

$dari = $_GET['dari'];





if($dari == '1'){


$query="SELECT  * FROM teslab where kdcabang='$kdcabang' and nama like'%$nama%' and kdgolongan='$kdgolongan' order by  nourut asc ";


}else if($dari == '2'){

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