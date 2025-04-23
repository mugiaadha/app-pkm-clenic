<?php

 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
  $rest_json = file_get_contents("php://input");
  $_POST = json_decode($rest_json,true);

$namacoa=$_POST['namacoa'];
$kdcoa=$_POST['kdcoa'];
$kdklinik=$_POST['kdklinik'];
$kdcabang=$_POST['kdcabang'];

$sql="SELECT * FROM coa WHERE parent='$kdcoa'";

  
if ($result=mysqli_query($conn,$sql))
  {
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
if($rowcount > 0){

$query="SELECT * FROM coa WHERE parent='$kdcoa' ORDER BY kdakun DESC  LIMIT 1 ";

$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {




 $kdc =  substr($row['kdakun'],4,3);
 $kdcx =  substr($row['kdakun'],0,4);


 $nextno=$kdc + 1;
 $nextnot =sprintf('%03s',$nextno);
$kdcoafix = $kdcx.$nextnot;


}





}else{


 $kdc =  substr($kdcoa,4,3);
 $kdcx =  substr($kdcoa,0,4);


 $nextno=$kdc + 1;
 $nextnot =sprintf('%03s',$nextno);
$kdcoafix = $kdcx.$nextnot;

}

  mysqli_free_result($result);
  }




// echo $kdcoafix;



  $conn -> query("INSERT INTO coa(kdakun,parent,akun,kdklinik,kdcabang) 
 values('$kdcoafix','$kdcoa','$namacoa','$kdklinik','$kdcabang')");
  $conn -> query("DELETE FROM coa where akun=''");


echo json_encode('Berhasil');

 mysqli_close($conn);



?>