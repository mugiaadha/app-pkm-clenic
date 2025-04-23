<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$notrans=$_GET['notrans'];
$sts=$_GET['sts'];






$query="SELECT a.notransaksi,
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,b.pasien,b.tgllahir,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas,a.nofaktur,a.kddokterpengirim
,x.namdokter as dokterkirim,b.jeniskelamin,'1' AS statusverif
FROM kunjunganpasien a 
LEFT join pasien b on a.norm = b.norm 
left join poliklinik d ON  a.kdpoli = d.kdpoli
LEFT JOIN  dokter e ON  a.kddokter = e.kddokter
left join kelompokkostumerd f on a.kdkostumerd = f.kdkostumerd
left join kelompokkostumer g ON f.kdkostumer = g.kdkostumer
LEFT  JOIN dokter x ON x.kddokter = a.kddokterpengirim
WHERE  a.kdcabang='$kdcabang' AND  a.notransaksi='$notrans' ";



$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>