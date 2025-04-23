<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$nama=$_GET['nama'];





$query="SELECT 
a.*,b.nama,c.namdokter,d.nama as kamar,e.pasien
FROM  pasienrawatinap a ,kelompokkostumerd b,dokter c,kamar d,pasien e
WHERE a.norm = e.norm AND a.kdkostumer = b.kdkostumerd AND a.kddokter = c.kddokter AND a.kdkamar = d.kdkamar AND a.kdcabang='$kdcabang' AND a.statuspulang='0' and e.pasien like '%$nama%' order by d.nama,b.nama asc ";
$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>