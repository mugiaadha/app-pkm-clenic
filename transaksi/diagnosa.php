<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$notrans=$_GET['notrans'];
$sts=$_GET['sts'];


if($sts === 'diagnosa'){
$query="SELECT  a.tgl,notrans,norm,kddokter,kdpoli,a.kddiagnosa,a.diagnosa,a.STATUS,a.no,b.freetext,a.iddiagnosa,c.diag,a.indexno
FROM ermcpptdiagnosa a
LEFT JOIN mdiagnosa b ON a.kddiagnosa = b.kddiagnosa
LEFT JOIN dignosatolak  c ON a.kddiagnosa = c.kdiag

 where notrans='$notrans' and kdcabang='$kdcabang' and status='$sts'  order by  a.indexno";

}else{

$query="SELECT * FROM ermcpptdiagnosa where notrans='$notrans' and kdcabang='$kdcabang' and status='$sts'  order by  diagnosa";


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