<?php
 header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin,Content-Type');
  


 date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_POST = json_decode( $rest_json, true );
$data = json_encode( $_POST );

$data = json_decode( $data);




$tgl = date("Y-m-d H:i:s");
$tglk = date("y");

  include '../koneksi.php';
  




 $namarep = str_replace("'"," ` ", $data->nama);




$nama=strtoupper($namarep);


$tlahir=$data->tlahir;


$jk         = $data->jeniskelamin;
$tgl_lahir  = $data->tanggallahir;
$alamat     = $data->alamat;

$kdklinik        =$data->kdklinik;
$kdcabang=$data->kdcabang;

$kd_desa    = $data->kodekel;



$identitas        = $data->identitas;


if (empty($data->noidentitas)) {
 // do something

    $noidentitas       = '';
}else{
  $noidentitas       = $data->noidentitas;
}





if (empty($data->nohp)) {
 // do something

$nohp       = '' ;
}else{
$nohp       = $data->nohp;
}


$agama       = $data->agama;
$kdpanggil = $data->kdpanggil;
$marital      = $data->marital;
$pendidikan       = $data->pendidikan;
$perkerjaan     = $data->perkerjaan;
$golda       = $data->golda;

$stssimpan = $data->stssimpan;

 

if($stssimpan === '1'){


 $conn -> autocommit(FALSE);



$query="SELECT angka from autonum where kdnomor='15' and kdklinik='$kdklinik'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$urutrm = $row['angka']+1;
}





 


    //----------------------------------------------------------------------------------------------
    if ( $urutrm >= 999999 ) {
        $uruttm = 1;
    }
    if ( strlen( $urutrm ) == 6 ) {
        $nomer = $urutrm;
    } elseif ( strlen( $urutrm ) == 5 ) {
        $nomer = '0'.$urutrm;
    } elseif ( strlen( $urutrm ) == 4 ) {
        $nomer = '00'.$urutrm;
    } elseif ( strlen( $urutrm ) == 3 ) {
        $nomer = '000'.$urutrm;
    } elseif ( strlen( $urutrm ) == 2 ) {
        $nomer = '0000'.$urutrm;
    } elseif ( strlen( $urutrm ) == 1 ) {
        $nomer = '00000'.$urutrm;
    }
   $no = $kdcabang.'-'.$tglk.$nomer;




if(strlen( $data->norm ) > 2){
    $no = $data->norm;
    
}else{
    
     $no =$nomer;
}



  $conn -> query("INSERT INTO pasien(norm,kdkelurahan,pasien,tgllahir,jeniskelamin,statusmarital,agama,
alamat,alamatsekarang,hp,tandapengenal,nopengenal,tempatlahir,golda,kdcabang,kdklinik,tgl,pendidikan,perkerjaan,noasuransi) 
 values('$no','$kd_desa','$nama','$tgl_lahir','$jk','$marital','$agama','$alamat','$alamat','$nohp','$identitas',
'$noidentitas','$tlahir','$golda','$kdcabang','$kdklinik','$tgl','$pendidikan','$perkerjaan','$data->noasuransi')");


$conn -> query("UPDATE autonum set angka='$urutrm' where kdklinik='$kdklinik' and  kdnomor='15' ");





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

}else if($stssimpan === '12'){

  $conn -> autocommit(FALSE);



$query="SELECT angka from autonum where kdnomor='15' and kdklinik='$kdklinik'";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

$urutrm = $row['angka']+1;
}




