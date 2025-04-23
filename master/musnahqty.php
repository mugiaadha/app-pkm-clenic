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

 
$tgl = date("Y-m-d");
$tgld = date("Y-m-d H:i");
if($stssimpan === '1'){



$conn -> autocommit(FALSE);




$query="SELECT a.TGLEX,a.KDOBAT,a.OBAT,a.QTY ,b.gudang,b.KDGUDANG,a.NOFAKTUR,c.KDSUPPLIER FROM beliobatd a,gudang b,beliobat c WHERE 
c.NOFAKTUR = a.NOFAKTUR AND c.KDGUDANG = b.kdgudang and
a.kdcabang='$kdcabang' AND a.tglex='$tgl'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {


$qty = $row['QTY'];
$kdgudang = $row['KDGUDANG'];
$kdobat = $row['KDOBAT'];
$notransaksi = $row['NOFAKTUR'];
$kdsup = $row['KDSUPPLIER'];






$conn -> query("UPDATE obatstock set stok=stok-$qty
 where kdcabang='$kdcabang' and kdgudang='$kdgudang'  and kdobat='$kdobat'");


  $conn -> query("INSERT INTO kartustok(KDBARANG,NOMOR,NOFAKTUR,KDCUS,TGLDATE,
  KDGUDANG,STSMUTASI,QTY,KDCABANG) 
   values('$kdobat','1','$notransaksi','$kdsup','$tgld','$kdgudang','OUT','$qty','$kdcabang')");




}



  $conn -> query("INSERT INTO historymusnah(kdcabang,tgl) 
   values('$kdcabang','$tgl')");



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

  $kdtamplate=$data->kdtamplate;

$conn -> query("UPDATE tsubjek set nama='$nama',detail='$detail' where kdcabang='$kdcabang' and kdtamplate='$kdtamplate'");


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

 
  $kdtamplatex=$data->kdtamplatex;


$conn -> query("DELETE from  tplaning  where kdcabang='$kdcabang' and kdtamplate='$kdtamplatex'");


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

 $conn -> query("INSERT INTO autonumobat(kdtamplatem,kdcabang,kduser ) 
 values('$kdtamplate','$kdcabang','$kddokter')");

// $conn -> query("DELETE from  autonumobat  where kdtamplatem=''");

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

 


$conn -> query("DELETE from  tplaning  where kdcabang='$kdcabang' and kdtamplated='$kdtamplate'");
$conn -> query("DELETE from  tplaningr  where kdcabang='$kdcabang' and kdtamplated='$kdtamplate'");


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