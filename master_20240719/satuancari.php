<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$kdobat=$_GET['kdobat'];
$satuan=$_GET['satuan'];




  $sqledit="SELECT
a.*
FROM obat a 


WHERE kdcabang ='$kdcabang'  and a.kdobat='$kdobat'  and standart='$satuan'";



      $resultedit=mysqli_query($conn,$sqledit);
       $rowcountedit=mysqli_num_rows($resultedit);
        
      if($rowcountedit > 0){


$query="SELECT
a.standart as bungkus,
    a.standartd as jumlah,1 as status
FROM obat a 


WHERE kdcabang ='$kdcabang'  and a.kdobat='$kdobat' and standart='$satuan'";

     }else{



$query="SELECT
a.kemasan as bungkus,a.kemasand as jumlah ,2 as status
FROM obat a WHERE kdcabang ='$kdcabang'  and a.kdobat='$kdobat' and kemasan='$satuan'";

     }







$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
$response[]=$row;
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>