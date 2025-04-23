<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

 date_default_timezone_set( 'Asia/Bangkok' );
 $todayDate = date("Y-m-d");
 
//  $tgl=$_GET['tgl'];
 $hari =  date('D', strtotime($todayDate));



if ($hari === 'Sun'){
    $hariq = 'minggu';

}else if($hari === 'Mon'){
$hariq = 'senin';
    
}else if($hari === 'Tue'){
$hariq ='selasa';
    
}else if($hari === 'Wed'){

$hariq ='rabu';
    
}else if($hari === 'Thu'){

$hariq = 'kamis';
    
}else if($hari === 'Fri'){
$hariq ='jumat';
     
 }else if($hari === 'Sat'){
$hariq = 'sabtu';
 }else{


 }



$kddokter=$_GET['kddokter'];
$kodepoliasli=$_GET['kodepoliasli'];

$sql = "SELECT $hariq as jadwal from jadwalpraktek where kddokter='".$kddokter."'
    and kdpoli='".$kodepoliasli."'";


$response=array();
$result=mysqli_query($conn, $sql);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>