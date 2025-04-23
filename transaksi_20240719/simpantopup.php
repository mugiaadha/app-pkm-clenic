<?php
 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  


 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);


$tgldaftar = date("Y-m-d");



$tgl = date("Y-m-d H:i:s");


  include '../koneksi.php';
  


$kdklinik        =$data->kdklinik;
$kdcabang=$data->kdcabang;
$stssimpan = $data->stssimpan;
$kduser=$data->kduser;
$nominal=$data->nominal;
$norm=$data->norm;




if($stssimpan === '1'){


 $conn -> autocommit(FALSE);



            $sqlcek="SELECT * from topup where norm='$norm'";

      $resultcek=mysqli_query($conn,$sqlcek);
     $rowcountcek=mysqli_num_rows($resultcek);
            
     if($rowcountcek  > 0){

 $conn -> query("UPDATE topup set 

        nominal=nominal+$nominal where norm='$norm' ");
     }else{




        $conn -> query("INSERT INTO topup(norm,tgl,nominal,user) 
               values('$norm','$tgl','$nominal','$kduser')");
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



}else if($stssimpan === '2'){

$conn -> autocommit(FALSE);



 $conn -> query("UPDATE topup set 

        nominal=nominal-$nominal where norm='$norm' ");

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

