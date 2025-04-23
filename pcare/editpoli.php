<?php
include 'sesi.php';
include 'fungsi.php';
include 'secretpcare.php';
include 'configpcare.php';
date_default_timezone_set('Asia/Bangkok');

$data = null;

$url = $serverklaim . 'poli/fktp/0/30';

$headers = array(
    'Content-Type: Application/x-www-form-urlencoded',
    'X-cons-id: ' . $consID . '',
    'X-timestamp: ' . $tgl_unix . '',
    'X-signature: ' . $encodedSignature . '',
    'X-authorization: Basic ' . $encodedAuthorization . '',
    'user_key: ' . $userkey . ''
);

$kirim = sendDataBpjs('GET', $url, $headers, $data);
$response = json_decode($kirim, true);

if ($response['metaData']['code'] == 200 && isset($response['response'])) {
    $key = $consID . $secretKey . $tgl_unix;
    $dekrip = stringDecrypt($key, $response['response']);
    $hasil_response = decompress($dekrip);
    $poli_list = json_decode($hasil_response, true);

    if (!empty($poli_list['list'])) {
        include '../koneksi.php';

        foreach ($poli_list['list'] as $poli) {
            $kdPoli = $poli['kdPoli'];
            if (in_array($kdPoli, ['998', '999', '005'])) {
                $poliSakit = 0; // Jika kdPoli termasuk dalam daftar tertentu, statusdaftar = 0
            } else {
                $poliSakit = $poli['poliSakit'] ? 1 : 0; // Jika tidak, gunakan nilai poliSakit
            }

            $query = "UPDATE poliklinik SET statusdaftar = $poliSakit WHERE kdpolibpjs = '" . mysqli_real_escape_string($conn, $kdPoli) . "'";

            if (mysqli_query($conn, $query)) {
                echo "Berhasil memperbarui data untuk kdPoli: $kdPoli\n";
            } else {
                echo "Gagal memperbarui data untuk kdPoli: $kdPoli. Error: " . mysqli_error($conn) . "\n";
            }
        }

        mysqli_close($conn);
    } else {
        echo "Tidak ada data poli yang ditemukan dalam respons.";
    }
} else {
    echo "Gagal mendapatkan data dari BPJS. Kode: " . $response['metaData']['code'] . " Pesan: " . $response['metaData']['message'];
}
?>
