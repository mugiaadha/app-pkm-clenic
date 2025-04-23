<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
 date_default_timezone_set( 'Asia/Bangkok' );



$statuscari=$_GET['statuscari'];


$sts=$_GET['sts'];



 $tglx = $_GET['tgl'];




 if($statuscari === 'semua'){




    if($sts === '5'){
// pasien

        $nama=$_GET['nama'];


$query="
SELECT a.notransaksi,
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
WHERE d.filter='2'   and a.kdcabang='$kdcabang'  and  b.pasien like '%$nama%' 
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
WHERE d.filter='2'  and a.status='0' and a.kdcabang='$kdcabang'  and  b.pasien like '%$nama%' AND a.dari='laborat'  and a.kirim='Ya' 
 ORDER BY tglpriksa,pasien asc  LIMIT  50";






    }else if($sts === '6'){
// norm
$nama=$_GET['nama'];



$query="
SELECT a.notransaksi,
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
WHERE d.filter='2'   and a.kdcabang='$kdcabang'  and  b.norm like '%$nama%' 
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
WHERE d.filter='2'  and a.status='0' and a.kdcabang='$kdcabang'  and  b.norm like '%$nama%' AND a.dari='laborat'  and a.kirim='Ya' 
 ORDER BY tglpriksa,pasien asc  LIMIT  50";






    }else if($sts === '51'){
// ktp
$nama=$_GET['nama'];




$query="
SELECT a.notransaksi,
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
WHERE d.filter='2'   and a.kdcabang='$kdcabang'  and  b.nopengenal like '%$nama%' 
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
WHERE d.filter='2'  and a.status='0' and a.kdcabang='$kdcabang'  and  b.nopengenal like '%$nama%' AND a.dari='laborat'  and a.kirim='Ya' 
 ORDER BY tglpriksa,pasien asc  LIMIT  50";




    }else if($sts === '61'){
// hp
$nama=$_GET['nama'];



$query="
SELECT a.notransaksi,
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
WHERE d.filter='2'   and a.kdcabang='$kdcabang'  and b.hp like '%$nama%' 
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
WHERE d.filter='2'  and a.status='0' and a.kdcabang='$kdcabang'  and b.hp like '%$nama%' AND a.dari='laborat'  and a.kirim='Ya' 
 ORDER BY tglpriksa,pasien asc  LIMIT  50";



    }



 }else{






  if($sts === '5'){
        $nama=$_GET['nama'];



$query="
SELECT a.notransaksi,
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
WHERE d.filter='2'  AND a.tglpriksa='$tglx'   and a.kdcabang='$kdcabang'  and  b.pasien like '%$nama%' 
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
WHERE d.filter='2'  AND a.tglpriksa='$tglx'   and a.status='0' and a.kdcabang='$kdcabang'  and  b.pasien like '%$nama%' AND a.dari='laborat'  and a.kirim='Ya' 
 ORDER BY tglpriksa,pasien asc";





    }else if($sts === '6'){

$nama=$_GET['nama'];

 $query="
SELECT a.notransaksi,
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
WHERE d.filter='2'  AND a.tglpriksa='$tglx'   and a.kdcabang='$kdcabang'  and  b.norm like '%$nama%' 
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
WHERE d.filter='2'  AND a.tglpriksa='$tglx'   and a.status='0' and a.kdcabang='$kdcabang'  and  b.norm like '%$nama%' AND a.dari='laborat'  and a.kirim='Ya' 
 ORDER BY tglpriksa,pasien asc";





    }else if($sts === '51'){

$nama=$_GET['nama'];



  $query="
SELECT a.notransaksi,
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
WHERE d.filter='2'  AND a.tglpriksa='$tglx'   and a.kdcabang='$kdcabang'  and  b.nopengenal like '%$nama%' 
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
WHERE d.filter='2'  AND a.tglpriksa='$tglx'   and a.status='0' and a.kdcabang='$kdcabang'  and  b.nopengenal like '%$nama%' AND a.dari='laborat'  and a.kirim='Ya' 
 ORDER BY tglpriksa,pasien asc";



    }else if($sts === '61'){

$nama=$_GET['nama'];




  $query="
SELECT a.notransaksi,
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
WHERE d.filter='2'  AND a.tglpriksa='$tglx'   and a.kdcabang='$kdcabang'  and  b.hp like '%$nama%' 
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
WHERE d.filter='2'  AND a.tglpriksa='$tglx'   and a.status='0' and a.kdcabang='$kdcabang'  and b.hp like '%$nama%' AND a.dari='laborat'  and a.kirim='Ya' 
 ORDER BY tglpriksa,pasien asc";





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