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


$stssimpan = $data->stssimpan;
$tglsimpan = date("Y-m-d H:i:s");


 $conn -> query("DELETE FROM jualobatd where kdobat='' and kdcabang='$kdcabang'");


 

if($stssimpan === '1'){
        $conn -> autocommit(FALSE);

          $kdklinik=$data->kdklinik;

        $query="SELECT angka from autonum where kdnomor='19' and kdklinik='$kdklinik'";
        $result=mysqli_query($conn, $query);
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

        $angka = $row['angka']+1;
        }


        $tgl = $data->tgl;
        $admresep = $data->admresep;
        $kdgudang = $data->kdgudang;
      


    if(empty($data->keterangan)){
    $keterangan ='';
    }else{
    $keterangan = $data->keterangan;
    }



        $nofaktur = $data->nofaktur;
        $mows = date_create( $tgl);
          
        $form_no = date_format( $mows, 'ymd' );

        $notransaksi = 'FJ-'.$kdcabang.$form_no.'-'.$angka;

       

          if(empty($data->noresep)){
    $noresep ='';
    }else{
    $noresep = $data->noresep;
    }



        $norm = $data->norm;
        $pembulatan = $data->pembulatan;
        $statuslunas = $data->statuslunas;
        $sudahbayar = $data->sudahbayar;


        $totalbayar = $data->totalbayar;
        $totaldisc = $data->totaldisc;
        $tuslahresep = $data->tuslahresep;
        $kdcus = $data->kdcus;
       $kdpoli = $data->kdpoli;
       $kddokter = $data->kddokter;





          $conn -> query("INSERT INTO jualobat(tgl , notransaksi , nofaktur,norm,pembulatan,
        adminresep,tuslah,totaldisc,totalbayar,sudahbayar,statuslunas,kdgudang,kdcabang,keterangan,noresep
            ,kdpoli,kddokter,kdkostumer) 
         values('$tgl','$notransaksi','$nofaktur','$norm','$pembulatan','$admresep','$tuslahresep','$totaldisc','$totalbayar','$sudahbayar','$statuslunas','$kdgudang','$kdcabang','$keterangan','$noresep','$kdpoli','$kddokter','$kdcus')");







        //  $sqlstoks="SELECT 
        // a.kdobat,sum(a.qty) AS qty,b.obat

        // FROM jualobatd a , obat b 
        // WHERE a.kdobat = b.kdobat 
        //  AND a.nofaktur='$nofaktur' AND a.kdcabang='$kdcabang' and dari='CPPT' and status='0'
        // GROUP BY a.kdobat";

        //   $resultstoks=mysqli_query($conn,$sqlstoks);
        //   while($rowstoks=mysqli_fetch_array($resultstoks,MYSQLI_ASSOC)) {

        // $kdobatss = $rowstoks['kdobat'];
        // $qtyss = $rowstoks['qty'];


        // $conn -> query("UPDATE obatstock set stok=stok-$qtyss where kdobat='$kdobatss' and kdcabang='$kdcabang'

        // and kdgudang='$kdgudang'");

        // $conn -> query("UPDATE saldoobat set FSBPENJUALAN=FSBPENJUALAN+$qtyss where kdbarang='$kdobatss' and KDCABANG='$kdcabang'

        // and kdgudang='$kdgudang'");

        // }




        $conn -> query("UPDATE jualobatd set notransaksi='$notransaksi',status='1' where nofaktur='$nofaktur' and  dari='CPPT' and status='0' and kdcabang='$kdcabang' ");







          $sqlstok="SELECT * from jualobatd where  nofaktur='$nofaktur' AND kdcabang='$kdcabang' and dari='CPPT' and status='1'";

          $resultstok=mysqli_query($conn,$sqlstok);


          while($rowstok=mysqli_fetch_array($resultstok,MYSQLI_ASSOC)) {
            $kdobats=$rowstok['kdobat'];
            $nomors=$rowstok['nomor'];
            $qtys=$rowstok['qty'];
          

         $conn -> query("INSERT INTO kartustok(KDBARANG,NOMOR,NOFAKTUR,KDCUS,TGLDATE,
              KDGUDANG,STSMUTASI,QTY,KDCABANG) 
           values('$kdobats','$nomors','$notransaksi','$norm','$tglsimpan','$kdgudang','JL','$qtys','$kdcabang')");

        }




        $conn -> query("UPDATE autonum set angka='$angka' where kdklinik='$kdklinik' and  kdnomor='19' ");




        // Commit transaction
        if (!$conn -> commit()) {
          // echo "Commit transaction failed";
            echo json_encode('Gagal');
         

          exit();
        }else{
        echo json_encode($notransaksi);

        }

        // Rollback transaction
        $conn -> rollback();

        $conn -> close();

}else if($stssimpan === '2'){
        $conn -> autocommit(FALSE);

        $disc=$data->disc;
        $discrp=$data->discrp;
        $harga=$data->harga;
        $kdgudang=$data->kdgudang;
        $kdobat=$data->kdobat;
        $nomor=$data->nomor;
        $notransaksi=$data->notransaksi;
        $qty=$data->qty;
        $qtyedit=$data->qtyedit;


        $nofaktur=$data->nofaktur;
        $kdpoli=$data->kdpoli;
        $kddokter=$data->kddokter;

          
         $sqlstoks="SELECT 
        a.kdobat,a.stok,a.kdgudang
        FROM obatstock a, gudang b
        WHERE a.kdcabang= b.kdcabang AND a.kdgudang = b.kdgudang AND b.utama='1' AND a.kdcabang='$kdcabang' and a.kdobat='$kdobat' and b.kdgudang='$kdgudang' limit 1";

          $resultstoks=mysqli_query($conn,$sqlstoks);
          while($rowstoks=mysqli_fetch_array($resultstoks,MYSQLI_ASSOC)) {
            $stokgudang = $rowstoks['stok'];

        if($qtyedit > $stokgudang){

        $respon='Stok Obat Tidak Cukup';


        }else{

        $nettoblm = $qtyedit * $harga;

        $discps= ($disc * $nettoblm) / 100;

        $jmldisc = $discrp + $discps;


        $netto = $nettoblm - $jmldisc;






        $conn -> query("UPDATE jualobatd  set qty='$qtyedit',jmldisc='$jmldisc',totalharga='$netto',
          status='0'
         where notransaksi='$notransaksi' and kdobat='$kdobat' 
         and nomor='$nomor' and kdcabang='$kdcabang'");



        $conn -> query("UPDATE ermcpptintruksi  set qty='$qtyedit',harga='$netto'
        where notransaksi='$nofaktur' and kddokter='$kddokter' and kdpoli='$kdpoli' 
         and no='$nomor' and kdcabang='$kdcabang' and dari='obat' and dari2='CPPT'");

        $conn -> query("UPDATE kartustok  set qty='$qtyedit'
        where NOFAKTUR='$notransaksi' and NOMOR='$nomor' and kdcabang='$kdcabang' and STSMUTASI='JL'");



        $stokkurang=$qtyedit - $qty;

        $conn -> query("UPDATE obatstock  set stok=stok - $stokkurang
        where kdgudang='$kdgudang' and kdobat='$kdobat' and kdcabang='$kdcabang'");


        $stokkurangz= $qty - $qtyedit;


        $conn -> query("UPDATE saldoobat set FSBPENJUALAN=FSBPENJUALAN-$stokkurangz
         where kdbarang='$kdobat' and KDCABANG='$kdcabang'

        and kdgudang='$kdgudang'");




        $respon='1';

        }

          }





        // Commit transaction
        if (!$conn -> commit()) {
          // echo "Commit transaction failed";
            echo json_encode('Gagal');
         

          exit();
        }else{
        echo json_encode($respon);

        }

        // Rollback transaction
        $conn -> rollback();

        $conn -> close();

}else if($stssimpan === '3'){
    $conn -> autocommit(FALSE);

    $disc=$data->disc;
    $discrp=$data->discrp;
    $harga=$data->harga;
    $kdgudang=$data->kdgudang;
    $kdobat=$data->kdobat;
    $nomor=$data->nomor;
    $notransaksi=$data->notransaksi;
    $qty=$data->qty;
    $qtyedit=$data->qtyedit;


    $nofaktur=$data->nofaktur;
    $kdpoli=$data->kdpoli;
    $kddokter=$data->kddokter;

    $nettoblm = $qtyedit * $harga;

    $discps= ($disc * $nettoblm) / 100;

    $jmldisc = $discrp + $discps;


    $netto = $nettoblm - $jmldisc;






    $conn -> query("UPDATE jualobatd  set disc='$disc' ,jmldisc='$jmldisc',totalharga='$netto',status='0'
     where notransaksi='$notransaksi' and kdobat='$kdobat' 
     and nomor='$nomor' and kdcabang='$kdcabang'");



    $conn -> query("UPDATE ermcpptintruksi  set harga='$netto'
    where notransaksi='$nofaktur' and kddokter='$kddokter' and kdpoli='$kdpoli' 
     and no='$nomor' and kdcabang='$kdcabang' and dari='obat' and dari2='CPPT'");



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




    $disc=$data->disc;
    $discrp=$data->discrp;
    $harga=$data->harga;
    $kdgudang=$data->kdgudang;
    $kdobat=$data->kdobat;
    $nomor=$data->nomor;
    $notransaksi=$data->notransaksi;
    $qty=$data->qty;
    $qtyedit=$data->qtyedit;


    $nofaktur=$data->nofaktur;
    $kdpoli=$data->kdpoli;
    $kddokter=$data->kddokter;

    $nettoblm = $qtyedit * $harga;

    $discps= ($disc * $nettoblm) / 100;

    $jmldisc = $discrp + $discps;


    $netto = $nettoblm - $jmldisc;






    $conn -> query("UPDATE jualobatd  set discrp='$discrp',jmldisc='$jmldisc',totalharga='$netto',
      status='0'
     where notransaksi='$notransaksi' and kdobat='$kdobat' 
     and nomor='$nomor' and kdcabang='$kdcabang'");



    $conn -> query("UPDATE ermcpptintruksi  set harga='$netto'
    where notransaksi='$nofaktur' and kddokter='$kddokter' and kdpoli='$kdpoli' 
     and no='$nomor' and kdcabang='$kdcabang' and dari='obat' and dari2='CPPT'");



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

}else if($stssimpan ==='5'){
    $conn -> autocommit(FALSE);


    $disc=$data->disc;
    $discrp=$data->discrp;
    
      
    if($disc === ''){
        
        $disc =0;
        
    }else{
        $disc =$data->disc;
        
        
    }
    
      if($discrp === ''){
        
        $discrp =0;
        
    }else{
        $discrp =$data->$discrp;
        
        
    }
    
    
    $hna=$data->hna;
    $kdgudang=$data->kdgudang;
    $kdobat=$data->kdobat;
    $kdkus=$data->kdkus;
    $notransaksi=$data->notransaksi;
    $qty=$data->qty;
    $norm=$data->norm;
    $total=$data->total;
    $nofaktur=$data->nofaktur;
    $kddokter=$data->kddokter;
    $kdcppt=$nofaktur.$kddokter;
    $jmldisca = $qty * $hna; 
    $jmldisc = $jmldisca - $total;
    $hargabeli = $data->hargabeli;




    $query="SELECT 
    a.stok
    FROM obatstock a
    where a.kdgudang='$kdgudang' and a.kdobat='$kdobat' and a.kdcabang='$kdcabang' ";
    $resulty=mysqli_query($conn, $query);
    while($row=mysqli_fetch_array($resulty,MYSQLI_ASSOC)) {

    $stokobat = $row['stok'];


    if($qty > $stokobat){

    $response='1';

    }else{

        $sql="SELECT nomor from jualobatd where notransaksi='$notransaksi' and kdcabang='$kdcabang' and norm='$norm'
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

     $conn -> query("INSERT INTO jualobatd(notransaksi,tgl,nomor,nofaktur,kdobat,qty,disc,discrp,harga,jmldisc,
      totalharga,kdcabang,kdcppt,norm,dari,status,hargabeli) 
     values('$notransaksi','$tglsimpan','$nomor','$nofaktur','$kdobat','$qty','$disc','$discrp','$hna','$jmldisc','$total','$kdcabang','$kdcppt','$norm','FARMASI','0','$hargabeli')");




      $frekuensi = $conn->real_escape_string( $data->frekuensi);
      $jmlpakai = $conn->real_escape_string( $data->jmlpakai);
     $signa = $conn->real_escape_string( $data->signa);
     $keterangan = $conn->real_escape_string( $data->keterangan);



  
         
     $conn -> query("INSERT INTO ermcpptintruksi (notransaksi, norm, kddokter, kdpruduk, qty, harga, keterangan, statuso, status,
      dari, kduser, kdcabang, tgl, kdcppt, kunci, tglpriksa, kd, no, hargasatuan, dari2, kirim, signa,
      hari, frekuensi, jmlpakai) 
                  VALUES ('$nofaktur', '$norm', '$kddokter', '$kdobat', '$qty', '$hna', '$keterangan', 'Non Racik', '0',
                  'Obat', 'xx', '$kdcabang', '$tglsimpan', '-', '0', '$tglsimpan', '-', '$nomor',
                  '$hna', 'CPPT', 'Ya', '$signa', '0', '$frekuensi',
                  '$jmlpakai')");



   


     $conn -> query("INSERT INTO kartustok(KDBARANG,NOMOR,NOFAKTUR,KDCUS,TGLDATE,
                  KDGUDANG,STSMUTASI,QTY,KDCABANG) 
               values('$kdobat','$nomor','$notransaksi','$norm','$tglsimpan','$kdgudang','JL','$qty','$kdcabang')");




            $conn -> query("UPDATE obatstock set stok=stok-$qty where kdobat='$kdobat' and kdcabang='$kdcabang'

            and kdgudang='$kdgudang'");

            $conn -> query("UPDATE saldoobat set FSBPENJUALAN=FSBPENJUALAN+$qty where kdbarang='$kdobat' and KDCABANG='$kdcabang'

            and kdgudang='$kdgudang'");





    $response='0';
    }


    }






    // Commit transaction
    if (!$conn -> commit()) {
      // echo "Commit transaction failed";
        echo json_encode('Gagal');
     

      exit();
    }else{
    echo json_encode($response);

    }

    // Rollback transaction
    $conn -> rollback();

    $conn -> close();
}else if($stssimpan === '6'){
            $conn -> autocommit(FALSE);


          $adminresep=$data->adminresep;

          $kdgudang=$data->kdgudang;
         

              if(empty($data->keterangan)){
    $keterangan ='';
    }else{
    $keterangan = $data->keterangan;
    }
     



          if(empty($data->noresep)){
    $noresep ='';
    }else{
    $noresep = $data->noresep;
    }
          $norm=$data->norm;
          $pembulatan=$data->pembulatan;

          $totalbayar=$data->totalbayar;
          $totaldisc=$data->totaldisc;
          $tuslah=$data->tuslah;
          $notransaksi=$data->notransaksi;

 


           $sqlcek="SELECT * from jualobatd where notransaksi='$notransaksi' and kdcabang='$kdcabang' ";

          $resultcek=mysqli_query($conn,$sqlcek);
           $rowcountcek=mysqli_num_rows($resultcek);
            
          if($rowcountcek  > 0){


          }else{


                   $conn -> query("UPDATE jualobat set 
                   kdgudang='$kdgudang'
                    
                   where notransaksi='$notransaksi' and  norm='$norm' and kdcabang='$kdcabang' ");

          }








        $conn -> query("UPDATE jualobat set 
         
    
          totaldisc='$totaldisc',
         
          keterangan='$keterangan',
          noresep='$noresep'
          
         where notransaksi='$notransaksi' and  norm='$norm' and kdcabang='$kdcabang' ");








$queryh="SELECT  SUM(totalharga) AS total  FROM  jualobatd WHERE notransaksi ='$notransaksi'  and norm='$norm' and kdcabang='$kdcabang' ";

$resulth=mysqli_query($conn, $queryh);
while($rowh=mysqli_fetch_array($resulth,MYSQLI_ASSOC)) {







$totalbayarsx = $rowh['total'];




$uang = $totalbayarsx;
$ratusan = substr($uang, -2);


 if($ratusan < 100){
 $akhir = $uang - $ratusan;
 }else{
 $akhir = $uang + (100-$ratusan);
}

$pembulatanx = $akhir - $totalbayarsx;

                             



    $conn -> query("UPDATE jualobat set 
              totalbayar='$akhir' ,pembulatan='$pembulatanx'
          
         where notransaksi='$notransaksi' and  norm='$norm' and kdcabang='$kdcabang' ");











}





        $conn -> query("UPDATE jualobatd set status='1' where notransaksi='$notransaksi' and kdcabang='$kdcabang'  and status='0' ");

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
}else if($stssimpan === '7'){
      $conn -> autocommit(FALSE); 


      $notransaksi=$data->notransaksi;
      $kdobat=$data->kdobat;
      $nomor=$data->nomor;
      $nofaktur=$data->nofaktur;
      $kddokter=$data->kddokter;
      $kdpoli=$data->kdpoli;
      $qty=$data->qty;
      $kdgudang=$data->kdgudang;



       $conn -> query("DELETE from jualobatd  where notransaksi='$notransaksi' and 
        kdobat='$kdobat' and nomor='$nomor'
        and kdcabang='$kdcabang'");

       $conn -> query("DELETE from ermcpptintruksi  where notransaksi='$nofaktur' and kddokter='$kddokter' and kdpoli='$kdpoli' 
           and no='$nomor' and kdcabang='$kdcabang' and dari='obat' and dari2='CPPT'");


       $conn -> query("DELETE from kartustok  where NOFAKTUR='$notransaksi' and 
        KDBARANG='$kdobat' and NOMOR='$nomor'
        and KDCABANG='$kdcabang' and STSMUTASI='JL'");



        
         $conn -> query("UPDATE obatstock  set stok=stok + $qty
              where kdgudang='$kdgudang' and kdobat='$kdobat' and kdcabang='$kdcabang'");


          $conn -> query("UPDATE saldoobat set FSBPENJUALAN=FSBPENJUALAN-$qty
             where kdbarang='$kdobat' and KDCABANG='$kdcabang'
      and kdgudang='$kdgudang'");


          $conn -> query("UPDATE jualobatd  set status='0' 
           where notransaksi='$notransaksi'  and kdcabang='$kdcabang'");



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


}else if($stssimpan === '8'){

   $conn -> autocommit(FALSE); 

   $notransaksi=$data->notransaksi;


   $sqlcek="SELECT * from jualobatd where notransaksi='$notransaksi' and kdcabang='$kdcabang' and kunci='0' ";

          $resultcek=mysqli_query($conn,$sqlcek);
           $rowcountcek=mysqli_num_rows($resultcek);
            
          if($rowcountcek  > 0){

            $response='1';
          }else{



            $conn -> query("DELETE from jualobat  where notransaksi='$notransaksi' and
                    kdcabang='$kdcabang' and kunci='0'
                    ");

            $response='0';

          }



    // Commit transaction
    if (!$conn -> commit()) {
      // echo "Commit transaction failed";
        echo json_encode('Gagal');
     

      exit();
    }else{
    echo json_encode($response);

    }

    // Rollback transaction
    $conn -> rollback();

    $conn -> close();
}else if($stssimpan === '9'){
   $conn -> autocommit(FALSE); 


  $kdklinik=$data->kdklinik;

$query="SELECT angka from autonum where kdnomor='19' and kdklinik='$kdklinik'";
        $result=mysqli_query($conn, $query);
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

        $angka = $row['angka']+1;
        }

        $kdgudang = $data->kdgudang;
       
            if(empty($data->keterangan)){
    $keterangan ='';
    }else{
    $keterangan = $data->keterangan;
    }


        $nofaktur = $data->nofaktur;
     


          if(empty($data->noresep)){
    $noresep ='';
    }else{
    $noresep = $data->noresep;
    }


        $norm = $data->norm;
        $mows = date_create( $tglsimpan);
          
        $form_no = date_format( $mows, 'ymd' );

        $notransaksi = 'FJ-'.$kdcabang.$form_no.'-'.$angka;

        $kdpoli = $data->kdpoli;
        $kddokter = $data->kddokter;
        $kdkostumer = $data->kdkostumer;
        
    $conn -> query("INSERT INTO jualobat(tgl,notransaksi , nofaktur,norm,
       statuslunas,kdgudang,kdcabang,keterangan,noresep,kdpoli,kddokter,kdkostumer
            ) 
         values('$tglsimpan','$notransaksi','$nofaktur','$norm','1','$kdgudang','$kdcabang','$keterangan','$noresep','$kdpoli','$kddokter','$kdkostumer')");


  $conn -> query("UPDATE autonum set angka='$angka' where kdklinik='$kdklinik' and  kdnomor='19' ");






      // Commit transaction
    if (!$conn -> commit()) {
      // echo "Commit transaction failed";
        echo json_encode('Gagal');
     

      exit();
    }else{
    echo json_encode($notransaksi);

    }

    // Rollback transaction
    $conn -> rollback();

    $conn -> close();
}else if($stssimpan === '10'){
 $conn -> autocommit(FALSE); 

 $qtyrl = $data->qtyrl;
 $qtyr = $data->qtyr;
 $qtyrr = $data->qtyrr;

 $totalharga = $data->totalharga;
 $totalhargar = $qtyr * $totalharga;
if($qtyr > 0){
  $stsr='1';

}else{
$stsr='0';
  
}
$nomor = $data->nomor;
$notransaksi = $data->notransaksi;
$kdobat = $data->kdobat;
$kdgudang = $data->kdgudang;
$norm = $data->norm;
$tglpx = $data->tglpx;

$conn -> query("UPDATE jualobatd set qtyr='$qtyr',totalhargar='$totalhargar',statusr='$stsr' ,statusrv='1'
  where kdcabang='$kdcabang' and  nomor='$nomor' and notransaksi='$notransaksi' and kdobat='$kdobat' ");





  $sqlsaldo="SELECT * from kartustok where KDBARANG='$kdobat' and KDGUDANG='$kdgudang' 
  and kdcabang='$kdcabang' and NOFAKTUR='$notransaksi' and NOMOR='$nomor' and STSMUTASI='RJ'";

  $resultsaldo=mysqli_query($conn,$sqlsaldo);
   $rowcountsaldo=mysqli_num_rows($resultsaldo);
    
  if($rowcountsaldo > 0){

$conn -> query("UPDATE kartustok set QTY='$qtyr'
                 where KDBARANG='$kdobat' and KDGUDANG='$kdgudang' 
  and kdcabang='$kdcabang' and NOFAKTUR='$notransaksi' and NOMOR='$nomor'  and STSMUTASI='RJ'");
  }else{

$conn -> query("INSERT INTO kartustok(KDBARANG,NOMOR,NOFAKTUR,KDCUS,TGLDATE,
      KDGUDANG,STSMUTASI,QTY,KDCABANG) 
   values('$kdobat','$nomor','$notransaksi','$norm','$tglsimpan','$kdgudang','RJ','$qtyr','$kdcabang')");



  }




  $qtykurang =  $qtyrr - $qtyr ;
    





  $conn -> query("UPDATE obatstock set stok=stok-$qtykurang where kdobat='$kdobat' and kdgudang='$kdgudang' 
  and kdcabang='$kdcabang' ");







  $conn -> query("UPDATE saldoobat set FSBRPENJUALAN=FSBRPENJUALAN-$qtykurang 
  where kdbarang='$kdobat' and kdgudang='$kdgudang' 
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


}else if($stssimpan === '11'){

 $conn -> autocommit(FALSE); 



$notransaksi = $data->notransaksi;


$norm = $data->norm;
$tglpx = $data->tglpx;
$notransaksir = 'RJ'.$notransaksi;



   if(empty($data->keteranganretur)){
$keteranganretur  = '' ;
    }else{
$keteranganretur  = $data->keteranganretur ;
    }
$totaluangr=$data->totaluangr;
$kduser = $data->kduser;



$conn -> query("UPDATE jualobat set noretur='$notransaksir',tglretur='$tglpx',
  keteranganretur='$keteranganretur',stsr='1',totaluangr='$totaluangr',userr='$kduser'
  where kdcabang='$kdcabang' and notransaksi='$notransaksi' and norm='$norm' ");




$conn -> query("UPDATE jualobatd set statusrv='0' 
  where kdcabang='$kdcabang' and notransaksi='$notransaksi'   ");



      // Commit transaction
    if (!$conn -> commit()) {
      // echo "Commit transaction failed";
        echo json_encode('Gagal');
     

      exit();
    }else{
    echo json_encode($notransaksir);

    }

    // Rollback transaction
    $conn -> rollback();

    $conn -> close();

}else if($stssimpan==='12'){
     $conn -> autocommit(FALSE);

    $norm=$data->norm;
  $notransaksi=$data->notransaksi;


  $sql="SELECT * from jualobatd where notransaksi='$notransaksi' and norm='$norm'  and kdcabang='$kdcabang'
and statusr='1'
  ";

  $result=mysqli_query($conn,$sql);
   $rowcount=mysqli_num_rows($result);
    
  if($rowcount > 0){

  $notifikasi ='Tidak bisa di hapus karena Qty Retur masih , Silahkan Kosongkan Qty Retur dulu';




  }else{


 
 $conn -> query("UPDATE jualobat set noretur='',
  keteranganretur='',stsr='0',totaluangr='0',userr='0'
  where kdcabang='$kdcabang' and notransaksi='$notransaksi' and norm='$norm' ");



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