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
a.notrans,a.norm,a.tglbayar,a.kdpoli,a.kdkostumer,a.kdcabang,a.status,a.totalutang,
sum(a.totalbayar) AS totalbayar ,b.pasien,c.nampoli,d.nama
FROM bayarpiutang a , pasien b, poliklinik c,kelompokkostumerd d
WHERE a.norm = b.norm AND a.kdpoli = c.kdpoli AND  a.kdkostumer = d.kdkostumerd and a.kdcabang='$kdcabang'
and b.pasien like '%$nama%' AND a.tglbayar='$tgl'

GROUP BY a.notrans,a.tglbayar
order by a.tglbayar,b.pasien desc limit 20";




}else{


 $query=" SELECT 
a.notrans,a.norm,a.tglbayar,a.kdpoli,a.kdkostumer,a.kdcabang,a.status,a.totalutang,
sum(a.totalbayar) AS totalbayar ,b.pasien,c.nampoli,d.nama
FROM bayarpiutang a , pasien b, poliklinik c,kelompokkostumerd d
WHERE a.norm = b.norm AND a.kdpoli = c.kdpoli AND  a.kdkostumer = d.kdkostumerd and a.kdcabang='$kdcabang'
and a.notrans like '%$nama%' AND a.tglbayar='$tgl'

GROUP BY a.notrans,a.tglbayar
order by a.tglbayar,b.pasien desc limit 20";


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