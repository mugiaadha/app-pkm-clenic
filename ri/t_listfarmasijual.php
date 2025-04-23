<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];


$nama=$_GET['nama'];
$tgl=$_GET['tgl'];






$query="SELECT 
a.nofaktur,a.tgl,c.pasien,a.kdpoli,e.nama as nampoli,a.kdkostumer as kdkostumerd,d.nama,a.kddokter,
f.namdokter,a.notransaksi,'1' AS sts,a.norm,a.statuslunas,a.kdgudang,a.bayar,'Ya' as ri
FROM jualobat a

left join pasien c ON a.norm =c.norm
LEFT JOIN kelompokkostumerd d ON  a.kdkostumer = d.kdkostumerd
LEFT JOIN kamar e ON a.kdpoli = e.kdkamar

left join dokter f ON a.kddokter=f.kddokter 
WHERE  a.tgl='$tgl' and   a.kdcabang='$kdcabang' 
 and c.pasien LIKE '%$nama%'

 UNION 
SELECT DISTINCT
 a.nofaktur,a.tgl,c.pasien,g.kdkamar AS kdpoli,l.nama  AS namapoli,b.kdkostumerd,e.nama,b.kddokter,f.namdokter,a.notransaksi,'0' AS sts,b.norm,'0' as statuslunas,'' as  kdgudang,'' as bayar,'Ya' AS ri
 FROM jualobatd a, kunjunganpasien b,pasien c,dokter f,kelompokkostumerd e,pasienrawatinap g,kamar l
 WHERE a.nofaktur = b.notransaksi AND a.norm =c.norm AND b.kdkostumerd = e.kdkostumerd AND g.kdkamar = l.kdkamar
AND   a.tgl='$tgl' and b.kddokter=f.kddokter  and a.status='0' AND b.kdcabang='$kdcabang' and a.ri='CPPTRI' and  c.pasien LIKE '%$nama%' and a.kirim='Ya'


  ";














$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>