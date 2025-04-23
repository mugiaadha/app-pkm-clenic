<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
 

 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);


$tgl = date("Y-m-d H:i:s");


$tgltransaksi = $tgl;


    // "kdtamplated":kdtamplated,"namaracik":namaracik,"metode":metode,"aturan":aturan,"qty":qty,"keterangan":keterangan,
    //   "notransaksi":notransaksi,"kdcabang":this.kdcabang,"stssimpan":'1'



$kdpoli = $data->kdpoli;

$kduser  = $data->kduser;

$stssimpan =$data->stssimpan;
$kdcabang =$data->kdcabang;
$notransaksi =  $data->notransaksi;



$kdtamplated =$data->kdtamplated;




if($stssimpan === '1'){
$conn -> autocommit(FALSE);

$aturan =$data->aturan;

$conn -> query("UPDATE ermcpptintruksi set aturan='$aturan'
 where notransaksi='$notransaksi' 
  and statuso='MRacik'
   and dari='Mobat' 
   and kdcabang='$kdcabang'
    and kd='$kdtamplated'");





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

$qty =$data->qty;

$conn -> query("UPDATE ermcpptintruksi set qty='$qty'
 where notransaksi='$notransaksi' 
  and statuso='MRacik'
   and dari='Mobat' 
   and kdcabang='$kdcabang'
    and kd='$kdtamplated'");





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

$keterangan =$data->keterangan;

$conn -> query("UPDATE ermcpptintruksi set keterangan='$keterangan'
 where notransaksi='$notransaksi' 
  and statuso='MRacik'
   and dari='Mobat' 
   and kdcabang='$kdcabang'
    and kd='$kdtamplated'");





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






}else if($stssimpan === '4'){
$conn -> autocommit(FALSE);

$metode =$data->metode;

$conn -> query("UPDATE ermcpptintruksi set nama='$metode'
 where notransaksi='$notransaksi' 
  and statuso='MRacik'
   and dari='Mobat' 
   and kdcabang='$kdcabang'
    and kd='$kdtamplated'");





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




}
   

 




?>