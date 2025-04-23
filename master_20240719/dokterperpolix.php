<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$kdpoli=$_GET['kdpoli'];


date_default_timezone_set( 'Asia/Jakarta' );




$hari = date('D');






if ($hari === 'Sun'){
	$hariq = 'minggu';

}else if($hari === 'Mon'){
$hariq = 'senin';
	
}else if($hari === 'Tue'){
$hariq = 'selasa';
	
}else if($hari === 'Wed'){

$hariq = 'rabu';
	
}else if($hari === 'Thu'){

$hariq = 'kamis';
	
}else if($hari === 'Fri'){
$hariq = 'jumat';
	
 }else if($hari === 'Sat'){
$hariq = 'sabtu';
 }else{


 }
 
 
// $query="SELECT 
// a.kddokter,a.namdokter,b.kdpoli,c.nampoli
// FROM dokter a ,dokterklinik b , poliklinik c
// WHERE a.kddokter = b.kddokter AND b.kdpoli = c.kdpoli AND a.kdcabang AND 
// a.kdcabang='$kdcabang' AND b.kdpoli='$kdpoli' and a.aktif='0'   order by nampoli asc ";


$query="
SELECT 
a.kddokter,a.namdokter,b.kdpoli,c.nampoli,d.$hariq as hari
FROM dokter a 
left join dokterklinik b ON a.kddokter = b.kddokter AND a.kdcabang=b.kdcabang 
left join poliklinik c ON  b.kdpoli = c.kdpoli AND b.kdcabang = c.kdcabang
LEFT JOIN jadwalpraktek d ON a.kddokter = d.kddokter AND d.kdpoli = c.kdpoli
WHERE 


 b.kdcabang='$kdcabang'  AND b.kdpoli='$kdpoli'  order by nampoli asc";



$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>