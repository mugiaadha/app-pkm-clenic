<?php
 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  


 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);




$tgl = date("Y-m-d H:i:s");


  include '../koneksi.php';
  

// 2022-05-10T02:41:04.957Z

$kdklinik        =$data->kdklinik;
$kdcabang=$data->kdcabang;


$stssimpan = $data->stssimpan;

 
 $norm=$data->norm;
 $pasien=$data->pasien;
 $indetitas=$data->indetitas;
 $noindetitas=$data->noindetitas;
 $hp=$data->hp;
 $kdpoli=$data->kdpoli;
 $kddokter=$data->kddokter;
 $tgldaftar=$data->tgldaftar;



 $tgld=substr($tgldaftar,-0,10);


 $kostumer=$data->kostumer;
 $kdkostumer=$data->kdkostumer;
 $noasuransi=$data->noasuransi;
$kelas = $data->kelas;
 $kduser=$data->kduser;


if(empty($data->kdprovider)){
$kdprovider='';
}else{
$kdprovider=str_replace("'"," ` ",$data->kdprovider);
}

if($stssimpan === '1'){


 $conn -> autocommit(FALSE);

   $mows = date_create( $tgldaftar);
  
    $form_no = date_format( $mows, 'ymd' );

$query="SELECT kdtarif from kelompokkostumer where kdkostumer='$kostumer' and kdcabang='$kdcabang'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {




 $jen_tarif = $row['kdtarif'];
 $nomer = 'RJ'.'-'.$jen_tarif.$form_no;
}




    $sql="SELECT notransaksi from transaksipasien where left(notransaksi,15)='$nomer' and kdcabang='$kdcabang' ORDER BY notransaksi desc limit 1";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {


$urut = $row['notransaksi'];
  $awal = substr( $urut, 16, 3 );
        $awal = $awal + 1;

 $urut = strlen( $awal );


        if ( $urut == 1 ) {
            $jum = '00';
        } elseif ( $urut == 2 ) {
            $jum = '0';
        } elseif ( $urut == 3 ) {
            $jum = '';
        }
        $no_trans = $nomer.'-'.$jum.$awal;



}

}else{


   $no_trans = $nomer.'-'.'001';

}





