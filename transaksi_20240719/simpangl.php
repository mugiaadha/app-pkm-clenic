<?php
 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  


 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);


$tgldaftar = date("Ymd");





  include '../koneksi.php';
  


$kdklinik        =$data->kdklinik;
$kdcabang=$data->kdcabang;


$stssimpan=$data->stssimpan;



if($stssimpan === '1'){


 $conn -> autocommit(FALSE);
 
 $keterangan=$data->keterangan;
 $tglgl=$data->tglgl;


   $query="SELECT angka from autonum where kdnomor='23' and kdklinik='$kdklinik'";
        $result=mysqli_query($conn, $query);
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

        $angka = $row['angka']+1;
        }


$kdgl = $tgldaftar.$angka;

$conn -> query("INSERT INTO glpusat(kdgl,keterangan,tgl,kdcabang,status,dari) 
 values('$kdgl','$keterangan','$tglgl','$kdcabang','0','biasa')");



$conn -> query("UPDATE autonum set angka='$angka' where kdklinik='$kdklinik' and  kdnomor='23' ");




// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode($kdgl);

}

// Rollback transaction
$conn -> rollback();

$conn -> close();



}else if($stssimpan === '2'){


 $conn -> autocommit(FALSE);


 $keterangan=$data->keterangan;
 $tglgl=$data->tglgl;
 $nogl=$data->nogl;
 $kdcoa=$data->kdcoa;
 $jml=$data->jml;
 $kduser=$data->kduser;



$conn -> query("INSERT INTO glpusatd(kdgl,kdcoa,tgl,notrans,jml,kodeunit,kdcabang,kduser,keterangan,statusd,dari) 
 values('$nogl','$kdcoa','$tglgl','$nogl','$jml','$kdcoa','$kdcabang','$kduser','$keterangan','0','biasa')");



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

}else if($stssimpan === '3'){


 $conn -> autocommit(FALSE);



 $nogl=$data->nogl;
 $kdcoa=$data->kdcoa;
 $no=$data->no;




 $conn -> query("DELETE from glpusatd  where kdgl='$nogl' and kdcoa='$kdcoa' and kdcabang='$kdcabang' and statusd='0' and no='$no'");



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



}else if($stssimpan === '4'){


 $conn -> autocommit(FALSE);

  $tgldarix = $data->tgldari;

  $tgldari = strtotime($tgldarix);
 $kduser=$data->kduser;


$tahun = date('Y',$tgldari);
$bulan = date('m',$tgldari);



        $sqlcek="SELECT * from prosesgl where  kdcabang='$kdcabang' and MONTH(tgl)='$bulan' and year(tgl)='$tahun'";

      $resultcek=mysqli_query($conn,$sqlcek);
     $rowcountcek=mysqli_num_rows($resultcek);
            
     if($rowcountcek  > 0){

          // $pesan='Bulan Ini Sudah Di Proses Silahkan Batal Proses Dulu';

      $pesan=201;



     }else{

  $query="SELECT angka from autonum where kdnomor='23' and kdklinik='$kdklinik'";
        $result=mysqli_query($conn, $query);
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

        $angka = $row['angka']+1;
        }


$kdgl = $tgldaftar.$angka;

$conn -> query("INSERT INTO glpusat(kdgl,keterangan,tgl,kdcabang,status,dari) 
 values('$kdgl','Pendapatan Instalasi bulan $bulan tahun $tahun','$tgldarix','$kdcabang','1','otomatis')");





   $queryl="SELECT sum(a.tagihan) AS total ,c.costumer,'RJ' AS sts 
 FROM transaksiakhir a,
 kelompokkostumerd b,kelompokkostumer c
  WHERE a.kdkostumer = b.kdkostumerd AND b.kdkostumer = c.kdkostumer and
  
  MONTH(a.tglfaktur)='$bulan' AND YEAR(a.tglfaktur)='$tahun' and a.kdcabang='$kdcabang'
    GROUP BY c.costumer";
        $resultl=mysqli_query($conn, $queryl);
        while($rowl=mysqli_fetch_array($resultl,MYSQLI_ASSOC)) {



if($rowl['costumer'] === 'ASURANSI'){
$kdcoa = '401.002';
$keterangan = ' RAWAT JALAN - NON BPJS '.$rowl['sts'];

}else if($rowl['costumer'] === 'BPJS'){
$kdcoa = '401.001';
$keterangan = ' RAWAT JALAN - BPJS '.$rowl['sts'];

}else if($rowl['costumer'] === 'UMUM'){
$kdcoa = '401.002';
$keterangan = ' RAWAT JALAN - NON BPJS '.$rowl['sts'];
}

$jml = $rowl['total'];

$conn -> query("INSERT INTO glpusatd(kdgl,kdcoa,tgl,notrans,jml,kodeunit,kdcabang,kduser,keterangan,statusd,dari) 
 values('$kdgl','$kdcoa','$tgldarix','$kdgl','$jml','$kdgl','$kdcabang','$kduser','$keterangan','1','otomatis')");



        }







$queryfar="SELECT sum(
a.totalbayar) AS total,c.costumer,'Farmasi' AS sts
from jualobat a ,
 kelompokkostumerd b,kelompokkostumer c
 WHERE a.kdkostumer = b.kdkostumerd AND b.kdkostumer = c.kdkostumer AND
 MONTH(a.tgl)='$bulan' AND YEAR(a.tgl)='$tahun'  and a.kdcabang='$kdcabang' GROUP BY c.costumer";
         $resultlfar=mysqli_query($conn, $queryfar);
        while($rowlfar=mysqli_fetch_array($resultlfar,MYSQLI_ASSOC)) {



if($rowlfar['costumer'] === 'ASURANSI'){
$kdcoaf = '403.002';
$keteranganf = ' FARMASI - NON BPJS '.$rowlfar['sts'];

}else if($rowlfar['costumer'] === 'BPJS'){
$kdcoaf = '403.001';
$keteranganf = ' FARMASI- BPJS '.$rowlfar['sts'];

}else if($rowlfar['costumer'] === 'UMUM'){
$kdcoaf = '403.002';
$keteranganf = ' FARMASI - NON BPJS '.$rowlfar['sts'];
}


$jmlf = $rowlfar['total'];

$conn -> query("INSERT INTO glpusatd(kdgl,kdcoa,tgl,notrans,jml,kodeunit,kdcabang,kduser,keterangan,statusd,dari) 
 values('$kdgl','$kdcoaf','$tgldarix','$kdgl','$jmlf','$kdgl','$kdcabang','$kduser','$keteranganf','1','otomatis')");



        }
  





$queryfarx="SELECT sum(a.hargabeli*a.qty) AS total
FROM jualobatd a ,obat b
WHERE a.kdobat = b.kdobat AND
 MONTH(a.tgl)='$bulan' AND YEAR(a.tgl)='$tahun'  and a.kdcabang='$kdcabang' AND a.status='1'";
         $resultlfarx=mysqli_query($conn, $queryfarx);
        while($rowlfarx=mysqli_fetch_array($resultlfarx,MYSQLI_ASSOC)) {

          $jmlfx=$rowlfarx['total'];
          $keteranganfx='HARGA POKOK FARMASI';
           $kdcoafx='610.000';

$conn -> query("INSERT INTO glpusatd(kdgl,kdcoa,tgl,notrans,jml,kodeunit,kdcabang,kduser,keterangan,statusd,dari) 
 values('$kdgl','$kdcoafx','$tgldarix','$kdgl','$jmlfx','$kdgl','$kdcabang','$kduser','$keteranganfx','1','otomatis')");



        }
  









$conn -> query("UPDATE glpusatd set statusd='1' where kdcabang='$kdcabang' and  MONTH(tgl)='$bulan' and year(tgl)='$tahun' and dari ='biasa' ");


$conn -> query("UPDATE glpusat set status='1' where kdcabang='$kdcabang' and  MONTH(tgl)='$bulan' and year(tgl)='$tahun' and dari ='biasa' ");


$conn -> query("INSERT INTO prosesgl(kdcabang,tgl,kduser) 
 values('$kdcabang','$tgldarix','$kduser')");



$conn -> query("UPDATE autonum set angka='$angka' where kdklinik='$kdklinik' and  kdnomor='23' ");

$conn -> query("UPDATE transaksipasiend set prosestutup='1' where kdcabang='$kdcabang' and
 MONTH(tgltransaksi)='$bulan' AND YEAR(tgltransaksi)='$tahun'  and jenistransaksi='KR'");



// $conn -> query("UPDATE jualobatd set tutup='Ya' where kdcabang='$kdcabang' and
//  MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'");


$conn -> query("UPDATE jualobat set kunci='1' where kdcabang='$kdcabang' and
 MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun' and statuslunas='2'");


$pesan=200;
      
          
     }


 

// Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode($pesan);

}

// Rollback transaction
$conn -> rollback();

$conn -> close();

}else if($stssimpan === '5'){

 $conn -> autocommit(FALSE);

   $tgldarix = $data->tgldari;

  $tgldari = strtotime($tgldarix);
 $kduser=$data->kduser;


$tahun = date('Y',$tgldari);
$bulan = date('m',$tgldari);

$conn -> query("UPDATE glpusatd set statusd='0' where kdcabang='$kdcabang' and  MONTH(tgl)='$bulan' and year(tgl)='$tahun' and dari ='biasa' ");


$conn -> query("UPDATE glpusat set status='0' where kdcabang='$kdcabang' and  MONTH(tgl)='$bulan' and year(tgl)='$tahun' and dari ='biasa' ");



$conn -> query("UPDATE transaksipasiend set prosestutup='0' where kdcabang='$kdcabang' and
 MONTH(tgltransaksi)='$bulan' AND YEAR(tgltransaksi)='$tahun' and  jenistransaksi='KR'");



// $conn -> query("UPDATE jualobatd set tutup='Tidak' where kdcabang='$kdcabang' and
//  MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'");

$conn -> query("UPDATE jualobat set kunci='0' where kdcabang='$kdcabang' and
 MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun' and statuslunas='2'");


 $conn -> query("DELETE from glpusatd  where  kdcabang='$kdcabang' and statusd='1' and dari='otomatis' and
 MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'");

 $conn -> query("DELETE from glpusat  where  kdcabang='$kdcabang'  and dari='otomatis' and
 MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'");


 $conn -> query("DELETE from prosesgl  where  kdcabang='$kdcabang'  and
 MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun'");




  // Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode('Sukses Batal');

}

// Rollback transaction
$conn -> rollback();

$conn -> close();
}else if($stssimpan === '6'){
 $conn -> autocommit(FALSE);
 $nogl=$data->nogl;


 $conn -> query("DELETE from glpusatd  where  kdcabang='$kdcabang' and statusd='0'  and kdgl='$nogl'");

 $conn -> query("DELETE from glpusat  where  kdcabang='$kdcabang'  and status='0' and kdgl='$nogl'");





    // Commit transaction
if (!$conn -> commit()) {
  // echo "Commit transaction failed";
    echo json_encode('Gagal');
 

  exit();
}else{
echo json_encode('Sukses ');

}

// Rollback transaction
$conn -> rollback();

$conn -> close();
}






  
?>

