<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];

$sts=$_GET['sts'];
$nama=$_GET['nama'];
$tgl=$_GET['tgl'];


if($sts === '1'){

$query="SELECT 
a.nofaktur,a.tgl,c.pasien,a.kdpoli,e.nampoli,a.kdkostumer as kdkostumerd,d.nama,a.kddokter,
f.namdokter,a.notransaksi,'1' AS sts,a.norm,a.statuslunas,a.keteranganretur,a.stsr,a.noretur,a.kdgudang,
a.tglretur
FROM jualobat a,pasien c,kelompokkostumerd d,poliklinik e,dokter f
WHERE a.norm =c.norm AND a.kdkostumer = d.kdkostumerd
 AND a.kdpoli = e.kdpoli AND  a.tglretur='$tgl' and a.kddokter=f.kddokter  AND   a.kdcabang='$kdcabang' 
 and a.noretur LIKE '%$nama%' AND a.stsr='1' and a.totaluangr > 0 order by c.pasien asc";




}else if($sts === '2'){
$query="SELECT 
a.nofaktur,a.tgl,c.pasien,a.kdpoli,e.nampoli,a.kdkostumer as kdkostumerd,d.nama,a.kddokter,
f.namdokter,a.notransaksi,'1' AS sts,a.norm,a.statuslunas,a.keteranganretur,a.stsr,a.noretur,a.kdgudang,
a.tglretur
FROM jualobat a,pasien c,kelompokkostumerd d,poliklinik e,dokter f
WHERE a.norm =c.norm AND a.kdkostumer = d.kdkostumerd
 AND a.kdpoli = e.kdpoli AND  a.tglretur='$tgl' and a.kddokter=f.kddokter  AND   a.kdcabang='$kdcabang' 
 and c.pasien LIKE '%$nama%' AND a.stsr='1'  and a.totaluangr > 0 order by c.pasien asc";








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