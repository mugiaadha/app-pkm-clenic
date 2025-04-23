<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
 

 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);






// $kdcabang=$data->kdcabang;

$tgl = date("Y-m-d H:i:s");

 
  // $kepala=json_encode($data->kepala);
  // $kepala =str_replace(']', '', $kepala);
  // $kepala =str_replace('[', '', $kepala);
  //   $kepala =str_replace('"', '', $kepala);

 
  $notransaksi =$data->notransaksi;
  $norm = $data->norm;
$kduser = $data->kduser;
$anamnesa = $data->anamnesa;
$anamnesaket = $data->anamnesaket;
$keluhanutama = $data->keluhanutama;
$rps = $data->rps;
$rpd = $data->rpd;
$alergi = $data->alergi;


  $rwtlahir=json_encode($data->rwtlahir);
  $rwtlahir =str_replace(']', '', $rwtlahir);
  $rwtlahir =str_replace('[', '', $rwtlahir);
    $rwtlahir =str_replace('"', '', $rwtlahir);
$rwtvaksi = $data->rwtvaksi;
$kebiasaan = $data->kebiasaan;
$td = $data->td;
$rr = $data->rr;
$suhu = $data->suhu;
$nadi = $data->nadi;
$tb = $data->tb;
$bb = $data->bb;
$pengetahuan = $data->pengetahuan;
$perawatan = $data->perawatan;

$keyakinan = json_encode($data->keyakinan);

  $keyakinan =str_replace(']', '', $keyakinan);
  $keyakinan =str_replace('[', '', $keyakinan);
    $keyakinan =str_replace('"', '', $keyakinan);



$komunikasi = json_encode($data->komunikasi);

  $komunikasi =str_replace(']', '', $komunikasi);
  $komunikasi =str_replace('[', '', $komunikasi);
    $komunikasi =str_replace('"', '', $komunikasi);


$ygmerawat = json_encode($data->ygmerawat);

  $ygmerawat =str_replace(']', '', $ygmerawat);
  $ygmerawat =str_replace('[', '', $ygmerawat);
  $ygmerawat =str_replace('"', '', $ygmerawat);


$stssimpan = $data->stssimpan;



  $nyeri =$data->nyeri;
  $pencetus =$data->pencetus;
  $kualitas =$data->kualitas;
  $lokasi =$data->lokasi;
  $skala =$data->skala;
  $waktu =$data->waktu;
  $jatuha =$data->jatuha;
  $jatuhb =$data->jatuhb;
  $ketjatuh =$data->ketjatuh;



$analisa = json_encode($data->analisa);

  $analisa =str_replace(']', '', $analisa);
  $analisa =str_replace('[', '', $analisa);
  $analisa =str_replace('"', '', $analisa);






if($stssimpan === '1'){

   $conn -> autocommit(FALSE);
  


 $conn -> query("INSERT INTO emrasesmenperawat(notransaksi,norm,kduser ,tgl,anamnesa,anamnesaket,keluhanutama,rps,rpd,alergi,rwtlahir,rwtvaksi,kebiasaan,td,rr,suhu,nadi,tb,bb,pengetahuan,perawatan,keyakinan,komunikasi,ygmerawat) 
 values('$notransaksi','$norm','$kduser','$tgl','$anamnesa','$anamnesaket','$keluhanutama','$rps','$rpd','$alergi','$rwtlahir','$rwtvaksi','$kebiasaan','$td','$rr','$suhu','$nadi','$tb','$bb','$pengetahuan','$perawatan','$keyakinan','$komunikasi','$ygmerawat')");




 $conn -> query("INSERT INTO emrasesmenperawat2(notransaksi,nyeri,pencetus,kualitas,lokasi,skala,waktu,jatuha,jatuhb,ketjatuh,analisa) 
 values('$notransaksi','$nyeri','$pencetus','$kualitas','$lokasi','$skala','$waktu','$jatuha','$jatuhb','$ketjatuh','$analisa')");



if (!$conn -> commit()) {
  // echo "Commit transaction failed";

  $value = array(
    "kode"=>201,
    "pesan"=>"gagal"
  

);


    echo json_encode($value);
 

  exit();
}else{
  $value = array(
    "kode"=>200,
    "pesan"=>"Suksesx"
  

);


    echo json_encode($value);

}

// Rollback transaction
$conn -> rollback();

$conn -> close();




}else if($stssimpan === '2'){

  
     $conn -> autocommit(FALSE);
  


   $conn -> query("DELETE FROM emrasesmenperawat where notransaksi='$notransaksi'");
  $conn -> query("DELETE FROM emrasesmenperawat2 where notransaksi='$notransaksi'");


if (!$conn -> commit()) {
  // echo "Commit transaction failed";

  $value = array(
    "kode"=>201,
    "pesan"=>"gagal"
  

);


    echo json_encode($value);
 

  exit();
}else{
  $value = array(
    "kode"=>200,
    "pesan"=>"Suksesx"
  

);


    echo json_encode($value);

}

// Rollback transaction
$conn -> rollback();

$conn -> close();




}else if($stssimpan === '3'){




}
   

 




?>