<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
date_default_timezone_set( 'Asia/Bangkok' );
 $sekarang = new DateTime();


$kdcabang=$_GET['kdcabang'];
$notransaksi=$_GET['notrans'];



$query="SELECT 
a.*,d.nama AS namasps,e.nama AS nmkamar,f.namdokter,g.nama AS nmkostumer,h.nama AS kostumercob,i.pasien,i.hp,i.nopengenal,i.alamat,c.namakelas,j.kdtarif,i.statusmarital,
i.jeniskelamin,i.agama,i.pendidikan,i.hp,i.perkerjaan,i.tgllahir,i.noasuransi,i.tandapengenal,i.statusmarital
FROM pasienrawatinap a 
LEFT JOIN 
kunjunganpasien b ON  a.notransaksi = b.notransaksi 
LEFT join kamarkelas c ON a.kdklas = c.kdkelas
LEFT join spesialis d ON a.kdspesial = d.kdspesial
LEFT JOIN kamar e ON a.kdkamar = e.kdkamar 
left join dokter f ON a.kddokter = f.kddokter
left join kelompokkostumerd g ON a.kdkostumer = g.kdkostumerd
left join kelompokkostumerd h ON a.kdkostumercob = g.kdkostumerd
left join kelompokkostumer j on j.kdkostumer = g.kdkostumer
LEFT JOIN pasien i ON a.norm = i.norm 
WHERE   a.kdcabang='$kdcabang' 
 AND a.notransaksi='$notransaksi'
order by e.nama,i.pasien asc";




$arr=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {


   $tanggal_lahir = new DateTime($row['tgllahir']);
    if ($tanggal_lahir > $sekarang) { 
    $thn = "0";
    $bln = "0";
    $tgl = "0";
    }
    $thn = $sekarang->diff($tanggal_lahir)->y;
    $bln = $sekarang->diff($tanggal_lahir)->m;
    $tgl = $sekarang->diff($tanggal_lahir)->d;
    $umur =  $thn." tahun ".$bln." bulan ".$tgl." hari";




   $temp = array(


    "norm" => $row['norm'],
   
    "tglmasuk"  => $row['tglmasuk'],
    "jammasuk"  => $row['jammasuk'],
    "kddokter" => $row['kddokter'],
    "kdkostumerd" => $row['kdkostumer'],
    "notransaksi" => $row['notransaksi'],
    "pasien" => $row['pasien'],
    "tgllahir" => $row['tgllahir'],
  
    "namdokter" => $row['namdokter'],
  "jk" => $row['jeniskelamin'],
    "costumer" => $row['nmkostumer'],
    "alamat" => $row['alamat'],
    "kdtarif" => $row['kdtarif'],
    "kelas" => $row['namakelas'],
   
    "umur" =>  $umur,

   
    "noasuransi"  => $row['noasuransi'],
     "agama"  => $row['agama'],
     "pendidikan"  => $row['pendidikan'],
     "hp"  => $row['hp'],
     "perkerjaan"  => $row['perkerjaan'],
      // "nokunjungan"  => $row['nokunjungan'],
      // "skunjungan"  => $row['skunjungan'],
    // "jeniskunjungan"  => $row['jeniskunjungan'],
      "tandapengenal"  => $row['tandapengenal'],
      "nopengenal"  => $row['nopengenal'],
      "caramasuk"  => $row['caramasuk'],
      "penerimaan"  => $row['penerimaan'],
   // "hp"  => $row['hp'],
      "kdkostumer"  => $row['kdkostumer'],
 "nmkamar"  => $row['nmkamar'],
 "kdkamar"  => $row['kdkamar'],
 "statusmarital" => $row['statusmarital'],
 "pj"  => $row['pj'],
  "pjnama"  => $row['pjnama'],
    "pjhp"  => $row['pjhp'],
     "pjalamat"  => $row['pjalamat'],
);

   
    array_push($arr, $temp);



}
$data = json_encode($arr);



echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>