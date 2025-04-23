<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$tgl=$_GET['tgl'];
$sts=$_GET['sts'];
$nama=$_GET['nama'];


if($sts === '1'){

$query="SELECT * from mutasi where nomutasi like '%$nama%' and tgl='$tgl' and kdcabang='$kdcabang' order by tgl";


}else if($sts === '2'){

$query="SELECT * from mutasi where keterangan like '%$nama%' and tgl='$tgl'  and kdcabang='$kdcabang' order by tgl";

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