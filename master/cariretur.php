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
a.*,b.nama
FROM beliobat a , suplier b
WHERE a.KDSUPPLIER = b.kdsup AND a.KDCABANG = b.kdcabang and a.TGLRETUR='$tgl' and a.kdcabang='$kdcabang'
 AND a.STSR='1' AND 
a.NOFAKTUR like '%$nama%' order by a.NOFAKTUR asc";


}else if($sts === '2'){
$query="SELECT
a.*,b.nama
FROM beliobat a , suplier b
WHERE a.KDSUPPLIER = b.kdsup AND a.KDCABANG = b.kdcabang and a.TGLRETUR='$tgl' and a.kdcabang='$kdcabang'
 AND a.STSR='1' AND 
b.nama like '%$nama%' order by a.NOFAKTUR asc";
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