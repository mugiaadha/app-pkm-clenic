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
$notrans=$data->notrans;




$norm=$data->norm;

$kdkamar=$data->kdkamar;



$stssimpan = $data->stssimpan;






$user=$data->user;
$kdkostumerd=$data->kdkostumerd;


if($stssimpan === '1'){

   $conn -> autocommit(FALSE);
$tgldari=$data->tgldari;
$tgl = $tgldari.' '.date("H:i:s");
$jumlahpasien=$data->jumlahpasien;
if(empty($data->banklis)){
$banklis='';
}else{
$banklis=str_replace("'"," ` ",$data->banklis);




}

$kdprodukbayar=$data->kdprodukbayar;
$kdjenisbayar=$data->kdjenisbayar;
$produkbayar=$data->produkbayar;
$sisanumber  = $data->sisanumber;
$totaltagihan = $data->totaltagihan;
$sudahmasuk = $data->sudahmasuk;


 $sqln="SELECT nomor from transaksipasiend where nofaktur='$notrans' and kdcabang='$kdcabang' ORDER BY nomor desc limit 1";

$resultn=mysqli_query($conn,$sqln);
 $rowcountn=mysqli_num_rows($resultn);
  
if($rowcountn > 0){

while($rown=mysqli_fetch_array($resultn,MYSQLI_ASSOC)) {



  $nomor=$rown['nomor']+1;



}

}else{


  $nomor=1;

}




    if($kdprodukbayar === '3'){
      // uangmuka

   $conn -> query("INSERT INTO transferbayar(tanggal,notrans,nomor,norm,kdpoli,nominal,
                        bank,
                        kodebayar,keterangan,kdcabang,user) 
                     values('$tgl','$notrans','$nomor','$norm','$kdkamar','$jumlahpasien','$banklis'
                     ,'$kdjenisbayar','Uang Muka ','$kdcabang','$user')");


   $conn -> query("INSERT INTO transaksiuangmuka(notrans,norm,nominal,keterangan,tgl,kdcabang,nomor) 
                     values('$notrans','$norm','$jumlahpasien','Uang Muka','$tgl','$kdcabang','$nomor')");




                        $conn -> query("INSERT INTO transaksipasiend(notransaksi,nofaktur,tgltransaksi,waktu,nomor,kdproduk,produk,kdpoli,
    qty,harga,debet,kridit,jenistransaksi,tarifasli,disc,kdcabang,user,ri) 
 values('$notrans','$notrans','$tgl','$tgl','$nomor','10','Uang Muka','$kdkamar','1',
 '$jumlahpasien','0','$jumlahpasien'

 ,'KR','0','0','$kdcabang','$user','1')");





                        //   $conn -> query("UPDATE trigerbayar set

                        // sudahdibayar=sudahdibayar+'$jumlahpasien' where
                        //  notrans='$notrans' and kdcabang='$kdcabang'  ");









    }else if($kdprodukbayar === '1'){

// tunai




                        $conn -> query("INSERT INTO transaksipasiend(notransaksi,nofaktur,tgltransaksi,waktu,nomor,kdproduk,produk,kdpoli,
    qty,harga,debet,kridit,jenistransaksi,tarifasli,disc,kdcabang,user,ri) 
 values('$notrans','$notrans','$tgl','$tgl','$nomor','$kdprodukbayar','$produkbayar','$kdkamar','1',
 '$jumlahpasien','0','$jumlahpasien'

 ,'KR','0','0','$kdcabang','$user','1')");

   $conn -> query("INSERT INTO transferbayar(tanggal,notrans,nomor,norm,kdpoli,nominal,
                        bank,
                        kodebayar,keterangan,kdcabang,user) 
                     values('$tgl','$notrans','$nomor','$norm','$kdkamar','$jumlahpasien','$banklis'
                     ,'$kdjenisbayar','$produkbayar ','$kdcabang','$user')");




if($jumlahpasien >= $sisanumber){
// tunai lunas
   






 $sqlx="SELECT * from transaksiakhir where notrans='$notrans' and kdcabang='$kdcabang'  ";
    $resultx=mysqli_query($conn,$sqlx);

     $rowcountx=mysqli_num_rows($resultx);

if($rowcountx > 0){



$conn -> query("UPDATE transaksiakhir set

totalpiutang=0,totalcash=$totaltagihan  where notrans='$notrans' and norm='$norm'  and 
 kdcabang='$kdcabang'");

 



}else{

   $conn -> query("INSERT INTO transaksiakhir(notrans,nomor,tglfaktur,waktu,norm,kdpoli,kdkostumer,jenistransaksi,namabank,
    totalcash,totalpiutang,tagihan

    ,kdcabang,keterangan,user,status) 
 values('$notrans','$nomor','$tgl','$tgl','$norm','$kdkamar','$kdkostumerd','$kdprodukbayar','$banklis','$totaltagihan','0','$totaltagihan','$kdcabang','','$user','2')");


 




}












}else{
// tunai tidak lunas


 //  $piutang = $totaltagihan - $jumlahpasien;


 //  $conn -> query("INSERT INTO transaksiakhir(notrans,nomor,tglfaktur,waktu,norm,kdpoli,kdkostumer,jenistransaksi,namabank,
 //    totalcash,totalpiutang,tagihan

 //    ,kdcabang,keterangan,user,status) 
 // values('$notrans','$nomor','$tgl','$tgl','$norm','$kdkamar','$kdkostumerd','$kdprodukbayar','$banklis',

 // '$jumlahpasien','$piutang','$totaltagihan','$kdcabang','','$user','1')");


}




      // echo "asdas";


    }else if($kdprodukbayar === '2'){

        // kridetlunas

                        $conn -> query("INSERT INTO transaksipasiend(notransaksi,nofaktur,tgltransaksi,waktu,nomor,kdproduk,produk,kdpoli,
    qty,harga,debet,kridit,jenistransaksi,tarifasli,disc,kdcabang,user,ri) 
 values('$notrans','$notrans','$tgl','$tgl','$nomor','$kdprodukbayar','$produkbayar','$kdkamar','1',
 '$sisanumber','0','$sisanumber'

 ,'KR','0','0','$kdcabang','$user','1')");

   $conn -> query("INSERT INTO transferbayar(tanggal,notrans,nomor,norm,kdpoli,nominal,
                        bank,
                        kodebayar,keterangan,kdcabang,user) 
                     values('$tgl','$notrans','$nomor','$norm','$kdkamar','$sisanumber','$banklis'
                     ,'$kdjenisbayar','$produkbayar ','$kdcabang','$user')");






   $conn -> query("INSERT INTO transaksiakhir(notrans,nomor,tglfaktur,waktu,norm,kdpoli,kdkostumer,jenistransaksi,namabank,
    totalcash,totalpiutang,tagihan

    ,kdcabang,keterangan,user,status) 
 values('$notrans','$nomor','$tgl','$tgl','$norm','$kdkamar','$kdkostumerd','$kdprodukbayar','','$sudahmasuk','$sisanumber','$totaltagihan','$kdcabang','','$user','2')");




    



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
$kridit=$data->kridit;
$kdproduk=$data->kdproduk;
$debet=$data->debet;


  if($kdproduk === '10'){
$conn -> query("DELETE FROM transaksipasiend where notransaksi='$notrans' and nomor='$nomorx' and kdproduk='$kdproduk' 
    and kdcabang='$kdcabang' ");



$conn -> query("DELETE FROM transaksiuangmuka where notrans='$notrans' and nomor='$nomorx' 
    and kdcabang='$kdcabang' ");

$conn -> query("DELETE FROM transferbayar where notrans='$notrans' and nomor='$nomorx' 
    and kdcabang='$kdcabang' ");



     // $conn -> query("UPDATE trigerbayar set

     //                    sudahdibayar=sudahdibayar-'$kridit'  where
     //                     notrans='$notrans' and kdcabang='$kdcabang'  ");




  }else{




  $conn -> query("DELETE FROM transaksipasiend where notransaksi='$notrans' and nomor='$nomorx' and kdproduk='$kdproduk' 
    and kdcabang='$kdcabang' ");


 $conn -> query("DELETE FROM transaksijasa where notrans='$notrans' and nomor='$nomorx' and kdproduk='$kdproduk' 
  and kdcabang='$kdcabang'  ");



 $conn -> query("DELETE FROM transaksiakhir where notrans='$notrans' and nomor='$nomorx'
 
  and kdcabang='$kdcabang' ");


  







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


   $conn -> autocommit(FALSE);

$nomorx = $data->nomorx;
$kdproduk= $data->kdproduk;


  $conn -> query("DELETE FROM transaksipasiend where notransaksi='$notrans' and nomor='$nomorx' and kdproduk='$kdproduk' 
    and kdcabang='$kdcabang' ");

    $conn -> query("DELETE FROM transaksiakhir where notrans='$notrans' and nomor='$nomorx'
 
  and kdcabang='$kdcabang' ");



      $conn -> query("DELETE FROM transferbayar where notrans='$notrans' 
 and nomor='$nomorx'
  and kdcabang='$kdcabang' ");





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


$tglpulang = $data->tglpulang;

     $conn -> query("UPDATE pasienrawatinap set

                        tglpulang='$tglpulang',userpulang='$user'  where
                         notransaksi='$notrans' and kdcabang='$kdcabang'  ");



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




     $conn -> query("UPDATE pasienrawatinap set

                        tglpulang = null,userpulang = null  where
                         notransaksi='$notrans' and kdcabang='$kdcabang'  ");



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