<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
  $rest_json = file_get_contents("php://input");
  $_POST = json_decode($rest_json,true);


$gudang  = $_POST["gudang"];
$kdklinik  = $_POST["kdklinik"];
$kdcabang  = $_POST["kdcabang"];
$hakakses  = $_POST["hakakses"];

$stssimpan  = $_POST["stssimpan"];



if($stssimpan === '1'){


$query="SELECT angka from autonum where kdnomor='2' and kdklinik='$kdklinik'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$angka = $row['angka']+1;
}

$kdcabangf = 'GUD'.$kdcabang.$angka;


if($hakakses === '1'){


  $sqledit="SELECT * FROM gudang where kdcabang='$kdcabang' and utama='1'";

      $resultedit=mysqli_query($conn,$sqledit);
       $rowcountedit=mysqli_num_rows($resultedit);
        
      if($rowcountedit > 0){


$pesan =201;



      }else{


              $conn -> query("INSERT INTO gudang(kdgudang,gudang,kdklinik,kdcabang,utama) 
 values('$kdcabangf','$gudang','$kdklinik','$kdcabang','$hakakses')");
  $conn -> query("DELETE FROM gudang where gudang=''");    
$pesan =200;

      }

}else{


              $conn -> query("INSERT INTO gudang(kdgudang,gudang,kdklinik,kdcabang,utama) 
 values('$kdcabangf','$gudang','$kdklinik','$kdcabang','$hakakses')");
  $conn -> query("DELETE FROM gudang where gudang=''");
$pesan =200;
}





//   $sqledit="SELECT * FROM gudang where kdcabang='$kdcabang' and utama='1'";

//       $resultedit=mysqli_query($conn,$sqledit);
//        $rowcountedit=mysqli_num_rows($resultedit);
        
//       if($rowcountedit > 0){


//         if($hakakses === '1'){
//  $pesan = 'Gudang Utama Sudah Ada Silahkan Ganti Jenis Gudang';
//         }else{


//               $conn -> query("INSERT INTO gudang(kdgudang,gudang,kdklinik,kdcabang,utama) 
//  values('$kdcabangf','$gudang','$kdklinik','$kdcabang','0')");
//   $conn -> query("DELETE FROM gudang where gudang=''");


// $conn -> query("UPDATE autonum set angka='$angka' where kdklinik='$kdklinik' and  kdnomor='2' ");
//  $pesan = 'Berhasil';


//         }



//       }else{

//       $conn -> query("INSERT INTO gudang(kdgudang,gudang,kdklinik,kdcabang,utama) 
//  values('$kdcabangf','$gudang','$kdklinik','$kdcabang','$hakakses')");
//   $conn -> query("DELETE FROM gudang where gudang=''");


// $conn -> query("UPDATE autonum set angka='$angka' where kdklinik='$kdklinik' and  kdnomor='2' ");

//  $pesan = 'Berhasil Simpan gudang ';

//       }




$conn -> query("UPDATE autonum set angka='$angka' where kdnomor='2' and kdklinik='$kdklinik' ");






 $pesan =$pesan;
  


}else if($stssimpan === '2'){
  
$kdgudang  = $_POST["kdgudang"];




if($hakakses === '1'){


  $sqledit="SELECT * FROM gudang where kdcabang='$kdcabang' and utama='1'";

      $resultedit=mysqli_query($conn,$sqledit);
       $rowcountedit=mysqli_num_rows($resultedit);
        
      if($rowcountedit > 0){


$pesan =201;



      }else{


$conn -> query("UPDATE gudang set gudang='$gudang',utama='$hakakses' where kdcabang='$kdcabang' and kdgudang='$kdgudang'");
     $pesan =200;
      }

}else{


$conn -> query("UPDATE gudang set gudang='$gudang',utama='$hakakses' where kdcabang='$kdcabang' and kdgudang='$kdgudang'");
 // $pesan ='Berhasil Edit gudang ';


$pesan =200;
}






  



$pesan = $pesan;


}else if($stssimpan === '3'){

$kdgudang  = $_POST["kdgudang"];



  
      $sql="SELECT kdgudang FROM obatstock WHERE kdcabang='$kdcabang' AND kdgudang='$kdgudang' ORDER BY kdgudang LIMIT 1";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){

 $pesan =201;

}else{


$conn -> query("DELETE from gudang where kdcabang='$kdcabang' and  kdgudang='$kdgudang'");

 $pesan =200;
}
   
}
 


echo json_encode($pesan);


 mysqli_close($conn);

?>