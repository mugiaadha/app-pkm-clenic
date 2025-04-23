<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include '../koneksi.php';
$kdcabang = $_GET['kdcabang'];
$dokter = $_GET['dokter'];
$kdpoli = $_GET['kdpoli'];
$tgl = $_GET['tgl'];


$query = "SELECT a.noantrian,b.kodeantrian FROM antrian a,dokterklinik b
WHERE 
 a.kddokter = b.kddokter AND a.kdcabang = b.kdcabang and
 a.kdcabang='$kdcabang' AND a.kddokter='$dokter'
AND a.kdpoli='$kdpoli' AND a.tglpriksa='$tgl'
ORDER BY a.noantrian DESC LIMIT 1";


$response = array();
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $response[] = $row;
    }
    $status_code = 200;
} else {
    $response[] = array(
        "noantrian" => 1,
        "kodeantrian" => "A",
        "message" => "Data tidak ditemukan, default value digunakan"
    );
    $status_code = 201;
}

http_response_code($status_code);
$response_with_code = array(
    "status_code" => $status_code,
    "response" => $response
);

$data = json_encode($response_with_code);
echo preg_replace('/\\r\\n|\\r|\\n\\r|\\n/m', ' ', $data);

mysqli_close($conn);
?>