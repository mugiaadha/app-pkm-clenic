<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$sts=$_GET['sts'];
$kdcabang=$_GET['kdcabang'];
$notransasal=$_GET['notransasal'];



if($sts === '1'){
$query="SELECT
a.kddokterasal,b.namdokter,a.kddokter,c.namdokter AS dokter,a.isi,d.kdpoli,a.notransasal,a.notrans,d.norm

FROM konsultasirj a
LEFT JOIN dokter b on a.kddokterasal = b.kddokter
LEFT JOIN dokter c ON a.kddokter = c.kddokter
LEFT JOIN kunjunganpasien d on a.notrans = d.notransaksi
WHERE a.kdcabang='$kdcabang' AND a.notransasal='$notransasal'";



}else{
$query="SELECT
a.kddokterasal,b.namdokter,a.kddokter,c.namdokter AS dokter,a.isi,d.kdpoli,a.notransasal,a.notrans,d.norm

FROM konsultasirj a
LEFT JOIN dokter b on a.kddokterasal = b.kddokter
LEFT JOIN dokter c ON a.kddokter = c.kddokter
LEFT JOIN kunjunganpasien d on a.notrans = d.notransaksi
WHERE a.kdcabang='$kdcabang' AND a.notrans='$notransasal'";




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