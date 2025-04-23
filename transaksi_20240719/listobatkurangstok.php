<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$kdcabang = $_GET['kdcabang'];
$notransaksi = $_GET['notransaksi'];
$nofaktur = $_GET['nofaktur'];







$query="SELECT 
a.kdobat,sum(a.qty) AS qty,b.obat,c.stok,d.gudang,
CASE WHEN SUM(a.qty) > c.stok THEN '0' ELSE '1' END AS status
FROM jualobatd a , obat b ,obatstock c,gudang d
WHERE a.kdobat = b.kdobat AND b.kdobat = c.kdobat AND c.kdgudang = d.kdgudang AND d.utama='1' 
and a.notransaksi='$notransaksi' AND a.nofaktur='$nofaktur' AND a.kdcabang='$kdobat'
 
  GROUP BY a.kdobat";




$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>