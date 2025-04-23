<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$sts=$_GET['sts'];




if($sts === '1'){

$query="SELECT  a.*,xc.city_name,re.subdis_name

 FROM pasien a
 
 left join keluarahan re ON  a.kdkelurahan = re.subdis_id
left join kecamatan xb ON     re.dis_id = xb.dis_id
left join kabupaten xc ON  xb.city_id = xc.city_id  where a.kdcabang='$kdcabang'   order by  a.norm desc  LIMIT 50";

}else if($sts ==='2'){
	$nama=$_GET['nama'];

	$query="SELECT  a.*,xc.city_name,re.subdis_name

 FROM pasien a
 
 left join keluarahan re ON  a.kdkelurahan = re.subdis_id
left join kecamatan xb ON     re.dis_id = xb.dis_id
left join kabupaten xc ON  xb.city_id = xc.city_id  where a.kdcabang='$kdcabang' and a.pasien like '%$nama%'   order by  a.norm desc  LIMIT 50";




}else if($sts === '3'){

    $nama=$_GET['nama'];
$query="SELECT  a.*,xc.city_name,re.subdis_name

 FROM pasien a
 
 left join keluarahan re ON  a.kdkelurahan = re.subdis_id
left join kecamatan xb ON     re.dis_id = xb.dis_id
left join kabupaten xc ON  xb.city_id = xc.city_id  where a.kdcabang='$kdcabang' and a.norm like '%$nama%'   order by  a.norm  LIMIT 50";


}else if($sts === '4'){
   $nama=$_GET['nama'];
$query="SELECT  a.*,xc.city_name,re.subdis_name

 FROM pasien a
 
 left join keluarahan re ON  a.kdkelurahan = re.subdis_id
left join kecamatan xb ON     re.dis_id = xb.dis_id
left join kabupaten xc ON  xb.city_id = xc.city_id  where a.kdcabang='$kdcabang' and a.nopengenal like '%$nama%'   order by  a.norm  LIMIT 50";


}else if($sts === '5'){
   $nama=$_GET['nama'];
$query="SELECT  a.*,xc.city_name,re.subdis_name

 FROM pasien a
 
 left join keluarahan re ON  a.kdkelurahan = re.subdis_id
left join kecamatan xb ON     re.dis_id = xb.dis_id
left join kabupaten xc ON  xb.city_id = xc.city_id  where a.kdcabang='$kdcabang' and a.hp like '%$nama%'   order by  a.norm  LIMIT 50";

}else if($sts === '6'){
   $nama=$_GET['nama'];
$query="SELECT  a.*,xc.city_name,re.subdis_name,r.kdkostumer
 FROM pasien a
 left join keluarahan re ON  a.kdkelurahan = re.subdis_id
left join kecamatan xb ON     re.dis_id = xb.dis_id
left join kabupaten xc ON  xb.city_id = xc.city_id 
LEFT JOIN kelompokkostumerd r ON a.kdasuransi = r.kdkostumerd
 where a.kdcabang='$kdcabang' and a.noasuransi ='$nama'   order by  a.norm  LIMIT 50";

 
}else if($sts === '7'){
   $nama=$_GET['nama'];
$query="SELECT  a.*,xc.city_name,re.subdis_name,r.kdkostumer
 FROM pasien a
 left join keluarahan re ON  a.kdkelurahan = re.subdis_id
left join kecamatan xb ON     re.dis_id = xb.dis_id
left join kabupaten xc ON  xb.city_id = xc.city_id 
LEFT JOIN kelompokkostumerd r ON a.kdasuransi = r.kdkostumerd
 where a.kdcabang='$kdcabang' and a.nopengenal ='$nama'   order by  a.norm  LIMIT 50";

 

}else{
	$nama=$_GET['nama'];
$query="SELECT  a.*,xc.city_name,re.subdis_name

 FROM pasien a
 
 left join keluarahan re ON  a.kdkelurahan = re.subdis_id
left join kecamatan xb ON     re.dis_id = xb.dis_id
left join kabupaten xc ON  xb.city_id = xc.city_id  where a.kdcabang='$kdcabang' and a.pasien like '%$nama%'   order by  a.norm  LIMIT 50";

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