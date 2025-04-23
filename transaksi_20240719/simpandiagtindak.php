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


if(empty($data->kddiagnosa)){
$kddiagnosa='';

}else{
$kddiagnosa=$data->kddiagnosa;

}

if(empty($data->diagnosa)){
$diagnosa='';

}else{
$diagnosa =$data->diagnosa;

}



$kdpoli=$data->kdpoli;
$kddokter=$data->kddokter;
$norm=$data->norm;
$notrans=$data->notrans;
$status=$data->status;
$stssimpan = $data->stssimpan;


$tgl = date("Y-m-d H:i:s");
if($stssimpan === '1'){

   $conn -> autocommit(FALSE);


   $sqlsaldo="SELECT * from ermcpptdiagnosa where notrans='$notrans'
  and kdcabang='$kdcabang' order by indexno desc limit 1";

  $resultsaldo=mysqli_query($conn,$sqlsaldo);
   $rowcountsaldo=mysqli_num_rows($resultsaldo);
    
  if($rowcountsaldo < 1 ){
              $conn -> query("INSERT INTO ermcpptdiagnosa(tgl,notrans,norm,kddokter,kdpoli,
  kddiagnosa,diagnosa,status,kdcabang,indexno) 
 values('$tgl','$notrans','$norm','$kddokter','$kdpoli','$kddiagnosa','$diagnosa','$status','$kdcabang','1')");

      
      

 
  }else{
      
      
        //  $query="SELECT angka from autonum where kdnomor='26' and kdcabang='$kdcabang'";
        // $result=mysqli_query($conn, $query);
        while($row=mysqli_fetch_array($resultsaldo,MYSQLI_ASSOC)) {

        $angka = $row['indexno']+1;
        }

        $conn -> query("INSERT INTO ermcpptdiagnosa(tgl,notrans,norm,kddokter,kdpoli,
  kddiagnosa,diagnosa,status,kdcabang,indexno) 
 values('$tgl','$notrans','$norm','$kddokter','$kdpoli','$kddiagnosa','$diagnosa','$status','$kdcabang','$angka')");



 
      
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



$no =$data->no;



  $conn -> query("DELETE FROM ermcpptdiagnosa where notrans='$notrans' and kdcabang='$kdcabang' and no='$no'");


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











}
   

 




?>