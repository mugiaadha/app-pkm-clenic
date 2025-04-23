<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];


$nama=$_GET['nama'];
$sts=$_GET['sts'];


// $query="SELECT * FROM pasien WHERE kdcabang='$kdcabang' AND norm like '%$nama%' ORDER BY norm asc limit 10";
if($sts === '5'){
$query="SELECT * FROM pasien WHERE kdcabang='$kdcabang' AND pasien like '%$nama%' ORDER BY pasien asc limit 10";

}else if($sts === '6'){
$query="SELECT * FROM pasien WHERE kdcabang='$kdcabang' AND norm like '%$nama%' ORDER BY norm asc limit 10";

}

$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {



$temp = array(

   "norm" => $row["norm"],  
   "pasien" => $row["pasien"],  
"namdokter" => $row["alamat"],
"nampoli" => '',
"sts" => 'semua',
"kdkostumerd" => $row["kdasuransi"],


);
   
    array_push($response, $temp);



}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>