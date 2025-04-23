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

   if(empty($data->rujukanuntuk)){
    $rujukanuntuk ='';
    }else{
    $rujukanuntuk = $data->rujukanuntuk;
    }



   if(empty($data->keteranganrujuk)){
    $keteranganrujuk ='';
    }else{
    $keteranganrujuk = $data->keteranganrujuk;
    }



$stssimpan = $data->stssimpan;
$tgl = date("Y-m-d H:i:s");




   if(empty($data->instansi)){
    $instansi ='';
    }else{
    $instansi = $data->instansi;
    }





   if(empty($data->catatan)){
    $catatan ='';
    }else{
    $catatan = $data->catatan;
    }




$notrans=$data->notrans;
$norm=$data->norm;
$kdcabang=$data->kdcabang;

if($stssimpan === '1'){

   $conn -> autocommit(FALSE);
  



    $sql="SELECT * from keteranganrujuk where notrans='$notrans' and kdcabang='$kdcabang'";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){


$conn -> query("UPDATE keteranganrujuk set 
rujukanuntuk='$rujukanuntuk',keteranganrujuk='$keteranganrujuk',instansi='$instansi',catatan='$catatan'
where 
 kdcabang='$kdcabang' and notrans='$notrans'");
 



}else{


 $conn -> query("INSERT INTO keteranganrujuk(rujukanuntuk,keteranganrujuk,instansi,catatan,notrans,norm,kdcabang) 
 values('$rujukanuntuk','$keteranganrujuk','$instansi','$catatan','$notrans','$norm','$kdcabang')");





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

  

}else if($stssimpan === '3'){




}
   

 




?>