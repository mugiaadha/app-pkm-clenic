<?php
 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  


 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);


$tgldaftar = date("Y-m-d");



$tgl = date("Y-m-d H:i:s");


  include '../koneksi.php';
  


$kdklinik        =$data->kdklinik;
$kdcabang=$data->kdcabang;
$notransaksi=$data->notransaksi;
$norm=$data->norm;
$kduser=$data->kduser;
$stssimpan = $data->stssimpan;


if($stssimpan === '1'){


 $conn -> autocommit(FALSE);

 $query="SELECT 
a.kdobat,b.obat,a.qty,c.aturan
FROM jualobatd a
LEFT JOIN obat b ON a.kdobat = b.kdobat AND a.kdcabang = b.kdcabang
LEFT JOIN ermcpptintruksi c ON a.nofaktur = c.notransaksi AND a.kdobat = c.kdpruduk  AND a.nomor = c.`no` AND
a.kdcabang = c.kdcabang AND c.statuso <> 'Racik'
WHERE a.notransaksi='$notransaksi' and a.kdcabang='$kdcabang'";
        $result=mysqli_query($conn, $query);
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

            $kdobat = $row['kdobat'];
          $obat = $row['obat'];
  $qty = $row['qty'];
  $aturan = $row['aturan'];

            $sqlcek="SELECT * from etiket where notransaksi='$notransaksi' and kdobat='$kdobat' and kdcabang='$kdcabang' ";

      $resultcek=mysqli_query($conn,$sqlcek);
     $rowcountcek=mysqli_num_rows($resultcek);
            
     if($rowcountcek  > 0){


     }else{




        $conn -> query("INSERT INTO etiket(tgl,notransaksi,norm,kdobat,obat,
                  signa,qty,kdcabang,kduser) 
               values('$tgl','$notransaksi','$norm','$kdobat','$obat','$aturan','$qty','$kdcabang','$kduser')");
    }



        }


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

$conn -> autocommit(FALSE);

$obat=$data->obat;
$signa=$data->signa;
$aturan=$data->aturan;
$qty=$data->qty;
$keterangan=$data->keterangan;


    $conn -> query("INSERT INTO etiket(tgl,notransaksi,norm,kdobat,obat,
                  signa,aturanminum,qty,keterangan,kdcabang,kduser) 
               values('$tgl','$notransaksi','$norm','$obat','$obat','$signa','$aturan','$qty','$keterangan','$kdcabang','$kduser')");



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

}else if($stssimpan === '3'){

$conn -> autocommit(FALSE);
$kdobat=$data->kdobat;
$obat=$data->obat;
$signa=$data->signa;
$aturan=$data->aturan;
$qty=$data->qty;
$keterangan=$data->keterangan;




     $conn -> query("UPDATE etiket set 

        obat='$obat', signa='$signa',aturanminum='$aturan',qty='$qty',keterangan='$keterangan'
         where kdobat='$kdobat' and kdcabang='$kdcabang'
          and notransaksi='$notransaksi'
            ");

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


}else if($stssimpan === '4'){

$conn -> autocommit(FALSE);
$kdobat=$data->kdobat;
$obat=$data->obat;
$signa=$data->signa;
$aturan=$data->aturan;
$qty=$data->qty;
$keterangan=$data->keterangan;





      $conn -> query("DELETE from etiket  where kdobat='$kdobat' and kdcabang='$kdcabang'
          and notransaksi='$notransaksi'");




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

}  






  
?>

