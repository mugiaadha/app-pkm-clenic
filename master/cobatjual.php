<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$kdgudang=$_GET['kdgudang'];
$nama=$_GET['nama'];




$query="SELECT 
a.kdobat,a.stok,b.obat,a.kdgudang
FROM obatstock a,obat b
WHERE a.kdobat = b.kdobat AND a.kdcabang = b.kdcabang AND a.kdgudang='$kdgudang' AND b.obat LIKE '%$nama%' and b.kdcabang='$kdcabang' and a.stok > 0 order by  a.kdobat asc limit 10";

$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {



$temp = array(


   "kdobat" => $row["kdobat"],  
"obat" => $row["obat"]. '|'.$row['stok'],
"stok" => $row["stok"],
"kdgudang" => $row["kdgudang"],


);
   
    array_push($response, $temp);



}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>