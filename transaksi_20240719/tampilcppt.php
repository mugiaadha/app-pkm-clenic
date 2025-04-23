<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$kdcabang=$_GET['kdcabang'];
$notrans=$_GET['notrans'];
$query="SELECT a.*, b.nama,b.hakakses
from ermcppt a,user b WHERE
a.kduser = b.kduser and
 a.notrans='$notrans' AND a.kdcabang='$kdcabang'  ";





$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {


   $temp = array(
   

"kduser" => $row['kduser'],
"namauser" => $row['nama'],
"hakakses" => $row['hakakses'],
    "notrans"=> $row['notrans'],
    "tgl"=> $row['tgl'],
    "norm"=> $row['norm'],
    "kdpoli"=> $row['kdpoli'],
    "kddokter"=> $row['kddokter'],
    "subjek"=> $row['subjek'],
    "td"=> $row['td'],
    "bb"=> $row['bb'],
    "nadi"=> $row['nadi'],
    "suhu"=> $row['suhu'],
     "tdd"=> $row['tdd'],
      "hr"=> $row['hr'],
    "rr"=> $row['rr'],
    "spo"=> $row['spo'],
    "pf"=> $row['pf'],
     "tb"=> $row['tb'],
    "planing"=> $row['planing'],
    "kdcabang"=> $row['kdcabang'],
     "alergi"=> $row['alergi'],
          "rwytp"=> $row['rwytp'],
    "url"=> 'https://tabaro.clenicapp.com/clenic/transaksi/gmb/'.$row['notrans'].$row['kdcabang'].'.jpg',
              "subjekp"=> $row['subjekp'],
                "tglkontrol"=> $row['tglkontrol'],
                  "rencanatindakan"=> $row['rencanatindakan'],
                  "diagnosa"=> $row['diagnosa'],
 "tindakan"=> $row['tindakan'],
 "insobat"=> $row['insobat'],
 "inspenunjang"=> $row['inspenunjang'],
  "skalanyeri"=> $row['skalanyeri'],
   "imt"=> $row['imt'],
    "jeniscppt"=> $row['jeniscppt'],
      "kdcppt"=> $row['kdcppt'],
         "riwayatdahulu"=> $row['riwayatdahulu'],
      "riwayatkeluarga"=> $row['riwayatkeluarga'],
      
               "stspulang"=> $row['stspulang'],
      "alergiudara"=> $row['alergiudara'],
       "alergiobat"=> $row['alergiobat'],
       "kdprognosa"=> $row['kdprognosa'],
       "terapinonobat"=> $row['terapinonobat'],
        "jam"=> $row['jam']
      
);
   
    array_push($response, $temp);






}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>