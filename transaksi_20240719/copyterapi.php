<?php



 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  include '../koneksi.php';
  
 

 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);


$tgl = date("Y-m-d H:i:s");


$tgltransaksi = $tgl;
$nofaktur = $data->notrans;
$kdkostumerd   = $data->kdkostumerd;
$norm = $data->norm;

$kdpoli = $data->kdpoli;

$kddokter  = $data->kddokter;
$kduser  = $data->kduser;
$kdcppt  = $data->kdcppt;
$stssimpan =$data->stssimpan;
$kdcabang =$data->kdcabang;
$notransaksi =  $data->notransaksi;
$kdtamplate = $data->kdtamplate;



if($stssimpan === '1'){

   $conn -> autocommit(FALSE);



$queryx="SELECT * FROM ermcpptintruksi WHERE notransaksi='$nofaktur' 
AND  dari ='obat' and statuso <> 'BHP'";

$resultx=mysqli_query($conn, $queryx);

while($rowx=mysqli_fetch_array($resultx,MYSQLI_ASSOC)) {

$kdproduk=$rowx['kdpruduk'];
$aturan=$rowx['aturan'];
$qty=$rowx['qty'];
$statuso=$rowx['statuso'];
$dari=$rowx['dari'];
$keterangan=$rowx['keterangan'];
$harga=$rowx['harga'];
$obat=$rowx['nama'];
$nomor=$rowx['no'];
$hargajual =$rowx['hargasatuan'];

$signa =$rowx['signa'];
$hari =$rowx['hari'];
$frekuensi =$rowx['frekuensi'];
$jmlpakai =$rowx['jmlpakai'];

if($statuso === 'Non Racik'){

$kd='';
}else{

$kd=$kdtamplate;

}



 
  $conn -> query("INSERT INTO ermcpptintruksi(notransaksi,kdkostumerd,norm,kddokter,kdpoli,kdpruduk,aturan,
    qty,statuso,status,dari,kduser,kdcabang,tgl,kdcppt,kunci,tglpriksa,keterangan,harga,nama,no,kd,dari2,signa,hari,frekuensi,jmlpakai) 
 values('$notransaksi','$kdkostumerd','$norm','$kddokter','$kdpoli','$kdproduk','$aturan','$qty','$statuso','0','$dari','$kduser','$kdcabang','$tgl','$kdcppt','0','$tgl','$keterangan','$harga','$obat','$nomor','$kd','CPPT','$signa','$hari','$frekuensi','$jmlpakai')");


 $conn -> query("INSERT INTO jualobatd(tgl,nomor,nofaktur,kdobat,qty,disc,harga,totalharga,kdcabang,kdcppt,norm,dari,status) 
  values('$tgl','$nomor','$notransaksi','$kdproduk','$qty',0,'$hargajual','$harga','$kdcabang','$kdcppt','$norm','CPPT','0')");


}


// $sql="SELECT hargajual,obat from obat where kdobat='$kdproduk' and kdcabang='$kdcabang' ";

// $result=mysqli_query($conn,$sql);

  


// while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {



//   $hargajual=$row['hargajual'];




// }


//  $conn -> query("INSERT INTO jualobatd(tgl,nomor,nofaktur,kdobat,qty,disc,harga,totalharga,kdcabang,kdcppt,norm) 
//  values('$tgl','$nomor','$nofaktur','$kdproduk','$qty',0,'$hargajual','$harga','$kdcabang','$kdcppt','$norm')");






// }






$sqls="SELECT * FROM ermcpptintruksi WHERE notransaksi='$nofaktur' 
AND   dari='mobat'";

$results=mysqli_query($conn,$sqls);

  


while($rows=mysqli_fetch_array($results,MYSQLI_ASSOC)) {



$kdproduks=$rows['kdpruduk'];
$aturan=$rows['aturan'];
$qty=$rows['qty'];
$statuso=$rows['statuso'];
$dari=$rows['dari'];
$keterangan=$rows['keterangan'];
$harga=$rows['harga'];
$obat=$rows['nama'];
$nomor=$rows['no'];


$signa =$rows['signa'];
$hari =$rows['hari'];
$frekuensi =$rows['frekuensi'];
$jmlpakai =$rows['jmlpakai'];

 $conn -> query("INSERT INTO ermcpptintruksi(notransaksi,kdkostumerd,norm,kddokter,kdpoli,kdpruduk,aturan,
    qty,statuso,status,dari,kduser,kdcabang,tgl,kdcppt,kunci,tglpriksa,keterangan,harga,nama,no,kd,dari2,signa,hari,frekuensi,jmlpakai) 
 values('$notransaksi','$kdkostumerd','$norm','$kddokter','$kdpoli','$kdproduks','$aturan','$qty','$statuso','0','$dari','$kduser','$kdcabang','$tgl','$kdcppt','0','$tgl','$keterangan','$harga','$obat','$nomor','$kdtamplate','CPPT','$signa','$hari','$frekuensi','$jmlpakai')");





}

 $conn -> query("INSERT INTO nomorracik(notransaksi,norm,kdcabang,nomor,status) 
 values('$notransaksi','$norm','$kdcabang','$kdtamplate','0')");








// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode('Sukses');

}

// Rollback transaction
$conn -> rollback();

$conn -> close();



}else if($stssimpan === '2'){



}else if($stssimpan === '3'){


}else if($stssimpan === '4'){


}else if($stssimpan === '5'){





}
   

 




?>