<?php
 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  


 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);


$tgldaftar = date("Y-m-d");



$tgl = date("Y-m-d H:i:s");


  include '../koneksi.php';
  

// 2022-05-10T02:41:04.957Z

$kdklinik        =$data->kdklinik;
$kdcabang=$data->kdcabang;
$nofaktur=$data->nofaktur;
$kduser=$data->kduser;
$norm=$data->norm;
$kdpoli=$data->kdpoli;
 $kddokter=$data->kddokter;
 $kddokterkirim = $data->kddokterkirim;
$kdkostumerd=$data->kdkostumerd;
$stssimpan = $data->stssimpan;



if($stssimpan === '1'){


 $conn -> autocommit(FALSE);

   $mows = date_create( $tgldaftar);
  
    $form_no = date_format( $mows, 'ymd' );

$query="SELECT a.kdtarif
FROM kelompokkostumer a , kelompokkostumerd b
WHERE a.kdkostumer = b.kdkostumer
and b.kdkostumerd='$kdkostumerd' and a.kdcabang='$kdcabang'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {




 $jen_tarif = $row['kdtarif'];
 $nomer = 'LJ'.'-'.$jen_tarif.$form_no;
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




  $conn -> query("INSERT INTO transaksipasien(notransaksi,norm,tgltransaksi,user,updaters,kdpoli,kunci,kdklinik,kdcabang) 
 values('$no_trans','$norm','$tgl','$kduser','$tgl','$kdpoli','0','$kdklinik','$kdcabang')");



  $conn -> query("INSERT INTO kunjunganpasien(norm,kdpoli,tglpriksa,kddokter,kdkostumerd,jammasuk,notransaksi,koreksierm,kdklinik,kdcabang,kddokterpengirim,nofaktur) 
 values('$norm','$kdpoli','$tgldaftar','$kddokter','$kdkostumerd','$tgl','$no_trans','BELUM','$kdklinik','$kdcabang','$kddokterkirim','$nofaktur')");






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




}else if($stssimpan === '3'){



}    






  
?>

