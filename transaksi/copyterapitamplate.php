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

$kdkostumerd   = $data->kdkostumerd;
$norm = $data->norm;
$kdpoli = $data->kdpoli;
$kddokter  = $data->kddokter;
$kduser  = $data->kduser;
$kdcppt  = $data->kdcppt;
$stssimpan =$data->stssimpan;
$kdcabang =$data->kdcabang;
$notransaksi =  $data->notransaksi;
$status =$data->status;
$kdtamplated =$data->kdtamplated;




if($stssimpan === '1'){

   $conn -> autocommit(FALSE);



$queryx="SELECT
a.*,b.standart,b.obat,b.hargajual
FROM tplaning a, obat b
WHERE a.kdobat = b.kdobat AND a.kdtamplated='$kdtamplated' and a.kdcabang='$kdcabang'";

$resultx=mysqli_query($conn, $queryx);

while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {


$kdproduk = $rowx['kdobat'];
$obat = $rowx['obat'];
$aturan = $rowx['aturan'];
$qty = $rowx['qty'];
$keterangan = $rowx['keterangan'];
$hargajual = $rowx['hargajual'];

$harga = $qty * $hargajual;

$sql="SELECT nomor from jualobatd where kdcppt='$kdcppt' and kdcabang='$kdcabang' and norm='$norm'
    ORDER BY nomor desc limit 1";

$result=mysqli_query($conn,$sql);
$rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {



  $nomor=$row['nomor']+1;



}

}else{


  $nomor=1;

}

 $conn -> query("INSERT INTO jualobatd(tgl,nomor,nofaktur,kdobat,qty,disc,harga,totalharga,kdcabang,kdcppt,norm,dari,status,ri) 
  values('$tgl','$nomor','$notransaksi','$kdproduk','$qty',0,'$hargajual','$harga','$kdcabang','$kdcppt','$norm','CPPT','0','CPPT')");


  $aturanx = $aturan.' '.$keterangan;
  $conn -> query("INSERT INTO ermcpptintruksi(notransaksi,kdkostumerd,norm,kddokter,kdpoli,kdpruduk,aturan,
    qty,statuso,status,dari,kduser,kdcabang,tgl,kdcppt,kunci,tglpriksa,keterangan,harga,nama,no,dari2) 
 values('$notransaksi','$kdkostumerd','$norm','$kddokter','$kdpoli','$kdproduk','$aturanx','$qty','Non Racik','0','Obat','$kduser','$kdcabang','$tgl','$kdcppt','0','$tgl','','$harga','$obat','$nomor','CPPT')");




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


 $today=date('dmy');
$sql = "SELECT MAX(nomor) as last FROM nomorracik  WHERE nomor LIKE '$today%' and kdcabang='$kdcabang' and notransaksi='$notransaksi' and norm='$norm' and status='0'";
$stmt = mysqli_query( $conn, $sql );

while( $row =mysqli_fetch_array( $stmt, MYSQLI_ASSOC) ) {
      $last=$row['last'];
    $lastnourut = substr($last,6,3);
    $nextno=$lastnourut + 1;

    $nextnot =$today.sprintf('%03s',$nextno);

    
}


$queryx="SELECT * from tplaningr where kdcabang='$kdcabang' and  kdtamplated='$kdtamplated'";

$resultx=mysqli_query($conn, $queryx);

while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {


$kdproduk = $rowx['obat'];
$aturan = $rowx['aturan'];
$qty = $rowx['qty'];
$obat = $rowx['satuan'];


  $conn -> query("INSERT INTO ermcpptintruksi(notransaksi,kdkostumerd,norm,kddokter,kdpoli,kdpruduk,aturan,
    qty,statuso,status,dari,kduser,kdcabang,tgl,kdcppt,kunci,tglpriksa,nama,kd,dari2) 
 values('$notransaksi','$kdkostumerd','$norm','$kddokter','$kdpoli','$kdproduk','$aturan','$qty','MRacik','0','MObat','$kduser','$kdcabang','$tgl','$kdcppt','0','$tgl','$obat','$nextnot','CPPT')");




}











$queryxx="SELECT
a.*,b.standart,b.obat,b.hargajual
FROM tplaning a, obat b
WHERE a.kdobat = b.kdobat AND a.kdtamplated='$kdtamplated' and a.kdcabang='$kdcabang'";

$resultxx=mysqli_query($conn, $queryxx);

while($rowxx=mysqli_fetch_array($resultxx,MYSQLI_ASSOC)) {


$kdproduk = $rowxx['kdobat'];
$obat = $rowxx['obat'];
$aturan = $rowxx['aturan'];
$qty = $rowxx['qty'];
$keterangan = $rowxx['keterangan'];
$hargajual = $rowxx['hargajual'];

$harga = $qty * $hargajual;

$sql="SELECT nomor from jualobatd where kdcppt='$kdcppt' and kdcabang='$kdcabang' and norm='$norm'
    ORDER BY nomor desc limit 1";

$result=mysqli_query($conn,$sql);
$rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {



  $nomor=$row['nomor']+1;



}

}else{


  $nomor=1;

}



 $conn -> query("INSERT INTO jualobatd(tgl,nomor,nofaktur,kdobat,qty,disc,harga,totalharga,kdcabang,kdcppt,norm,dari,status) 
  values('$tgl','$nomor','$notransaksi','$kdproduk','$qty',0,'$hargajual','$harga','$kdcabang','$kdcppt','$norm','CPPT','0')");



 
  $conn -> query("INSERT INTO ermcpptintruksi(notransaksi,kdkostumerd,norm,kddokter,kdpoli,kdpruduk,aturan,
    qty,statuso,status,dari,kduser,kdcabang,tgl,kdcppt,kunci,tglpriksa,keterangan,harga,nama,no,kd,dari2) 
 values('$notransaksi','$kdkostumerd','$norm','$kddokter','$kdpoli','$kdproduk','$aturan','$qty','Racik','0','Obat','$kduser','$kdcabang','$tgl','$kdcppt','0','$tgl','$keterangan','$harga','$obat','$nomor','$nextnot','CPPT')");


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



}else if($stssimpan === '3'){


}else if($stssimpan === '4'){


}else if($stssimpan === '5'){





}
   

 




?>