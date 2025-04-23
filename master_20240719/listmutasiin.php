<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$tgl=$_GET['tgl'];
$sts=$_GET['sts'];
$nama=$_GET['nama'];


if($sts === '1'){

$query="SELECT 
a.* , b.nama
FROM mutasiin a , suplier b
WHERE a.kdsuplier = b.kdsup AND a.kdcabang = b.kdcabang and a.nomutasi like '%$nama%' and a.tgl='$tgl' and a.kdcabang='$kdcabang' order by a.tgl";


}else if($sts === '2'){


$query="SELECT 
a.* , b.nama
FROM mutasiin a , suplier b
WHERE a.kdsuplier = b.kdsup AND a.kdcabang = b.kdcabang and a.keterangan like '%$nama%' and a.tgl='$tgl' and a.kdcabang='$kdcabang' order by a.tgl";



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