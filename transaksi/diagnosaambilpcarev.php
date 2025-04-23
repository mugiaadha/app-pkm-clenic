<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$kdcabang=$_GET['kdcabang'];
$notrans=$_GET['notrans'];

$query="SELECT 
(SELECT b.kddiagnosa FROM ermcpptdiagnosa b WHERE  b.notrans=a.notrans AND b.status='diagnosa' ORDER BY a.no ASC LIMIT 1 ) AS kddiag1
,
(SELECT c.kddiagnosa FROM ermcpptdiagnosa c WHERE  c.notrans='xxxxxx' AND c.indexno=2 AND c.status='diagnosa') AS kddiag2
,
(SELECT d.kddiagnosa FROM ermcpptdiagnosa d WHERE  d.notrans='xxxxxx'  AND d.indexno=3 AND d.status='diagnosa') AS kddiag3

 from ermcpptdiagnosa a WHERE  a.notrans='$notrans'
AND a.status='diagnosa'   order BY a.no asc limit 3";





$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>