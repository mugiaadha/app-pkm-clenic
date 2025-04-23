<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];

$sts=$_GET['sts'];
// $tgl = date("Y-m-d");
$tgl=$_GET['tgl'];



if($sts === 'ALL'){

$query="SELECT 
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,a.notransaksi,b.pasien,b.tgllahir,c.noantrian,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas
FROM kunjunganpasien a , pasien b,antrian c,poliklinik d, dokter e,kelompokkostumerd f,kelompokkostumer g
WHERE a.norm = b.norm 
AND a.notransaksi = c.notransaksi AND a.kdpoli = d.kdpoli AND a.kddokter = e.kddokter AND
a.kdkostumerd = f.kdkostumerd AND f.kdkostumer = g.kdkostumer AND a.kdcabang='$kdcabang' 
AND a.tglpriksa='$tgl' order by a.kddokter,c.noantrian asc ";

}else if($sts ==='ri'){
$query="SELECT 
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,a.notransaksi,b.pasien,b.tgllahir,c.noantrian,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas
FROM kunjunganpasien a , pasien b,antrian c,poliklinik d, dokter e,kelompokkostumerd f,kelompokkostumer g
WHERE a.norm = b.norm 
AND a.notransaksi = c.notransaksi AND a.kdpoli = d.kdpoli AND a.kddokter = e.kddokter AND
a.kdkostumerd = f.kdkostumerd AND f.kdkostumer = g.kdkostumer AND a.kdcabang='$kdcabang' 
AND a.tglpriksa='$tgl'  AND d.sts='ri' order by a.kddokter,c.noantrian asc ";

}else if($sts ==='lab'){
$query="SELECT 
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,a.notransaksi,b.pasien,b.tgllahir,c.noantrian,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas
FROM kunjunganpasien a , pasien b,antrian c,poliklinik d, dokter e,kelompokkostumerd f,kelompokkostumer g
WHERE a.norm = b.norm 
AND a.notransaksi = c.notransaksi AND a.kdpoli = d.kdpoli AND a.kddokter = e.kddokter AND
a.kdkostumerd = f.kdkostumerd AND f.kdkostumer = g.kdkostumer AND a.kdcabang='$kdcabang' 
AND a.tglpriksa='$tgl'  AND d.sts='lab' order by a.kddokter,c.noantrian asc ";
}else if($sts ==='BPJS'){
$query="SELECT 
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,a.notransaksi,b.pasien,b.tgllahir,c.noantrian,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas
FROM kunjunganpasien a , pasien b,antrian c,poliklinik d, dokter e,kelompokkostumerd f,kelompokkostumer g
WHERE a.norm = b.norm 
AND a.notransaksi = c.notransaksi AND a.kdpoli = d.kdpoli AND a.kddokter = e.kddokter AND
a.kdkostumerd = f.kdkostumerd AND f.kdkostumer = g.kdkostumer AND a.kdcabang='$kdcabang' 
AND a.tglpriksa='$tgl'  AND g.dash='BPJS' order by a.kddokter,c.noantrian asc ";

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