<?php
 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  


 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);


$tgldaftar = date("Y-m-d H:i");





  include '../koneksi.php';
  



$kdcabang=$data->kdcabang;
$notransaksi=$data->notransaksi;
$norm=$data->norm;
$kddokter=$data->kddokter;
$kdpoli=$data->kdpoli;
$kduser=$data->kduser;


$stssimpan=$data->stssimpan;



if($stssimpan === '1'){


 $conn -> autocommit(FALSE);
 


            $sqlcek="SELECT * from transaksipasiend where notransaksi='$notransaksi' and kdcabang='$kdcabang' ";

      $resultcek=mysqli_query($conn,$sqlcek);
     $rowcountcek=mysqli_num_rows($resultcek);
            
     if($rowcountcek  > 0){

          $pesan ='Tidak Bisa di Batal Priksa Karena Sudah Terbiling/Sudah Priksa';

     }else{


    $pesan ='Berhasil Batal Priksa' ;

          
//  $conn -> query("DELETE from antrian  where notransaksi='$notransaksi'  and kdcabang='$kdcabang'");


$conn -> query("UPDATE antrian set norm='',notransaksi='$notransaksi$norm' where notransaksi='$notransaksi'  and kdcabang='$kdcabang'");

       
      


 $conn -> query("DELETE from kunjunganpasien  where notransaksi='$notransaksi'  and kdcabang='$kdcabang'");
 $conn -> query("DELETE from transaksipasien  where notransaksi='$notransaksi'  and kdcabang='$kdcabang'");


 $conn -> query("DELETE from transaksipasien  where notransaksi='$notransaksi'  and kdcabang='$kdcabang'");

 $conn -> query("DELETE from riwayatkunjungan  where notransaksi='$notransaksi'");
 
 $conn -> query("DELETE from ermcppt  where notrans='$notransaksi'  and kdcabang='$kdcabang'");

 $conn -> query("DELETE from ermcpptdiagnosa  where notrans='$notransaksi'  and kdcabang='$kdcabang'");




$conn -> query("INSERT INTO batalpriksa(notrans,norm,kddokter,kdpoli,kduser,tgl,kdcabang) 
 values('$notransaksi','$norm','$kddokter','$kdpoli','$kduser','$tgldaftar','$kdcabang')");


    }




// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode($pesan );

}

// Rollback transaction
$conn -> rollback();

$conn -> close();



}else if($stssimpan === '2'){



 $conn -> autocommit(FALSE);
 


            $sqlcek="SELECT * from transaksipasiend where notransaksi='$notransaksi' and kdcabang='$kdcabang' ";

      $resultcek=mysqli_query($conn,$sqlcek);
     $rowcountcek=mysqli_num_rows($resultcek);
            
     if($rowcountcek  > 0){

          $pesan ='Tidak Bisa di Batal Priksa Karena Sudah Terbiling/Sudah Priksa';

     }else{


    $pesan ='Berhasil Batal Priksa' ;

          
    $conn -> query("UPDATE antrian set norm='',notransaksi='$notransaksi$norm' where notransaksi='$notransaksi'  and kdcabang='$kdcabang'");

     
    
  // $conn -> query("DELETE from antrian  where notransaksi='$notransaksi'  and kdcabang='$kdcabang'");

 $conn -> query("DELETE from kunjunganpasien  where notransaksi='$notransaksi'  and kdcabang='$kdcabang'");
 $conn -> query("DELETE from transaksipasien  where notransaksi='$notransaksi'  and kdcabang='$kdcabang'");

 $conn -> query("DELETE from ermcppt  where notrans='$notransaksi'  and kdcabang='$kdcabang'");

 $conn -> query("DELETE from ermcpptdiagnosa  where notrans='$notransaksi'  and kdcabang='$kdcabang'");




$conn -> query("INSERT INTO batalpriksa(notrans,norm,kddokter,kdpoli,kduser,tgl,kdcabang) 
 values('$notransaksi','$norm','$kddokter','$kdpoli','$kduser','$tgldaftar','$kdcabang')");


    }




// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode($pesan );

}

// Rollback transaction
$conn -> rollback();

$conn -> close();

}else if($stssimpan === '3'){


 $conn -> autocommit(FALSE);





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

