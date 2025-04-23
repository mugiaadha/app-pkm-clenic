<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
date_default_timezone_set( 'Asia/Bangkok' );
 $sekarang = new DateTime();


$kdcabang=$_GET['kdcabang'];
$notrans=$_GET['notrans'];



$query="SELECT 
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,a.notransaksi,b.pasien,b.tgllahir,c.noantrian,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas,a.koreksierm,g.dash,d.sts,b.noasuransi,d.kdpolibpjs,e.kddokterbpjs,DATE_FORMAT(a.tglpriksa, '%d-%m-%Y') as tgldaftar,a.spcare,a.nokunjungan,a.skunjungan,a.jeniskunjungan,b.tandapengenal,b.nopengenal,b.kdprovider,b.hp,g.kdkostumer,b.idpasien,c.idsatusehat,e.idhis,
b.jeniskelamin,a.kdtkp,a.ri,d.status
FROM kunjunganpasien a , pasien b,antrian c,poliklinik d, dokter e,kelompokkostumerd f,kelompokkostumer g
WHERE a.norm = b.norm 
AND a.notransaksi = c.notransaksi AND a.kdpoli = d.kdpoli AND a.kddokter = e.kddokter AND
a.kdkostumerd = f.kdkostumerd AND f.kdkostumer = g.kdkostumer AND a.kdcabang='$kdcabang' 
and a.notransaksi='$notrans' order by a.kddokter,c.noantrian asc  ";




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


if($row['jeniskelamin'] === 'L'){
    $jk='L';
    
}else{
    
    $jk='P';
    
}

   $temp = array(


    "norm" => $row['norm'],
    "kdpoli" => $row['kdpoli'],
    "tglpriksa"  => $row['tglpriksa'],
    "kddokter" => $row['kddokter'],
    "kdkostumerd" => $row['kdkostumerd'],
    "notransaksi" => $row['notransaksi'],
    "pasien" => $row['pasien'],
    "tgllahir" => $row['tgllahir'],
    "noantrian" => $row['noantrian'],
    "nampoli" => $row['nampoli'],
    "namdokter" => $row['namdokter'],
    "nama" => $row['nama'],
    "costumer" => $row['costumer'],
    "alamat" => $row['alamat'],
    "kdtarif" => $row['kdtarif'],
    "kelas" => $row['kelas'],
    "koreksierm"=> $row['koreksierm'],
    "umur" =>  $umur,
    "ststarif"  => $row['sts'],
    "dash"  => $row['dash'],
    "noasuransi"  => $row['noasuransi'],
     "kdpolibpjs"  => $row['kdpolibpjs'],
     "kddokterbpjs"  => $row['kddokterbpjs'],
     "tgldaftar"  => $row['tgldaftar'],
     "spcare"  => $row['spcare'],
      "nokunjungan"  => $row['nokunjungan'],
      "skunjungan"  => $row['skunjungan'],
       "jeniskunjungan"  => $row['jeniskunjungan'],
      "tandapengenal"  => $row['tandapengenal'],
      "nopengenal"  => $row['nopengenal'],
      "kdprovider"  => $row['kdprovider'],
      "hp"  => $row['hp'],
      "kdkostumer"  => $row['kdkostumer'],
      "idpasien" =>$row['idpasien'],
      "idsatusehat" =>$row['idsatusehat'],
       "idhis" =>$row['idhis'],
       "jeniskelamin" =>$jk,
  
        "kdtkp"=>$row['kdtkp'],
        "ri"=>$row['ri'],
        "status"=>$row['status']
        


);

   
    array_push($arr, $temp);



}
$data = json_encode($arr);



echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>