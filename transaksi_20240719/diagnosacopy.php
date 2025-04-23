<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$norm=$_GET['norm'];
$sts=$_GET['sts'];
$kdpoli=$_GET['kdpoli'];
$query="SELECT DISTINCT notrans,tgl FROM ermcpptdiagnosa where norm='$norm' and kdcabang='$kdcabang' and status='$sts' and kdpoli='$kdpoli' order by  tgl desc";


$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$notrans = $row['notrans'];

	$queryx="SELECT * FROM ermcpptdiagnosa where notrans='$notrans' and kdcabang='$kdcabang' and status='$sts'  and kdpoli='$kdpoli'order by  tgl desc";
$responsexx=array();
$resultxx=mysqli_query($conn, $queryx);

while($rowxx=mysqli_fetch_array($resultxx,MYSQLI_ASSOC)) {

   $responsexx[]=$rowxx;




}


	 $temp = array(
 	"notrans" => $row["notrans"],
 "tgl" => $row["tgl"],
 "resp" => $responsexx

);
   
    array_push($response, $temp);


}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>