<?php

 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');





date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);


  include '../koneksi.php';



 $obatrep = str_replace("'"," ` ", $data->obat);
 $obat=  strtoupper($obatrep); 





 $hna=$data->hna;
 $disc=$data->disc;
 $ppn=$data->ppn;
 $hargabeli=$data->hargabeli;
 $margin=$data->margin;
  
  $hargajual=$data->hargajual;
  $bhp=$data->bhp;
  $rakinput=$data->rakinput;
  $supplier =$data->supplier;
  $pabrikan=$data->pabrikan;
  
  $golonganobat=$data->golonganobat;
  $jenisobat=$data->jenisobat;
  $zakaktif=$data->zakaktif;
  $standart=$data->standart;
  $standartd=$data->standartd;
  $sedang=$data->sedang;
  $sedangd=$data->sedangd;
  $kemasan=$data->kemasan;
  $kemasand=$data->kemasand;
  $kdcabang=$data->kdcabang;
  $kdklinik=$data->kdklinik;
  $stssimpan = $data->stssimpan;
  $caraberi=$data->caraberi;
  $bentuks=$data->bentuks;


if(empty($data->zataktif)){
$zataktif='';
}else{
$zataktif=$data->zataktif;





}




  if($stssimpan === '1'){

$query="SELECT angka from autonum where kdnomor='9' and kdklinik='$kdklinik'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$angka = $row['angka']+1;
}

$kdobat = 'OB'.$kdcabang.$angka;

 $conn -> autocommit(FALSE);

// Insert some values
$conn -> query("INSERT INTO obat(kdobat
    ,obat
    ,golonganobat
    ,jenisobat
    ,hna
    ,disc
    ,ppn
    ,hargabeli
    ,margin
    ,hargajual
    ,bhp
    ,raksimpan
    ,kdsuplier
    ,kdpabrikan
    ,zakaktif
    ,standart
    ,standartd
    ,sedang
    ,sedangd
    ,kemasan
    ,kemasand
    ,kdklinik
    ,kdcabang,kdcp,kdbs,zataktifasli,kdobatbpjs) 
 values('$kdobat','$obat','$golonganobat','$jenisobat','$hna','$disc','$ppn','$hargabeli',
 '$margin','$hargajual','$bhp','$rakinput','$supplier','$pabrikan','$zakaktif','$standart',
 '$standartd','$sedang','$sedangd','$kemasan','$kemasand','$kdklinik','$kdcabang','$caraberi',
 '$bentuks','$zataktif','$data->kdobatbpjs')");


$conn -> query("DELETE FROM obat where obat=''");


$conn -> query("UPDATE autonum set angka='$angka' where kdklinik='$kdklinik' and  kdnomor='9' ");




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
  $kdobat = $data->kdobat;


$conn -> query("UPDATE obat set obat='$obat'
    ,golonganobat='$golonganobat'
    ,jenisobat='$jenisobat'
    ,hna='$hna'
    ,disc='$disc'
    ,ppn='$ppn'
    ,hargabeli='$hargabeli'
    ,margin='$margin'
    ,hargajual='$hargajual'
    ,bhp='$bhp'
    ,raksimpan='$rakinput'
    ,kdsuplier='$supplier'
    ,kdpabrikan='$pabrikan'
    ,zakaktif='$zakaktif'
    ,standart='$standart'
    ,standartd='$standartd'
    ,sedang='$sedang'
    ,sedangd='$sedangd'
    ,kemasan='$kemasan'
    ,kemasand='$kemasand',kdcp='$caraberi',kdbs='$bentuks',zataktifasli='$zataktif' 
    ,kdobatbpjs='$data->kdobatbpjs'
    where  kdobat='$kdobat' and kdcabang='$kdcabang'");



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
  $kdobat = $data->kdobat;






  
      $sql="SELECT kdobat FROM obatstock WHERE kdcabang='$kdcabang' AND kdobat='$kdobat' ORDER BY kdobat LIMIT 1";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){

 $pesan = array(
        'metadata'=>array(
            'code'=>201,
             'message'=>'Tidak Bisa Di Hapus Karena Sudah Di pakai'
        )
    );

}else{


$conn -> query("DELETE FROM obat where kdobat='$kdobat' and kdcabang='$kdcabang'");


  $pesan = array(
        'metadata'=>array(
            'code'=>200,
             'message'=>'Berhasil Hapus'
        )
    );

}










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
}




// }











?>