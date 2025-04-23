<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];

$sts=$_GET['sts'];
$nama=$_GET['nama'];
$tgl=$_GET['tgl'];





if($sts === '1'){

$query="
 SELECT distinct
 a.nofaktur,a.tgl,c.pasien,b.kdpoli,e.nampoli,b.kdkostumerd,d.nama,b.kddokter,f.namdokter,a.notransaksi,'0' AS sts,b.norm,'0' as statuslunas,'' as kdgudang,'' as bayar
 FROM jualobatd a, kunjunganpasien b,pasien c,kelompokkostumerd d,poliklinik e,dokter f
 WHERE a.nofaktur = b.notransaksi AND a.norm =c.norm AND b.kdkostumerd = d.kdkostumerd
 AND b.kdpoli = e.kdpoli AND  b.kddokter=f.kddokter and  a.status='0' AND b.kdcabang='$kdcabang'
 and  a.dari='CPPT' and a.tgl='$tgl' and a.notransaksi like '%$nama%' and a.kirim='Ya' 
 union

SELECT 
a.nofaktur,a.tgl,c.pasien,a.kdpoli,e.nampoli,a.kdkostumer as kdkostumerd,d.nama,a.kddokter,
f.namdokter,a.notransaksi,'1' AS sts,a.norm,a.statuslunas,a.kdgudang,a.bayar
FROM jualobat a

left join pasien c ON a.norm =c.norm
LEFT JOIN kelompokkostumerd d ON  a.kdkostumer = d.kdkostumerd
LEFT JOIN poliklinik e ON a.kdpoli = e.kdpoli

left join dokter f ON a.kddokter=f.kddokter 
WHERE  a.tgl='$tgl' and   a.kdcabang='$kdcabang' 
 and c.pasien like '%$nama%' and a.ri is null";




}else if($sts === '2'){
$query="
 SELECT distinct
 a.nofaktur,a.tgl,c.pasien,b.kdpoli,e.nampoli,b.kdkostumerd,d.nama,b.kddokter,f.namdokter,a.notransaksi,'0' AS sts,b.norm,'0' as statuslunas,'' as  kdgudang,'' as bayar
 FROM jualobatd a, kunjunganpasien b,pasien c,kelompokkostumerd d,poliklinik e,dokter f
 WHERE a.nofaktur = b.notransaksi AND a.norm =c.norm AND b.kdkostumerd = d.kdkostumerd
 AND b.kdpoli = e.kdpoli AND   a.tgl='$tgl' and b.kddokter=f.kddokter and  a.status='0' AND b.kdcabang='$kdcabang' and a.dari='CPPT' and  c.pasien like '%$nama%' and a.kirim='Ya' and a.ri='CPPT'
 union

SELECT 
a.nofaktur,a.tgl,c.pasien,a.kdpoli,e.nampoli,a.kdkostumer as kdkostumerd,d.nama,a.kddokter,
f.namdokter,a.notransaksi,'1' AS sts,a.norm,a.statuslunas,a.kdgudang,a.bayar
FROM jualobat a

left join pasien c ON a.norm =c.norm
LEFT JOIN kelompokkostumerd d ON  a.kdkostumer = d.kdkostumerd
LEFT JOIN poliklinik e ON a.kdpoli = e.kdpoli

left join dokter f ON a.kddokter=f.kddokter 
WHERE  a.tgl='$tgl' and   a.kdcabang='$kdcabang' 
 and c.pasien like '%$nama%' and a.ri is null";









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