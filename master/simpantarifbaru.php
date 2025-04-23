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
  $kdklinik=$data->kdklinik;

   $nama= $data->nama;  
   $kdtarifmasli = $data->kdtarifmasli;
    $kdtarifm = $data->kdtarifm;
    $harga = $data->harga;
    $jenist = $data->jenist;

  $tglb=$data->tglb;
  $tgla=$data->tgla;
    $stssimpan=$data->stssimpan;
if($stssimpan === '1'){

   $conn -> autocommit(FALSE);

$query="SELECT angka from autonum where kdnomor='14' and kdklinik='$kdklinik'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$angka = $row['angka']+1;
}

$kodetariff = 'TRD'.$kdcabang.$angka;



  $conn -> query("INSERT INTO tarifdetail(kdtarifmasli,kdtarifm,kdtarif,nama,harga,kdcabang,statust,tglberlaku,tglberakhir) 
 values('$kdtarifmasli','$kdtarifm','$kodetariff','$nama','$harga','$kdcabang','$jenist','$tglb','$tgla')");









  $conn -> query("DELETE FROM tarifdetail where nama=''");


$conn -> query("UPDATE autonum set angka='$angka' where kdklinik='$kdklinik' and  kdnomor='14' ");








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