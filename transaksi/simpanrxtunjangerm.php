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
$nofaktur = $data->nofaktur;
$kdkostumerd   = $data->kdkostumerd;
$norm = $data->norm;
$kddokter = $data->kddokter;
$kdpoli = $data->kdpoli;
$kdproduk  = $data->kdproduk;
$produk = $data->produk;
$qty = $data->qty;
$harga = $data->harga;
$debet =   $data->debet;
$kridit =   $data->kridit;
$jenistransaksi  = $data->jenistransaksi;
$tarifasli = $data->tarifasli;
$kdcppt =   $data->kdcppt;
$dari =   $data->dari;
$kduser =   $data->kduser;
$kdcabang=$data->kdcabang;

$stssimpan = $data->stssimpan;

if($stssimpan === '1'){

   $conn -> autocommit(FALSE);



$tglminta = $data->tglminta;


$sqlpoli="SELECT kdpoli from poliklinik where kdcabang='$kdcabang' and sts='$kdpoli' ";
$resultpoli=mysqli_query($conn,$sqlpoli);
while($rowpoli=mysqli_fetch_array($resultpoli,MYSQLI_ASSOC)) {

$kdpolix = $rowpoli['kdpoli'];

}



$sql="SELECT nomor from transaksipasiend where kdcppt='$kdcppt' and kdcabang='$kdcabang' and kdpoli='$kdpolix'
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






  $conn -> query("INSERT INTO ermcpptintruksi(notransaksi,kdkostumerd,norm,kddokter,kdpoli,kdpruduk,nama,
    qty,harga,status,dari,kduser,kdcabang,tgl,kdcppt,kunci,tglpriksa,dari2,no) 
 values('$nofaktur','$kdkostumerd','$norm','$kddokter','$kdpolix','$kdproduk','$produk','$qty','$harga','0','$dari','$kduser','$kdcabang','$tglminta','$kdcppt','0','$tgl','CPPT','$nomor')");





  $conn -> query("INSERT INTO transaksipasiend(notransaksi,nofaktur,tgltransaksi,waktu,nomor,kdproduk,produk,kdpoli,
    qty,harga,debet,kridit,jenistransaksi,tarifasli,disc,kdcabang,user,kdcppt) 
 values('','$nofaktur','$tgltransaksi','$tgltransaksi','$nomor','$kdproduk','$produk','$kdpolix','$qty','$harga','$debet','$kridit','$jenistransaksi','$tarifasli','0','$kdcabang','$kduser','$kdcppt')");




$sqljasa="SELECT * from tarifkomponen where kdtarif='$kdproduk' and kdcabang='$kdcabang'";
$resultjasa=mysqli_query($conn,$sqljasa);
while($rowjasa=mysqli_fetch_array($resultjasa,MYSQLI_ASSOC)) {

$kdkom = $rowjasa['kdkomponen'];
$hargakom =  $rowjasa['harga'];



  $conn -> query("INSERT INTO transaksijasa(notrans,nofaktur,nomor,kdkomponen,kdpoli,kdproduk,kddokter,tgltransaksi,jasa,kdcabang,kdcppt,qty) 
 values('','$nofaktur','$nomor','$kdkom','$kdpolix','$kdproduk','$kddokter',
 '$tgltransaksi','$hargakom','$kdcabang','$kdcppt','1')");



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


  $nomorx = $data->nomorx;
$nofakturhap= $data->nofakturhap;


  $conn -> query("DELETE FROM transaksipasiend where nofaktur='$nofakturhap' and nomor='$nomorx' and kdproduk='$kdproduk' and kdcabang='$kdcabang' and kdpoli='$kdpoli' and kdcppt='$kdcppt' ");



  $conn -> query("DELETE FROM kunjunganpasien where nofaktur='$nofakturhap'  and kdcabang='$kdcabang' and kdpoli='$kdpoli'  ");

  $conn -> query("DELETE FROM transaksipasien where notransaksi='$nofakturhap'  and kdcabang='$kdcabang' and kdpoli='$kdpoli'  ");






 $conn -> query("DELETE FROM transaksijasa where nofaktur='$nofakturhap' and nomor='$nomorx' and kdproduk='$kdproduk' and kdcabang='$kdcabang' and kdpoli='$kdpoli' and kdcppt='$kdcppt' ");



 $conn -> query("DELETE FROM ermcpptintruksi where notransaksi='$nofakturhap' and kdpruduk='$kdproduk'
and kdpoli='$kdpoli' and kddokter='$kddokter' and dari='$dari' and kdcppt='$kdcppt' and kunci='0'
and kdcabang='$kdcabang' and no='$nomorx' ");


// echo "DELETE FROM ermcpptintruksi where notransaksi='$nofakturhap' and kdpruduk='$kdproduk'
// and kdpoli='$kdpoli' and kddokter='$kddokter' and dari='$dari' and kdcppt='$kdcppt' and kunci='0'
// and kdcabang='$kdcabang' and no='$nomorx' ";

 

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




$keterangan = $data->keterangan;
$norm = $data->norm;



$conn -> query("UPDATE ermcpptintruksi set keterangan='$keterangan' where notransaksi='$nofaktur' 
 and kdcabang='$kdcabang' and kdcppt='$kdcppt' and norm='$norm' and dari='$dari' ");









// $keterangan = $data->keterangan;
// $norm = $data->norm;
// $tgldaftar = date("Y-m-d");
// $kdklinik=$data->kdklinik;
// $sts = $data->sts;
// $sqlpoli="SELECT kdpoli from poliklinik where kdcabang='$kdcabang' and sts='$sts' ";




// $resultpoli=mysqli_query($conn,$sqlpoli);
// while($rowpoli=mysqli_fetch_array($resultpoli,MYSQLI_ASSOC)) {

// $kdpolix = $rowpoli['kdpoli'];

// }




// $sqlpolifd="SELECT kddokter from dokterklinik where kdcabang='$kdcabang' and kdpoli='$kdpolix' order by kddokter desc LIMIT 1";



// $resultpolid=mysqli_query($conn,$sqlpolifd);
// while($rowpolid=mysqli_fetch_array($resultpolid,MYSQLI_ASSOC)) {

// $kddokterasli = $rowpolid['kddokter'];

// }




//    $mows = date_create( $tgldaftar);
  
//     $form_no = date_format( $mows, 'ymd' );

// $query="SELECT a.kdtarif
// FROM kelompokkostumer a , kelompokkostumerd b
// WHERE a.kdkostumer = b.kdkostumer
// and b.kdkostumerd='$kdkostumerd' and a.kdcabang='$kdcabang'";
// $result=mysqli_query($conn, $query);
// while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {




//  $jen_tarif = $row['kdtarif'];
//  $nomer = 'LJ'.'-'.$jen_tarif.$form_no;
// }




//    $sql="SELECT notransaksi from transaksipasien where left(notransaksi,15)='$nomer' ORDER BY notransaksi desc limit 1";

// $result=mysqli_query($conn,$sql);
//  $rowcount=mysqli_num_rows($result);
  
// if($rowcount > 0){

// while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {


// $urut = $row['notransaksi'];
//   $awal = substr( $urut, 16, 3 );
//         $awal = $awal + 1;

//  $urut = strlen( $awal );


//         if ( $urut == 1 ) {
//             $jum = '00';
//         } elseif ( $urut == 2 ) {
//             $jum = '0';
//         } elseif ( $urut == 3 ) {
//             $jum = '';
//         }
//         $no_trans = $nomer.'-'.$jum.$awal;



// }

// }else{


//    $no_trans = $nomer.'-'.'001';

// }





// $conn -> query("UPDATE ermcpptintruksi set keterangan='$keterangan' where notransaksi='$nofaktur' 
//  and kdcabang='$kdcabang' and kdcppt='$kdcppt' and norm='$norm' and dari='$dari' ");









 // $conn -> query("INSERT INTO transaksipasien(notransaksi,norm,tgltransaksi,user,updaters,kdpoli,kunci,kdklinik,kdcabang) 
 // values('$no_trans','$norm','$tgl','$kduser','$tgl','$kdpolix','0','$kdklinik','$kdcabang')");



 //  $conn -> query("INSERT INTO kunjunganpasien(norm,kdpoli,tglpriksa,kddokter,kdkostumerd,jammasuk,notransaksi,koreksierm,kdklinik,kdcabang,kddokterpengirim,nofaktur) 
 // values('$norm','$kdpolix','$tgldaftar','$kddokterasli','$kdkostumerd','$tgl','$no_trans','BELUM','$kdklinik','$kdcabang','$kddokter','$nofaktur')");





 // $conn -> query("UPDATE  transaksipasiend set notransaksi='$no_trans',pr='1' where  kdcppt='$kdcppt' and kdcabang='$kdcabang' and kdpoli='$kdpolix' and pr='0'");

 // $conn -> query("UPDATE  transaksijasa set notrans='$no_trans',pr='1' where  kdcppt='$kdcppt' and kdcabang='$kdcabang' and kdpoli='$kdpolix' and pr='0'");



//  $conn -> query("UPDATE  ermcpptintruksi set status='1' where  kdcppt='$kdcppt' and 
// status='0' and
//   kdcabang='$kdcabang' and kdpoli='$kdpolix'");






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



//      $conn -> autocommit(FALSE);

// $disc = $data->disc;


// $sqljasa="SELECT * from transaksipasiend  
// where notransaksi='$notransaksi' and jenistransaksi='DB' and kdcabang='$kdcabang'";

// $resultjasa=mysqli_query($conn,$sqljasa);
// while($rowjasa=mysqli_fetch_array($resultjasa,MYSQLI_ASSOC)) {


// $pengkurangdisc = ($disc * $rowjasa['debet']) / 100;

// $harganew = $rowjasa['debet'] - $pengkurangdisc;
// $nm =  $rowjasa['nomor'];
// $kp =  $rowjasa['kdproduk'];




// $conn -> query("UPDATE transaksipasiend set debet='$harganew',disc='$pengkurangdisc' where notransaksi='$notransaksi' and jenistransaksi='DB' and kdcabang='$kdcabang'  and nomor='$nm' and kdproduk='$kp'");


// }



// $sqljasax="SELECT * from transaksijasa  
// where   notrans='$notransaksi'  and kdcabang='$kdcabang'";

// $resultjasax=mysqli_query($conn,$sqljasax);
// while($rowjasax=mysqli_fetch_array($resultjasax,MYSQLI_ASSOC)) {


// $pengkurangdiscx = ($disc * $rowjasax['jasa']) / 100;

// $harganewx = $rowjasax['jasa'] - $pengkurangdiscx;



// $kp =  $rowjasax['kdproduk'] ;
// $km =  $rowjasax['kdkomponen'] ;


// $conn -> query("UPDATE transaksijasa set jasa='$harganewx' where 
//   notrans='$notransaksi' 
//   and kdcabang='$kdcabang' and kdproduk='$kp' and kdkomponen='$km'");


// }




// // Commit transaction
// if (!$conn -> commit()) {
//   // echo "Commit transaction failed";
//     echo json_encode('Gagal');
 

//   exit();
// }else{
// echo json_encode('Sukses');

// }

// // Rollback transaction
// $conn -> rollback();

// $conn -> close();


}else if($stssimpan === '5'){

//   $conn -> autocommit(FALSE);

// $disc = $data->disc;
// $kdkomponen = $data->kdkomponen;
//   $nomorx = $data->nomorx;




// $sqljasax="SELECT * from transaksijasa  
// where notrans='$notransaksi' and kdcabang='$kdcabang' and kdkomponen='$kdkomponen' and nomor='$nomorx' and kdproduk='$kdproduk'";

// $resultjasax=mysqli_query($conn,$sqljasax);
// while($rowjasax=mysqli_fetch_array($resultjasax,MYSQLI_ASSOC)) {


// $pengkurangdiscx = ($disc * $rowjasax['jasa']) / 100;

// $harganewx = $rowjasax['jasa'] - $pengkurangdiscx;




// $conn -> query("UPDATE transaksijasa set jasa='$harganewx' 
// where notrans='$notransaksi' and kdcabang='$kdcabang' and kdkomponen='$kdkomponen' and nomor='$nomorx' and kdproduk='$kdproduk'");



// $conn -> query("UPDATE transaksipasiend set debet=debet-'$pengkurangdiscx',disc=disc+'$pengkurangdiscx' 

//   where notransaksi='$notransaksi' and jenistransaksi='DB' and kdcabang='$kdcabang'  and nomor='$nomorx' and kdproduk='$kdproduk'");



// }






//   // Commit transaction
// if (!$conn -> commit()) {
//   // echo "Commit transaction failed";
//     echo json_encode('Gagal');
 

//   exit();
// }else{
// echo json_encode('Sukses');

// }

// // Rollback transaction
// $conn -> rollback();

// $conn -> close();




}
   

 




?>