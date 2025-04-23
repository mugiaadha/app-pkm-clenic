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
and a.notransaksi='$notransaksi' AND a.nofaktur='$nofaktur' AND a.kdcabang='$kdcabang'
and a.dari='CPPT' and a.status='0'
GROUP BY a.kdobat";

$result=mysqli_query($conn, $query);

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {


 $dataset[] = $row['status'];





}




// echo implode ("", $dataset);
$kalimat = implode ("", $dataset);
$dicari=0;
  if(preg_match("/$dicari/i", $kalimat)) {
           $response =  1;

         
    
        }else {
           $response = 0;
        }



        $data = json_encode($response);
echo $data;

?>