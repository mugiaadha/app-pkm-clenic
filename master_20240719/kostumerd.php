<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$kdkelompok=$_GET['kdkelompok'];
$sts=$_GET['sts'];




if($sts === '1'){
$query="SELECT  a.*,b.dash FROM kelompokkostumerd a,kelompokkostumer b  WHERE
a.kdkostumer = b.kdkostumer and
 a.kdcabang='$kdcabang' AND a.kdkostumer='$kdkelompok'   order BY  a.nama asc";
}else{
	$nama=$_GET['nama'];

	$query="SELECT  a.*,b.dash FROM kelompokkostumerd a,kelompokkostumer b  WHERE
a.kdkostumer = b.kdkostumer and
 a.kdcabang='$kdcabang' AND a.kdkostumer='$kdkelompok' and a.nama like '%$nama%'    order BY  a.nama asc";


// $query="SELECT  * FROM kelompokkostumerd  where kdcabang='$kdcabang' and kdkostumer='$kdkelompok' and nama like '%$nama%'  order by  nama ";

}

$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>