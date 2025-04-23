<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$nofaktur=$_GET['nofaktur'];
$nolpb=$_GET['nolpb'];



$query="SELECT * from beliobatd where NOFAKTUR='$nofaktur' and NOLPB='$nolpb' and kdcabang='$kdcabang' order by nomor desc";





$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
// $response[]=$row;




    $temp = array(
"NOMOR" => $row['NOMOR'],
    "KDJENISOBAT" => $row['KDJENISOBAT'],
    "KDOBAT"=> $row['KDOBAT'],
    "OBAT"=> $row['OBAT'],
    "SATUAN"=> $row['SATUAN'],
    "HNA"=> $row['HNA'],
     "HNARP"=> number_format($row['HNA'],0),
    "QTY"=> $row['QTY'],
    "DISCPERSEN"=> $row['DISCPERSEN'],
    "DISCRP"=> $row['DISCRP'],
     "TOTAL"=>$row['TOTAL'],
    "TOTALRP"=> number_format($row['TOTAL'],0),
    "NOFAKTUR"=> $row['NOFAKTUR'],
    "NOLPB"=> $row['NOLPB'],
    "KDSUPLIER"=> $row['KDSUPLIER'],
    "TGLEX"=> $row['TGLEX'],
    "NOBATCH"=> $row['NOBATCH'],
    "STATUS"=> $row['STATUS'],
    "KDCABANG"=> $row['KDCABANG'],
    "QTYR" => $row['QTYR'],
    "DISCPERSENR" => $row['DISCPERSENR'],
    "DISCRPR" => $row['DISCRPR'],
    "TOTALR" => $row['TOTALR'],
     "TOTALRN" => number_format($row['TOTALR'],0),
    "STATUSR"  => $row['STATUSR'],
    "STATUSRV"  => $row['STATUSRV'],


);
   
    array_push($response, $temp);


}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>