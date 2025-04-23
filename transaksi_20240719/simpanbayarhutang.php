<?php
 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  


 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);


$tgldaftar = date("Y-m-d");



// $tgl = date("Y-m-d H:i:s");


  include '../koneksi.php';
  


$kdklinik        =$data->kdklinik;
$kdcabang=$data->kdcabang;
$nofaktur=$data->nofaktur;
$kdsup=$data->kdsup;
$jumlah=$data->jumlah;
$kduser=$data->kduser;
$stssimpan=$data->stssimpan;
$tgl=$data->tgl;


if($stssimpan === '1'){


 $conn -> autocommit(FALSE);


$kdbayar=$data->kdbayar;
$keterangb=$data->keterangb;



   $query="SELECT angka from autonum where kdnomor='22' and kdklinik='$kdklinik'";
        $result=mysqli_query($conn, $query);
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

        $angka = $row['angka']+1;
        }



$conn -> query("INSERT INTO bayarhutangfarmasi(nofaktur,tglbayar,kdsup,jumlah,kdcabang,kduser,kdbayar,keterangan) 
 values('$nofaktur','$tgl','$kdsup','$jumlah','$kdcabang','$kduser','$kdbayar','$keterangb')");

$conn -> query("UPDATE beliobat set verif='1' where kdcabang='$kdcabang' and  NOFAKTUR='$nofaktur' and KDSUPPLIER='$kdsup' ");


$conn -> query("UPDATE autonum set angka='$angka' where kdklinik='$kdklinik' and  kdnomor='22' ");




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




  $conn -> query("DELETE FROM bayarhutangfarmasi where nofaktur='$nofaktur'
    and kdcabang='$kdcabang'");
  
$conn -> query("UPDATE beliobat set verif='0' where kdcabang='$kdcabang' and  NOFAKTUR='$nofaktur' and KDSUPPLIER='$kdsup' ");






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





}else if($stssimpan === '4'){



}  






  
?>