$conn -> query("UPDATE pasien set

kdasuransi='$kdkostumer',noasuransi='$noasuransi',tandapengenal='$indetitas',nopengenal='$noindetitas',
hp='$hp',kdprovider='$kdprovider',idpasien='$data->idhs'
where kdcabang='$kdcabang' and norm='$norm' ");

// echo "UPDATE pasien set

// kdasuransi='$kdkostumer',noasuransi='$noasuransi',tandapengenal='$indetitas',nopengenal='$noindetitas',
// hp='$hp',kdprovider='$kdprovider',idpasien='$data->idhs'
// where kdcabang='$kdcabang' and norm='$norm' ";



  $conn -> query("INSERT INTO transaksipasien(notransaksi,norm,tgltransaksi,user,updaters,kdpoli,kunci,kdklinik,kdcabang) 
 values('$no_trans','$norm','$tgldaftar','$kduser','$tgl','$kdpoli','0','$kdklinik','$kdcabang')");



  $conn -> query("INSERT INTO kunjunganpasien(norm,kdpoli,tglpriksa,kddokter,kdkostumerd,jammasuk,notransaksi,koreksierm,kelas,kdklinik,kdcabang,nofaktur) 
 values('$norm','$kdpoli','$tgldaftar','$kddokter','$kdkostumer','$tgl','$no_trans','BELUM','$kelas','$kdklinik','$kdcabang','$no_trans')");









$sqla="SELECT noantrian from antrian where kdpoli='$kdpoli' and tglpriksa='$tgldaftar' and kddokter='$kddokter' 
and kdcabang='$kdcabang' and rirj is null order by noantrian desc  limit 1";

$resulta=mysqli_query($conn,$sqla);
 $rowcounta=mysqli_num_rows($resulta);
  
if($rowcounta > 0){

while($rowa=mysqli_fetch_array($resulta,MYSQLI_ASSOC)) {



$noantrian=$rowa['noantrian']+1;


}

}else{

$noantrian=1;
 

}


  $conn -> query("INSERT INTO antrian(noantrian,norm,kdpoli,tglpriksa,notransaksi,kddokter,status,dari,kdklinik,kdcabang,tgldatang) 
 values('$noantrian','$norm','$kdpoli','$tgldaftar','$no_trans','$kddokter','ANTRI','IN','$kdklinik','$kdcabang','$tgl')");





// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode($no_trans);

}

// Rollback transaction
$conn -> rollback();

$conn -> close();

}else if($stssimpan === '12'){

   $conn -> autocommit(FALSE);

   $mows = date_create( $tgldaftar);
  
    $form_no = date_format( $mows, 'ymd' );




$tglxx = date("Y-m-d");
$tgldaftar = $tglxx;



$queryd="SELECT 
a.kdkostumer,a.costumer,d.kdkostumerd ,d.nama
FROM kelompokkostumer a,kelompokkostumerd d
WHERE a.kdkostumer = d.kdkostumer AND a.dash='BPJS' LIMIT 1";
$resultd=mysqli_query($conn, $queryd);
while($rowd=mysqli_fetch_array($resultd,MYSQLI_ASSOC)) {

$kdkostumerd = $rowd['kdkostumerd'];
$kdkostumer = $rowd['kdkostumer'];

}




$querycek="SELECT  a.* 
FROM kunjunganpasien a,poliklinik b  where 
a.kdpoli = b.kdpoli and 
a.kdcabang='$kdcabang' and a.norm='$norm' and a.kdpoli='$kdpoli' and a.tglpriksa='$tglxx' and b.filter='1' and a.ri='No'";

$resultcek=mysqli_query($conn,$querycek);
 $rowcountcek=mysqli_num_rows($resultcek);
if($rowcountcek > 0){


$value = array(
   "kode" => 201,
     "notrans" => '',
   "keterangan" => 'SUDAH TERDAFTAR POLI YANG SAMA'




);

echo json_encode( $value );



exit();
}else{





$query="SELECT kdtarif from kelompokkostumer where kdkostumer='$kostumer' and kdcabang='$kdcabang'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {




 $jen_tarif = $row['kdtarif'];
 $nomer = 'RJ'.'-'.$jen_tarif.$form_no;
}




    $sql="SELECT notransaksi from transaksipasien where left(notransaksi,15)='$nomer' and kdcabang='$kdcabang' ORDER BY notransaksi desc limit 1";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {


$urut = $row['notransaksi'];
  $awal = substr( $urut, 16, 3 );
        $awal = $awal + 1;

 $urut = strlen( $awal );


        if ( $urut == 1 ) {
            $jum = '00';
        } elseif ( $urut == 2 ) {
            $jum = '0';
        } elseif ( $urut == 3 ) {
            $jum = '';
        }
        $no_trans = $nomer.'-'.$jum.$awal;



}

}else{


   $no_trans = $nomer.'-'.'001';

}





$conn -> query("UPDATE pasien set

kdasuransi='$kdkostumerd',noasuransi='$noasuransi',tandapengenal='$indetitas',kdprovider='$kdprovider'
where kdcabang='$kdcabang' and norm='$norm' ");



  $conn -> query("INSERT INTO transaksipasien(notransaksi,norm,tgltransaksi,user,updaters,kdpoli,kunci,kdklinik,kdcabang) 
 values('$no_trans','$norm','$tgldaftar','$kduser','$tgl','$kdpoli','0','$kdklinik','$kdcabang')");



  $conn -> query("INSERT INTO kunjunganpasien(norm,kdpoli,tglpriksa,kddokter,kdkostumerd,jammasuk,notransaksi,koreksierm,kelas,kdklinik,kdcabang,nofaktur) 
 values('$norm','$kdpoli','$tgldaftar','$kddokter','$kdkostumerd','$tgl','$no_trans','BELUM','$kelas','$kdklinik','$kdcabang','$no_trans')");









$sqla="SELECT noantrian from antrian where kdpoli='$kdpoli' and tglpriksa='$tgldaftar' and kddokter='$kddokter' 
and kdcabang='$kdcabang' and  rirj is null order by noantrian desc  limit 1";

$resulta=mysqli_query($conn,$sqla);
 $rowcounta=mysqli_num_rows($resulta);
  
if($rowcounta > 0){

while($rowa=mysqli_fetch_array($resulta,MYSQLI_ASSOC)) {



$noantrian=$rowa['noantrian']+1;


}

}else{

$noantrian=1;
 

}


  $conn -> query("INSERT INTO antrian(noantrian,norm,kdpoli,tglpriksa,notransaksi,kddokter,status,dari,kdklinik,kdcabang,tgldatang) 
 values('$noantrian','$norm','$kdpoli','$tgldaftar','$no_trans','$kddokter','ANTRI','IN','$kdklinik','$kdcabang','$tgl')");

















}











// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
$value = array(
   "kode" => 200,
     "notrans" => $no_trans,
   "keterangan" => 'Berhasil'




);
echo json_encode( $value );


}

// Rollback transaction
$conn -> rollback();

$conn -> close();

}else if($stssimpan === '2'){


 $conn -> autocommit(FALSE);


 





$conn -> query("UPDATE pasien set

kdasuransi='$kdkostumer',noasuransi='$noasuransi',tandapengenal='$indetitas',nopengenal='$noindetitas',hp='$hp'
where kdcabang='$kdcabang' and norm='$norm' ");




// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode('Sukses');

}

// Rollback transaction
$conn -> rollback();

$conn -> close();

}else if($stssimpan === '3'){


  
  

 $conn -> autocommit(FALSE);

   $mows = date_create( $tgldaftar);
  
    $form_no = date_format( $mows, 'ymd' );

$query="SELECT kdtarif from kelompokkostumer where kdkostumer='$kostumer' and kdcabang='$kdcabang'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {




 $jen_tarif = $row['kdtarif'];
 $nomer = 'RJ'.'-'.$jen_tarif.$form_no;
}




    $sql="SELECT notransaksi from transaksipasien where left(notransaksi,15)='$nomer' and kdcabang='$kdcabang' ORDER BY notransaksi desc limit 1";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {


$urut = $row['notransaksi'];
  $awal = substr( $urut, 16, 3 );
        $awal = $awal + 1;

 $urut = strlen( $awal );


        if ( $urut == 1 ) {
            $jum = '00';
        } elseif ( $urut == 2 ) {
            $jum = '0';
        } elseif ( $urut == 3 ) {
            $jum = '';
        }
        $no_trans = $nomer.'-'.$jum.$awal;



}

}else{


   $no_trans = $nomer.'-'.'001';

}





$conn -> query("UPDATE pasien set

kdasuransi='$kdkostumer',noasuransi='$noasuransi',tandapengenal='$indetitas',nopengenal='$noindetitas',
hp='$hp',kdprovider='$kdprovider',idpasien='$data->idhs'
where kdcabang='$kdcabang' and norm='$norm' ");

// echo "UPDATE pasien set

// kdasuransi='$kdkostumer',noasuransi='$noasuransi',tandapengenal='$indetitas',nopengenal='$noindetitas',
// hp='$hp',kdprovider='$kdprovider',idpasien='$data->idhs'
// where kdcabang='$kdcabang' and norm='$norm' ";



  $conn -> query("INSERT INTO transaksipasien(notransaksi,norm,tgltransaksi,user,updaters,kdpoli,kunci,kdklinik,kdcabang) 
 values('$no_trans','$norm','$tgldaftar','$kduser','$tgl','$kdpoli','0','$kdklinik','$kdcabang')");



  $conn -> query("INSERT INTO kunjunganpasien(norm,kdpoli,tglpriksa,kddokter,kdkostumerd,jammasuk,notransaksi,koreksierm,kelas,kdklinik,kdcabang,nofaktur) 
 values('$norm','$kdpoli','$tgldaftar','$kddokter','$kdkostumer','$tgl','$no_trans','BELUM','$kelas','$kdklinik','$kdcabang','$no_trans')");









$noantrian=0;
 



  $conn -> query("INSERT INTO antrian(noantrian,norm,kdpoli,tglpriksa,notransaksi,kddokter,status,dari,kdklinik,kdcabang,tgldatang,rirj) 
 values('$noantrian','$norm','$kdpoli','$tgldaftar','$no_trans','$kddokter','ANTRI','IN','$kdklinik','$kdcabang','$tgl','1')");





// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode($no_trans);

}

// Rollback transaction
$conn -> rollback();

$conn -> close();

  

}






  
?>

