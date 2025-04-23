
<?php     
   // header("Access-Control-Allow-Origin: *");
   // header("Access-Control-Allow-Methods: PUT, GET, POST");
   // header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
   
   //  $folderPath = "gmb/";
   //  $postdata = file_get_contents("php://input");     
   //  if(!empty($postdata)){

   //  $request = json_decode($postdata);
   //  $image_parts = explode(";base64,", $request->image);      
   //  $image_type_aux = explode("image/", $image_parts[0]); 
   //  $image_base64 = base64_decode($image_parts[1]);      
   //  $file = $folderPath . uniqid() . '.png';      
   //  if(file_put_contents($file, $image_base64)){    
   //  $response[] = array('sts'=>true,'msg'=>'Successfully uploaded');
   //  }      
   //   echo json_encode($response);
   // }






 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
  $rest_json = file_get_contents("php://input");
  $_POST = json_decode($rest_json,true);




$kdcabang  = $_POST["kdcabang"];
$notrans  = $_POST["notrans"];




 $kdcppt = $notrans.$kdcabang;

 $target_path=$kdcppt.'.jpg';



  $target_path = "gmb/".$target_path;

  $imagedata = $_POST['file'];
  $imagedata = str_replace('data:image/jpeg;base64','',$imagedata);
  $imagedata = str_replace('data:image/jpg;base64','',$imagedata);
  $imagedata = str_replace('data:image/png;base64','',$imagedata);
  $imagedata = str_replace('', '+', $imagedata);
  $imagedata = base64_decode($imagedata);


  file_put_contents($target_path, $imagedata);
  


$pesan='Berhasil';




 


echo json_encode($pesan);


 mysqli_close($conn);





?>