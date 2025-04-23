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
$tgldaftar = date("Y-m-d H:i:s");
$notransaksi=$data->notransaksi;
$norm=$data->norm;
$kdpoli=$data->kdpoli;
$kdkostumerd=$data->kdkostumerd;
$total=$data->total;

$user=$data->user;

$conn -> autocommit(FALSE);


 $sqlx="SELECT * from transaksiakhir where notrans='$notransaksi' and kdcabang='$kdcabang'   and norm='$norm' and kdpoli='$kdpoli'   ";
    $resultx=mysqli_query($conn,$sqlx);

     $rowcountx=mysqli_num_rows($resultx);
  
if($rowcountx > 0){




$conn -> query("UPDATE transaksiakhir set

totalpiutang='0',totalcash='$total' ,tagihan='$total'  where notrans='$notransaksi' and norm='$norm' and kdpoli='$kdpoli' and 
 kdcabang='$kdcabang'");


}else{




    $conn -> query("INSERT INTO transaksiakhir(notrans,nomor,tglfaktur,waktu,norm,kdpoli,kdkostumer,jenistransaksi,
    namabank,
    totalcash,totalpiutang,tagihan

    ,kdcabang,keterangan,user,status) 
 values('$notransaksi','1','$tgldaftar','$tgldaftar','$norm','$kdpoli','$kdkostumerd','1',''
 ,'$total','0','$total','$kdcabang','','$user','2')");

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




?>