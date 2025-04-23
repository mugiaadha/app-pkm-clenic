<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
  $rest_json = file_get_contents("php://input");
  $_POST = json_decode($rest_json,true);



$kdklinik  = $_POST["kdklinik"];
$kdcabang  = $_POST["kdcabang"];

$namarak  = $_POST["namarak"];


$stssimpan  = $_POST["stssimpan"];



if($stssimpan === '1'){



$query="SELECT angka from autonum where kdnomor='5' and kdklinik='$kdklinik'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$angka = $row['angka']+1;
}

$kdcabangf = 'RAK'.$kdcabang.$angka;




  $conn -> query("INSERT INTO rakobat(kdrak,namarak,kdklinik,kdcabang) 
 values('$kdcabangf','$namarak','$kdklinik','$kdcabang')");
  $conn -> query("DELETE FROM rakobat where namarak=''");


$conn -> query("UPDATE autonum set angka='$angka' where kdklinik='$kdklinik' and  kdnomor='5' ");


$pesan = 200;



 // $pesan = array(
 //        'metadata'=>array(
 //            'code'=>200,
 //            'message'=>'Berhasil Simpan'
 //        )
 //    );
  


}else if($stssimpan === '2'){

$kdrak  = $_POST["kdrak"];

$conn -> query("UPDATE rakobat set namarak='$namarak' where kdcabang='$kdcabang' and kdrak='$kdrak'");

 // $pesan = array(
 //        'metadata'=>array(
 //            'code'=>200,
 //          'message'=>'Berhasil Simpan'
 //        )
 //    );
  
$pesan = 200;



}else if($stssimpan === '3'){


$kdrak  = $_POST["kdrak"];


    $sql="SELECT raksimpan FROM obat WHERE kdcabang='$kdcabang' AND raksimpan='$kdrak' ORDER BY raksimpan LIMIT 1";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){




 // $pesan = array(
 //        'metadata'=>array(
 //            'code'=>201,
 //             'message'=>'Tidak Bisa Di Hapus Karena Sudah Di pakai'
 //        )
 //    );


$pesan = 201;


}else{

  $conn -> query("DELETE from rakobat where kdcabang='$kdcabang' and kdrak='$kdrak'");

$pesan = 200;


 // $pesan = array(
 //        'metadata'=>array(
 //            'code'=>200,
 //             'message'=>'Berhasil Simpan'
 //        )
 //    );

}





}
   

 


echo json_encode($pesan);


 mysqli_close($conn);

?>