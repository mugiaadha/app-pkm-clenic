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


$stssimpan=$_POST['stssimpan'];




if($stssimpan == '1'){
  $conn -> query("UPDATE coa set akun='$namacoa' where kdklinik='$kdklinik' and  kdcabang='$kdcabang' and kdakun='$kdcoa'");

 $pesan ='200';

 
}else if($stssimpan == '2'){

  $sqledit="SELECT kdcoa FROM glpusatd where   kdcabang='$kdcabang' and kdcoa='$kdcoa' LIMIT 1";



      $resultedit=mysqli_query($conn,$sqledit);
       $rowcountedit=mysqli_num_rows($resultedit);
        
      if($rowcountedit > 0){

 $pesan ='201';
     }else{
$conn -> query("DELETE FROM coa where kdklinik='$kdklinik' and  kdcabang='$kdcabang' and kdakun='$kdcoa'");

 $pesan ='200';


     }


}





 //  $conn -> query("INSERT INTO coa(kdakun,parent,akun,kdklinik,kdcabang) 
 // values('$kdcoafix','$kdcoa','$namacoa','$kdklinik','$kdcabang')");
 //  $conn -> query("DELETE FROM coa where akun=''");


echo json_encode($pesan);

 mysqli_close($conn);



?>