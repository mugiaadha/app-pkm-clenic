<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$kdobat=$_GET['kdobat'];




$query="SELECT
a.*,b.stok
FROM obat a 
LEFT join obatstock b ON a.kdobat = b.kdobat AND a.kdcabang = b.kdcabang
LEFT JOIN gudang c ON c.kdgudang = b.kdgudang 
WHERE a.kdcabang ='$kdcabang' AND c.utama='1' and  a.kdobat='$kdobat'

order by  a.kdobat asc limit 20  ";



$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {



$temp = array(


   "kdobat" => $row["kdobat"],  
  "stok" => number_format($row["stok"],0),
"obat" => $row["obat"],
"obatx" => $row["obat"],
"kdcp" => $row["kdcp"],
"kdbs" => $row["kdbs"],
"standart" => $row["standart"],
"kdobatsatusehat" => $row["kdobatsatusehat"]

);
   
    array_push($response, $temp);



}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>