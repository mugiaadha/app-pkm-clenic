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

  $kdcabang=$data->kdcabang;

$stssimpan = $data->stssimpan;

 $kdbayar=$data->kdbayar;
 $bayar=$data->bayar;
 $kduser=$data->kduser;
$notransaksi=$data->notransaksi;
$notransri=$data->notransri;
 $norm=$data->norm;
 $sudahbayar=$data->sudahbayar;
 $kdkamar =$data->kdkamar ;

if($stssimpan === '1'){

 $conn -> autocommit(FALSE);



    $conn -> query("UPDATE jualobat set 
          kdbayar='$kdbayar',bayar='$bayar',statuslunas='2',
          userbayar='$kduser',tglbayar='$tgl',ri='Ya'
         where notransaksi='$notransaksi' and kdcabang='$kdcabang' and statuslunas='1'
            ");





        $conn -> query("INSERT INTO transferbayar(tanggal,notrans,nomor,norm,kdpoli,
                  nominal,bank,kodebayar,keterangan,kdcabang,user) 
               values('$tgl','$notransaksi','100','$norm','Farmasi','$sudahbayar','','9','Transfer Farmasi','$kdcabang','$kduser')");





      $sql="SELECT nomor from transaksipasiend where nofaktur='$notransri' and kdcabang='$kdcabang'
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
    qty,harga,debet,kridit,jenistransaksi,tarifasli,disc,kdcabang,user,ri) 
 values('$notransaksi','$notransri','$tgl','$tgl','$nomor','9','Transfer Farmasi','$kdkamar','1',
 '$sudahbayar','$sudahbayar','0'

 ,'KR','0','0','$kdcabang','$kduser','1')");






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