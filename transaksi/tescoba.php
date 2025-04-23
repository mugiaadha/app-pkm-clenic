<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$query="
SELECT 
a.kdobat,sum(a.qty) as qty,b.obat
FROM jualobatd a , obat b 
WHERE a.kdobat = b.kdobat
and a.notransaksi='' AND a.nofaktur='RJ-TR11220711-001' AND a.kdcabang='002'  GROUP BY kdobat";



 $response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
// echo "minta".$row['qty']."<br>";

$kdobat = $row['kdobat'];


$queryy="SELECT a.kdgudang,b.gudang,a.stok from obatstock a, gudang b

 WHERE   a.kdgudang = b.kdgudang  and a.kdgudang='GD002' and a.kdobat='$kdobat'";
 $responsex=array();
$resultt=mysqli_query($conn, $queryy);
while($roww=mysqli_fetch_array($resultt,MYSQLI_ASSOC)) {
  $responsex[]=$roww;
// echo "stok".$roww['stok']."<br>";


// if($row['qty'] > $roww['stok']){




// $x =  "stok".$row['obat']."kurang";



// }else{


// $x =  "stok".$row['obat']."cukup";



// }












}

$temp = array(

 "qty" => $row['qty'],  
   "stst" => $responsex,  



);
   
    array_push($response, $temp);





}



$data = json_encode($response);
echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);



mysqli_close($conn);



?>