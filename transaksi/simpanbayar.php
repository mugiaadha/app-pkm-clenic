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


$tgldari=$data->tgldari;
$tgl = $tgldari.' '.date("H:i:s");




$banklis=$data->banklis;
$produkbayar =$data->produkbayar;

$jbayari=$data->jbayari;
$jumlahpasien=$data->jumlahpasien;
$kddokter=$data->kddokter;
$kdkostumerd=$data->kdkostumerd;
$kdpoli=$data->kdpoli;
$kembalian=$data->kembalian;
$keterangb=$data->keterangb;
$notrans=$data->notrans;
$totalrjsaja =$data->totalrjsaja;
$norm =$data->norm;
$user =$data->user;

$yangmasuk=$data->yangmasuk;
$stssimpan = $data->stssimpan;
$kurangbayar = $data->kurangbayar;

$kurangbayars = $data->kurangbayar;
$totalrjsajaasli = $data->totalrjsajaasli;
$kdprodukbayar = $data->kdprodukbayar;
$bulat = $data->bulat;


if($stssimpan === '1'){

   $conn -> autocommit(FALSE);

 $sql="SELECT nomor from transaksipasiend where notransaksi='$notrans' and kdcabang='$kdcabang' and kdpoli='$kdpoli'
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


if($jbayari === '2'){

  // kridit
$harga = $jumlahpasien;
$debet = 0;
$kridit = $jumlahpasien;

$kurangbayarx = $jumlahpasien; 
$jumlahpasienx = $kurangbayar;

}else{

  // cash tf edc
$kurangbayarx = $kurangbayar; 
$jumlahpasienx = $jumlahpasien;




$harga = $jumlahpasien;
$debet = 0;
$kridit = $jumlahpasien;

}

  $conn -> query("INSERT INTO transaksipasiend(notransaksi,nofaktur,tgltransaksi,waktu,nomor,kdproduk,produk,kdpoli,
    qty,harga,debet,kridit,jenistransaksi,tarifasli,disc,kdcabang,user) 
 values('$notrans','$notrans','$tgl','$tgl','$nomor','$jbayari','$produkbayar','$kdpoli','1',
 '$harga','$debet','$kridit'

 ,'KR','0','0','$kdcabang','$user')");





 $sqlx="SELECT * from transaksiakhir where notrans='$notrans' and kdcabang='$kdcabang'   and norm='$norm' and kdpoli='$kdpoli' and jenistransaksi='$kdprodukbayar'  ";
    $resultx=mysqli_query($conn,$sqlx);

     $rowcountx=mysqli_num_rows($resultx);
  
if($rowcountx > 0){




$conn -> query("UPDATE transaksiakhir set

totalpiutang=totalpiutang -'$jumlahpasienx',totalcash=totalcash+'$jumlahpasienx'  where notrans='$notrans' and norm='$norm' and kdpoli='$kdpoli' and 
 kdcabang='$kdcabang'");


}else{


// $totalrjsajaasli = $totalrjsajaasli;


    $conn -> query("INSERT INTO transaksiakhir(notrans,nomor,tglfaktur,waktu,norm,kdpoli,kdkostumer,jenistransaksi,
    namabank,
    totalcash,totalpiutang,tagihan

    ,kdcabang,keterangan,user,status) 
 values('$notrans','$nomor','$tgl','$tgl','$norm','$kdpoli','$kdkostumerd','$kdprodukbayar','$banklis'
 ,'$jumlahpasienx','$kurangbayarx','$totalrjsajaasli','$kdcabang','$keterangb','$user','1')");

}




if($kdprodukbayar === '1'){
// cash


     $conn -> query("INSERT INTO transferbayar(tanggal,notrans,nomor,norm,kdpoli,nominal,
    bank,
    kodebayar,keterangan,kdcabang,user) 
 values('$tgl','$notrans','$nomor','$norm','$kdpoli','$jumlahpasienx','$banklis'
 ,'$jbayari','$keterangb ','$kdcabang','$user')");



}else if($kdprodukbayar === '2'){
// kridit
}







$sqlnbulat="SELECT nominal,bulat from pembulatanrj where notrans='$notrans' and kdcabang='$kdcabang'";

$resultnbulat=mysqli_query($conn,$sqlnbulat);
 $rowcountnbulat=mysqli_num_rows($resultnbulat);
  
if($rowcountnbulat > 0){

while($rownbulat=mysqli_fetch_array($resultnbulat,MYSQLI_ASSOC)) {



 $conn -> query("UPDATE pembulatanrj set

bulat='$bulat'  where notrans='$notrans' and kdcabang='$kdcabang'");


}

}else{




  $conn -> query("INSERT INTO pembulatanrj(notrans,kdcabang,nominal,bulat) 
                     values('$notrans','$kdcabang','','$bulat')");


}



$conn -> query("DELETE from transaksipasiend  where harga <= 0 and kdcabang='$kdcabang'");



$conn -> query("UPDATE kunjunganpasien set

layan='1'  where nofaktur='$notrans' 
 and kdcabang='$kdcabang'");




// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode($tgl);

}

// Rollback transaction
$conn -> rollback();

$conn -> close();



}else if($stssimpan === '2'){
 $conn -> autocommit(FALSE);
  $netto = $data->netto;


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


  



 $sql="SELECT * from trigerbayar where notrans='$notrans' and kdcabang='$kdcabang' and status='1' ";

$result=mysqli_query($conn,$sql);
//  $rowcount=mysqli_num_rows($result);
  
// if($rowcount > 0){

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {



if($jumlahpasien >= $row['totaltagihan']){
// langsung input ke transaksi dan tagihan

     if($kdprodukbayar === '1'){
       $pesan='satu';
        // cash
       $conn -> query("INSERT INTO transferbayar(tanggal,notrans,nomor,norm,kdpoli,nominal,
                        bank,
                        kodebayar,keterangan,kdcabang,user) 
                     values('$tgl','$notrans','100','$norm','$kdpoli','$jumlahpasien','$banklis'
                     ,'$jbayari','$keterangb ','$kdcabang','$user')");



  $queryx="SELECT  distinct
                    a.notransaksi,b.nampoli,a.kdpoli
                    FROM transaksipasiend a,poliklinik b
                    wHERE a.kdpoli = b.kdpoli   and a.nofaktur='$notrans' 
                    and a.kdcabang='$kdcabang'";
                    $resultx=mysqli_query($conn, $queryx);
                    while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {
                      $nx = $rowx['notransaksi'];
                      $nxx = $rowx['nampoli'];
                      $nxxx = $rowx['kdpoli'];

                       $queryxx="SELECT SUM(debet) as  total,SUM(kridit) AS tkridit FROM transaksipasiend WHERE notransaksi='$nx' and kdcabang='$kdcabang'";
                    $resultxx=mysqli_query($conn, $queryxx);
                    while($rowxx=mysqli_fetch_array($resultxx,MYSQLI_ASSOC)) {

                      $totaal = $rowxx['total'] - $rowxx['tkridit'];



                        $conn -> query("INSERT INTO transaksipasiend(notransaksi,nofaktur,tgltransaksi,waktu,nomor,kdproduk,produk,kdpoli,
    qty,harga,debet,kridit,jenistransaksi,tarifasli,disc,kdcabang,user) 
 values('$nx','$notrans','$tgl','$tgl','100','1','Cash','$nxxx','1',
 '$totaal','0','$totaal'

 ,'KR','0','0','$kdcabang','$user')");





                    $conn -> query("INSERT INTO transaksiakhir(notrans,nomor,tglfaktur,waktu,norm,kdpoli,kdkostumer,jenistransaksi,namabank,
    totalcash,totalpiutang,tagihan

    ,kdcabang,keterangan,user,status) 
 values('$nx','100','$tgl','$tgl','$norm','$nxxx','$kdkostumerd','$kdprodukbayar','','$totaal','0','$totaal','$kdcabang','$keterangb','$user','2')");



                 }
                      




                      }




                          $queryxxl="SELECT * FROM jualobat WHERE nofaktur='$notrans' and kdcabang='$kdcabang'";
                    $resultxxl=mysqli_query($conn, $queryxxl);
                    while($rowxx=mysqli_fetch_array($resultxxl,MYSQLI_ASSOC)) {
                        $nff =$rowxx['totalbayar'];
                        $nfft =$rowxx['notransaksi'];

                      $conn -> query("UPDATE jualobat set

                        sudahbayar='$nff',statuslunas='2',kdbayar='1',bayar='Cash',userbayar='$user',
                        tglbayar='$tgl'
                         where
                         notransaksi='$nfft' and kdcabang='$kdcabang' and statuslunas='1' ");






         }









                      $conn -> query("UPDATE trigerbayar set

                        sudahdibayar=sudahdibayar+'$jumlahpasien',status='2' where
                         notrans='$notrans' and kdcabang='$kdcabang' and status='1' ");



     }else{
         $pesan='dua';
 $queryx="SELECT  distinct
                    a.notransaksi,b.nampoli,a.kdpoli
                    FROM transaksipasiend a,poliklinik b
                    wHERE a.kdpoli = b.kdpoli   and a.nofaktur='$notrans' 
                    and a.kdcabang='$kdcabang'";
                    $resultx=mysqli_query($conn, $queryx);
                    while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {
                      $nx = $rowx['notransaksi'];
                      $nxx = $rowx['nampoli'];
                      $nxxx = $rowx['kdpoli'];

                       $queryxx="SELECT SUM(debet) as  total,SUM(kridit) AS tkridit FROM transaksipasiend WHERE notransaksi='$nx' and kdcabang='$kdcabang'";
                    $resultxx=mysqli_query($conn, $queryxx);
                    while($rowxx=mysqli_fetch_array($resultxx,MYSQLI_ASSOC)) {

                      $totaal = $rowxx['total'] - $rowxx['tkridit'];



                        $conn -> query("INSERT INTO transaksipasiend(notransaksi,nofaktur,tgltransaksi,waktu,nomor,kdproduk,produk,kdpoli,
    qty,harga,debet,kridit,jenistransaksi,tarifasli,disc,kdcabang,user) 
 values('$nx','$notrans','$tgl','$tgl','100','2','Kridit','$nxxx','1',
 '$totaal','0','$totaal'

 ,'KR','0','0','$kdcabang','$user')");





                    $conn -> query("INSERT INTO transaksiakhir(notrans,nomor,tglfaktur,waktu,norm,kdpoli,kdkostumer,jenistransaksi,namabank,
    totalcash,totalpiutang,tagihan

    ,kdcabang,keterangan,user,status) 
 values('$nx','100','$tgl','$tgl','$norm','$nxxx','$kdkostumerd','$kdprodukbayar','','0','$totaal','$totaal','$kdcabang','$keterangb','$user','2')");



                 }
                      




                      }




                          $queryxxl="SELECT * FROM jualobat WHERE nofaktur='$notrans' and kdcabang='$kdcabang'";
                    $resultxxl=mysqli_query($conn, $queryxxl);
                    while($rowxx=mysqli_fetch_array($resultxxl,MYSQLI_ASSOC)) {
                        $nff =$rowxx['totalbayar'];
                        $nfft =$rowxx['notransaksi'];

                      $conn -> query("UPDATE jualobat set

                        statuslunas='2',kdbayar='2',bayar='Kridit',
                        userbayar='$user',
                        tglbayar='$tgl'
                         where
                         notransaksi='$nfft' and kdcabang='$kdcabang' and statuslunas='1' ");



   


                    }









                      $conn -> query("UPDATE trigerbayar set

                        sudahdibayar=sudahdibayar+'$jumlahpasien',status='2' where
                         notrans='$notrans' and kdcabang='$kdcabang' and status='1' ");





     }
    


}else{
 $pesan='kridit lunascx';
 if($kurangbayar <= 0 ){

      if($kdprodukbayar === '1'){
        $pesan='tiga';
          // cash lunas
                  $conn -> query("INSERT INTO transferbayar(tanggal,notrans,nomor,norm,kdpoli,nominal,
                        bank,
                        kodebayar,keterangan,kdcabang,user) 
                     values('$tgl','$notrans','100','$norm','$kdpoli','$jumlahpasien','$banklis'
                     ,'$jbayari','$keterangb ','$kdcabang','$user')");

                    $queryx="SELECT  distinct
                    a.notransaksi,b.nampoli,a.kdpoli
                    FROM transaksipasiend a,poliklinik b
                    wHERE a.kdpoli = b.kdpoli   and a.nofaktur='$notrans' 
                    and a.kdcabang='$kdcabang'";
                    $resultx=mysqli_query($conn, $queryx);
                    while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {
                      $nx = $rowx['notransaksi'];
                      $nxx = $rowx['nampoli'];
                      $nxxx = $rowx['kdpoli'];

                       $queryxx="SELECT SUM(debet) as  total,SUM(kridit) AS tkridit  FROM transaksipasiend WHERE notransaksi='$nx' and kdcabang='$kdcabang'";
                    $resultxx=mysqli_query($conn, $queryxx);
                    while($rowxx=mysqli_fetch_array($resultxx,MYSQLI_ASSOC)) {

                      $totaal = $rowxx['total'] - $rowxx['tkridit'];



                        $conn -> query("INSERT INTO transaksipasiend(notransaksi,nofaktur,tgltransaksi,waktu,nomor,kdproduk,produk,kdpoli,
    qty,harga,debet,kridit,jenistransaksi,tarifasli,disc,kdcabang,user) 
 values('$nx','$notrans','$tgl','$tgl','100','1','Cash','$nxxx','1',
 '$totaal','0','$totaal'

 ,'KR','0','0','$kdcabang','$user')");




                    $conn -> query("INSERT INTO transaksiakhir(notrans,nomor,tglfaktur,waktu,norm,kdpoli,kdkostumer,jenistransaksi,namabank,
    totalcash,totalpiutang,tagihan

    ,kdcabang,keterangan,user,status) 
 values('$nx','100','$tgl','$tgl','$norm','$nxxx','$kdkostumerd','$kdprodukbayar','','$totaal','0','$totaal','$kdcabang','$keterangb','$user','2')");



                 }
                      



                      }


                          $queryxxl="SELECT * FROM jualobat WHERE nofaktur='$notrans' and kdcabang='$kdcabang'";
                    $resultxxl=mysqli_query($conn, $queryxxl);
                    while($rowxx=mysqli_fetch_array($resultxxl,MYSQLI_ASSOC)) {
                        $nff =$rowxx['totalbayar'];
                        $nfft =$rowxx['notransaksi'];

                      $conn -> query("UPDATE jualobat set

                        sudahbayar='$nff',statuslunas='2',kdbayar='1',bayar='Cash'
                        ,userbayar='$user',
                        tglbayar='$tgl'

                         where
                         notransaksi='$nfft' and kdcabang='$kdcabang' and statuslunas='1' ");


 


                    }









                      $conn -> query("UPDATE trigerbayar set

                        sudahdibayar=sudahdibayar+'$jumlahpasien',status='2' where
                         notrans='$notrans' and kdcabang='$kdcabang' and status='1' ");



      }else{

       
          // kridit lunas
                         $pesan='empat';
        $pesan='kridit lunas';
                      //mencari cash di tangan
                    $queryxxl="SELECT * FROM trigerbayar WHERE notrans='$notrans' and kdcabang='$kdcabang' and status='1'";
                    $resultxxl=mysqli_query($conn, $queryxxl);
                    while($rowxxl=mysqli_fetch_array($resultxxl,MYSQLI_ASSOC)) {
                 
                      $sudahdibayarxx = $rowxxl['sudahdibayar'];

                   

                       

                    }
                      // kurangbayar adalah jumlah piutang



                     $queryx="SELECT  distinct
                    a.notransaksi,b.nampoli,a.kdpoli
                    FROM transaksipasiend a,poliklinik b
                    wHERE a.kdpoli = b.kdpoli   and a.nofaktur='$notrans' 
                    and a.kdcabang='$kdcabang'";
                    $resultx=mysqli_query($conn, $queryx);
                    while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {
                      $nx = $rowx['notransaksi'];
                  
                      $nxxx = $rowx['kdpoli'];

 


                    $queryxx="SELECT SUM(debet) as  total,SUM(kridit) AS tkridit FROM transaksipasiend WHERE notransaksi='$nx' and kdcabang='$kdcabang' and kdpoli='$nxxx'";
                    $resultxx=mysqli_query($conn, $queryxx);
                    while($rowxx=mysqli_fetch_array($resultxx,MYSQLI_ASSOC)) {

                      $totaal = $rowxx['total'] - $rowxx['tkridit'];

                      $cashs = ($totaal*$sudahdibayarxx) / $netto;
                      $cash  = ceil($cashs);

                      $hutangs = ($totaal*$jumlahpasien) / $netto;
                      $hutang = ceil($hutangs);

                        $conn -> query("INSERT INTO transaksipasiend(notransaksi,nofaktur,tgltransaksi,waktu,nomor,kdproduk,produk,kdpoli,
                          qty,harga,debet,kridit,jenistransaksi,tarifasli,disc,kdcabang,user) 
                       values('$nx','$notrans','$tgl','$tgl','100','1','Cash','$nxxx','1',
                       '$cash','0','$cash'

                       ,'KR','0','0','$kdcabang','$user')");


            $conn -> query("INSERT INTO transaksipasiend(notransaksi,nofaktur,tgltransaksi,waktu,nomor,kdproduk,produk,kdpoli,
                                qty,harga,debet,kridit,jenistransaksi,tarifasli,disc,kdcabang,user) 
                             values('$nx','$notrans','$tgl','$tgl','100','2','Kridit','$nxxx','1',
                             '$hutang','0','$hutang'

                             ,'KR','0','0','$kdcabang','$user')");



         $conn -> query("INSERT INTO transaksiakhir(notrans,nomor,tglfaktur,waktu,norm,kdpoli,kdkostumer,jenistransaksi,namabank,
                        totalcash,totalpiutang,tagihan

                        ,kdcabang,keterangan,user,status) 
                     values('$nx','100','$tgl','$tgl','$norm','$nxxx','$kdkostumerd','2','','$cash','$hutang','$totaal','$kdcabang','$keterangb','$user','2')");




           
                 }
                      
                      
              }


                   


                      



                          $sqlnf="SELECT * FROM jualobat WHERE nofaktur='$notrans' AND kdcabang='$kdcabang' AND statuslunas='1'";
                           $resultxxlf=mysqli_query($conn, $sqlnf);
                    while($rowxxf=mysqli_fetch_array($resultxxlf,MYSQLI_ASSOC)) {
              
                        $nfft =$rowxxf['notransaksi'];


                          $totaalf = $rowxxf['totalbayar'];

                      $cashsf = ($totaalf*$sudahdibayarxx) / $netto;
                      $cashf  = ceil($cashsf);



                     $conn -> query("UPDATE jualobat set

                        sudahbayar='$cashf',kdbayar='1',bayar='Cash',statuslunas='2',
userbayar='$user',
                        tglbayar='$tgl'
                         where
                         notransaksi='$nfft' and kdcabang='$kdcabang' and statuslunas='1' ");







                    }


                  


                      $conn -> query("UPDATE trigerbayar set

                        sudahdibayar=sudahdibayar+'$jumlahpasien',status='2' where
                         notrans='$notrans' and kdcabang='$kdcabang' and status='1' ");






      }

 }else{

 $pesan='kridit lunasc';
      // edit aja

          if($kdprodukbayar === '1'){
                  // cash
               $pesan='lima';

                         $conn -> query("INSERT INTO transferbayar(tanggal,notrans,nomor,norm,kdpoli,nominal,
                        bank,
                        kodebayar,keterangan,kdcabang,user) 
                     values('$tgl','$notrans','100','$norm','$kdpoli','$jumlahpasien','$banklis'
                     ,'$jbayari','$keterangb ','$kdcabang','$user')");



                       $conn -> query("UPDATE trigerbayar set

                        sudahdibayar=sudahdibayar+'$jumlahpasien' where
                         notrans='$notrans' and kdcabang='$kdcabang' and status='1' ");
                  }else{
                  // kridit
                  }


   
        }

       

}



// akhir

}






$sqlnbulat="SELECT nominal,bulat from pembulatanrj where notrans='$notrans' and kdcabang='$kdcabang'";

$resultnbulat=mysqli_query($conn,$sqlnbulat);
 $rowcountnbulat=mysqli_num_rows($resultnbulat);
  
if($rowcountnbulat > 0){

while($rownbulat=mysqli_fetch_array($resultnbulat,MYSQLI_ASSOC)) {



 $conn -> query("UPDATE pembulatanrj set

nominal='$netto',bulat='$bulat'  where notrans='$notrans' and kdcabang='$kdcabang'");


}

}else{




  $conn -> query("INSERT INTO pembulatanrj(notrans,kdcabang,nominal,bulat) 
                     values('$notrans','$kdcabang','$netto','$bulat')");


}








                      $conn -> query("DELETE from transaksipasiend  where harga <= 0 and kdcabang='$kdcabang'");

$conn -> query("UPDATE kunjunganpasien set

layan='1'  where nofaktur='$notrans' 
 and kdcabang='$kdcabang'");


// Commit transaction
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


}else if($stssimpan === '3'){
 $conn -> autocommit(FALSE);




     $queryx="SELECT  distinct
                    a.notransaksi,b.nampoli,a.kdpoli
                    FROM transaksipasiend a,poliklinik b
                    wHERE a.kdpoli = b.kdpoli   and a.nofaktur='$notrans' 
                    and a.kdcabang='$kdcabang'";
                    $resultx=mysqli_query($conn, $queryx);
                    while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {
                      $nx = $rowx['notransaksi'];
                      $nxx = $rowx['nampoli'];
                      $nxxx = $rowx['kdpoli'];


  $conn -> query("DELETE FROM transaksipasiend where notransaksi='$nx' and kdproduk='1' and kdcabang='$kdcabang' and kdpoli='$nxxx' ");

  $conn -> query("DELETE FROM transaksipasiend where notransaksi='$nx'  and kdproduk='2' and kdcabang='$kdcabang' and kdpoli='$nxxx' ");
 $conn -> query("DELETE FROM transaksipasiend where notransaksi='$nx'  and kdproduk='3' and kdcabang='$kdcabang' and kdpoli='$nxxx' ");
 $conn -> query("DELETE FROM transaksipasiend where notransaksi='$nx'  and kdproduk='4' and kdcabang='$kdcabang' and kdpoli='$nxxx' ");
 $conn -> query("DELETE FROM transaksipasiend where notransaksi='$nx'  and kdproduk='5' and kdcabang='$kdcabang' and kdpoli='$nxxx' ");
 $conn -> query("DELETE FROM transaksipasiend where notransaksi='$nx'  and kdproduk='6' and kdcabang='$kdcabang' and kdpoli='$nxxx' ");
 $conn -> query("DELETE FROM transaksipasiend where notransaksi='$nx'  and kdproduk='7' and kdcabang='$kdcabang' and kdpoli='$nxxx' ");
$conn -> query("DELETE FROM transaksipasiend where notransaksi='$nx'  and kdproduk='8' and kdcabang='$kdcabang' and kdpoli='$nxxx' ");


   $conn -> query("DELETE FROM transaksiakhir where notrans='$nx' 
  and kdpoli='$nxxx'
  and kdcabang='$kdcabang' ");

      $conn -> query("DELETE FROM transferbayar where notrans='$nx' 
  and kdpoli='$nxxx'
  and kdcabang='$kdcabang' ");







                    }





  $sqlnf="SELECT * FROM jualobat WHERE nofaktur='$notrans' AND kdcabang='$kdcabang' AND statuslunas='2'";
                           $resultxxlf=mysqli_query($conn, $sqlnf);
                    while($rowxxf=mysqli_fetch_array($resultxxlf,MYSQLI_ASSOC)) {
              
                        $nfft =$rowxxf['notransaksi'];




                     $conn -> query("UPDATE jualobat set

                        sudahbayar=0,kdbayar='',bayar='',statuslunas='1',

userbayar='$user',
                        tglbayar='$tgl'
                         where
                         notransaksi='$nfft' and kdcabang='$kdcabang' and statuslunas='2' ");




                    }







$conn -> query("DELETE FROM pembulatanrj where notrans='$notrans' and kdcabang='$kdcabang' ");



  $conn -> query("UPDATE trigerbayar set

                        sudahdibayar=0,status='1' where
                         notrans='$notrans' and kdcabang='$kdcabang' and status='2' ");

$conn -> query("UPDATE kunjunganpasien set

layan='0'  where nofaktur='$notrans' 
 and kdcabang='$kdcabang'");



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