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
  


$kdklinik        =$data->kdklinik;
$kdcabang=$data->kdcabang;
$notransaksi=$data->notransaksi;
$norm=$data->norm;
$kduser=$data->kduser;
$stssimpan = $data->stssimpan;


if($stssimpan === '1'){


 $conn -> autocommit(FALSE);



$kdbayar=$data->kdbayar;
$bayar=$data->bayar;
$sudahbayar=$data->sudahbayar;
$norm=$data->norm;
$bank=$data->bank;
$jbayari=$data->jbayari;




if($kdbayar === '2'){

// kridit

     $conn -> query("UPDATE jualobat set 
          kdbayar='$kdbayar',bayar='$bayar',statuslunas='2',
          userbayar='$kduser',tglbayar='$tgl'
         where notransaksi='$notransaksi' and kdcabang='$kdcabang' and statuslunas='1'
            ");





        $conn -> query("INSERT INTO transferbayar(tanggal,notrans,nomor,norm,kdpoli,
                  nominal,bank,kodebayar,kdcabang,user) 
               values('$tgl','$notransaksi','100','$norm','Farmasi','$sudahbayar','$bank','$jbayari','$kdcabang','$kduser')");




}else if($kdbayar === '1'){

// cash
     $conn -> query("UPDATE jualobat set 
          kdbayar='$kdbayar',bayar='$bayar',statuslunas='2',
          userbayar='$kduser',tglbayar='$tgl',sudahbayar='$sudahbayar'
         where notransaksi='$notransaksi' and kdcabang='$kdcabang' and statuslunas='1'
            ");





        $conn -> query("INSERT INTO transferbayar(tanggal,notrans,nomor,norm,kdpoli,
                  nominal,bank,kodebayar,kdcabang,user) 
               values('$tgl','$notransaksi','100','$norm','Farmasi','$sudahbayar','$bank','$jbayari','$kdcabang','$kduser')");



}




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

$kdbayar=$data->kdbayar;
$bayar=$data->bayar;
$sudahbayar=$data->sudahbayar;
$norm=$data->norm;
$bank=$data->bank;
$jbayari=$data->jbayari;

     $conn -> query("UPDATE jualobat set 
          kdbayar='',bayar='',sudahbayar='0',statuslunas='1',
          userbayar='',tglbayar='$tgl'
         where notransaksi='$notransaksi' and kdcabang='$kdcabang' and statuslunas='2'
            ");





      $conn -> query("DELETE from transferbayar  where notrans='$notransaksi' and kdcabang='$kdcabang'
          and kdpoli='Farmasi'");



        



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


$notransri=$data->notransri;




     $conn -> query("UPDATE jualobat set 
          kdbayar='',bayar='',sudahbayar='0',statuslunas='1',
          userbayar='',tglbayar='$tgl'
         where notransaksi='$notransaksi' and kdcabang='$kdcabang' and statuslunas='2'
            ");





      $conn -> query("DELETE from transferbayar  where notrans='$notransaksi' and kdcabang='$kdcabang'
          and kdpoli='Farmasi'");


      $conn -> query("DELETE from transaksipasiend  where notransaksi='$notransaksi' and kdcabang='$kdcabang'
          and kdproduk='9'");



        



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

