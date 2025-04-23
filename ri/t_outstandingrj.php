<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$norm=$_GET['norm'];

$query="SELECT b.tgltransaksi,a.notransaksi, SUM(a.debet) - SUM(a.kridit) AS KREDIT,b.norm,b.kdpoli,c.pasien,d.nampoli 
FROM transaksipasiend a,transaksipasien b,pasien c,poliklinik d
 WHERE a.notransaksi = b.notransaksi AND b.norm = c.norm AND b.kdpoli = d.kdpoli and a.tgltransaksi  AND a.kdcabang='$kdcabang' AND a.ri='0' AND b.norm='$norm'
GROUP BY a.notransaksi,b.norm,b.kdpoli HAVING( SUM(a.debet) - SUM(a.kridit) > 0) order BY a.notransaksi";


$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>