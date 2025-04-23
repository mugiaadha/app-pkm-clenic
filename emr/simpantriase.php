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

  $stssimpan=$data->stssimpan;




if($stssimpan === '1'){

	   $conn -> autocommit(FALSE);


    $gmbx = str_replace('data:image/png;base64','data:image/jpeg;base64',$data->gmb);

	$conn -> query("INSERT IGNORE INTO `emrigdtriase` (`kondisimasuk`, `dxmedis`, `triage`, `td`, `suhu`, `rr`, `n`, `spo2`, `bb`, `tb`, `anamnesa`, `ku`, `ru`, `rwtalergi`, `jeniskasus`, `rwyt`, `diagnosaket`, `jalannafas`, `obstruksi`, `suaranafas`, `keluhanlain`, `kreteriahasil`, `intervensi`, `bretdiagnosa`, `gerakandada`, `iramanafas`, `retraksi`, `sesaknafas`, `keluhanlainb`, `kreteriahasilb`, `intervensib`, `nadicir`, `sianosiscir`, `crtcir`, `pendarahancir`, `keluhanlaincir`, `diagnosacir`, `kreteriacir`, `intervensicir`, `gcs`, `eye`, `mo`, `ver`, `perdarahan`, `faktur`, `parese`, `plegi`, `nyeri`, `gmb`, `problem`, `quality`, `regio`, `scale`, `time`, `diagnosakep`, `discplan`, `kontrolwaktu`, `kekontrol`, `lanjutperawatan`, `aturandiet`, `obatminum`, `kddokter`, `kduser`, `notransaksi`,`norm`,`tgl`) VALUES

	('$data->kondisimasuk', '$data->dxmedis', '$data->triage', '$data->td','$data->suhu', '$data->rr', '$data->n','$data->spo2', '$data->bb', '$data->tb',  '$data->anamnesa', '$data->ku', '$data->ru','$data->rwtalergi', '$data->jeniskasus', '$data->rwyt',

	 '$data->diagnosaket', '$data->jalannafas', '$data->obstruksi', '$data->suaranafas', '$data->keluhanlain', '$data->kreteriahasil', '$data->intervensi', '$data->bretdiagnosa', '$data->gerakandada',

	  '$data->iramanafas', '$data->retraksi', '$data->sesaknafas', '$data->keluhanlainb', '$data->kreteriahasilb', '$data->intervensib', '$data->nadicir', '$data->sianosiscir', '$data->crtcir', '$data->pendarahancir', '$data->keluhanlaincir', '$data->diagnosacir', '$data->kreteriacir', '$data->intervensicir', '$data->gcs', '$data->eye', '$data->mo', '$data->ver', '$data->perdarahan', '$data->faktur', '$data->parese', '$data->plegi', '$data->nyeri', '$gmbx', '$data->problem', '$data->quality', '$data->regio', '$data->scale', '$data->time', '$data->diagnosakep', '$data->discplan', '$data->kontrolwaktu', '$data->kontrolwaktu', '$data->lanjutperawatan', '$data->aturandiet', '$data->obatminum','$data->namadokter','$data->kduser', '$data->notransaksi','$data->norm','$tgl')");





  // Commit transaction
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
  
   $conn -> query("DELETE FROM emrigdtriase where notransaksi='$data->notransaksi'");







  // Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";

	$value = array(
    "kode"=>201,
    "pesan"=>"Sukses"
  

);


    echo json_encode($value);
 

  exit();
}else{
	$value = array(
    "kode"=>200,
    "pesan"=>"Sukses"
  

);


    echo json_encode($value);

}

// Rollback transaction
$conn -> rollback();

$conn -> close();



}








?>
