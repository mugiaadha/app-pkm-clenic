<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
date_default_timezone_set( 'Asia/Bangkok' );
// $tgl = date("Y-m-d");
$kdcabang=$_GET['kdcabang'];
// $kddokter=$_GET['kddokter'];
$sts=$_GET['sts'];
$nama=$_GET['nama'];

$stss=$_GET['stss'];


$tgl=$_GET['tgl'];

$tgls=$_GET['tgls'];

if($stss ==='1'){
$query="SELECT 
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,a.notransaksi,b.pasien,b.tgllahir,c.noantrian,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas,c.status,
case c.status when 'SELESAI' then '1' ELSE '0' END AS koreksirmakhir 
,i.kodeantrian,d.kdpolibpjs,b.noasuransi,a.spcare,g.dash,c.idsatusehat
FROM kunjunganpasien a , pasien b,antrian c,poliklinik d, dokter e,kelompokkostumerd f,kelompokkostumer g,dokterklinik i
WHERE a.norm = b.norm 
AND a.notransaksi = c.notransaksi AND a.kdpoli = d.kdpoli AND a.kddokter = e.kddokter AND
a.kdkostumerd = f.kdkostumerd AND f.kdkostumer = g.kdkostumer AND a.kdcabang='$kdcabang' AND a.tglpriksa BETWEEN '$tgl' and  '$tgls'
 and a.koreksirmakhir='$sts' 
  and a.kdpoli = i.kdpoli AND a.kddokter = i.kddokter
 and b.pasien like '%$nama%' and c.rirj is null order by a.kddokter,c.noantrian asc  ";



}elseif($stss === '2'){
$query="SELECT 
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,a.notransaksi,b.pasien,b.tgllahir,c.noantrian,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas,c.status,
case c.status when 'SELESAI' then '1' ELSE '0' END AS koreksirmakhir 
,i.kodeantrian,d.kdpolibpjs,b.noasuransi,a.spcare,g.dash,c.idsatusehat
FROM kunjunganpasien a , pasien b,antrian c,poliklinik d, dokter e,kelompokkostumerd f,kelompokkostumer g,dokterklinik i
WHERE a.norm = b.norm 
AND a.notransaksi = c.notransaksi AND a.kdpoli = d.kdpoli AND a.kddokter = e.kddokter AND
a.kdpoli = i.kdpoli AND a.kddokter = i.kddokter and
a.kdkostumerd = f.kdkostumerd AND f.kdkostumer = g.kdkostumer AND a.kdcabang='$kdcabang' and a.tglpriksa BETWEEN '$tgl' and  '$tgls'
   and b.pasien like '%$nama%' and c.rirj is null order by a.kddokter,c.noantrian asc  ";



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