<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';


$kdcabang = $_GET['kdcabang'];
$nama = $_GET['nama'];

$dari = $_GET['dari'];



if($dari == '1'){
// supplier

	$query="SELECT  * FROM suplier where nama like '%$nama%' and kdcabang='$kdcabang' order by  kdsup desc  ";


}else if($dari == '2'){
// pabrikan
	$query="SELECT  * FROM pabrikan where nama like '%$nama%' and kdcabang='$kdcabang' order by  kdpabrikan desc  ";

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