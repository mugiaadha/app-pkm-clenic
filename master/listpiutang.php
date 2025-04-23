<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];

$sts=$_GET['sts'];
$nama=$_GET['nama'];
$tgl=strtotime($_GET['tgl']);


// $time = strtotime('2022-08-10');

$tahun = date('Y',$tgl);
$bulan = date('m',$tgl);

// echo $bulan;
// 2003-10-16




if($sts === '1'){

$query="SELECT
a.notrans,a.tglfaktur AS tgl,a.norm,c.pasien,b.nampoli,a.kdkostumer,d.nama,a.tagihan - a.totalcash AS total,'RJ' AS sts,a.kdpoli
FROM transaksiakhir a , poliklinik b, pasien c ,kelompokkostumerd d
WHERE a.kdpoli = b.kdpoli AND a.norm = c.norm AND a.kdcabang='$kdcabang'
AND a.kdkostumer = d.kdkostumerd
AND (a.tagihan - a.totalcash) > 0 
AND YEAR(a.tglfaktur)='$tahun'  AND MONTH(a.tglfaktur)='$bulan' and a.notrans like '%$nama%'
UNION ALL
SELECT 
a.notransaksi,a.tgl,a.norm,c.pasien,b.nampoli,a.kdkostumer,d.nama,a.totalbayar - a.sudahbayar AS total,'FARMASI' AS sts,,a.kdpoli
FROM jualobat a, poliklinik b, pasien c ,kelompokkostumerd d
WHERE a.kdpoli = b.kdpoli AND a.norm = c.norm AND a.kdkostumer = d.kdkostumerd
AND a.kdcabang='$kdcabang' AND (a.totalbayar - a.sudahbayar) > 0
AND YEAR(a.tgl)='$tahun'  AND MONTH(a.tgl)='$bulan' and a.notransaksi like '%$nama%'
";





}else if($sts === '2'){

$query="SELECT
a.notrans,a.tglfaktur AS tgl,a.norm,c.pasien,b.nampoli,a.kdkostumer,d.nama,a.tagihan - a.totalcash AS total,'RJ' AS sts,a.kdpoli
FROM transaksiakhir a , poliklinik b, pasien c ,kelompokkostumerd d
WHERE a.kdpoli = b.kdpoli AND a.norm = c.norm AND a.kdcabang='$kdcabang'
AND a.kdkostumer = d.kdkostumerd
AND (a.tagihan - a.totalcash) > 0 
AND YEAR(a.tglfaktur)='$tahun'  AND MONTH(a.tglfaktur)='$bulan' and c.pasien like '%$nama%'
UNION ALL
SELECT 
a.notransaksi,a.tgl,a.norm,c.pasien,b.nampoli,a.kdkostumer,d.nama,a.totalbayar - a.sudahbayar AS total,'FARMASI' AS sts,a.kdpoli
FROM jualobat a, poliklinik b, pasien c ,kelompokkostumerd d
WHERE a.kdpoli = b.kdpoli AND a.norm = c.norm AND a.kdkostumer = d.kdkostumerd
AND a.kdcabang='$kdcabang' AND (a.totalbayar - a.sudahbayar) > 0
AND YEAR(a.tgl)='$tahun'  AND MONTH(a.tgl)='$bulan' and c.pasien like '%$nama%'
";








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