<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';

$kdcabang=$_GET['kdcabang'];
$notransaksi=$_GET['notransaksi'];
$sts=$_GET['sts'];

if($sts ==='1'){
$query="SELECT a.*, b.obat
                    FROM jualobatd a,obat b WHERE 
                    a.kdobat = b.kdobat and
                    a.nofaktur='$notransaksi' AND a.kdcabang='$kdcabang' AND a.kdcabang = b.kdcabang and a.status='1'";



}else if($sts ==='2'){

$obat=$_GET['obat'];
  $query="SELECT a.*, b.obat
                    FROM jualobatd a,obat b WHERE 
                    a.kdobat = b.kdobat and
                    a.nofaktur='$notransaksi' AND a.kdcabang='$kdcabang' and b.obat like '%$obat%' and a.status='1'  AND a.kdcabang = b.kdcabang";


  
}



$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {


 $temp = array(

    
"notransaksi" => $row["notransaksi"],
    "tgl" => $row["tgl"],
    "nomor" => $row["nomor"],
    "nofaktur"=> $row["nofaktur"],
    "kdobat"=> $row["kdobat"],
    "qty"=> $row["qty"],
    "disc"=> number_format($row["jmldisc"],0),
    "discrp"=> $row["discrp"],
    "harga"=> $row["harga"],
    "totalharga"=> $row["totalharga"],
    "kdcabang"=> $row["kdcabang"],
    "kdcppt"=> $row["kdcppt"],
    "norm"=> $row["norm"],
    "dari"=> $row["dari"],
    "status"=> $row["status"],
    "obat"=> $row["obat"],
      "hargax"=> number_format($row["harga"],2),
    "totalhargax"=> number_format($row["totalharga"],2),

);
   
    array_push($response, $temp);









}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>