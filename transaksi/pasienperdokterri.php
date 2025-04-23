<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
date_default_timezone_set( 'Asia/Bangkok' );
$tgl = date("Y-m-d");
$kdcabang=$_GET['kdcabang'];
$kddokter=$_GET['kddokter'];
$sts=$_GET['sts'];
$nama=$_GET['nama'];

$stss=$_GET['stss'];
$status=$_GET['status'];



	$query="SELECT 
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,a.notransaksi,b.pasien,b.tgllahir,c.noantrian,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas,a.koreksierm,c.status,i.kodeantrian,a.spcare
,(SELECT hj.notransaksi FROM pasienrawatinap hj WHERE hj.norm=a.norm AND hj.tglpulang IS NULL) AS notransri
FROM kunjunganpasien a 
LEFT JOIN  pasien b ON a.norm = b.norm 
left join  antrian c ON  a.notransaksi = c.notransaksi

left join  poliklinik d ON a.kdpoli = d.kdpoli
LEFT JOIN   dokter e ON  a.kddokter = e.kddokter
left join  kelompokkostumerd f ON  a.kdkostumerd = f.kdkostumerd 
left join  kelompokkostumer g ON f.kdkostumer = g.kdkostumer
left join  dokterklinik i ON  a.kddokter = i.kddokter and a.kdpoli = i.kdpoli
WHERE 
a.kdcabang='$kdcabang' 

and b.pasien like '%$nama%' and c.rirj ='1' and  
 (SELECT hj.notransaksi FROM pasienrawatinap hj WHERE hj.norm=a.norm AND hj.tglpulang IS NULL) IS not null

 order by a.kddokter,c.noantrian desc  ";








$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>