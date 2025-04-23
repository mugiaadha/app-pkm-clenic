<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$kdcabang=$_GET['kdcabang'];
$norm=$_GET['norm'];
$query="SELECT CASE WHEN alergi = '00' THEN 'Tidak ada'
WHEN alergi = '01' THEN 'Seafood'
WHEN alergi = '02' THEN 'Gandum'
WHEN alergi = '03' THEN 'Susu Sapi'
WHEN alergi = '04' THEN 'Kacang-Kacangan'
WHEN alergi = '05' THEN 'Makanan Lain'
ELSE 'Tidak ada'
END AS alergi,
CASE WHEN alergiobat = '00' THEN 'Tidak ada'
WHEN alergiobat = '01' THEN 'Antibiotik'
WHEN alergiobat = '02' THEN 'Antiinflamasi'
WHEN alergiobat = '03' THEN 'Non Steriod'
WHEN alergiobat = '04' THEN 'Aspirin'
WHEN alergiobat = '05' THEN 'Kortikosteroid'
WHEN alergiobat = '06' THEN 'Insulin'
WHEN alergiobat = '07' THEN 'Obat-obat lain'
ELSE 'Tidak ada'
END AS alergi,
bb FROM ermcppt WHERE norm='$norm' AND kdcabang='$kdcabang' AND alergi <> '' 
and alergi <> '-'  ORDER BY tgl DESC LIMIT 1 ";





$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>