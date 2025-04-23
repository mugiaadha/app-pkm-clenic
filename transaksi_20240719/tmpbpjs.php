<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");




$data = '{
    "response": {
        "noKartu": "0000039043765",
        "nama": "SUSIAMINI IMAM SOERADI",
        "hubunganKeluarga": "Peserta",
        "sex": "P",
        "tglLahir": "25-10-1939",
        "tglMulaiAktif": "12-11-2014",
        "tglAkhirBerlaku": "01-01-2050",
        "kdProviderPst": {
            "kdProvider": "0114U163",
            "nmProvider": "Klinik Cempaka Putih"
        },
        "kdProviderGigi": {
            "kdProvider": null,
            "nmProvider": null
        },
        "jnsKelas": {
            "nama": "KELAS I",
            "kode": "1"
        },
        "jnsPeserta": {
            "nama": "PENERIMA PENSIUN PNS",
            "kode": "15"
        },
        "golDarah": "0",
        "noHP": "",
        "noKTP": "",
        "pstProl": "HT",
        "pstPrb": "HT",
        "aktif": true,
        "ketAktif": "AKTIF",
        "asuransi": {
            "kdAsuransi": null,
            "nmAsuransi": null,
            "noAsuransi": null,
            "cob": false
        },
        "tunggakan": 0
    },
    "metaData": {
        "message": "OK",
        "code": 200
    }
}
';


// $data ='{
//   "response": {
//     "count": 2,
//     "list": [
//       {
//         "kdPoli": "001",
//         "nmPoli": "Umum",
//         "poliSakit":true
//       },
//       {
//         "kdPoli": "003",
//         "nmPoli": "K I A",
//         "poliSakit":true
//       }
//     ]
//   },
//   "metaData": {
//     "message": "OK",
//     "code": 200
//   }
// }';


// $data = json_encode($response);

echo $data;



?>