<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
date_default_timezone_set('Asia/Jakarta');


include '../koneksi.php';


$kdcabang=$_GET['kdcabang'];
$nofaktur=$_GET['nofaktur'];


$nama=$_GET['nama'];

$sts=$_GET['sts'];



if($sts === '1'){

$queryx="SELECT 
a.*
FROM transaksipasiend a,poliklinik b
WHERE a.kdpoli = b.kdpoli  AND b.filter='2'  and a.notransaksi='$nofaktur' 
and a.kdcabang='$kdcabang' and  a.produk like '%$nama%' and a.ri='0'  order by a.nomor asc";

}else if($sts === '2'){

$queryx="SELECT 
a.*
FROM transaksipasiend a,poliklinik b
WHERE a.kdpoli = b.kdpoli  AND b.filter='3'  and a.notransaksi='$nofaktur' 
and a.kdcabang='$kdcabang' and  a.produk like '%$nama%' and a.ri='0' order by a.nomor asc";


}else{

}

$responsex=array();
$resultx=mysqli_query($conn, $queryx);

while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {



      $temp = array(

   "notransaksi" =>$rowx['notransaksi'],
    "nofaktur" =>$rowx['nofaktur'],
    "tgltransaksi" => $rowx['tgltransaksi'],
     "waktu" => $rowx['waktu'],
        "nomor" =>$rowx['nomor'],
    "kdproduk"=>$rowx['kdproduk'],
    "produk"=>$rowx['produk'],
    "kdpoli"=>$rowx['kdpoli'],
  "qty"=>$rowx['qty'],
    "harga"=>number_format($rowx['harga'],0),
       "hargaa"=>$rowx['harga'],
 "debet"=>number_format($rowx['debet'],0),
    "debeta"=>$rowx['debet'],

    "kridit"=>number_format($rowx['kridit'],0),

     "kridita"=>$rowx['kridit'],
    "jenistransaksi"=>$rowx['jenistransaksi'],
     "tarifasli"=>$rowx['tarifasli'],
      "disc"=>$rowx['disc'],
       "print"=>$rowx['print'],
      "kdcabang"=>$rowx['kdcabang'],
      "user"=>$rowx['user'],
        "prosestutup"=>$rowx['prosestutup'],

);

   
    array_push($responsex, $temp);






}


$data = json_encode($responsex);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>