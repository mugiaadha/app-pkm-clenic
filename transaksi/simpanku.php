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
  










    $notransaksi  = $data->notransaksi;
  $norm= $data->norm;
  $keterangan= $data->keterangan;
  $kulit=$data->kulit;
  $kuku=$data->kuku;
  $kepala=$data->kepala;
  $wajah=$data->wajah;
  $mata=$data->mata;
  $telinga=$data->telinga;
  $hidung=$data->hidung;
  $mulut=$data->mulut;
  $leher=$data->leher;
  $dada=$data->dada;
  $abdomen=$data->abdomen;
  $ekstermis=$data->ekstermis;



 $conn -> autocommit(FALSE);


            $sqlcek="SELECT * from keadaanfisik where notrans='$notransaksi' ";

      $resultcek=mysqli_query($conn,$sqlcek);
     $rowcountcek=mysqli_num_rows($resultcek);
            
     if($rowcountcek  > 0){


          $conn -> query("UPDATE keadaanfisik set keterangan='$keterangan',kulit='$kulit',kuku='$kuku',
                  kepala='$kepala',wajah='$wajah',mata='$mata',telinga='$telinga',hidung='$hidung',mulut='$mulut',leher='$leher',dada='$dada',
                  abdomen='$abdomen',ekstermis='$ekstermis' where notrans='$notransaksi' ");




     }else{




        $conn -> query("INSERT INTO keadaanfisik(notrans,norm,keterangan,kulit,kuku,
                  kepala,wajah,mata,telinga,hidung,mulut,leher,dada,abdomen,ekstermis) 
               values('$notransaksi','$norm','$keterangan','$kulit','$kuku','$kepala','$wajah','$mata','$telinga','$hidung','$mulut','$leher','$dada','$abdomen','$ekstermis')");
    }




//  $query="SELECT 
// a.kdobat,b.obat,a.qty,c.aturan
// FROM jualobatd a
// LEFT JOIN obat b ON a.kdobat = b.kdobat AND a.kdcabang = b.kdcabang
// LEFT JOIN ermcpptintruksi c ON a.nofaktur = c.notransaksi AND a.kdobat = c.kdpruduk  AND a.nomor = c.`no` AND
// a.kdcabang = c.kdcabang AND c.statuso <> 'Racik'
// WHERE a.notransaksi='$notransaksi' and a.kdcabang='$kdcabang'";
//         $result=mysqli_query($conn, $query);
//         while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

//             $kdobat = $row['kdobat'];
//           $obat = $row['obat'];
//   $qty = $row['qty'];
//   $aturan = $row['aturan'];



//         }


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








  
?>

