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

$tgl = date("Y-m-d H:i:s");

  $kddokter=$data->kddokter;
  // $kdpoli=$data->kdpoli;
  // $keluhan=$data->keluhan;
  $rps=$data->rps;
  $rpd=$data->rpd;
  $rpk=$data->rpk;
  $kesadaranu=$data->kesadaranu;
  $kesadaran=$data->kesadaran;
  $kepala=json_encode($data->kepala);
  $kepala =str_replace(']', '', $kepala);
  $kepala =str_replace('[', '', $kepala);
    $kepala =str_replace('"', '', $kepala);

  // $kepalaket=$data->kepalaket;
  $mata=json_encode($data->mata);
   $mata =str_replace(']', '', $mata);
    $mata =str_replace('[', '', $mata);
    $mata =str_replace('"', '', $mata);

  // $mataket=$data->mataket;
  $leher =json_encode($data->leher);
     $leher =str_replace(']', '', $leher);
    $leher =str_replace('[', '', $leher);
    $leher =str_replace('"', '', $leher);
    // $leherket =$data->leherket;
  $tht  =json_encode($data->tht);
     $tht =str_replace(']', '', $tht);
    $tht =str_replace('[', '', $tht);
    $tht =str_replace('"', '', $tht);

  // $thtket=$data->thtket;
  $paru=json_encode($data->paru);

       $paru =str_replace(']', '', $paru);
    $paru =str_replace('[', '', $paru);
    $paru =str_replace('"', '', $paru);


  // $paruket =$data->paruket;
  $jantung=json_encode($data->jantung);

  
       $jantung =str_replace(']', '', $jantung);
    $jantung =str_replace('[', '', $jantung);
    $jantung =str_replace('"', '', $jantung);

  // $jantungket =$data->jantungket;
  $abdomen  =json_encode($data->abdomen);


       $abdomen =str_replace(']', '', $abdomen);
    $abdomen =str_replace('[', '', $abdomen);
    $abdomen =str_replace('"', '', $abdomen);


  // $abdomenket =$data->abdomenket;
  $ektremis  =json_encode($data->ektremis);

       $ektremis =str_replace(']', '', $ektremis);
    $ektremis =str_replace('[', '', $ektremis);
    $ektremis =str_replace('"', '', $ektremis);

  // $ektremisket  =$data->ektremisket;
  $kulit  =json_encode($data->kulit);

     $kulit =str_replace(']', '', $kulit);
    $kulit =str_replace('[', '', $kulit);
    $kulit =str_replace('"', '', $kulit);

  
  // $kulitket =$data->kulitket;
  $pf=$data->pf;

  // $rencana      =$data->rencana;
  // $dirujuk=$data->dirujuk;
  $edukasipasien=$data->edukasipasien;
  $notransaksi =$data->notransaksi;
$stssimpan = $data->stssimpan;
$keluhan = $data->keluhan;
$norm = $data->norm;







if($stssimpan === '1'){

   $conn -> autocommit(FALSE);
  



 $conn -> query("INSERT INTO emrkajianawalrj(notransaksi,norm, tgl,kddokter, keluhan, rps,rpd,rpk,kesadaranu, kesadaran, kepala, mata,leher, tht,paru, jantung, abdomen, ektremis, kulit, pf,  edukasipasien,kduser) 
 values('$notransaksi','$norm', '$tgl','$kddokter', '$keluhan', '$rps','$rpd','$rpk','$kesadaranu', '$kesadaran', '$kepala', '$mata','$leher', '$tht','$paru', '$jantung', '$abdomen', '$ektremis', '$kulit', '$pf', '$edukasipasien','$data->kduser')");

$conn -> query("UPDATE ermcpptintruksi set

kirim='Ya' where notransaksi='$notransaksi' ");


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
  


   $conn -> query("DELETE FROM emrkajianawalrj where notransaksi='$notransaksi'");


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