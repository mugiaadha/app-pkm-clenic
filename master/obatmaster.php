<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$sts=$_GET['sts'];
$type=$_GET['type'];




if($sts === '1'){
$query="SELECT 
a.*,c.nama,b.nama AS sup,d.jenis,e.golongan
FROM obat a

LEFT JOIN suplier b
ON a.kdsuplier = b.kdsup
LEFT join
pabrikan c  ON a.kdpabrikan = c.kdpabrikan left join jenisobat d ON a.jenisobat = d.kdjenis
 left join golonganobat e ON a.golonganobat = e.kdgolongan
 where a.kdcabang='$kdcabang' order by  a.kdobat desc limit 100  ";
}else{


if($type === '1'){

$nama=$_GET['nama'];
$query="SELECT 
a.*,c.nama,b.nama AS sup,d.jenis,e.golongan
FROM obat a

LEFT JOIN suplier b
ON a.kdsuplier = b.kdsup
LEFT join
pabrikan c  ON a.kdpabrikan = c.kdpabrikan left join jenisobat d ON a.jenisobat = d.kdjenis
 left join golonganobat e ON a.golonganobat = e.kdgolongan

 where a.kdcabang='$kdcabang' and a.obat like '%$nama%'  order by  a.kdobat desc limit 100  ";

}else{
    $nama=$_GET['nama'];
$query="SELECT 
a.*,c.nama,b.nama AS sup,d.jenis,e.golongan
FROM obat a

LEFT JOIN suplier b
ON a.kdsuplier = b.kdsup
LEFT join
pabrikan c  ON a.kdpabrikan = c.kdpabrikan left join jenisobat d ON a.jenisobat = d.kdjenis
 left join golonganobat e ON a.golonganobat = e.kdgolongan

 where a.kdcabang='$kdcabang' and a.zataktifasli like '%$nama%'  order by  a.kdobat desc limit 100  ";

}


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