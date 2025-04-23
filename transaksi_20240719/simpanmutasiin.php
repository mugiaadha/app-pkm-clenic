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
$stssimpan = $data->stssimpan;
$tgl = date("Y-m-d H:i:s");

if($stssimpan === '1'){

   $conn -> autocommit(FALSE);
   $nomutasi = $data->nomutasi;

$kdsuplier = $data->kdsuplier;
$kdgudang = $data->kdgudang;

   if(empty($data->keterangan)){
    $keterangan ='';
    }else{
    $keterangan = $data->keterangan;
    }

$user = $data->user;

    $sqlsaldo="SELECT * from mutasiin where nomutasi='$nomutasi'
  and kdcabang='$kdcabang'";

  $resultsaldo=mysqli_query($conn,$sqlsaldo);
   $rowcountsaldo=mysqli_num_rows($resultsaldo);
    
  if($rowcountsaldo > 0){

$nomutasi = $nomutasi;

 $conn -> query("UPDATE mutasiin set keterangan='$keterangan' where nomutasi='$nomutasi' and  kdcabang='$kdcabang' ");

  }else{



   $query="SELECT angka from autonum where kdnomor='20' and kdklinik='$kdklinik'";
        $result=mysqli_query($conn, $query);
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

        $angka = $row['angka']+1;
        }




    $mows = date_create( $tgl);
          
        $form_no = date_format( $mows, 'ymd' );
   $nomutasix = 'MUT-'.$kdcabang.$form_no.'-'.$angka;



  $conn -> query("INSERT INTO mutasiin(nomutasi,tgl,kdsuplier,kdgudang,user,kdcabang,keterangan) 
 values('$nomutasix','$tgl','$kdsuplier','$kdgudang','$user','$kdcabang','$keterangan')");



 $conn -> query("UPDATE autonum set angka='$angka' where kdklinik='$kdklinik' and  kdnomor='20' ");

$nomutasi = $nomutasix;

  }






     



// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode($nomutasi);

}

// Rollback transaction
$conn -> rollback();

$conn -> close();



}else if($stssimpan === '2'){

  

 $conn -> autocommit(FALSE);

$kdsuplier = $data->kdsuplier;
$kdgudang = $data->kdgudang;
$kdobat = $data->kdobat;
$nomutasi = $data->nomutasi;

$qty = $data->qty;




     $sql="SELECT nomor from mutasiind where nomutasi='$nomutasi' and kdcabang='$kdcabang'";

    $result=mysqli_query($conn,$sql);
    $rowcount=mysqli_num_rows($result);
      
    if($rowcount > 0){

    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {



      $nomor=$row['nomor']+1;



    }

    }else{


      $nomor=1;

    }



  $conn -> query("INSERT INTO mutasiind(nomutasi,nomor,kdobat,qty,kdcabang) 
 values('$nomutasi','$nomor','$kdobat','$qty','$kdcabang')");




 $sqlsaldo="SELECT * from kartustok where KDBARANG='$kdobat' and KDGUDANG='$kdgudang' 
  and kdcabang='$kdcabang' and NOFAKTUR='$nomutasi' and STSMUTASI='MUTIN'";

  $resultsaldo=mysqli_query($conn,$sqlsaldo);
   $rowcountsaldo=mysqli_num_rows($resultsaldo);
    
  if($rowcountsaldo > 0){

$conn -> query("UPDATE kartustok set QTY='$qty'
                 where KDBARANG='$kdobat' and KDGUDANG='$kdgudang' 
  and kdcabang='$kdcabang' and NOFAKTUR='$nomutasi' and STSMUTASI='MUTIN'");
  }else{

$conn -> query("INSERT INTO kartustok(KDBARANG,NOMOR,NOFAKTUR,KDCUS,TGLDATE,
      KDGUDANG,STSMUTASI,QTY,KDCABANG) 
   values('$kdobat','$nomor','$nomutasi','$kdsuplier','$tgl','$kdgudang','MUTIN','$qty','$kdcabang')");



  }



 $sqlsaldo="SELECT * from obatstock where kdobat='$kdobat' and kdgudang='$kdgudang' 
  and kdcabang='$kdcabang'";

  $resultsaldo=mysqli_query($conn,$sqlsaldo);
   $rowcountsaldo=mysqli_num_rows($resultsaldo);
    
  if($rowcountsaldo > 0){
$conn -> query("UPDATE obatstock set stok=stok+'$qty'
                 where kdobat='$kdobat' and kdgudang='$kdgudang' and kdcabang='$kdcabang' ");



     }else{

    

$conn -> query("INSERT INTO obatstock(kdcabang,kdgudang,kdobat,stok) 
   values('$kdcabang','$kdgudang','$kdobat','$qty')");

}

// $conn -> query("UPDATE obatstock set stok=stok-'$qty'
//                  where kdobat='$kdobat' and kdgudang='$kdgudangd'  and kdcabang='$kdcabang' ");





 $sqlsaldox="SELECT * from saldoobat where kdbarang='$kdobat' and kdgudang='$kdgudang' 
  and kdcabang='$kdcabang'";

  $resultsaldox=mysqli_query($conn,$sqlsaldox);
   $rowcountsaldox=mysqli_num_rows($resultsaldox);
    
  if($rowcountsaldox > 0){
$conn -> query("UPDATE saldoobat set FSBLAIN_MASUK=FSBLAIN_MASUK+'$qty'
                where kdbarang='$kdobat' and kdgudang='$kdgudang' 
  and kdcabang='$kdcabang' ");



     }else{

    

$conn -> query("INSERT INTO saldoobat(kdbarang,kdgudang,FSBLAIN_MASUK,KDCABANG) 
   values('$kdobat','$kdgudang','$qty','$kdcabang')");

}


// $conn -> query("UPDATE saldoobat set FSBLAIN_KELUAR=FSBLAIN_KELUAR+'$qty'
//                  where kdbarang='$kdobat' and kdgudang='$kdgudangd'  and kdcabang='$kdcabang' ");







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

$kdsuplier = $data->kdsuplier;
$kdgudang = $data->kdgudang;
$kdobat = $data->kdobat;
$nomor = $data->nomor;
$nomutasi = $data->nomutasi;

$qty = $data->qty;




     $conn -> query("DELETE from mutasiind where kdcabang='$kdcabang' 
    and nomutasi='$nomutasi' and nomor='$nomor' and kdobat='$kdobat'");


     $conn -> query("DELETE from kartustok where kdcabang='$kdcabang' 
    and NOFAKTUR='$nomutasi' and nomor='$nomor' and KDBARANG='$kdobat' and  STSMUTASI='MUTIN'");




$conn -> query("UPDATE saldoobat set FSBLAIN_MASUK=FSBLAIN_MASUK-$qty
                 where kdbarang='$kdobat' and kdgudang='$kdgudang'  and kdcabang='$kdcabang' ");



$conn -> query("UPDATE obatstock set stok=stok-$qty
                 where kdobat='$kdobat' and kdgudang='$kdgudang'  and kdcabang='$kdcabang' ");





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

$nomutasi = $data->nomutasi;

     $conn -> query("DELETE from mutasiin where kdcabang='$kdcabang' 
    and nomutasi='$nomutasi'");



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