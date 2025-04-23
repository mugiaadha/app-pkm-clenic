<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



include '../koneksi.php';
$kdcabang=$_GET['kdcabang'];

$notrans=$_GET['notrans'];
$nofaktur=$_GET['nofaktur'];

// $query="
// SELECT 
// a.*,b.obat,b.standart
// FROM jualobatd a , obat b 
// WHERE a.kdobat = b.kdobat
// and a.notransaksi='$notrans' and a.nofaktur='$nofaktur' AND a.kdcabang='$kdcabang' ORDER BY a.nomor";

$query ="SELECT 
a.*,b.obat,b.standart,
(SELECT signa from ermcpptintruksi WHERE notransaksi=a.nofaktur AND norm=a.norm AND dari='obat' AND kdpruduk = a.kdobat and no=a.nomor) AS  signa,
(SELECT frekuensi from ermcpptintruksi WHERE notransaksi=a.nofaktur AND norm=a.norm AND dari='obat' AND kdpruduk = a.kdobat  and no=a.nomor) AS  frekuensi,
(SELECT jmlpakai from ermcpptintruksi WHERE notransaksi=a.nofaktur AND norm=a.norm AND dari='obat' AND kdpruduk = a.kdobat and no=a.nomor ) AS  jmlpakai,
(SELECT keterangan from ermcpptintruksi WHERE notransaksi=a.nofaktur AND norm=a.norm AND dari='obat' AND kdpruduk = a.kdobat and no=a.nomor ) AS  keterangan

FROM jualobatd a 
LEFT JOIN  obat b ON a.kdobat = b.kdobat
WHERE 
 a.notransaksi='$notrans' and a.nofaktur='$nofaktur' AND a.kdcabang='$kdcabang'  ORDER BY a.nomor";


$response=array();
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {



	$bruto=$row['qty']*$row['harga'];


	 $temp = array(
 	"notransaksi" => $row["notransaksi"],
 	"tgl" => $row["tgl"],
 	"nomor" => $row["nomor"],
 	
 	"nofaktur" => $row["nofaktur"],
 	"kdobat" => $row["kdobat"],
 	"qty" => $row["qty"],
 	

 	"disc" => $row["disc"],
 	"discrp" => $row["discrp"],
 	"harga" => $row["harga"],
 	"jmldisc" => $row['jmldisc'],
 	"bruto" => $bruto,
 		"brutorp" => number_format($bruto,0),
 	"hargarp" => number_format($row["harga"],0),
 	

 	"totalharga" => $row["totalharga"],
 	
 	"totalhargarp" => number_format($row["totalharga"],0),
 	

 	"kdcabang" => $row["kdcabang"],
 	"kdcppt" => $row["kdcppt"],

"norm" => $row["norm"],
"dari" => $row["dari"],
 	"status" => $row["status"],
 	"obat" => $row["obat"],
"standart" => $row["standart"],



"qtyr" => $row["qtyr"],
"discr" => $row["discr"],
 	"discrpr" => $row["discrpr"],
 	"jmldiscr" => $row["jmldiscr"],
"totalhargar" => $row["totalhargar"],
"totalhargarx" => number_format($row["totalhargar"],0),
"statusr" => $row["statusr"],
"statusrv" => $row["statusrv"],
"signa" => $row["signa"],
"frekuensiket" => $row["frekuensi"].'x'.$row["jmlpakai"],
"frekuensi" => $row["frekuensi"],
"jmlpakai" => $row["jmlpakai"],
"keterangan"=> $row["keterangan"]




);
   
    array_push($response, $temp);



   
 
}


$data = json_encode($response);

echo preg_replace('/\\\r\\\n|\\\r|\\\n\\\r|\\\n/m', ' ', $data);

mysqli_close($conn);


?>