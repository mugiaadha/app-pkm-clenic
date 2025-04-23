<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include '../koneksi.php';
$kdcabang = $_GET['kdcabang'];
$dokter = $_GET['dokter'];

$query = "SELECT * FROM dokter WHERE kdcabang='$kdcabang' AND kddokter='$dokter' ORDER BY namdokter ASC";
$response = array();
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $response[] = $row;
    }
    $status_code = 200;
} else {
    $response = array("message" => "Data tidak ditemukan");
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