<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$nama=$_GET['nama'];
$tgl=$_GET['tgl'];


$query="SELECT 
a.*,d.nama AS namasps,e.nama AS nmkamar,f.namdokter,g.nama AS nmkostumer,h.nama AS kostumercob,i.pasien,i.hp,i.nopengenal,i.alamat,c.namakelas,j.kdtarif
FROM pasienrawatinap a 
LEFT JOIN 
kunjunganpasien b ON  a.notransaksi = b.notransaksi 
LEFT join kamarkelas c ON a.kdklas = c.kdkelas
LEFT join spesialis d ON a.kdspesial = d.kdspesial
LEFT JOIN kamar e ON a.kdkamar = e.kdkamar 
left join dokter f ON a.kddokter = f.kddokter
left join kelompokkostumerd g ON a.kdkostumer = g.kdkostumerd
left join kelompokkostumerd h ON a.kdkostumercob = g.kdkostumerd
left join kelompokkostumer j on j.kdkostumer = g.kdkostumer
LEFT JOIN pasien i ON a.norm = i.norm 
WHERE   a.kdcabang='$kdcabang' AND tglpulang='$tgl'
and i.pasien like '%$nama%' 
order by e.nama,i.pasien asc";






$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>