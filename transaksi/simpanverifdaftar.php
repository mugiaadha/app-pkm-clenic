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

$kdklinik=$data->kdklinik;
$kdcabang=$data->kdcabang;

// $kduser=$data->kduser;
$norm=$data->norm;
$kdpoli=$data->kdpoli;
 $kddokter=$data->kddokter;
 // $kddokterkirim = $data->kddokterkirim;
$kdkostumerd=$data->kdkostumerd;
$notransaksi =$data->notransaksi;

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



$conn -> query("UPDATE kunjunganpasien set notransaksi='$no_trans',nofaktur='$no_trans',kdkostumerd='$kdkostumerd'
 where kdcabang='$kdcabang' and  kdpoli='$kdpoli' and kddokter='$kddokter' and notransaksi='$notransaksi' ");


$conn -> query("UPDATE transaksipasien set notransaksi='$no_trans'
where kdcabang='$kdcabang' and  kdpoli='$kdpoli' and notransaksi='$notransaksi'");


$conn -> query("UPDATE antrian set notransaksi='$no_trans'
where kdcabang='$kdcabang' and  kdpoli='$kdpoli' and notransaksi='$notransaksi'");


$conn -> query("UPDATE transaksi_pasien_mobile set notransbaru='$no_trans',statusverif='1'
where cabang_id='$kdcabang' and  poli_id='$kdpoli' and nomor_transaksi='$notransaksi'");





// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    // echo json_encode('Gagal');
       $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Gagal'
        ),
      
    );

  exit();
}else{
// echo json_encode('Sukses');

        $pesan = array(
        'metadata'=>array(
            'code'=>200,
            'message'=>$no_trans
        ),
      
    );


}
echo json_encode($pesan);

// Rollback transaction
$conn -> rollback();

$conn -> close();



}else if($stssimpan === '2'){




}else if($stssimpan === '3'){



}    






  
?>

