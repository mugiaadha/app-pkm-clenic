<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];
$notrans=$_GET['notrans'];

$kdcppt=$_GET['kdcppt'];

// $query="SELECT * FROM ermcpptintruksi 
// WHERE notransaksi='$notrans' AND kdcabang='$kdcabang' 
// AND dari='obat'  and statuso='Non Racik' AND kdcppt='$kdcppt'
// order BY  tgl asc";


$query ="SELECT a.*,b.kdobatbpjs FROM ermcpptintruksi a
 LEFT JOIN obat b ON a.kdpruduk = b.kdobat
WHERE a.notransaksi='$notrans' AND a.kdcabang='$kdcabang' 
AND a.dari='obat'  AND a.statuso='Non Racik' and
 a.kdcppt='$kdcppt'
order BY  a.tgl asc";

// $response=array();
$arr=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
// $response[]=$row;





	 $temp = array(


	"notransaksi"=> $row['notransaksi'],
    "kdkostumerd"=> $row['kdkostumerd'],
    "norm"=> $row['norm'],
    "kddokter"=> $row['kddokter'],
    "kdpoli"=> $row['kdpoli'],
    "kdpruduk"=> $row['kdpruduk'],
    "nama"=> $row['nama'],
    "aturan"=> $row['aturan'],
    "qty"=> number_format($row['qty'],1),
    "harga"=> $row['harga'],
    "keterangan"=> $row['keterangan'],
    "statuso"=> $row['statuso'],
    "status"=> $row['status'],
    "dari"=> $row['dari'],
    "kduser"=> $row['kduser'],
    "kdcabang"=> $row['kdcabang'],
    "tgl"=>$row['tgl'],
    "kdcppt"=> $row['kdcppt'],
    "kunci"=> $row['kunci'],
    "tglpriksa"=> $row['tglpriksa'],
    "kd"=> $row['kd'],
    "no"=> $row['no'],
    "hargasatuan"=> $row['hargasatuan'],
    "dari2"=> $row['dari2'],
    "kirim"=> $row['kirim'],
    "signa"=> $row['signa'],
    "hari"=> $row['hari'],
    "frekuensi"=> $row['frekuensi'],
    "jmlpakai"=> $row['jmlpakai'],
      "untukhari"=> "Untuk ".$row['hari'].' Hari',
 "kdObatSK"=> $row['kdObatSK'],
  "kdRacikan"=> $row['kdRacikan'],
);

   
    array_push($arr, $temp);


}


$data = json_encode($arr);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>