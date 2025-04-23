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



  $notransaksi = $data->notransaksi;
  $nofaktur = $data->nofaktur;
   $tgltransaksi = $tgl;
  $kdproduk  = $data->kdproduk;
  $produk = $data->produk;
  $kdpoli = $data->kdpoli;
  $qty = $data->qty;
  $harga = $data->harga;
  $debet =   $data->debet;
  $kridit =   $data->kridit;
  $jenistransaksi  = $data->jenistransaksi;
  $tarifasli = $data->tarifasli;
  $disc = $data->disc;
 $kddokter = $data->kddokter;

$user =$data->user;

  $kdcabang=$data->kdcabang;
  $kdklinik=$data->kdklinik;
  $stssimpan = $data->stssimpan;



if($stssimpan === '1'){

   $conn -> autocommit(FALSE);



  $kddokterkirim=$data->kddokterkirim;


if(is_null($kddokterkirim)){

$kddokterkirim = $kddokter;

}else if($kddokterkirim === ''){

$kddokterkirim = $kddokter;
}else{
$kddokterkirim = $kddokterkirim;

}



    $sql="SELECT nomor from transaksipasiend where notransaksi='$notransaksi' and kdcabang='$kdcabang' and kdpoli='$kdpoli'
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




  $conn -> query("INSERT INTO transaksipasiend(notransaksi,nofaktur,tgltransaksi,waktu,nomor,kdproduk,produk,kdpoli,
    qty,harga,debet,kridit,jenistransaksi,tarifasli,disc,kdcabang,user) 
 values('$notransaksi','$nofaktur','$tgltransaksi','$tgltransaksi','$nomor','$kdproduk','$produk','$kdpoli','$qty','$harga','$debet','$kridit','$jenistransaksi','$tarifasli','$disc','$kdcabang','$user')");




$sqljasa="SELECT * from tarifkomponen where kdtarif='$kdproduk' and kdcabang='$kdcabang' and kdkomponen<>'8'";
$resultjasa=mysqli_query($conn,$sqljasa);
while($rowjasa=mysqli_fetch_array($resultjasa,MYSQLI_ASSOC)) {

$kdkom = $rowjasa['kdkomponen'];
$hargakom =  $rowjasa['harga'];



  $conn -> query("INSERT INTO transaksijasa(notrans,nofaktur,nomor,kdkomponen,kdpoli,kdproduk,kddokter,tgltransaksi,jasa,kdcabang,qty) 
 values('$notransaksi','$nofaktur','$nomor','$kdkom','$kdpoli','$kdproduk','$kddokter','$tgltransaksi','$hargakom','$kdcabang','1')");



}

$sqljasa="SELECT * from tarifkomponen where kdtarif='$kdproduk' and kdcabang='$kdcabang' and kdkomponen='8'";
$resultjasa=mysqli_query($conn,$sqljasa);
while($rowjasa=mysqli_fetch_array($resultjasa,MYSQLI_ASSOC)) {

$kdkom = $rowjasa['kdkomponen'];
$hargakom =  $rowjasa['harga'];



  $conn -> query("INSERT INTO transaksijasa(notrans,nofaktur,nomor,kdkomponen,kdpoli,kdproduk,kddokter,tgltransaksi,jasa,kdcabang,qty) 
 values('$notransaksi','$nofaktur','$nomor','$kdkom','$kdpoli','$kdproduk','$kddokterkirim','$tgltransaksi','$hargakom','$kdcabang','1')");



}











  // $conn -> query("DELETE FROM kelompokkostumer where costumer=''");





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


  $nomorx = $data->nomorx;
$netto = $data->netto;
$kk = $netto + $kridit;
$nofakturhap = $data->nofakturhap;

  $conn -> query("DELETE FROM transaksipasiend where notransaksi='$notransaksi' and nomor='$nomorx' and kdproduk='$kdproduk' and kdcabang='$kdcabang' and kdpoli='$kdpoli' ");


 $conn -> query("DELETE FROM transaksijasa where notrans='$notransaksi' and nomor='$nomorx' and kdproduk='$kdproduk' and kdcabang='$kdcabang' and kdpoli='$kdpoli' ");



 $conn -> query("DELETE FROM transaksiakhir where notrans='$notransaksi' and nomor='$nomorx'
  and kdpoli='$kdpoli'
  and kdcabang='$kdcabang' ");



 







 $sqljasass="SELECT * from transaksiakhir where notrans='$notransaksi' 
  and kdpoli='$kdpoli'
  and kdcabang='$kdcabang' order by nomor desc limit 1";
$resultjasass=mysqli_query($conn,$sqljasass);
while($rowjasass=mysqli_fetch_array($resultjasass,MYSQLI_ASSOC)) {

$nomoooor=$rowjasass['nomor'];



$conn -> query("UPDATE transaksiakhir set totalpiutang='$kk' 
where notrans='$notransaksi' 
  and kdpoli='$kdpoli'
  and kdcabang='$kdcabang'
and nomor='$nomoooor'");


}






 $conn -> query("DELETE FROM ermcpptintruksi where notransaksi='$nofakturhap' and kdpruduk='$kdproduk'
and kdcabang='$kdcabang' and no='$nomorx' ");




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


  $nomorx = $data->nomorx;
$qtyx = $data->qty;



$sqljasa="SELECT * from transaksipasiend  where notransaksi='$notransaksi' and nomor='$nomorx' and kdproduk='$kdproduk' and kdcabang='$kdcabang'";
$resultjasa=mysqli_query($conn,$sqljasa);
while($rowjasa=mysqli_fetch_array($resultjasa,MYSQLI_ASSOC)) {


$hargaj = ($rowjasa['harga'] * $qtyx) - $rowjasa['disc'];


$conn -> query("UPDATE transaksipasiend set qty='$qty',debet='$hargaj',tarifasli='$hargaj' where notransaksi='$notransaksi' and nomor='$nomorx' and kdproduk='$kdproduk' and kdcabang='$kdcabang' ");


}




$sqljasax="SELECT * from transaksijasa  where notrans='$notransaksi' and nomor='$nomorx' and kdproduk='$kdproduk' and kdcabang='$kdcabang'";
$resultjasax=mysqli_query($conn,$sqljasax);
while($rowjasax=mysqli_fetch_array($resultjasax,MYSQLI_ASSOC)) {

// $hargajx = $rowjasax['jasa'] * $qtyx;

  $hargajx  = ($qtyx * $rowjasax['jasa'])/$rowjasax['qty'];

$kdkomx = $rowjasax['kdkomponen'];

$conn -> query("UPDATE transaksijasa set jasa='$hargajx',qty='$qtyx'  where notrans='$notransaksi' and nomor='$nomorx' and kdproduk='$kdproduk' and kdcabang='$kdcabang' and kdkomponen='$kdkomx' ");


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



}else if($stssimpan === '4'){



     $conn -> autocommit(FALSE);

$disc = $data->disc;


$sqljasa="SELECT * from transaksipasiend  
where notransaksi='$notransaksi' and jenistransaksi='DB' and kdcabang='$kdcabang'";

$resultjasa=mysqli_query($conn,$sqljasa);
while($rowjasa=mysqli_fetch_array($resultjasa,MYSQLI_ASSOC)) {


$pengkurangdisc = ($disc * $rowjasa['debet']) / 100;

$harganew = $rowjasa['debet'] - $pengkurangdisc;
$nm =  $rowjasa['nomor'];
$kp =  $rowjasa['kdproduk'];




$conn -> query("UPDATE transaksipasiend set debet='$harganew',disc='$pengkurangdisc' where notransaksi='$notransaksi' and jenistransaksi='DB' and kdcabang='$kdcabang'  and nomor='$nm' and kdproduk='$kp'");


}



$sqljasax="SELECT * from transaksijasa  
where   notrans='$notransaksi'  and kdcabang='$kdcabang'";

$resultjasax=mysqli_query($conn,$sqljasax);
while($rowjasax=mysqli_fetch_array($resultjasax,MYSQLI_ASSOC)) {


$pengkurangdiscx = ($disc * $rowjasax['jasa']) / 100;

$harganewx = $rowjasax['jasa'] - $pengkurangdiscx;



$kp =  $rowjasax['kdproduk'] ;
$km =  $rowjasax['kdkomponen'] ;


$conn -> query("UPDATE transaksijasa set jasa='$harganewx' where 
  notrans='$notransaksi' 
  and kdcabang='$kdcabang' and kdproduk='$kp' and kdkomponen='$km'");


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


}else if($stssimpan === '5'){

  $conn -> autocommit(FALSE);

$disc = $data->disc;
$kdkomponen = $data->kdkomponen;
  $nomorx = $data->nomorx;




$sqljasax="SELECT * from transaksijasa  
where notrans='$notransaksi' and kdcabang='$kdcabang' and kdkomponen='$kdkomponen' and nomor='$nomorx' and kdproduk='$kdproduk'";

$resultjasax=mysqli_query($conn,$sqljasax);
while($rowjasax=mysqli_fetch_array($resultjasax,MYSQLI_ASSOC)) {


$jasaa = $rowjasax['jasa'] +  $rowjasax['nominal'];

$pengkurangdiscx = ($disc * $jasaa) / 100;

$harganewx = $jasaa - $pengkurangdiscx;





$conn -> query("UPDATE transaksijasa set jasa='$harganewx' ,discp='$disc',nominal='$pengkurangdiscx'
where notrans='$notransaksi' and kdcabang='$kdcabang' and kdkomponen='$kdkomponen' and nomor='$nomorx' and kdproduk='$kdproduk'");





}



$sqljasaxx="SELECT * from transaksijasa  
where nofaktur='$nofaktur' and kdcabang='$kdcabang'  and nomor='$nomorx' and kdproduk='$kdproduk'";

$resultjasaxx=mysqli_query($conn,$sqljasaxx);

   $tot_cash = 0;
   $tot_cash1 = 0;
   

while($rowjasaxx=mysqli_fetch_array($resultjasaxx,MYSQLI_ASSOC)) {



                $tot_cash  += $rowjasaxx['jasa'];
                $tot_cash1  += $rowjasaxx['nominal'];



$conn -> query("UPDATE transaksipasiend set debet='$tot_cash',disc='$tot_cash1' 

  where nofaktur='$nofaktur' and jenistransaksi='DB' and kdcabang='$kdcabang'  and nomor='$nomorx' and kdproduk='$kdproduk'");



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




}
   

 




?>