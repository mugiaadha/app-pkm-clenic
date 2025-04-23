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
$ruang=$data->ruang;
$tgl = date("Y-m-d H:i:s");

$dpjp=$data->dpjp;
$asisten=$data->asisten;
$dokteranastesi=$data->dokteranastesi;
$diagnosa=$data->diagnosa;
$diagnosapos=$data->diagnosapos;
$namatindakan=$data->namatindakan;
$jammulai=$data->jammulai;
$jamselesai=$data->jamselesai;

$jaringan=$data->jaringan;
$spesimen=$data->spesimen;
$jenisanastesi=$data->jenisanastesi;
$laporan=$data->laporan;
$komplikasi=$data->komplikasi;
$no=$data->no;
$notransaksi =$data->notransaksi;






if($stssimpan === '1'){

   $conn -> autocommit(FALSE);
  



    $sql="SELECT * from emrlaporantindakan where notransaksi='$notransaksi' and no='$no'";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){



        $conn -> query("UPDATE emrlaporantindakan set


ruang='$ruang',dpjp='$dpjp',asisten='$asisten',dokteranastesi='$dokteranastesi',diagnosa='$diagnosa',diagnosapos='$diagnosapos',namatindaka='$namatindakan',jammulai='$jammulai',jamselesai='$jamselesai',jaringandiambil='$jaringandiambil',spesimen='$spesimen',jenisanastesi='$jenisanastesi',laporan='$laporan',komplikasipasca='$komplikasipasca'

where  notransaksi='$notransaksi' and no='$no' ");






}else{


  
 $conn -> query("INSERT INTO emrlaporantindakan(notransaksi,tgl,ruang,dpjp,asisten,dokteranastesi,diagnosa,diagnosapos,namatindakan,jammulai,jamselesai,jaringandiambil,spesimen,jenisanastesi,laporan,komplikasipasca,kdcabang) 
 values('$notransaksi','$tgl','$ruang','$dpjp','$asisten','$dokteranastesi','$diagnosa','$diagnosapos','$namatindakan','$jammulai','$jamselesai','$jaringan','$spesimen','$jenisanastesi','$laporan','$komplikasi','$kdcabang')");




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
  


  $conn -> query("DELETE FROM emrlaporantindakan where notransaksi='$notransaksi' and no='$no'");



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




}
   

 




?>