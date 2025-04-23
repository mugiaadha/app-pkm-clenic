<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$tgl=$_GET['tgl'];
$sts=$_GET['sts'];
$pasien=$_GET['pasien'];




if($sts === '0'){
$query="SELECT  distinct
a.nomor_transaksi,a.norm,b.pasien,a.poli_id,d.nampoli,a.dokter_id,c.namdokter,a.nomor_antrian,a.jadwal_pertemuan,a.statusverif
FROM transaksi_pasien_mobile a , pasien b,dokter c , poliklinik d
WHERE a.norm = b.norm AND a.dokter_id = c.kddokter AND a.poli_id = d.kdpoli AND a.cabang_id='$kdcabang' AND a.statusverif='0' 
AND DATE(a.jadwal_pertemuan)='$tgl' and b.pasien like '%$pasien%' order by b.pasien ,a.nomor_antrian asc";



}else if($sts === '1'){
$query=" SELECT  distinct
a.nomor_transaksi,a.norm,b.pasien,a.poli_id,d.nampoli,a.dokter_id,c.namdokter,a.nomor_antrian,a.jadwal_pertemuan,a.statusverif
FROM transaksi_pasien_mobile a , pasien b,dokter c , poliklinik d
WHERE a.norm = b.norm AND a.dokter_id = c.kddokter AND a.poli_id = d.kdpoli AND a.cabang_id='$kdcabang' AND a.statusverif='0' 
AND DATE(a.jadwal_pertemuan)='$tgl'  and a.nomor_transaksi like '%$pasien%' order by b.pasien ,a.nomor_antrian asc";




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