<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';



$kdcabang = $_GET['kdcabang'];
$notransaksi = $_GET['notransaksi'];
$jk = $_GET['jk'];





$q="SELECT distinct a.kdgolongan,a.golongan ,d.notransaksi
FROM teslab a 
LEFT join mapinglaborat b
on a.kdlab = b.kdtes 
AND a.kdcabang = b.kdcabang
LEFT JOIN transaksipasiend d
ON b.kdproduk = d.kdproduk 
AND a.kdcabang = d.kdcabang
LEFT JOIN hasillab f
on f.notrans=d.notransaksi
AND a.kdlab = f.kdlab
AND f.kdcabang = d.kdcabang
where d.notransaksi ='$notransaksi' AND d.kdcabang='$kdcabang' order by golongan,nourut asc";
$responseq=array();
$resultq=mysqli_query($conn, $q);
while($rowq=mysqli_fetch_array($resultq,MYSQLI_ASSOC)) {
$kdgolongan = $rowq['kdgolongan'];







$query="SELECT a.* ,b.kdproduk,d.notransaksi,f.hasil,f.keterangan,f.warna
FROM teslab a 
LEFT join mapinglaborat b
on a.kdlab = b.kdtes 
AND a.kdcabang = b.kdcabang
LEFT JOIN transaksipasiend d
ON b.kdproduk = d.kdproduk 
AND a.kdcabang = d.kdcabang
LEFT JOIN hasillab f
on f.notrans=d.notransaksi
AND a.kdlab = f.kdlab
AND f.kdcabang = d.kdcabang
where d.notransaksi ='$notransaksi' and a.kdgolongan='$kdgolongan'  AND d.kdcabang='$kdcabang' order by golongan,nourut asc";
$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
// $response[]=$row;

if($jk === 'L'){
$jk = $row['reflaki'];
}else{
$jk = $row['refperempuan'];
}

     $temp = array(
    

    "kdlab"=> $row["kdlab"],
  "nama"=> $row["nama"],
 "kdgolongan"=> $row["kdgolongan"],
"golongan" => $row["golongan"],
"kdmetode" => $row["kdmetode"],
 "metode" => $row["metode"],
"satuan" => $row["satuan"],
    "refrensi" => $jk,
     "lmin" => $row["lmin"],
 "lmax" => $row["lmax"],
"pmin"=> $row["pmin"],
"pmax"=> $row["pmax"],
 "kdcabang" => $row["kdcabang"],
"hasil" => $row["hasil"],
"kdproduk" => $row["kdproduk"],
 "keterangan" => $row["keterangan"],
 "warna" => $row["warna"],
);
   
    array_push($response, $temp);




}








    $temp = array(
   "kdgolongan" => $rowq["kdgolongan"],
   "golongan" => $rowq["golongan"],
 
   "detail" => $response

);
   
    array_push($responseq, $temp);





}









$data = json_encode($responseq);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);




mysqli_close($conn);


?>