$queryd="SELECT 
a.kdkostumer,a.costumer,d.kdkostumerd ,d.nama
FROM kelompokkostumer a,kelompokkostumerd d
WHERE a.kdkostumer = d.kdkostumer AND a.dash='BPJS'";
$resultd=mysqli_query($conn, $queryd);
while($rowd=mysqli_fetch_array($resultd,MYSQLI_ASSOC)) {

$kdkostumerd = $rowd['kdkostumerd'];
$kdkostumer = $rowd['kdkostumer'];

}




 


    //----------------------------------------------------------------------------------------------
    if ( $urutrm >= 999999 ) {
        $uruttm = 1;
    }
    if ( strlen( $urutrm ) == 6 ) {
        $nomer = $urutrm;
    } elseif ( strlen( $urutrm ) == 5 ) {
        $nomer = '0'.$urutrm;
    } elseif ( strlen( $urutrm ) == 4 ) {
        $nomer = '00'.$urutrm;
    } elseif ( strlen( $urutrm ) == 3 ) {
        $nomer = '000'.$urutrm;
    } elseif ( strlen( $urutrm ) == 2 ) {
        $nomer = '0000'.$urutrm;
    } elseif ( strlen( $urutrm ) == 1 ) {
        $nomer = '00000'.$urutrm;
    }
   $no = $kdcabang.'-'.$tglk.$nomer;


// $tglku = date('Y-m-d',$tgl_lahir);

$tahun =  substr($tgl_lahir,6,4);
$bulan = substr($tgl_lahir,3,-5);
$hari = substr($tgl_lahir,0,-8);


$tglku = $tahun.'-'.$bulan.'-'.$hari;

  $conn -> query("INSERT INTO pasien(norm,kdkelurahan,pasien,tgllahir,jeniskelamin,statusmarital,agama,
alamat,alamatsekarang,hp,tandapengenal,nopengenal,tempatlahir,golda,kdcabang,kdklinik,tgl,pendidikan,perkerjaan,noasuransi,kdasuransi) 
 values('$no','$kd_desa','$nama','$tglku','$jk','$marital','$agama','$alamat','$alamat','$nohp','$identitas',
'$noidentitas','$tlahir','$golda','$kdcabang','$kdklinik','$tgl','$pendidikan','$perkerjaan','$data->noasuransi','$kdkostumerd')");


$conn -> query("UPDATE autonum set angka='$urutrm' where kdklinik='$kdklinik' and  kdnomor='15' ");





// Commit transaction
if (!$conn -> commit()) {
$value = array(
  
     "norm" => $no,
   "kdasuransi" => $kdkostumerd,
 "kdkostumer" => $kdkostumer




);

echo json_encode( $value );
 

  exit();
}else{
$value = array(
  
     "norm" => $no,
   "kdasuransi" => $kdkostumerd,
   "kdkostumer" => $kdkostumer





);

echo json_encode( $value );

}

// Rollback transaction
$conn -> rollback();

$conn -> close();




}else if($stssimpan === '2'){


 $conn -> autocommit(FALSE);

$norm=$data->norm;

$conn -> query("UPDATE pasien set

kdkelurahan='$kd_desa',pasien='$nama',tgllahir='$tgl_lahir',jeniskelamin='$jk',statusmarital='$marital',agama='$agama',
 alamat='$alamat',alamatsekarang='$alamat',hp='$nohp',tandapengenal='$identitas',
 nopengenal='$noidentitas',tempatlahir='$tlahir',golda='$golda',pendidikan='$pendidikan',perkerjaan='$perkerjaan'
 ,noasuransi='$data->noasuransi'
where kdklinik='$kdklinik' and norm='$norm' ");



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

$norm=$data->norm;


     $sql="SELECT norm FROM kunjunganpasien WHERE kdcabang='$kdcabang' AND norm='$norm' ORDER BY norm LIMIT 1";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){
  $pesan = array(
        'metadata'=>array(
            'code'=>201,
             'message'=>'Pasien Sudah pernah Priksa tidak bisa di hapus'
        )
    );

}else{

$conn -> query("DELETE FROM pasien where kdcabang='$kdcabang' and norm='$norm'");


  $pesan = array(
        'metadata'=>array(
            'code'=>200,
             'message'=>'Berhasil Hapus'
        )
    );

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


}


  
?>

