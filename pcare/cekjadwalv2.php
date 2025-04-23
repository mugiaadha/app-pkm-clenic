<?php

include 'sesi.php';
include 'fungsi.php';
include 'secretpcare.php';
include '../koneksi.php';

date_default_timezone_set('Asia/Bangkok');

$data = null;

$kdpoli = $_GET['kdpoli'];
$tgl = $_GET['tgl'];
$kdpoliin = $_GET['kdpoliin'];

$tanggal = date_create($_GET['tgl']);
$hari = date_format($tanggal, 'D');

switch ($hari) {
    case 'Sun': $hariq = 'minggu'; break;
    case 'Mon': $hariq = 'senin'; break;
    case 'Tue': $hariq = 'selasa'; break;
    case 'Wed': $hariq = 'rabu'; break;
    case 'Thu': $hariq = 'kamis'; break;
    case 'Fri': $hariq = 'jumat'; break;
    case 'Sat': $hariq = 'sabtu'; break;
    default: $hariq = null;
}

if (!$hariq) {
    echo json_encode(['error' => 'Invalid day']);
    exit;
}

$url = "https://apijkn.bpjs-kesehatan.go.id/antreanfktp/ref/dokter/kodepoli/" . $kdpoli . "/tanggal/" . $tgl;

$headers = [
    'Content-Type: Application/x-www-form-urlencoded',
    'x-cons-id: ' . $consID,
    'x-timestamp: ' . $tgl_unix,
    'x-signature: ' . $encodedSignature,
    'x-authorization: Basic ' . $encodedAuthorization,
    'user_key: ' . $userkeyan
];

$kiriml = sendDataBpjs('GET', $url, $headers, $data);
$response = json_decode($kiriml, true);

if ($response && $response['metadata']['code'] == 200) {
    $key = $consID . $secretKey . $tgl_unix;
    $dekrip = stringDecrypt($key, $response['response']);
    $hasil_response = json_decode(decompress($dekrip), true);

    if ($hasil_response === null || !is_array($hasil_response)) {
        echo json_encode(['error' => 'Failed to decrypt or decompress response.']);
        exit;
    }

    // Mulai transaksi
    $conn->begin_transaction();

    try {
        foreach ($hasil_response as $dokter) {
            $kodedokter = $dokter['kodedokter'];
            $jampraktek = $dokter['jampraktek'];
            $namadokter = $dokter['namadokter'];

            $query = "SELECT * FROM dokter WHERE kddokterbpjs = '$kodedokter'";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $kddokter = $row['kddokter'];

                // Update atau Insert ke jadwalpraktek
                $sqlcx = "SELECT * FROM jadwalpraktek WHERE kddokter = '$kddokter' AND kdpoli = '$kdpoliin'";
                $resultvx = mysqli_query($conn, $sqlcx);
                $rowcountx = mysqli_num_rows($resultvx);

                if ($rowcountx > 0) {
                    $conn->query("UPDATE jadwalpraktek SET $hariq = '$jampraktek' 
                                  WHERE kddokter = '$kddokter' AND kdpoli = '$kdpoliin'");
                } else {
                    $conn->query("INSERT INTO jadwalpraktek (kddokter, kdpoli, kuota, $hariq) 
                                  VALUES ('$kddokter', '$kdpoliin', '20', '$jampraktek')");
                }

                // Update atau Insert ke jadwalpraktekv2
                $sqlv = "SELECT * FROM jadwalpraktekv2 WHERE tgl = '$tgl' AND kddokter = '$kddokter' AND kdpoli = '$kdpoliin'";
                $resultv = mysqli_query($conn, $sqlv);
                $rowcount = mysqli_num_rows($resultv);

                if ($rowcount > 0) {
                    $conn->query("UPDATE jadwalpraktekv2 SET jadwal = '$jampraktek' 
                                  WHERE tgl = '$tgl' AND kddokter = '$kddokter' AND kdpoli = '$kdpoliin'");
                } else {
                    $conn->query("INSERT INTO jadwalpraktekv2 (tgl, kddokter, kdpoli, jadwal) 
                                  VALUES ('$tgl', '$kddokter', '$kdpoliin', '$jampraktek')");
                }
            }
        }

        // Commit transaksi jika semua berhasil
        $conn->commit();
        $pesan = 200;

    } catch (Exception $e) {
        // Rollback transaksi jika ada kesalahan
        $conn->rollback();
        $pesan = 201;
    }

    echo json_encode($pesan);
    $conn->close();

} else {
    if (in_array($kdpoli, ['005', '998', '999'])) {
        $pesan = 200;
    } else {
        $pesan = 201;
    }
    echo json_encode($pesan);
}
?>
