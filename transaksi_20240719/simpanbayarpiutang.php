<?php
 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  


 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);


// $tgldaftar = date("Y-m-d");



$tgl = date("Y-m-d H:i:s");


  include '../koneksi.php';
  


$kdklinik        =$data->kdklinik;
$kdcabang=$data->kdcabang;
$notransaksi=$data->notransaksi;
$norm=$data->norm;
$kdkostumer=$data->kdkostumer;
$totalbayar=$data->totalbayar;
$status=$data->status;
$kdpoli=$data->kdpoli;
$kduser=$data->kduser;
$totalpiutang = $data->totalpiutang;

$stssimpan = $data->stssimpan;

if($stssimpan === '1'){


 $conn -> autocommit(FALSE);

 $tgl=$data->tgl;


   $query="SELECT angka from autonum where kdnomor='21' and kdklinik='$kdklinik'";
        $result=mysqli_query($conn, $query);
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

        $angka = $row['angka']+1;
        }




$conn -> query("INSERT INTO bayarpiutang(notrans,norm,kdpoli,kdkostumer,tglbayar,totalbayar,kdcabang,status,user,no,totalutang) 
 values('$notransaksi','$norm','$kdpoli','$kdkostumer','$tgl','$totalbayar','$kdcabang','$status','$kduser','$angka','$totalpiutang')");


if($status === 'RJ'){

 $conn -> query("UPDATE transaksiakhir set totalpiutang=totalpiutang-$totalbayar,totalcash=totalcash+$totalbayar
   where notrans='$notransaksi' and  kdcabang='$kdcabang' and kdpoli='$kdpoli' and kdkostumer='$kdkostumer'");


}else if($status === 'FARMASI'){

 $conn -> query("UPDATE jualobat set sudahbayar=sudahbayar+$totalbayar

   where notransaksi='$notransaksi' and  kdcabang='$kdcabang' and kdpoli='$kdpoli' and kdkostumer='$kdkostumer'");
}


$conn -> query("UPDATE autonum set angka='$angka' where kdklinik='$kdklinik' and  kdnomor='21' ");




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


$totalbayara=$data->totalbayara;
$no=$data->no;






$sql="SELECT * FROM bayarpiutang  where notrans='$notransaksi'
   and kdpoli='$kdpoli' and no='$no' and kdcabang='$kdcabang' and kunci=1";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){

$pesan=201;


}else{


if($status === 'RJ'){

 $conn -> query("UPDATE transaksiakhir set totalpiutang=totalpiutang+$totalbayara,totalcash=totalcash-$totalbayara
   where notrans='$notransaksi' and  kdcabang='$kdcabang' and kdpoli='$kdpoli' and kdkostumer='$kdkostumer'");


}else if($status === 'FARMASI'){

 $conn -> query("UPDATE jualobat set sudahbayar=sudahbayar-$totalbayara

   where notransaksi='$notransaksi' and  kdcabang='$kdcabang' and kdpoli='$kdpoli' and kdkostumer='$kdkostumer'");
}




  $conn -> query("DELETE FROM bayarpiutang where notrans='$notransaksi'
   and kdpoli='$kdpoli' and no='$no' and kdcabang='$kdcabang'");




$pesan=200;


}








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





}else if($stssimpan === '4'){



}  






  
?>

