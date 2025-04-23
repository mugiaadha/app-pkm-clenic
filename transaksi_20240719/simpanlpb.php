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
$kduser=$data->kduser;
$stssimpan = $data->stssimpan;


$tgl = date("Y-m-d H:i:s");
$tgllpb = date("Ymd");
if($stssimpan === '1'){

   $conn -> autocommit(FALSE);
    $nofakturbeli=$data->nofakturbeli;
    $kdsuplier=$data->kdsuplier;







  if(empty($data->kdbayar)){
  $kdbayar='';
  }else{
  $kdbayar=str_replace("'"," ` ",$data->kdbayar);
  }

  if(empty($data->kdgudang)){
  $kdgudang='';
  }else{

  $kdgudang=str_replace("'"," ` ",$data->kdgudang);


  }

  if(empty($data->nofakturpajak)){
  $nofakturpajak='';
  }else{
  $nofakturpajak=$data->nofakturpajak;
  }

  if(empty($data->tglfaktur)){
  $tglfaktur='';
  }else{
  $tglfaktur=$data->tglfaktur;
  }

  if(empty($data->tgljatuhtempo)){
  $tgljatuhtempo='';
  }else{
  $tgljatuhtempo=$data->tgljatuhtempo;
  }

  if(empty($data->keterangan)){
  $keterangan='';
  }else{
  $keterangan=$data->keterangan;
  }
  $query="SELECT angka from autonum where kdnomor='18' and kdklinik='$kdklinik'";
  $result=mysqli_query($conn, $query);
  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

  $angka = $row['angka']+1;
  }

  $kdcabangf = 'LPB-'.$tgllpb.'-'.$kdcabang.$angka;


    $conn -> query("INSERT INTO beliobat(NOFAKTUR,KDSUPPLIER,SYSTEMBAYAR,KDGUDANG,FAKTURPAJAK,NOLPB,TGLFAKTUR,TGLJATUHTEMPO,KETERANGAN,KDUSER,KUNCIVAL,KDCABANG) 
   values('$nofakturbeli','$kdsuplier','$kdbayar','$kdgudang','$nofakturpajak','$kdcabangf','$tglfaktur','$tgljatuhtempo','$keterangan','$kduser','0','$kdcabang')");


  $conn -> query("UPDATE autonum set angka='$angka' where kdklinik='$kdklinik' and  kdnomor='18' ");








  // Commit transaction
  if (!$conn -> commit()) {
    // echo "Commit transaction failed";
      echo json_encode('Gagal');
   

    exit();
  }else{
  echo json_encode($kdcabangf);

  }

  // Rollback transaction
  $conn -> rollback();

  $conn -> close();



}else if($stssimpan === '2'){



   $conn -> autocommit(FALSE);

  $KDJENISOBAT=$data->KDJENISOBAT;
  $KDOBAT=$data->KDOBAT;
  $obat=$data->obat;
  $SATUAN=$data->SATUAN;
  $HNA=$data->HNA;
  $QTY=$data->QTY;
  $TOTAL=$data->TOTAL;
  $NOFAKTUR=$data->NOFAKTUR;
  $kdgudang=$data->kdgudang;
  $NOLPB=$data->NOLPB;
  $KDSUPLIER=$data->KDSUPLIER;
  $TGLEX=$data->TGLEX;


  if(empty($data->DISCPERSEN)){
  $DISCPERSEN='0';
  }else{
  $DISCPERSEN=$data->DISCPERSEN;
  }

  if(empty($data->DISCRP)){
  $DISCRP='0';
  }else{
  $DISCRP=$data->DISCRP;
  }


  if(empty($data->NOBATCH)){
  $NOBATCH='';
  }else{
  $NOBATCH=$data->NOBATCH;
  }



  $sql="SELECT NOMOR from beliobatd where NOLPB='$NOLPB'  and kdcabang='$kdcabang'
      ORDER BY NOMOR desc limit 1";

  $result=mysqli_query($conn,$sql);
   $rowcount=mysqli_num_rows($result);
    
  if($rowcount > 0){

  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {



    $nomor=$row['NOMOR']+1;



  }

  }else{


    $nomor=1;

  }


    $conn -> query("INSERT INTO beliobatd(NOMOR,KDJENISOBAT,KDOBAT,OBAT,SATUAN,HNA,QTY,DISCPERSEN,DISCRP,TOTAL,NOFAKTUR,NOLPB,KDSUPLIER,TGLEX,NOBATCH,KDCABANG) 
   values('$nomor','$KDJENISOBAT','$KDOBAT','$obat','$SATUAN','$HNA','$QTY','$DISCPERSEN','$DISCRP','$TOTAL','$NOFAKTUR','$NOLPB','$KDSUPLIER','$TGLEX','$NOBATCH','$kdcabang')");






    $conn -> query("INSERT INTO kartustok(KDBARANG,NOMOR,NOFAKTUR,KDCUS,TGLDATE,
      KDGUDANG,STSMUTASI,QTY,KDCABANG) 
   values('$KDOBAT','$nomor','$NOFAKTUR','$KDSUPLIER','$tgl','$kdgudang','BL','$QTY','$kdcabang')");








  $sqlstok="SELECT * from obatstock where kdobat='$KDOBAT' and kdgudang='$kdgudang' 
  and kdcabang='$kdcabang'";

  $resultstok=mysqli_query($conn,$sqlstok);
   $rowcountstok=mysqli_num_rows($resultstok);
    
  if($rowcountstok > 0){

  while($rowstok=mysqli_fetch_array($resultstok,MYSQLI_ASSOC)) {



    $stokobat=$rowstok['stok'];
    $stokobatakhir = $stokobat + $QTY;

  $conn -> query("UPDATE obatstock set stok='$stokobatakhir' where kdobat='$KDOBAT' and kdgudang='$kdgudang' 
  and kdcabang='$kdcabang' ");



  }

  }else{

    $conn -> query("INSERT INTO obatstock(kdcabang,kdgudang,kdobat,stok) 
   values('$kdcabang','$kdgudang','$KDOBAT','$QTY')");



  }
















  $sqlsaldo="SELECT * from saldoobat where kdbarang='$KDOBAT' and kdgudang='$kdgudang' 
  and kdcabang='$kdcabang'";

  $resultsaldo=mysqli_query($conn,$sqlsaldo);
   $rowcountsaldo=mysqli_num_rows($resultsaldo);
    
  if($rowcountsaldo > 0){

  while($rowsaldo=mysqli_fetch_array($resultsaldo,MYSQLI_ASSOC)) {



    $saldoobat=$rowsaldo['FSBPEMBELIAN'];
    $saldoobatakhir = $saldoobat + $QTY;

  $conn -> query("UPDATE saldoobat set FSBPEMBELIAN='$saldoobatakhir' 
  where kdbarang='$KDOBAT' and kdgudang='$kdgudang' 
  and kdcabang='$kdcabang' ");



  }

  }else{

    $conn -> query("INSERT INTO saldoobat(kdbarang,kdgudang,FSBPEMBELIAN,KDCABANG) 
   values('$KDOBAT','$kdgudang','$QTY','$kdcabang')");



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

    $nofakturbeli=$data->nofakturbeli;
    $kdsuplier=$data->kdsuplier;
      $kdbayar=$data->kdbayar;
   $NOLPB=$data->NOLPB;

      if(empty($data->nofakturpajak)){
    $nofakturpajak='';
    }else{
    $nofakturpajak=$data->nofakturpajak;
    }

    if(empty($data->tglfaktur)){
    $tglfaktur='';
    }else{
    $tglfaktur=$data->tglfaktur;
    }

    if(empty($data->tgljatuhtempo)){
    $tgljatuhtempo='';
    }else{
    $tgljatuhtempo=$data->tgljatuhtempo;
    }


    if(empty($data->PPN)){
    $PPN=0;
    }else{
    $PPN=$data->PPN;
    }

    if(empty($data->JMLPPN)){
    $JMLPPN='';
    }else{
    $JMLPPN=$data->JMLPPN;
    }

  if(empty($data->TOTAL)){
    $TOTAL='';
    }else{
    $TOTAL=$data->TOTAL;
    }
  if(empty($data->ADM)){
    $ADM='';
    }else{
    $ADM=$data->ADM;
    }

    if(empty($data->NETTO)){
    $NETTO='';
    }else{
    $NETTO=$data->NETTO;
    }


   if(empty($data->keterangan)){
    $keterangan='';
    }else{
    $keterangan=$data->keterangan;
    }


   if(empty($data->kdgudang)){
    $kdgudang='';
    }else{

    $kdgudang=str_replace("'"," ` ",$data->kdgudang);


    }



  $conn -> query("UPDATE beliobat set PPN='$PPN',JMLPPN='$JMLPPN',TOTAL='$TOTAL',
  ADM='$ADM',NETTO='$NETTO',keterangan='$keterangan',TGLFAKTUR='$tglfaktur',
  TGLJATUHTEMPO='$tgljatuhtempo',FAKTURPAJAK='$nofakturpajak' where kdcabang='$kdcabang'  and NOLPB='$NOLPB' ");



 




     $sqledit="SELECT * FROM beliobatd where kdcabang='$kdcabang' 
     and NOLPB='$NOLPB'";

      $resultedit=mysqli_query($conn,$sqledit);
       $rowcountedit=mysqli_num_rows($resultedit);
        
      if($rowcountedit > 0){


      }else{

      $conn -> query("UPDATE beliobat set 
    KDSUPPLIER='$kdsuplier',SYSTEMBAYAR='$kdbayar',KDGUDANG='$kdgudang'

       where kdcabang='$kdcabang'  and NOLPB='$NOLPB' ");

     
       $conn -> query("UPDATE beliobathutang set 
    KDSUPLIER='$kdsuplier',JENISBAYAR='$kdbayar'

       where KDCABANG='$kdcabang'  and NOLPB='$NOLPB' ");

     


      }





     $sqledit="SELECT * FROM beliobathutang where KDCABANG='$kdcabang'  and NOLPB='$NOLPB' ";

      $resultedit=mysqli_query($conn,$sqledit);
       $rowcountedit=mysqli_num_rows($resultedit);
        
      if($rowcountedit > 0){

       $conn -> query("UPDATE beliobathutang set 
    TGLFAKTUR='$tglfaktur',TGLJATUHTEMPO='$tgljatuhtempo',JUMLAH='$NETTO',
    NOFAKTURPAJAK='$nofakturpajak',KDSUPLIER='$kdsuplier'

       where KDCABANG='$kdcabang'  and NOLPB='$NOLPB' ");
      
      }else{



      $conn -> query("INSERT INTO beliobathutang(NOFAKTUR,NOLPB,NOFAKTURPAJAK,TGLFAKTUR,TGLJATUHTEMPO,KDSUPLIER,
        JENISBAYAR,JUMLAH,STATUS,KDUSER,KUNCI,KDCABANG) 
       values('$nofakturbeli','$NOLPB','$nofakturpajak','$tglfaktur','$tgljatuhtempo','$kdsuplier','$kdbayar','$NETTO','HU','$kduser','0','$kdcabang')");


     



      }






      $conn -> query("UPDATE beliobatd set STATUS='1' where kdcabang='$kdcabang'  and NOLPB='$NOLPB'");




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



    $nofakturbeli=$data->nofakturbeli;
    $NOLPB=$data->NOLPB;
    $nomor=$data->nomor;
    $kdobat=$data->kdobat;

    $field=$data->field;
    $angka=$data->angka;



      if($field == 'DISCPERSEN'){



      $HNA=$data->HNA;
      $QTY=$data->QTY;
      $discrp=$data->discrp;
      $jhq = $HNA * $QTY;
      $nominaldisc = ($jhq * $angka)/100;
      $akhirtotal = $jhq - $nominaldisc;
      $akhirtotala = $akhirtotal - $discrp;


      $conn -> query("UPDATE beliobatd set 
          $field='$angka',TOTAL='$akhirtotala',STATUS='0'
       where kdcabang='$kdcabang'  and NOLPB='$NOLPB' 
      and NOMOR='$nomor' and KDOBAT='$kdobat'");

      }else if($field == 'DISCRP'){

      $HNA=$data->HNA;
      $QTY=$data->QTY;
      $discpersen=$data->DISCPERSEN;



      $jhq = $HNA * $QTY;
      $nominaldisc = ($jhq * $discpersen)/100;
      $akhirtotal = $jhq - $nominaldisc;

      $akhirtotala = $akhirtotal - $angka;







      $conn -> query("UPDATE beliobatd set 
          $field='$angka',TOTAL='$akhirtotala',STATUS='0'
       where kdcabang='$kdcabang'  and NOLPB='$NOLPB' 
      and NOMOR='$nomor' and KDOBAT='$kdobat'");




      }else if($field == 'QTY'){


      $HNA=$data->HNA;
      $NOLPB=$data->NOLPB;
      $QTY=$data->QTY;
      $angka=$data->angka;
      $discpersen=$data->discpersen;
      $discrp=$data->discrp;
      $field=$data->field;
      $kdgudang=$data->kdgudang;
      $kdobat=$data->kdobat;
      $nofakturbeli=$data->nofakturbeli;
      $nomor=$data->nomor;



      $stok =   $angka - $QTY;

      $totalhna = $HNA * $angka;
      $totaldisc = ($totalhna * $discpersen) / 100;
      $netto = ($totalhna - $totaldisc) - $discrp;





         $conn -> query("UPDATE kartustok set QTY='$angka'
         where KDCABANG='$kdcabang' and NOMOR='$nomor' and KDBARANG='$kdobat' and NOFAKTUR='$nofakturbeli'");

         $conn -> query("UPDATE saldoobat set FSBPEMBELIAN=FSBPEMBELIAN + $stok
         where KDCABANG='$kdcabang' and kdgudang='$kdgudang' and kdbarang='$kdobat'");

         $conn -> query("UPDATE obatstock set stok=stok + $stok
         where kdcabang='$kdcabang' and kdgudang='$kdgudang' and kdobat='$kdobat'");

         $conn -> query("UPDATE beliobatd set 
         $field=QTY+ $stok,TOTAL='$netto'
         where kdcabang='$kdcabang' and NOFAKTUR='$nofakturbeli' and NOLPB='$NOLPB' 
         and NOMOR='$nomor' and KDOBAT='$kdobat'");



      }else{
         $conn -> query("UPDATE beliobatd set 
          $field='$angka'

             where kdcabang='$kdcabang'  and NOLPB='$NOLPB' 
      and NOMOR='$nomor' and KDOBAT='$kdobat'");
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

  $HNA=$data->HNA;
      $NOLPB=$data->NOLPB;
      $QTY=$data->QTY;
    
      $discpersen=$data->discpersen;
      $discrp=$data->discrp;
     
      $kdgudang=$data->kdgudang;
      $kdobat=$data->kdobat;
      $nofakturbeli=$data->nofakturbeli;
      $nomor=$data->nomor;




  $conn -> query("DELETE from beliobatd where kdcabang='$kdcabang' 
    and NOFAKTUR='$nofakturbeli' and NOLPB='$NOLPB' and NOMOR='$nomor' and KDOBAT='$kdobat'");



  $conn -> query("DELETE from kartustok where kdcabang='$kdcabang' 
    and NOFAKTUR='$nofakturbeli' and NOMOR='$nomor' and KDBARANG='$kdobat'");


  $conn -> query("UPDATE from obatstock set stok=stok - $QTY
         where kdcabang='$kdcabang' and kdgudang='$kdgudang' and kdobat='$kdobat'");


  $conn -> query("UPDATE from saldoobat set FSBPEMBELIAN=FSBPEMBELIAN - $QTY
         where KDCABANG='$kdcabang' and kdgudang='$kdgudang' and kdbarang='$kdobat'");



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
}else if($stssimpan === '6'){

   $conn -> autocommit(FALSE);

    $NOLPB=$data->NOLPB;
  $nofakturbeli=$data->nofakturbeli;


  $sql="SELECT * from beliobatd where NOLPB='$NOLPB'  and kdcabang='$kdcabang'";

  $result=mysqli_query($conn,$sql);
   $rowcount=mysqli_num_rows($result);
    
  if($rowcount > 0){

  $notifikasi ='Tidak bisa di hapus karena belum mengkosongkan transaksi, Silahkan Kosongkan Transaksi dulu';




  }else{


     $conn -> query("DELETE from beliobat where kdcabang='$kdcabang' 
   and NOLPB='$NOLPB' ");

  $conn -> query("DELETE from beliobathutang where kdcabang='$kdcabang' 
    and NOLPB='$NOLPB' ");

 
 

   $notifikasi ='Berhasil Hapus';


  }


      // Commit transaction
  if (!$conn -> commit()) {
    // echo "Commit transaction failed";
      echo json_encode('Gagal');
   

    exit();
  }else{
  echo json_encode($notifikasi);

  }

  // Rollback transaction
  $conn -> rollback();

  $conn -> close();
}else if($stssimpan === '7'){

   $conn -> autocommit(FALSE);

    $nofakturbeli=$data->nofakturbeli;
    $NOLPB=$data->NOLPB;
    $nomor=$data->nomor;
    $kdobat=$data->kdobat;
    $HNA=$data->HNA;
    $angka=$data->angka;
    $field=$data->field;
    $suplier =$data->suplier;
    $kdgudang = $data->kdgudang;
    $QTY = $data->QTY;
    $QTYR = $data->QTYR;




    $DISCPERSENR = $data->DISCPERSENR;
    $DISCRPR = $data->DISCRPR;


    $totalr = $angka * $HNA;




    $angkar = ($DISCPERSENR * $totalr) / 100;

    $totalra = ($totalr - $angkar) - $DISCRPR;












    if($angka > 0){
      $stsr = '1';

    }else{

    $stsr = '0';
      

        $conn -> query("UPDATE beliobatd set DISCPERSENR=0,DISCRPR=0
                 where kdcabang='$kdcabang'  and NOLPB='$NOLPB' 
                 and NOMOR='$nomor' and KDOBAT='$kdobat'");


    }


  $conn -> query("UPDATE beliobatd set QTYR='$angka',TOTALR='$totalra',STATUSR='$stsr'
                 where kdcabang='$kdcabang'  and NOLPB='$NOLPB' 
                 and NOMOR='$nomor' and KDOBAT='$kdobat'");



  $sqlsaldo="SELECT * from kartustok where KDBARANG='$kdobat' and KDGUDANG='$kdgudang' 
  and kdcabang='$kdcabang'  and NOMOR='$nomor' and STSMUTASI='RB'";

  $resultsaldo=mysqli_query($conn,$sqlsaldo);
   $rowcountsaldo=mysqli_num_rows($resultsaldo);
    
  if($rowcountsaldo > 0){

$conn -> query("UPDATE kartustok set QTY='$angka'
                 where KDBARANG='$kdobat' and KDGUDANG='$kdgudang' 
  and kdcabang='$kdcabang'  and NOMOR='$nomor'  and STSMUTASI='RB'");
  }else{

$conn -> query("INSERT INTO kartustok(KDBARANG,NOMOR,NOFAKTUR,KDCUS,TGLDATE,
      KDGUDANG,STSMUTASI,QTY,KDCABANG) 
   values('$kdobat','$nomor','$nofakturbeli','$suplier','$tgl','$kdgudang','RB','$angka','$kdcabang')");



  }

 
  $qtykurang =  $angka - $QTYR ;
    




  $conn -> query("UPDATE obatstock set stok=stok-$qtykurang where kdobat='$kdobat' and kdgudang='$kdgudang' 
  and kdcabang='$kdcabang' ");







  $conn -> query("UPDATE saldoobat set FSBRPEMBELIAN=FSBRPEMBELIAN+$qtykurang 
  where kdbarang='$kdobat' and kdgudang='$kdgudang' 
  and kdcabang='$kdcabang' ");

  


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


}else if($stssimpan === '8'){

 $conn -> autocommit(FALSE);

    $nofakturbeli=$data->nofakturbeli;
    $NOLPB=$data->NOLPB;
    $nomor=$data->nomor;
    $kdobat=$data->kdobat;
    $HNA=$data->HNA;
    $angka=$data->angka;
    $field=$data->field;
    $QTY=$data->QTY;
    $QTYR=$data->QTYR;
    
    $TOTALR = $HNA * $QTYR;



    $angkar = ($angka * $TOTALR) / 100;

    $totalra = $TOTALR - $angkar;







  $conn -> query("UPDATE beliobatd set DISCPERSENR='$angka',TOTALR='$totalra'
                 where kdcabang='$kdcabang'  and NOLPB='$NOLPB' 
                 and NOMOR='$nomor' and KDOBAT='$kdobat'");


  


  if (!$conn -> commit()) {
    // echo "Commit transaction failed";
      echo json_encode('Gagal');
   

    exit();
  }else{
  echo json_encode($totalra);

  }

  // Rollback transaction
  $conn -> rollback();

  $conn -> close();

}else if($stssimpan === '9'){

   $conn -> autocommit(FALSE);

    $nofakturbeli=$data->nofakturbeli;
    $NOLPB=$data->NOLPB;
    $nomor=$data->nomor;
    $kdobat=$data->kdobat;
    $HNA=$data->HNA;
    $angka=$data->angka;
    $field=$data->field;
    $QTY=$data->QTY;
    $QTYR=$data->QTYR;
    $DISCPERSENR = $data->DISCPERSENR;

    $TOTALR = $HNA * $QTYR;



    $angkar = ($DISCPERSENR * $TOTALR) / 100;

    $totalra = ($TOTALR - $angkar) - $angka;







  $conn -> query("UPDATE beliobatd set DISCRPR='$angka',TOTALR='$totalra'
                 where kdcabang='$kdcabang'  and NOLPB='$NOLPB' 
                 and NOMOR='$nomor' and KDOBAT='$kdobat'");


  


  if (!$conn -> commit()) {
    // echo "Commit transaction failed";
      echo json_encode('Gagal');
   

    exit();
  }else{
  echo json_encode($totalra);

  }

  // Rollback transaction
  $conn -> rollback();

  $conn -> close();

}else if($stssimpan === '10'){


    $conn -> autocommit(FALSE);

    $nofakturbeli=$data->nofakturbeli;
    $kdsuplier=$data->kdsuplier;
      $kdbayar=$data->kdbayar;
   $NOLPB=$data->NOLPB;

      if(empty($data->nofakturpajak)){
    $nofakturpajak='';
    }else{
    $nofakturpajak=$data->nofakturpajak;
    }

    if(empty($data->tglfaktur)){
    $tglfaktur='';
    }else{
    $tglfaktur=$data->tglfaktur;
    }

    if(empty($data->tgljatuhtempo)){
    $tgljatuhtempo='';
    }else{
    $tgljatuhtempo=$data->tgljatuhtempo;
    }


    if(empty($data->PPN)){
    $PPN=0;
    }else{
    $PPN=$data->PPN;
    }

    if(empty($data->JMLPPN)){
    $JMLPPN='';
    }else{
    $JMLPPN=$data->JMLPPN;
    }

  if(empty($data->TOTAL)){
    $TOTAL='';
    }else{
    $TOTAL=$data->TOTAL;
    }
  if(empty($data->ADM)){
    $ADM='';
    }else{
    $ADM=$data->ADM;
    }

    if(empty($data->NETTO)){
    $NETTO='';
    }else{
    $NETTO=$data->NETTO;
    }


   if(empty($data->keterangan)){
    $keterangan='';
    }else{
    $keterangan=$data->keterangan;
    }


   if(empty($data->kdgudang)){
    $kdgudang='';
    }else{

    $kdgudang=str_replace("'"," ` ",$data->kdgudang);


    }

 $totalsebelumpajakr=$data->totalsebelumpajakr;
 $jmlppnr=$data->jmlppnr;
 $totalsetelahppnr=$data->totalsetelahppnr;


$noretur = 'RT'.$nofakturbeli.$kdcabang;


$jmlhutang = $NETTO - $totalsetelahppnr;

  $conn -> query("UPDATE beliobat set NORETUR='$noretur',TGLRETUR='$tgljatuhtempo',
    KETERANGANR='$keterangan',
    KDUSERR='$kduser',DPP='$totalsebelumpajakr',PPNR='$PPN',JMLPPNR='$jmlppnr',
    JUMLAH='$totalsetelahppnr',STSR='1'
   where kdcabang='$kdcabang' and NOLPB='$NOLPB' ");



  $conn -> query("UPDATE beliobatd set STATUSRV='1'
   where kdcabang='$kdcabang' and NOLPB='$NOLPB' and STATUSR='1' ");


 $conn -> query("UPDATE beliobathutang set JUMLAH='$jmlhutang'
   where kdcabang='$kdcabang'  and NOLPB='$NOLPB' and BAYAR='0' ");


  if (!$conn -> commit()) {
   
   

    $pesan = array(
        'metadata'=>array(
            'code'=>201,
            'message'=>'Gagal'
        ),
      
    );




    exit();
  }else{

        $pesan = array(
        'metadata'=>array(
            'code'=>200,
            'message'=>$noretur
        ),
      
    );



  }
 echo json_encode($pesan);
  // Rollback transaction
  $conn -> rollback();

  $conn -> close();




}else if($stssimpan === '11'){
     $conn -> autocommit(FALSE);

    $NOLPB=$data->NOLPB;
  $nofakturbeli=$data->nofakturbeli;
  $noretur = $data->noretur;



  $sql="SELECT * from beliobatd where NOLPB='$NOLPB'  and kdcabang='$kdcabang'
and statusr='1'
  ";

  $result=mysqli_query($conn,$sql);
   $rowcount=mysqli_num_rows($result);
    
  if($rowcount > 0){

  $notifikasi ='Tidak bisa di hapus karena belum mengkosongkan retur, Silahkan Kosongkan Retur dulu';




  }else{

  $conn -> query("UPDATE beliobat set NORETUR='',
    KETERANGANR='',
    KDUSERR='',DPP='0',PPNR='0',JMLPPNR='0',
    JUMLAH='0',STSR='0'
   where kdcabang='$kdcabang' and NOLPB='$NOLPB'  and noretur='$noretur'");


    //  $conn -> query("DELETE from beliobat where kdcabang='$kdcabang' 
    // and NOFAKTUR='$nofakturbeli' and NOLPB='$NOLPB' ");

  // $conn -> query("DELETE from beliobathutang where kdcabang='$kdcabang' 
  //   and NOFAKTUR='$nofakturbeli' and NOLPB='$NOLPB' ");

 
 

   $notifikasi ='Berhasil Hapus';


  }


      // Commit transaction
  if (!$conn -> commit()) {
    // echo "Commit transaction failed";
      echo json_encode('Gagal');
   

    exit();
  }else{
  echo json_encode($notifikasi);

  }

  // Rollback transaction
  $conn -> rollback();

  $conn -> close();
}
   

 




?>