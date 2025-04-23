<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$notransaksi=$_GET['notransaksi'];


$query="SELECT 
a.kdproduk,a.produk,a.harga,SUM(a.qty) AS qty,SUM(a.debet) AS debet,SUM(a.kridit) AS kridit,SUM(a.disc) AS disc
FROM transaksipasiend a
WHERE  a.nofaktur='$notransaksi'  and a.kdcabang='$kdcabang'
  and a.notransaksi <> '' 
  GROUP BY a.kdproduk,a.produk
  
   order by a.kdproduk asc";


$response=array();
$result=mysqli_query($conn, $query);
while($rowx=mysqli_fetch_array($result,MYSQLI_ASSOC)) {




      $temp = array(

   "kdproduk" =>$rowx['kdproduk'],
     "produk" =>$rowx['produk'],
    "harga"=>number_format($rowx['harga'],0),
  
 "debet"=>number_format($rowx['debet'],0),


    "kridit"=>number_format($rowx['kridit'],0),
"qty"=>number_format($rowx['qty'],0),
"disc"=>number_format($rowx['disc'],0),
   
   
);

   
    array_push($response, $temp);




}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>