<?php

 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
 

 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);



$kdcabang=$data->kdcabang;
$notransaksi = $data->notransaksi;
$kdpoli = $data->kdpoli;
$kdpruduk = $data->kdpruduk;
$statuso = $data->statuso;
$dari = $data->dari;
$kunci  = $data->kunci;
$no  = $data->no;
$kdcppt  = $data->kdcppt;
$stssimpan = $data->stssimpan;


if($stssimpan === '1'){

$conn -> autocommit(FALSE);


$sql="SELECT * FROM jualobatd  where nofaktur='$notransaksi'
   and nomor='$no' and kdcabang='$kdcabang' and kdobat='$kdpruduk' and status='1'";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){

$pesan='Tidak Bisa di Hapus Obat Karena Sudah Terverif Oleh Farmasi..Silahkan Hubungi Bagian Farmasi';


}else{


  $conn -> query("DELETE FROM ermcpptintruksi where notransaksi='$notransaksi' and kdpoli='$kdpoli' and kdpruduk='$kdpruduk' and
    statuso='$statuso' and dari='$dari' and no='$no' and kdcppt='$kdcppt'");


$conn -> query("DELETE FROM jualobatd where nofaktur='$notransaksi'  and nomor='$no' and kdcppt='$kdcppt'");

  
$pesan='Berhasil!';



}








// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode($pesan);

}

// Rollback transaction
$conn -> rollback();

$conn -> close();



}else if($stssimpan === '2'){

  $conn -> autocommit(FALSE);

  $kd = $data->kd;


  $conn -> query("DELETE FROM ermcpptintruksi where notransaksi='$notransaksi' and kdpoli='$kdpoli' and 
    statuso='$statuso' and dari='$dari'  and kdcppt='$kdcppt' and kd='$kd'");



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










}else if($stssimpan === '4'){



}else if($stssimpan === '5'){

 

}
   

 




?>