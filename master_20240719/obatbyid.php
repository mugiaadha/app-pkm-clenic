<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$kdobat=$_GET['kdobat'];



$query="SELECT 
a.*,c.nama,b.nama AS sup,d.jenis,e.golongan
FROM obat a

LEFT JOIN suplier b
ON a.kdsuplier = b.kdsup
LEFT join
pabrikan c  ON a.kdpabrikan = c.kdpabrikan left join jenisobat d ON a.jenisobat = d.kdjenis
 left join golonganobat e ON a.golonganobat = e.kdgolongan
 where a.kdcabang='$kdcabang'  and a.kdobat='$kdobat' order by  a.kdobat asc limit 20  ";




$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>