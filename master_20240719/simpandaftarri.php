<?php
 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
 

 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);


$tgldaftar = date("Y-m-d");



$tgl = date("Y-m-d H:i:s");


  include '../koneksi.php';
  



$kduser=$data->kduser;



$kdklinik        =$data->kdklinik;
$kdcabang=$data->kdcabang;


$stssimpan = $data->stssimpan;


if($stssimpan === '1'){





$caramasuk=$data->caramasuk;
$cusi=$data->cusi;
$cusid=$data->cusid;
$dokter=$data->dokter;

$indetitas=$data->indetitas;
$kamar = $data->kamar;
$kelas=$data->kelas;


if(empty($data->keterangan)){
$keterangan='';
}else{
$keterangan=str_replace("'"," ` ",$data->keterangan);
}



if(empty($data->hp)){
$hp='';
}else{
$hp=str_replace("'"," ` ",$data->hp);
}


if(empty($data->noasuransi)){
$noasuransi='';
}else{
$noasuransi=str_replace("'"," ` ",$data->noasuransi);
}


if(empty($data->noindetitas)){
$noindetitas='';
}else{
$noindetitas=str_replace("'"," ` ",$data->noindetitas);
}



$norm=$data->norm;
$pasien=$data->pasien;
$penerimaan=$data->penerimaan;

if(empty($data->pj)){
$pj='';
}else{
$pj=str_replace("'"," ` ",$data->pj);
}

if(empty($data->pjalamat)){
$pjalamat='';
}else{
$pjalamat=str_replace("'"," ` ",$data->pjalamat);
}

if(empty($data->pjhp)){
$pjhp='';
}else{
$pjhp=str_replace("'"," ` ",$data->pjhp);
}

if(empty($data->pjnama)){
$pjnama='';
}else{
$pjnama=str_replace("'"," ` ",$data->pjnama);
}




$privasi=$data->privasi;
$spesialis=$data->spesialis;
$tgllahir=$data->tgllahir;
$tglp=$data->tglp;




 $conn -> autocommit(FALSE);




   $mows = date_create( $tglp);
  
    $form_no = date_format( $mows, 'ymd' );

$query="SELECT kdtarif from kelompokkostumer where kdkostumer='$cusi' and kdcabang='$kdcabang'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {




 $jen_tarif = $row['kdtarif'];
 $nomer = 'RI'.'-'.$jen_tarif.$form_no;
}





    $sql="SELECT notransaksi from pasienrawatinap where left(notransaksi,15)='$nomer' and kdcabang='$kdcabang' ORDER BY notransaksi desc limit 1";



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



$sqlkdpoli = "SELECT kdpoli from spesialis where  kdspesial='$spesialis' and kdcabang='$kdcabang' ORDER BY kdpoli desc limit 1";
$resultp=mysqli_query($conn,$sqlkdpoli);
while($rowp=mysqli_fetch_array($resultp,MYSQLI_ASSOC)) {

$kdpoli = $rowp['kdpoli'];


}






        $conn -> query("INSERT INTO pasienrawatinap(notransaksi,norm,kdspesial,kdklas,tglmasuk,jammasuk,kdkamar,kddokter,kdkostumer,statusjenguk,user,caramasuk,
          penerimaan,keterangan,pj,pjnama,pjalamat,pjhp,kdcabang) 
               values('$no_trans','$norm','$spesialis','$kelas','$tglp','$tglp','$kamar','$dokter','$cusid','$privasi','$kduser','$caramasuk','$penerimaan','$keterangan','$pj','$pjnama','$pjalamat','$pjhp','$kdcabang')");
  






    $conn -> query("INSERT INTO transaksipasien(notransaksi,norm,tgltransaksi,user,updaters,kdpoli,kunci,kdklinik,kdcabang) 
 values('$no_trans','$norm','$tglp','$kduser','$tgl','$kdpoli','0','$kdklinik','$kdcabang')");



  $conn -> query("INSERT INTO kunjunganpasien(norm,kdpoli,tglpriksa,kddokter,kdkostumerd,jammasuk,notransaksi,koreksierm,kelas,kdklinik,kdcabang,nofaktur,ri) 
 values('$norm','$kdpoli','$tglp','$dokter','$cusid','$tgl','$no_trans','BELUM','$kelas','$kdklinik','$kdcabang','$no_trans','Ya')");








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



}else if($stssimpan === '2'){

  $conn -> autocommit(FALSE);


$notransaksi = $data->notransaksi;






$penerimaan=$data->penerimaan;

if(empty($data->pj)){
$pj='';
}else{
$pj=str_replace("'"," ` ",$data->pj);
}

if(empty($data->pjalamat)){
$pjalamat='';
}else{
$pjalamat=str_replace("'"," ` ",$data->pjalamat);
}

if(empty($data->pjhp)){
$pjhp='';
}else{
$pjhp=str_replace("'"," ` ",$data->pjhp);
}

if(empty($data->pjnama)){
$pjnama='';
}else{
$pjnama=str_replace("'"," ` ",$data->pjnama);
}




$privasi=$data->privasi;

$caramasuk=$data->caramasuk;

if(empty($data->keterangan)){
$keterangan='';
}else{
$keterangan=str_replace("'"," ` ",$data->keterangan);
}


  $conn -> query("UPDATE pasienrawatinap set statusjenguk='$privasi',
caramasuk='$caramasuk',penerimaan='$penerimaan',keterangan='$keterangan',pj='$pj',pjnama='$pjnama',pjalamat='$pjalamat',pjhp='$pjhp'

   where  kdcabang='$kdcabang' and notransaksi='$notransaksi'");








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
$notransaksi = $data->notransaksi;




   $sql="SELECT * from transaksipasiend where notransaksi='$notransaksi' and kdcabang='$kdcabang'";



$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);

 if($rowcount > 0){

    $kode = 201;


 }else{

$conn -> query("DELETE FROM pasienrawatinap where notransaksi='$notransaksi' and kdcabang='$kdcabang'");
$conn -> query("DELETE FROM transaksipasien where notransaksi='$notransaksi' and kdcabang='$kdcabang'");
$conn -> query("DELETE FROM kunjunganpasien where notransaksi='$notransaksi' and kdcabang='$kdcabang'");


    $kode = 200;

 }



 // Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode($kode);

}

// Rollback transaction
$conn -> rollback();

$conn -> close();
}else if($stssimpan === '4'){


  $conn -> autocommit(FALSE);
$notransaksi = $data->notransaksi;
$kddokter = $data->kddokter;




  $conn -> query("UPDATE pasienrawatinap set kddokter='$kddokter' where  kdcabang='$kdcabang' and notransaksi='$notransaksi'");
  $conn -> query("UPDATE kunjunganpasien set kddokter='$kddokter' where  kdcabang='$kdcabang' and notransaksi='$notransaksi'");





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
}else if($stssimpan === '5'){


  $conn -> autocommit(FALSE);
$notransaksi = $data->notransaksi;
$kdkostumerd = $data->kdkostumerd;




  $conn -> query("UPDATE pasienrawatinap set kdkostumer='$kdkostumerd' where  kdcabang='$kdcabang' and notransaksi='$notransaksi'");
  $conn -> query("UPDATE kunjunganpasien set kdkostumerd='$kdkostumerd' where  kdcabang='$kdcabang' and notransaksi='$notransaksi'");





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
}





  
?>

