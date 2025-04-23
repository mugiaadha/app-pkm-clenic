<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
 date_default_timezone_set( 'Asia/Bangkok' );

$tgl = date("Y-m-d");


$sts=$_GET['sts'];

// $tglx=$_GET['tgl'];

 $tglx = substr($_GET['tgl'], 0, 10);




if($sts === '1'){
$query="SELECT 
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,a.notransaksi,b.pasien,b.tgllahir,c.noantrian,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas
FROM kunjunganpasien a , pasien b,antrian c,poliklinik d, dokter e,kelompokkostumerd f,kelompokkostumer g
WHERE a.norm = b.norm 
AND a.notransaksi = c.notransaksi AND a.kdpoli = d.kdpoli AND a.kddokter = e.kddokter AND
a.kdkostumerd = f.kdkostumerd AND f.kdkostumer = g.kdkostumer AND a.kdcabang='$kdcabang' AND a.tglpriksa='$tgl'  and a.ri='No' order by a.kddokter,c.noantrian asc ";
}else if($sts === '2'){
$notransaksi=$_GET['notransaksi'];
$query="SELECT 
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,a.notransaksi,b.pasien,b.tgllahir,c.noantrian,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas,g.dash,b.noasuransi,d.kdpolibpjs,b.kdprovider,a.spcare,c.noantrianbpjs,a.nokunjungan,i.kodeantrian,c.dari,c.status
,b.idpasien,e.idhis,d.idsatusehat,b.nopengenal,e.kddokterbpjs,b.hp
FROM kunjunganpasien a , pasien b,antrian c,poliklinik d, dokter e,kelompokkostumerd f,
kelompokkostumer g,dokterklinik i
WHERE a.norm = b.norm 
AND a.notransaksi = c.notransaksi AND a.kdpoli = d.kdpoli AND a.kddokter = e.kddokter AND
a.kdkostumerd = f.kdkostumerd AND f.kdkostumer = g.kdkostumer AND a.kdcabang='$kdcabang' and a.notransaksi='$notransaksi'  and a.ri='No' 
and i.kdpoli = a.kdpoli and i.kddokter = a.kddokter

  order by a.kddokter,c.noantrian asc ";

}else if($sts === '3'){

$nama=$_GET['nama'];
$query="SELECT 
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,a.notransaksi,b.pasien,b.tgllahir,c.noantrian,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas,b.kdprovider,a.spcare,c.noantrianbpjs,b.idpasien,e.idhis,d.idsatusehat,b.nopengenal
FROM kunjunganpasien a , pasien b,antrian c,poliklinik d, dokter e,kelompokkostumerd f,kelompokkostumer g
WHERE a.norm = b.norm 
AND a.notransaksi = c.notransaksi AND a.kdpoli = d.kdpoli AND a.kddokter = e.kddokter AND
a.kdkostumerd = f.kdkostumerd AND f.kdkostumer = g.kdkostumer AND a.kdcabang='$kdcabang' AND
b.pasien like '%$nama%' and a.tglpriksa='$tgl'  and a.ri='No'  order by a.kddokter,c.noantrian asc ";

}else if($sts === '4'){

$query="SELECT 
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,a.notransaksi,b.pasien,b.tgllahir,c.noantrian,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas,d.sts
FROM kunjunganpasien a , pasien b,antrian c,poliklinik d, dokter e,kelompokkostumerd f,kelompokkostumer g
WHERE a.norm = b.norm 
AND a.notransaksi = c.notransaksi AND a.kdpoli = d.kdpoli AND a.kddokter = e.kddokter AND
a.kdkostumerd = f.kdkostumerd AND f.kdkostumer = g.kdkostumer AND a.kdcabang='$kdcabang' 
AND a.tglpriksa='$tglx' and d.filter='1'  and a.ri='No'  order by a.kddokter,c.noantrian asc  ";

}else if($sts === '5'){
$nama=$_GET['nama'];
$query="SELECT 
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,a.notransaksi,b.pasien,b.tgllahir,c.noantrian,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas,d.sts
FROM kunjunganpasien a , pasien b,antrian c,poliklinik d, dokter e,kelompokkostumerd f,kelompokkostumer g
WHERE a.norm = b.norm 
AND a.notransaksi = c.notransaksi AND a.kdpoli = d.kdpoli AND a.kddokter = e.kddokter AND
a.kdkostumerd = f.kdkostumerd AND f.kdkostumer = g.kdkostumer AND a.kdcabang='$kdcabang' 
AND a.tglpriksa='$tglx' and b.pasien like '%$nama%'   and a.ri='No'  and d.filter='1' order by a.kddokter,c.noantrian asc ";



}else if($sts === '6'){
$nama=$_GET['nama'];
$query="SELECT 
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,a.notransaksi,b.pasien,b.tgllahir,c.noantrian,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas,d.sts
FROM kunjunganpasien a , pasien b,antrian c,poliklinik d, dokter e,kelompokkostumerd f,kelompokkostumer g
WHERE a.norm = b.norm 
AND a.notransaksi = c.notransaksi AND a.kdpoli = d.kdpoli AND a.kddokter = e.kddokter AND
a.kdkostumerd = f.kdkostumerd AND f.kdkostumer = g.kdkostumer AND a.kdcabang='$kdcabang' 
AND a.tglpriksa='$tglx' and b.norm like '%$nama%' and a.ri='No'   and d.filter='1' order by a.kddokter,c.noantrian asc ";


}else if($sts === '7'){
$nama=$_GET['nama'];

$query="
SELECT a.notransaksi,
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,b.pasien,b.tgllahir,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas,a.nofaktur,a.kddokterpengirim
,x.namdokter as dokterkirim,b.jeniskelamin,'1' AS statusverif
FROM kunjunganpasien a 
LEFT join pasien b on a.norm = b.norm 
left join poliklinik d ON  a.kdpoli = d.kdpoli
LEFT JOIN  dokter e ON  a.kddokter = e.kddokter
left join kelompokkostumerd f on a.kdkostumerd = f.kdkostumerd
left join kelompokkostumer g ON f.kdkostumer = g.kdkostumer
LEFT  JOIN dokter x ON x.kddokter = a.kddokterpengirim
WHERE d.filter='2'  AND a.tglpriksa='$tglx' and a.ri='No'  and a.kdcabang='$kdcabang'  and  b.pasien like '%$nama%' 
UNION
SELECT distinct
a.notransaksi,
a.norm,a.kdpoli,a.tglpriksa,'' AS kddokter,a.kdkostumerd,b.pasien,b.tgllahir,
d.nampoli,'' as namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,'1' AS kelas,a.notransaksi AS  nofaktur,
a.kddokter as kddokterpengirim,x.namdokter as dokterkirim,b.jeniskelamin,a.status AS statusverif
FROM ermcpptintruksi a 
LEFT join pasien b on a.norm = b.norm 
left join poliklinik d ON  a.kdpoli = d.kdpoli
LEFT JOIN  dokter e ON  a.kddokter = e.kddokter
left join kelompokkostumerd f on a.kdkostumerd = f.kdkostumerd
left join kelompokkostumer g ON f.kdkostumer = g.kdkostumer
LEFT  JOIN dokter x ON x.kddokter = a.kddokter
WHERE d.filter='2'  AND a.tglpriksa='$tglx'   and a.status='0' and a.kdcabang='$kdcabang'  and  b.pasien like '%$nama%' AND a.dari='laborat'  and a.kirim='Ya' 
 ORDER BY tglpriksa,pasien asc";


}else if($sts === '8'){
$nama=$_GET['nama'];
$query="SELECT a.notransaksi,
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,b.pasien,b.tgllahir,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas,a.nofaktur,a.kddokterpengirim
,x.namdokter as dokterkirim,b.jeniskelamin,'1' AS statusverif
FROM kunjunganpasien a 
LEFT join pasien b on a.norm = b.norm 
left join poliklinik d ON  a.kdpoli = d.kdpoli
LEFT JOIN  dokter e ON  a.kddokter = e.kddokter
left join kelompokkostumerd f on a.kdkostumerd = f.kdkostumerd
left join kelompokkostumer g ON f.kdkostumer = g.kdkostumer
LEFT  JOIN dokter x ON x.kddokter = a.kddokterpengirim
WHERE d.filter='2'  AND a.tglpriksa='$tglx'  and a.ri='No' and a.kdcabang='$kdcabang'  and  b.norm like '%$nama%' 
UNION
SELECT distinct
a.notransaksi,
a.norm,a.kdpoli,a.tglpriksa,'' AS kddokter,a.kdkostumerd,b.pasien,b.tgllahir,
d.nampoli,'' as namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,'1' AS kelas,a.notransaksi AS  nofaktur,
a.kddokter as kddokterpengirim,x.namdokter as dokterkirim,b.jeniskelamin,a.status AS statusverif
FROM ermcpptintruksi a 
LEFT join pasien b on a.norm = b.norm 
left join poliklinik d ON  a.kdpoli = d.kdpoli
LEFT JOIN  dokter e ON  a.kddokter = e.kddokter
left join kelompokkostumerd f on a.kdkostumerd = f.kdkostumerd
left join kelompokkostumer g ON f.kdkostumer = g.kdkostumer
LEFT  JOIN dokter x ON x.kddokter = a.kddokter
WHERE d.filter='2'  AND a.tglpriksa='$tglx'  and a.status='0' and a.kdcabang='$kdcabang'  and  b.norm like '%$nama%' AND a.dari='laborat'  and a.kirim='Ya' 
 ORDER BY tglpriksa,pasien asc ";


}else if($sts === '9'){
$nama=$_GET['nama'];

$query="SELECT a.notransaksi,
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,b.pasien,b.tgllahir,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas,a.nofaktur,a.kddokterpengirim
,x.namdokter as dokterkirim,b.jeniskelamin,'1' AS statusverif,'' as kdcppt
FROM kunjunganpasien a 
LEFT join pasien b on a.norm = b.norm 
left join poliklinik d ON  a.kdpoli = d.kdpoli
LEFT JOIN  dokter e ON  a.kddokter = e.kddokter
left join kelompokkostumerd f on a.kdkostumerd = f.kdkostumerd
left join kelompokkostumer g ON f.kdkostumer = g.kdkostumer
LEFT  JOIN dokter x ON x.kddokter = a.kddokterpengirim
WHERE d.filter='3'  AND a.tglpriksa='$tglx' and a.ri='No'  and a.kdcabang='$kdcabang'  and  b.pasien like '%$nama%' 
UNION


SELECT distinct
a.notransaksi,
a.norm,a.kdpoli,a.tglpriksa,'' AS kddokter,a.kdkostumerd,b.pasien,b.tgllahir,
d.nampoli,'' as namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,'1' AS kelas,a.notransaksi AS  nofaktur,
a.kddokter as kddokterpengirim,x.namdokter as dokterkirim,b.jeniskelamin,a.status AS statusverif,a.kdcppt
FROM ermcpptintruksi a 
LEFT join pasien b on a.norm = b.norm 
left join poliklinik d ON  a.kdpoli = d.kdpoli
LEFT JOIN  dokter e ON  a.kddokter = e.kddokter
left join kelompokkostumerd f on a.kdkostumerd = f.kdkostumerd
left join kelompokkostumer g ON f.kdkostumer = g.kdkostumer
LEFT  JOIN dokter x ON x.kddokter = a.kddokter
WHERE d.filter='3'  AND a.tglpriksa='$tglx'  and a.status='0' and a.kdcabang='$kdcabang'  and  b.pasien like '%$nama%' AND a.dari='radiologi'  and a.kirim='Ya' ORDER BY tglpriksa,pasien asc";








}else if($sts === '10'){
$nama=$_GET['nama'];

$query="SELECT a.notransaksi,
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,b.pasien,b.tgllahir,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas,a.nofaktur,a.kddokterpengirim
,x.namdokter as dokterkirim,b.jeniskelamin,'1' AS statusverif,'' as kdcppt
FROM kunjunganpasien a 
LEFT join pasien b on a.norm = b.norm 
left join poliklinik d ON  a.kdpoli = d.kdpoli
LEFT JOIN  dokter e ON  a.kddokter = e.kddokter
left join kelompokkostumerd f on a.kdkostumerd = f.kdkostumerd
left join kelompokkostumer g ON f.kdkostumer = g.kdkostumer
LEFT  JOIN dokter x ON x.kddokter = a.kddokterpengirim
WHERE d.filter='3'  AND a.tglpriksa='$tglx' and a.ri='No'  and a.kdcabang='$kdcabang'  and  a.norm like '%$nama%' 
UNION


SELECT distinct
a.notransaksi,
a.norm,a.kdpoli,a.tglpriksa,'' AS kddokter,a.kdkostumerd,b.pasien,b.tgllahir,
d.nampoli,'' as namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,'1' AS kelas,a.notransaksi AS  nofaktur,
a.kddokter as kddokterpengirim,x.namdokter as dokterkirim,b.jeniskelamin,a.status AS statusverif,a.kdcppt
FROM ermcpptintruksi a 
LEFT join pasien b on a.norm = b.norm 
left join poliklinik d ON  a.kdpoli = d.kdpoli
LEFT JOIN  dokter e ON  a.kddokter = e.kddokter
left join kelompokkostumerd f on a.kdkostumerd = f.kdkostumerd
left join kelompokkostumer g ON f.kdkostumer = g.kdkostumer
LEFT  JOIN dokter x ON x.kddokter = a.kddokter
WHERE d.filter='3'  AND a.tglpriksa='$tglx'  and a.status='0'  and a.kdcabang='$kdcabang'  and  a.norm like '%$nama%' AND a.dari='radiologi'   and a.kirim='Ya'  ORDER BY tglpriksa,pasien asc";

}else if($sts === '11'){
$nama=$_GET['nama'];
$query="SELECT 
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,a.notransaksi,b.pasien,b.tgllahir,
d.nampoli as nampolias,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas,'riasli' as sts,i.tglmasuk,j.nama as nampoli,k.namakelas,i.kdkamar
FROM kunjunganpasien a , pasien b,poliklinik d, dokter e,kelompokkostumerd f,kelompokkostumer g,pasienrawatinap i,kamar j,kamarkelas k
WHERE a.norm = b.norm 
AND a.kdpoli = d.kdpoli AND a.kddokter = e.kddokter AND
a.kdkostumerd = f.kdkostumerd AND f.kdkostumer = g.kdkostumer AND a.kdcabang='$kdcabang' 
AND a.notransaksi = i.notransaksi
AND i.kdkamar = j.kdkamar AND a.kelas = k.kdkelas and  i.tglpulang IS null

 and b.pasien like '%$nama%'   and a.ri='Ya'   order by a.kddokter asc ";



}else{

}


// echo $query;

$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>