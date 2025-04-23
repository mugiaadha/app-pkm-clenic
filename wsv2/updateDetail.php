<?php
include 'sesi.php';
 include 'koneksi.php';


date_default_timezone_set( 'Asia/Bangkok' );

$rest_json = file_get_contents( 'php://input' );
$_PUT = json_decode( $rest_json, true );
$data = json_encode( $_PUT['data'] );
$data = json_decode( $data, true );







$statement = $db->prepare('insert into HASILORDERLABLIS
                       (id, notransaksi, kodepemeriksaan, namapemeriksaan, hasil, flag, satuan, nilainormal, metoda)
                        Values
                     (:id,:NoOrder,:ParameterID,:Parameter,:Hasil,:Flag,:Satuan,:NilaiNormal,:Metode)');

$statement->execute([
    'id' => $data['DetailID'],
    
       'NoOrder'=>$data['NoOrder'],
      'ParameterID'=>$data['ParameterID'],
      'Parameter'=> $data['Parameter'],
      'Satuan'=> $data['Satuan'],
      'NilaiNormal'=> $data['NilaiNormal'],
      'Metode'=> $data['Metode'],
      'Hasil'=> $data['Hasil'],
      'Flag'=> $data['Flag'],
      

]);


$notrans= $data['NoOrder'];
$kdp= $data['ParameterID'];



    $sql = "update ORDERLABLIS set
            status='2'  where notransaksi='$notrans' and kodepemeriksaan='$kdp' ";
    $query = $db->prepare( $sql );
    $query->execute();


   $pesan = array(
        'metadata'=>array(
            'code'=>200,
            'message'=>'Ok'
        )
    );

    echo json_encode( $pesan );



?>